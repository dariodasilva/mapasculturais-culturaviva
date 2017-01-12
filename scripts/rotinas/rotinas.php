<?php

require __DIR__ . '/../../src/protected/application/bootstrap.php';

/**
 * Rotina para importação das inscrições cadastradas
 * 
 * O fluxo de certificação se inicia quando a rotina de importação de inscrições é acionada, esta tem
 * a responsabilidade de verificar quais inscrições de pontos de cultura estão concluídas e ainda não estão
 * participando do processo de certificação (novos cadastros).
 * 
 * A rotina irá criar o registro para cada inscrição (culturaviva.inscricao) atribuindo o estado "[P] Pendente".
 * 
 * Neste momento, deve registrar também os critérios de avaliação da inscrição (culturaviva.inscricao_criterio).
 * 
 * Estados da inscrição
 * 
 * P - Pendente
 * C - Certificado
 * N - Não Certificado
 * R - Re Submissão - Inscrição rejeitada pelos certificadores, cadastro alterado pelo Ponto de Cultura e nova Inscrição criada para reavaliação
 * 
 * 
 * ALGORITMO
 * 
 * 1 - Buscar todos os cadastros finalizados que não possui inscrição com estado [P], [C] OU [R]
 * 2 - Para cada registro:
 *  2.1 - Criar registro de inscrição culturaviva.inscricao
 *  2.2 - Registrar os critérios da avaliação (culturaviva.inscricao_criterio)
 */
class RotinaImportarInscricoes {

    public static function executar() {
        $app = MapasCulturais\App::i();

        $conn = $app->em->getConnection();


        $cadastros = $conn->fetchAll(file_get_contents(__DIR__ . '/importar-inscricoes.sql'));

        foreach ($cadastros as $index => $cadastro) {
            $cadastro = (array) $cadastro;

            $self::criarInscricao($cadastro);
        }
    }

    /**
     * Cria o registro de uma inscrição a partir das informações do cadastro do ponto de cultura
     * 
     * @param type $cadastro
     * @return type
     */
    private static function criarInscricao($cadastro) {
        $this->requireAuthentication();
        $app = App::i();

        $data = json_decode($app->request()->getBody());

        // Salva detalhes do certificador
        $certificador = null;
        if (isset($data->id)) {
            $certificador = App::i()->repo('\CulturaViva\Entities\Certificador')->find($data->id);
        }

        if ($certificador) {
            $certificador->tsAtualizacao = date('Y-m-d H:i:s');
        } else {
            $certificador = new CertificadorEntity();
            $certificador->id = null;

            // Dados estáticos, nao recebem atualização
            $certificador->tsCriacao = date('Y-m-d H:i:s');
            $certificador->agenteId = $data->agenteId;
            $certificador->tipo = $data->tipo;
        }

        // Permite alterar apenas status e grupo do certificador
        $certificador->ativo = $data->ativo ? 't' : 'f';
        $certificador->titular = $data->titular ? 't' : 'f';

        // Validação de consistencia
        $tiposValidos = [CertificadorEntity::TP_PUBLICO, CertificadorEntity::TP_CIVIL, CertificadorEntity::TP_MINERVA];
        if (!in_array($certificador->tipo, $tiposValidos)) {
            return $this->json(["message" => 'O tipo do Agente Certificador informado é inválido'], 400);
        }

        // Verifica se já existe cadastro do mesmo agente como certificador do mesmo tipo
        $salvos = App::i()->repo('\CulturaViva\Entities\Certificador')->findBy(['agenteId' => $certificador->agenteId]);
        if ($salvos) {
            $tiposPC = [CertificadorEntity::TP_PUBLICO, CertificadorEntity::TP_CIVIL];
            foreach ($salvos as $salvo) {
                if ($salvo->id == $certificador->id) {
                    continue;
                }

                // Impedir registrar o mesmo agente para o mesmo tipo (independente se ativo ou nao)
                if ($salvo->tipo === $certificador->tipo) {
                    return $this->json(["message" => 'Agente Certificador já registrado com o Tipo informado'], 400);
                }

                if ($salvo->ativo) {
                    // Certificador não pode ser PUBLICO e CIVIL ao mesmo tempo
                    if (in_array($certificador->tipo, $tiposPC) && in_array($salvo->tipo, $tiposPC)) {
                        return $this->json(["message" => 'Agente Certificador não pode ser "Publico" e "Civil" simultaneamente'], 400);
                    }
                }
            }
        }


        $certificador->save();

        //-------------------------------------------
        // Faz a manutenção das permissões do usuario

        /**
         * @var \MapasCulturais\Entities\User
         */
        $usuario = $app->repo('Agent')->find($certificador->agenteId);

        $perfilUsuario = null;
        if ($certificador->tipo == CertificadorEntity::TP_PUBLICO) {
            $perfilUsuario = CertificadorEntity::ROLE_PUBLICO;
        } else if ($certificador->tipo == CertificadorEntity::TP_CIVIL) {
            $perfilUsuario = CertificadorEntity::ROLE_CIVIL;
        } else {
            $perfilUsuario = CertificadorEntity::ROLE_MINERVA;
        }
        if ($certificador->ativo) {
            $usuario->addRole($perfilUsuario);
        } else {
            $usuario->removeRole($perfilUsuario);
        }

        $app->em->flush();
    }

}

/**
 * 
 */
class RotinaDistribuirInscricoes {

    public static function executar() {
        $app = MapasCulturais\App::i();

        $conn = $app->em->getConnection();


        $result = $conn->fetchAll(file_get_contents(__DIR__ . '/importar-inscricoes.sql'));

        foreach ($result as $index => $avaliacao) {
            $avaliacao = (array) $avaliacao;

            $avaliacao['area'] = fetchTerms(2, 'Agent', $avaliacao['id']);

            if ($index == 0) {
                $obj_keys = array_keys($avaliacao);
                file_put_contents('output/agents.csv', arrayToCsv($obj_keys) . "\n", FILE_APPEND);
            }
            file_put_contents('output/agents.csv', arrayToCsv($avaliacao) . "\n", FILE_APPEND);
        }
    }

}

// Executa a importação
ImportarInscricoes::executar();
