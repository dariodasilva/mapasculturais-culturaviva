<?php

namespace CulturaViva\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Representa a homologação de um ponto de cultura por um analista
 *
 * @ORM\Table(name="culturaviva.diligence")
 * @ORM\Entity
 * @ORM\entity(repositoryClass="CulturaViva\Repositories\DiligenceRepository")
 */
class Diligence extends \MapasCulturais\Entity {

    /**
     * Indica que a análise da solicitação não foi iniciada pelo responsável
     */
    const STATUS_PENDENT = 'P';

    /**
     * Indica que o responsável já começou a fazer a análise da solicitação mas ainda não finalizou
     */
    const STATUS_UNDER_REVIEW = 'R';

    /**
     * Indica que o responsável já finalizou a análise e marcou a solicitação como DEFERIDO
     */
    const STATUS_CERTIFIED = 'C';

    /**
     * Indica que o responsável já finalizou a análise e marcou a solicitação como INDEFERIDO
     */
    const STATUS_NO_CERTIFIED = 'N';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="culturaviva.diligence_id_seq", allocationSize=1, initialValue=1)
     */
    protected $id;

    /**
     * @var \CulturaViva\Entities\Subscription
     *
     * @ORM\ManyToOne(targetEntity="CulturaViva\Entities\Subscription")
     * @ORM\JoinColumn(name="subscription_id", referencedColumnName="id")
     *
     */
    protected $subscriptionId;

    /**
     * @var \CulturaViva\Entities\Certifier
     *
     * @ORM\ManyToOne(targetEntity="CulturaViva\Entities\Certifier")
     * @ORM\JoinColumn(name="certifier_id", referencedColumnName="id")
     */
    protected $certifierId;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=1, nullable=false)
     */
    protected $status;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_recognized", type="boolean", nullable=false)
     */
    protected $isRecognized;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_experienced", type="boolean", nullable=false)
     */
    protected $isExperienced;

    /**
     * @var string
     *
     * @ORM\Column(name="justification", type="string", length=1000, nullable=false)
     */
    protected $justification;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="string", nullable=false)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="string", nullable=true)
     */
    protected $updatedAt;

    //============================================================= //
    // The following lines ara used by MapasCulturais hook system.
    // Please do not change them.
    // ============================================================ //

    public function getCreatedAt() {
        return \DateTime::createFromFormat('Y-m-d H:i:s.u', $this->createdAt)->format('d/m/Y H:i:s');
    }

    public function getUpdatedAt() {
        if ($this->updatedAt) {
            return \DateTime::createFromFormat('Y-m-d H:i:s', $this->updatedAt)->format('d/m/Y H:i:s');
        } else {
            return $this->updatedAt;
        }
    }

    /** @ORM\PrePersist */
    public function prePersist($args = null) {
        parent::prePersist($args);
    }

    /** @ORM\PostPersist */
    public function postPersist($args = null) {
        parent::postPersist($args);
    }

    /** @ORM\PreRemove */
    public function preRemove($args = null) {
        parent::preRemove($args);
    }

    /** @ORM\PostRemove */
    public function postRemove($args = null) {
        parent::postRemove($args);
    }

    /** @ORM\PreUpdate */
    public function preUpdate($args = null) {
        parent::preUpdate($args);
    }

    /** @ORM\PostUpdate */
    public function postUpdate($args = null) {
        parent::postUpdate($args);
    }

}
