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
    'add default seal' => function() use($app, $conn){
        echo 'criando selo "Ponto de Cultura"';
        $agent_id = $app->config['rcv.admin'];
        $conn->executeQuery("
            INSERT INTO seal (agent_id, name, short_description, valid_period, create_timestamp, status, update_timestamp )
            VALUES ($agent_id, 'Ponto de Cultura', 'Ponto de Cultura', 0, CURRENT_TIMESTAMP, 1, CURRENT_TIMESTAMP);");
    },
    'add default seal to verified entities' => function() use($app, $conn) {
        echo 'Adicionando o selo "Ponto de Cultura" para as entidades verificadas';
        $agent_id = $app->config['rcv.admin'];
        $seal_id = $conn->fetchColumn("SELECT MIN(id) FROM seal WHERE agent_id = $agent_id");
        $conn->executeQuery("
            INSERT INTO seal_relation
            SELECT
                nextval('seal_relation_id_seq'),
                1,
                s.id,
                CURRENT_TIMESTAMP,
                1,
                'MapasCulturais\Entities\Space',
                $agent_id
            FROM space s
                    JOIN space_meta sm
                        ON sm.object_id = s.id
                        AND sm.key = 'rcv_tipo'
                        AND sm.value = 'ponto'
            WHERE s.is_verified = 't';"
        );
    }
];
