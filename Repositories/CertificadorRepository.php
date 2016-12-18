<?php

namespace CulturaViva\Repositories;

use MapasCulturais\Traits;

class CertifierRepository extends \MapasCulturais\Repository {

    function save($data) {
        $app = \MapasCulturais\App::i();
        $entity = reset($app->repo('\CulturaViva\Entities\Diligence')->findBy([
                    'id' => $diligenceId,
                    'certifierId' => $certifierId
        ]));

        if (isset($entity) && !in_array($entity, [self::CERTIFIED, self::NO_CERTIFIED])) {
            $entity->updatedAt = date('Y-m-d H:i:s');
            $entity->isRecognized = $this->data['isRecognized'] ? $this->data['isRecognized'] : null;
            $entity->isExperienced = $this->data['isExperienced'] ? $this->data['isExperienced'] : null;
            $entity->justification = $this->data['justification'];
            $entity->status = self::UNDER_REVIEW;
            if ($this->data['status'] == self::NO_CERTIFIED) {
                $entity->status = self::NO_CERTIFIED;
            }
            if ($this->data['status'] == self::CERTIFIED) {
                $entity->status = self::CERTIFIED;
            }

            $entity->save(true);
        }
    }

}
