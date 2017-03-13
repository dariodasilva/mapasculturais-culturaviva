<?php

$app = MapasCulturais\App::i();
$em = $app->em;
$conn = $em->getConnection();

return [
    'create project rede cultura viva' => function() use ($app) {
        $project = new MapasCulturais\Entities\Project;
        $owner = $app->repo('Agent')->find(1); // usuario admin
        $project->owner = $owner;
        $project->name = 'Rede Cultura Viva';
        $project->useRegistrations = true;
        $project->categories = ['Ponto de Cultura', 'Pontão de Cultura'];
        $project->registrationFrom = new \DateTime('2015-01-01');
        $project->registrationTo = new \DateTime('2099-12-31');
        $project->type = 9;
        $project->save(true);
    },
    'recreate agent metadata rcv_tipo' => function() use($conn) {
        $conn->executeQuery("DELETE FROM agent_meta WHERE key = 'rcv_tipo'");
        $rs = $conn->fetchAll("SELECT * FROM user_meta WHERE key = 'redeCulturaViva'");

        foreach ($rs as $r) {
            $ids = json_decode($r['value']);

            $conn->executeQuery("INSERT INTO agent_meta (object_id, key, value) VALUES ('{$ids->agenteIndividual}', 'rcv_tipo', 'responsavel')");
            $conn->executeQuery("INSERT INTO agent_meta (object_id, key, value) VALUES ('{$ids->agenteEntidade}', 'rcv_tipo', 'entidade')");
            $conn->executeQuery("INSERT INTO agent_meta (object_id, key, value) VALUES ('{$ids->agentePonto}', 'rcv_tipo', 'ponto')");
        }
    },
    'rcv: add default seal' => function() use($app, $conn) {
        $agent_id = $app->config['rcv.admin'];
        echo "criando selo \"Ponto de Cultura\" to user $agent_id'";
        $conn->executeQuery("
            INSERT INTO seal (id, agent_id, name, short_description, valid_period, create_timestamp, status, update_timestamp )
            VALUES (nextval('seal_id_seq'), $agent_id, 'Ponto de Cultura', 'Ponto de Cultura', 0, CURRENT_TIMESTAMP, 1, CURRENT_TIMESTAMP);");
    },
    'rcv: add default seal culturaviva to verified agents' => function() use($app, $conn) {
        echo 'Adicionando o selo "Ponto de Cultura" para as entidades verificadas';
        $agent_id = $app->config['rcv.admin'];
        $seal_id = $conn->fetchColumn("SELECT id FROM seal WHERE agent_id = $agent_id and name = 'Ponto de Cultura'");
        // Remove auto created seals in other updates ("Selo Mapas") to agents with rcv_tipo = 'ponto'
        $conn->executeQuery("
            DELETE FROM seal_relation
            WHERE
                object_type = 'MapasCulturais\Entities\Agent'
                AND object_id IN (
                    SELECT s.id
                    FROM agent s
                        JOIN agent_meta sm
                            ON sm.object_id = s.id
                            AND sm.key = 'rcv_tipo'
                            AND sm.value = 'ponto'
                    WHERE s.is_verified = 't'
                )"
        );

        // Insert new default seals to agent with rcv_tipo = 'ponto'
        $conn->executeQuery("
            INSERT INTO seal_relation
            SELECT
                nextval('seal_relation_id_seq'),
                $seal_id,
                s.id,
                CURRENT_TIMESTAMP,
                1,
                'MapasCulturais\Entities\Agent',
                $agent_id
            FROM agent s
                JOIN agent_meta sm
                    ON sm.object_id = s.id
                    AND sm.key = 'rcv_tipo'
                    AND sm.value = 'ponto'
            WHERE s.is_verified = 't';"
        );
    },
    'rcv: create schema' => function() use($app, $conn) {
        echo "Criando tabelas da Rede Cultura Viva";
        $conn->executeUpdate(file_get_contents(__DIR__ . '/scripts/db/culturaviva-schema.sql'));
    },
    'rcv: create schema log' => function() use($app, $conn) {
        echo "Criando tabelas de Log";
        $conn->executeUpdate(file_get_contents(__DIR__ . '/scripts/db/culturaviva_log-schema.sql'));
    },
];
