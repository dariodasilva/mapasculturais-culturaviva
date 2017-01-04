<?php

namespace CulturaViva\Controllers;

use MapasCulturais\App;
use CulturaViva\Entities\Certificador as CertificadorEntity;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * API usado no gerenciamento de agentes de certificação
 */
class Certificador extends \MapasCulturais\Controller {

    /**
     * Lista todos os certificadores cadastrados, com informações sobre o
     * status dos processos
     */
    function GET_listar() {
        $this->requireAuthentication();
        $app = App::i();

        $query = "
            WITH avaliacoes AS (
                SELECT
                    f.certificador_id,
                    f.estado,
                    count(*) AS qtd
                FROM (
                    SELECT
                        certificador_id,
                        CASE
                            WHEN estado = ANY(ARRAY['D','I']) THEN 'F'
                            ELSE estado
                        END AS estado
                    FROM culturaviva.avaliacao
                    WHERE estado <> 'C'
                ) f
                GROUP BY f.certificador_id, f.estado
            )
            SELECT
                c.*,
                a.name AS agente_nome,
                COALESCE(ap.qtd, 0) AS avaliacoes_pendentes,
                COALESCE(aa.qtd, 0) AS avaliacoes_em_analise,
                COALESCE(af.qtd, 0) AS avaliacoes_finalizadas
            FROM culturaviva.certificador c
            JOIN agent a ON a.id = c.agente_id
            LEFT JOIN avaliacoes ap ON ap.certificador_id = c.id AND ap.estado = 'P'
            LEFT JOIN avaliacoes aa ON aa.certificador_id = c.id AND aa.estado = 'A'
            LEFT JOIN avaliacoes af ON af.certificador_id = c.id AND af.estado = 'F'";

        $rsm = new ResultSetMapping();

        $campos = [
            'id',
            'agente_id',
            'agente_nome',
            'ativo',
            'tipo',
            'ts_criacao',
            'ts_atualizacao',
            'avaliacoes_pendentes',
            'avaliacoes_em_analise',
            'avaliacoes_finalizadas',
        ];
        foreach ($campos as $field) {
            $prop = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $field))));
            $rsm->addScalarResult($field, $prop);
        }

        $registros = $app->em->createNativeQuery($query, $rsm)->getResult();
        $this->json($registros);
    }

    /**
     * Permite salvar certificadores.
     *
     * Somente usuários com perfil AGENTE DA AREA pode fazer alterações nos certificadores
     *
     * @see CulturaViva\Entities\Certifier
     */
    function POST_salvar() {
        $this->requireAuthentication();
        $app = App::i();

        $data = json_decode($app->request()->getBody());

        // Salva detalhes do certificador
        $certificador = null;
        if (isset($data->id)) {
            $certificador = reset(App::i()->repo('\CulturaViva\Entities\Certificador')->find($data->id));
        }

        if ($certificador) {
            $certificador->tsAtualizacao = new \DateTime(date('Y-m-d H:i:s'));
        } else {
            $certificador = new CertificadorEntity();
            $certificador->id = null;
            $certificador->tsCriacao = date('Y-m-d H:i:s');
        }
        $certificador->ativo = $data->ativo;
        $certificador->agenteId = $data->agenteId;
        $certificador->tipo = $data->tipo;
        $certificador->titular = $data->titular;

        // Validação de consistencia
        $tiposValidos = [CertificadorEntity::TP_PUBLICO, CertificadorEntity::TP_CIVIL, CertificadorEntity::TP_MINERVA];
        if (!in_array($certificador->tipo, $tiposValidos)) {
            throw new \Exception('O tipo do Agente Certificador informado é inválido');
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

        $this->json($certificador);
    }

    /**
     * Pesquisa de agentes por nome, para cadastro de certificador
     *
     * @param string $nome O nome do agente sendo buscado
     */
    function GET_buscarAgente() {
        $this->requireAuthentication();
        $app = App::i();

        $nome = $this->data['nome'];

        // Agente, diferente do usuario atual
        $query = 'SELECT
                    a.id,
                    a.userId,
                    a.name
                FROM \MapasCulturais\Entities\Agent a
                JOIN a.user u
                WHERE a.user <> :usuario
                AND unaccent(lower(a.name)) LIKE unaccent(lower(:nome))
                ';

        $agents = $app->em->createQuery($query)
                ->setParameters([
                    'usuario' => $app->user,
                    'nome' => "%$nome%"
                ])
                ->setMaxResults(10)
                ->getResult();

        $this->json($agents);
    }

}
