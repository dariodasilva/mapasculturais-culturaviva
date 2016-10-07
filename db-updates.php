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
            
            
    'migra avatar dos pontos para o agente responsável' => function() use($app, $conn) {
        $umeta = $conn->fetchAll("SELECT value FROM user_meta WHERE key = 'redeCulturaViva';");

        $move_file = function($file, $to_agent_id) use ($conn) {
            $id = $file['id'];
            $grp = $file['grp'];
            $name = $file['name'];
            $owner_id = $file['object_id'];
            $parent_id = $file['parent_id'];


            if ($parent_id) {
                $original_file = "files/agent/{$owner_id}/file/{$parent_id}/{$name}";
            } else {
                $original_file = "files/agent/{$owner_id}/{$name}";
            }

            if (file_exists(BASE_PATH . $original_file)) {
                $new_name = $name;

                // encontra um nome de arquivo válido
                $fcount = 2;
                if ($parent_id) {
                    $destination_file = "files/agent/{$to_agent_id}/file/{$parent_id}/{$new_name}";
                } else {
                    $destination_file = "files/agent/{$to_agent_id}/{$new_name}";
                }

                while (file_exists(BASE_PATH . $destination_file)) {
                    $new_name = preg_replace("#(\.[[:alnum:]]+)$#i", '-' . $fcount . '$1', $name);
                    if ($parent_id) {
                        $destination_file = "files/agent/{$to_agent_id}/file/{$parent_id}/{$new_name}";
                    } else {
                        $destination_file = "files/agent/{$to_agent_id}/{$new_name}";
                    }
                    $fcount++;
                }

                echo "
====================

Movendo arquivo '$grp' do agente {$owner_id} para o agente {$to_agent_id}:
      DE: $original_file
    PARA: $destination_file\n";

                $conn->executeQuery("
                    UPDATE file SET name = '{$new_name}', object_id = {$to_agent_id} WHERE id = {$id}
                ");

                $original_file = BASE_PATH . $original_file;
                $destination_file = BASE_PATH . $destination_file;

                // cria a pasta do destino se ela não existir
                if (!is_dir(dirname($destination_file))) {
                    mkdir(dirname($destination_file), 0755, true);
                }

                rename($original_file, $destination_file);
            }
        };

        foreach ($umeta as $meta) {
            $obj = json_decode($meta['value']);

            $avatar = $conn->fetchAssoc("
                SELECT 
                    * 
                FROM 
                    file 
                WHERE 
                    object_type = 'MapasCulturais\Entities\Agent' AND
                    object_id = {$obj->agentePonto} AND
                    grp = 'avatar'
            ");
            if ($avatar) {
//                var_dump($avatar);
                $fid = $avatar['id'];
                $thumbs = $conn->fetchAll("
                    SELECT 
                        * 
                    FROM 
                        file 
                    WHERE 
                        object_type = 'MapasCulturais\Entities\Agent' AND
                        object_id = {$obj->agentePonto} AND
                        parent_id = {$fid}
                ");

                $move_file($avatar, $obj->agenteIndividual);

                foreach ($thumbs as $thumb) {
                    $move_file($thumb, $obj->agenteIndividual);
                }
            }
        }
        echo "\nrenomeando grupo logoponto para avatar\n";
        $conn->executeQuery("UPDATE file SET grp = 'avatar' WHERE grp = 'logoponto'");
    },
    ];
        