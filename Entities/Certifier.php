<?php

namespace CulturaViva\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Representa os agentes certificadores
 *
 * @ORM\Table(name="culturaviva.certifier")
 * @ORM\Entity
 * @ORM\entity(repositoryClass="MapasCulturais\Repository")
 */
class Certifier extends \MapasCulturais\Entity {

    /**
     * Representa Agente Certificador do Poder Público
     */
    const TYPE_PUBLIC = 'P';

    /**
     * Representa Agente Certificador da Sociedade Civil
     */
    const TYPE_CIVIL = 'C';

    /**
     * Representa Agente Certificador com Voto de Minerva
     */
    const TYPE_MINERVA = 'M';

    /**
     * Função de Agente Certificador do Poder Público
     */
    const ROLE_PUBLIC = 'rcv_certificador_publico';

    /**
     * Função de Agente Certificador da Sociedade Civil
     */
    const ROLE_CIVIL = 'rcv_certificador_civil';

    /**
     * Função de Agente Certificador com Voto de Minerva
     */
    const ROLE_MINERVA = 'rcv_certificador_minerva';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="culturaviva.certifier_id_seq", allocationSize=1, initialValue=1)
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="agent_id", type="integer", nullable=false)
     */
    protected $agentId;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    protected $isActive;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=1, nullable=false)
     */
    protected $type;

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

    //============================================================= //
    // Controle de permissão da entidade
    // ============================================================ //

    /**
     * Somente usuários com perfil AGENTE DA AREA pode fazer alterações nos certificadores
     *
     * @param \MapasCulturais\Entities\User $user
     * @return boolean
     */
    protected function canUserCreate($user) {
        return $user->is("rcv_agente_area");
    }

    /**
     * Somente usuários com perfil AGENTE DA AREA pode fazer alterações nos certificadores
     *
     * @param \MapasCulturais\Entities\User $user
     * @return boolean
     */
    protected function canUserModify($user) {
        return $user->is("rcv_agente_area");
    }

}
