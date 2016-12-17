<?php

namespace CulturaViva\Controllers;

use MapasCulturais\App;
use CulturaViva\Entities\Diligence;

/**
 * Api base do processo de certificação
 */
class Certificacao extends \MapasCulturais\Controller {

    // @todo
    protected $_user = 3;

    const MINERVA_DILIGENCE = 'M';

    function getUser() {
        return $this->_user;
    }

    function GET_diligences() {
        $userId = $this->getUser();
        $diligences = App::i()->repo('\CulturaViva\Entities\Diligence')->getDiligences($userId);
        if ($diligences) {
            $this->json($diligences);
        } else {
            $this->json(['erro' => 'Nenhuma diligência encontrada.'], 400);
        }
    }

    function GET_ponto() {
        $this->render('ponto');
    }

    function GET_diligence() {
        $userId = $this->getUser();
        $diligence = reset(App::i()->repo('\CulturaViva\Entities\Diligence')->findBy([
                    'id' => $this->getUrlData()['id'],
                    'certifierId' => $userId
        ]));

        if ($diligence) {
            $diligence->createdAt = $diligence->getCreatedAt();
            $diligence->updatedAt = $diligence->getUpdatedAt();
            $this->json($diligence);
        } else {
            $this->json(['erro' => 'Nenhuma diligência encontrada.'], 400);
        }
    }

    function POST_index() {
        $userId = $this->getUser();
        $entity = reset(App::i()->repo('\CulturaViva\Entities\Diligence')->findBy([
                    'id' => $this->data['id'],
                    'certifierId' => $userId
        ]));

        if (isset($entity) && !in_array($entity, [Diligence::STATUS_CERTIFIED, Diligence::STATUS_NO_CERTIFIED])) {
            $entity->updatedAt = date('Y-m-d H:i:s');
            $entity->isRecognized = $this->data['isRecognized'] ? $this->data['isRecognized'] : null;
            $entity->isExperienced = $this->data['isExperienced'] ? $this->data['isExperienced'] : null;
            $entity->justification = $this->data['justification'];
            $entity->status = Diligence::STATUS_UNDER_REVIEW;
            if ($this->data['status'] == Diligence::STATUS_NO_CERTIFIED) {
                $entity->status = Diligence::STATUS_NO_CERTIFIED;
            }
            if ($this->data['status'] == Diligence::STATUS_CERTIFIED) {
                $entity->status = Diligence::STATUS_CERTIFIED;
            }

            $entity->save(true);
        }

        $this->render('index');
    }

}
