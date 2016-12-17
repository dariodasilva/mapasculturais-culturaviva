<?php
namespace CulturaViva\Repositories;
use MapasCulturais\Traits;

class DiligenceRepository extends \MapasCulturais\Repository
{
    const PENDENT = 'P';
    const UNDER_REVIEW = 'R';
    const CERTIFIED = 'C';
    const NO_CERTIFIED = 'N';
    const MINERVA_DILIGENCE = 'M';

    /**
     *
     * @param $certifierId
     * @param $status
     * @return array
     */
    function getByCertifierAndStatus($certifierId, $status)
    {
        $rsm = new \Doctrine\ORM\Query\ResultSetMapping();
        $rsm->addScalarResult('id', 'id');
        $rsm->addScalarResult('agent', 'agent');
        $rsm->addScalarResult('diligence', 'diligence');
        $rsm->addScalarResult('civilstatus', 'civilstatus');
        $rsm->addScalarResult('publicstatus', 'publicstatus');

        $strQuery = "SELECT 
            C.id as id,
            S.agent_id as agent,
            C.id as diligence,
            C.status as civilstatus,
            P.status as publicstatus
        FROM
            culturaviva.subscription S
        INNER JOIN culturaviva.diligence C ON S.id = C.subscription_id
        INNER JOIN culturaviva.diligence P ON (C.subscription_id = P.subscription_id) AND (C.id <> P.id)
        WHERE
            S.status NOT IN ('C', 'N') AND
            C.certifier_id = (:certifierId) AND ";
        if (is_array($status)) {
            $strQuery .= ' C.status IN (:status) ';
        } else {
            $strQuery .= ' C.status = (:status) ';
        }
        $strOrder = $status == 'M' ? 'DESC' : 'ASC'; 
        $strQuery .= " ORDER BY C.updated_at DESC, C.created_at";
        $strQuery .= ' LIMIT 10';
        $query = $this->_em->createNativeQuery($strQuery, $rsm);
        $query->setParameters([
            'certifierId' => $certifierId,
            'status' => $status,
        ]);

        return $query->getScalarResult();
    }

    /**
     *
     * @param $certifierId
     * @param $status
     * @return int
     */
    function countByCertifierAndStatus($certifierId, $status)
    {
        $rsm = new \Doctrine\ORM\Query\ResultSetMapping();
        $rsm->addScalarResult('count', 'count');

        $strQuery = "SELECT COUNT(0) FROM culturaviva.subscription S
                    INNER JOIN culturaviva.diligence C ON S.id = C.subscription_id
                    INNER JOIN culturaviva.diligence P ON (C.subscription_id = P.subscription_id) AND (C.id <> P.id)
                    WHERE C.certifier_id = (:certifierId) AND ";
        if (is_array($status)) {
            $strQuery .= ' C.status IN (:status) ';
        } else {
            $strQuery .= ' C.status = (:status) ';
        }
        $query = $this->_em->createNativeQuery($strQuery, $rsm);
        $query->setParameters([
            'certifierId' => $certifierId,
            'status' => $status,
        ]);

        $result = $query->getScalarResult();
        return reset($result)['count'];
    }

    /**
     *
     * @param $certifierId
     * @param $status
     * @return array
     */
    function getDiligences($certifierId)
    {
        $diligences = [
            'pendent' => $this->getByCertifierAndStatus($certifierId, self::PENDENT),
            'review' => $this->getByCertifierAndStatus($certifierId, self::UNDER_REVIEW),
            'finished' => $this->getByCertifierAndStatus($certifierId, [self::CERTIFIED, self::NO_CERTIFIED]),
            'divergent' => $this->getByCertifierAndStatus($certifierId, self::MINERVA_DILIGENCE),
            'countPendent' => $this->countByCertifierAndStatus($certifierId, self::PENDENT),
            'countReview' => $this->countByCertifierAndStatus($certifierId, self::UNDER_REVIEW),
            'countFinished' => $this->countByCertifierAndStatus($certifierId, [self::CERTIFIED, self::NO_CERTIFIED]),
            'countDivergent' => $this->countByCertifierAndStatus($certifierId, self::MINERVA_DILIGENCE)
        ];

        return $diligences;
    }

    function saveDiligence($diligenceId, $certifierId, $data)
    {
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
