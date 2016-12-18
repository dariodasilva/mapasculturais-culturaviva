<?php

namespace CulturaViva\Controllers;

use MapasCulturais\App;

/**
 * API para a configuração do processo de certificação
 */
class Configuracao extends \MapasCulturais\Controller {

    function GET_get() {
        $entity = App::i()->repo('\CulturaViva\Entities\Configuration')->find(1);
        $this->json($entity);
    }

    function POST_save() {

        $entity = App::i()->repo('\CulturaViva\Entities\Configuration')->find(1);
        if ($entity) {
            $entity->updatedAt = new \DateTime(date('Y-m-d H:i:s'));
        } else {
            $entity = new \CulturaViva\Entities\Configuration;
            $entity->id = 1;
            $entity->createdAt = new \DateTime(date('Y-m-d H:i:s'));
        }

        $data = json_decode(App::i()->request()->getBody());
        $entity->civil = intval($data->civil);
        $entity->government = intval($data->government);
        $entity->save(true);

        $this->json($entity);
    }

}
