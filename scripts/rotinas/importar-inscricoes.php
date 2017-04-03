<?php

require __DIR__ . '/../../../../../../protected/application/bootstrap.php';

// Remove timeout de execução do script
set_time_limit(0);

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
function loadScript($file) {
    return file_get_contents(__DIR__ . "/importar/$file");
}

function importar() {
    $app = MapasCulturais\App::i();
    $conn = $app->em->getConnection();



    print("1   - Registra as inscricoes dos pontos de cultura\n");
    $conn->executeQuery(loadScript('1-registrar-inscricoes.sql'));

    print("2   - Registra os criterios das inscricoes\n");
    $conn->executeQuery(loadScript('2-registrar-criterios-inscricoes.sql'));

    print("3   - Associar avaliacao a certificador\n");
    $totalInscricoes = $conn->fetchColumn(loadScript('3-obter-total-inscricoes.sql'));

    print("3.1 - Total de inscricoes nao associadas a avaliacao: $totalInscricoes\n");

    print("3.3 - Obter inscricoes sem avaliacao:\n");
    inserirAvaliacaoCertificador($conn, ['tipo' => 'C']);
    inserirAvaliacaoCertificador($conn, ['tipo' => 'P']);
}

/**
 * Associa avaliações para certificadores da sociedade civil para inscrições que ainda não possuem
 *
 * @param type $conn
 * @param Array $filtro
 * @return type
 */
function inserirAvaliacaoCertificador($conn, $filtro) {
    print("         - Distribuindo avaliacoes para certificadores do tipo: \"" . $filtro['tipo'] . "\"\n");

    $inscricoes = $conn->fetchAll(loadScript('3.3-obter-inscricoes-sem-avaliacao.sql'), $filtro);
    if (!isset($inscricoes) || empty($inscricoes)) {
        return print("         - Nao existem INSCRICOES para distribuir\n");
    }

    $certificadores = $conn->fetchAll(loadScript('3.2-obter-avaliadores.sql'), $filtro);
    if (!isset($certificadores) || empty($certificadores)) {
        return print("         - Nao existem AVALIADORES para o tipo\n");
    }

    $inscricao = current($inscricoes);
    while (true) {
        if ($inscricao === false) {
            break;
        }
        foreach ($certificadores as $certificador) {

            $conn->executeQuery("INSERT INTO culturaviva.avaliacao (inscricao_id, certificador_id, estado) VALUES (?, ?, ?)",[
                $inscricao['id'], $certificador['id'], 'P'
            ]);

            $inscricao = next($inscricoes);
            if ($inscricao === false) {
                break;
            }
        }
    }
}

importar();
