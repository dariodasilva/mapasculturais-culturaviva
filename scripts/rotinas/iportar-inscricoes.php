<?php

//echo realpath(__DIR__ . '/../../../../../../protected/application/bootstrap.php');
//exit(0);

require __DIR__ . '/../../../../../../protected/application/bootstrap.php';

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
function importar() {
    $app = MapasCulturais\App::i();
    $conn = $app->em->getConnection();



    print("1   - Registra as inscricoes dos pontos de cultura\n");
    $conn->executeQuery(<<<EOT
        INSERT INTO culturaviva.inscricao(agente_id, estado)
        SELECT
            r.agent_id, 'P'
        FROM registration r
        LEFT JOIN culturaviva.inscricao insc
                on insc.agente_id = r.agent_id
        WHERE r.project_id = 1
        AND r.status = 1
        AND insc.id IS NULL AND (insc.estado = 'P' OR insc.estado is null);
EOT
    );

    print("2   - Registra os criterios das inscricoes\n");
    $conn->executeQuery(<<<EOT
        INSERT INTO culturaviva.inscricao_criterio (criterio_id, inscricao_id)
        SELECT
                crit.id,
                insc.id
        FROM culturaviva.inscricao insc
        JOIN culturaviva.criterio crit ON  crit.ativo = TRUE 
        LEFT JOIN culturaviva.inscricao_criterio incrit
                on incrit.inscricao_id = insc.id
        WHERE insc.estado = 'P'
        AND incrit.inscricao_id IS NULL;
EOT
    );

    print("3   - Associar avaliacao a certificador\n");
    $totalInscricoes = $conn->fetchColumn(<<<EOT
        SELECT
            count(0) as total
        FROM culturaviva.inscricao insc
        LEFT JOIN culturaviva.avaliacao aval 
            on aval.inscricao_id = insc.id
        WHERE aval.inscricao_id IS NULL
        AND insc.estado = ANY(ARRAY['P','R']);      
EOT
    );
    print("3.1 - Total de inscricoes nao associadas a avaliacao: $totalInscricoes\n");


    print("3.2 - Quantidade de certificadores por tipo:\n");
    $totaisPorTipoCertificador = $conn->fetchAssoc(<<<EOT
        SELECT
            count(CASE WHEN cert.tipo = 'C' THEN 1 ELSE 0 END) as civil,
            count(CASE WHEN cert.tipo = 'P' THEN 1 ELSE 0 END) as publico,
            count(CASE WHEN cert.tipo = 'M' THEN 1 ELSE 0 END) as minerva
        FROM culturaviva.certificador cert
        WHERE cert.ativo = TRUE 
        AND cert.titular = TRUE;   
EOT
    );
    $numCertCivil = intval($totaisPorTipoCertificador['civil']);
    $numCertPublico = intval($totaisPorTipoCertificador['publico']);
    $numCertMinerva = intval($totaisPorTipoCertificador['minerva']);
    print("    CIVIL: $numCertCivil\n");
    print("    PUBLICO: $numCertPublico\n");
    print("    MINERVA: $numCertMinerva\n");
}

importar();
