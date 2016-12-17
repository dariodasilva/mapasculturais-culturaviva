<?php

namespace CulturaViva\Controllers;

use MapasCulturais\App;
use CulturaViva\Entities\Certifier;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * API usado no gerenciamento de agentes de certificação
 */
class Certificador extends \MapasCulturais\Controller {

    protected $_user = null;
    protected $buscaAnterior = null;

    function getUser() {
        return $this->_user;
    }

    /**
     * Pesquisa de agentes por nome, para cadastro de certificador
     *
     * @param string $nome O nome do agente sendo buscado
     */
    function GET_buscarAgente() {
        $this->requireAuthentication();
        $app = App::i();

        $nome = $this->data['nome'];

        // Agente, não cadastrado e diferente do usuario atual
        $dql = 'SELECT
                    a.id,
                    a.userId,
                    a.name
                FROM \MapasCulturais\Entities\Agent a
                JOIN a.user u
                LEFT JOIN CulturaViva\Entities\Certifier c WITH a.id = c.agentId
                WHERE a.user <> :usuario
                AND c.agentId IS NULL
                AND unaccent(lower(a.name)) LIKE unaccent(lower(:nome))';

        $agents = $app->em->createQuery($dql)
                ->setParameters([
                    'usuario' => $app->user,
                    'nome' => "%$nome%"
                ])
                ->setMaxResults(10)
                ->getResult();

        $this->json($agents);
    }

    /**
     * Permite salvar certificadores.
     *
     * Somente usuários com perfil AGENTE DA AREA pode fazer alterações nos certificadores
     *
     * @see CulturaViva\Entities\Certifier
     */
    function POST_salvar() {


        $this->requireAuthentication();
        $app = App::i();

        $data = json_decode($app->request()->getBody());

        // Salva detalhes do certificador
        $certifier = null;
        if (isset($data->id)) {
            $certifier = reset(App::i()->repo('\CulturaViva\Entities\Certifier')->find($data->id));
        }

        if ($certifier) {
            $certifier->updatedAt = new \DateTime(date('Y-m-d H:i:s'));
        } else {
            $certifier = new Certifier;
            $certifier->id = null;
            $certifier->createdAt = date('Y-m-d H:i:s');
        }
        $certifier->isActive = $data->isActive;
        $certifier->agentId = $data->agentId;
        $certifier->type = $data->type;

        // Validação de consistencia
        if (!in_array($certifier->type, [Certifier::TYPE_PUBLIC, Certifier::TYPE_CIVIL, Certifier::TYPE_MINERVA])) {
            throw new \Exception('O tipo do Agente Certificador informado é inválido');
        }

        $certifier->save();

        /**
         * @var \MapasCulturais\Entities\User
         *
         * Faz a manutenção das permissões do agente
         */
        $user = $app->repo('Agent')->find($certifier->agentId);

        if ($certifier->type === Certifier::TYPE_PUBLIC) {
            $user->removeRole(Certifier::ROLE_CIVIL);
            $user->addRole(Certifier::ROLE_PUBLIC);
        } else if ($certifier->type === Certifier::TYPE_MINERVA) {
            $user->removeRole(Certifier::ROLE_CIVIL);
            $user->addRole(Certifier::ROLE_PUBLIC);
            $user->addRole(Certifier::ROLE_MINERVA);
        } else if ($certifier->type === Certifier::TYPE_CIVIL) {
            $user->removeRole(Certifier::ROLE_PUBLIC);
            $user->removeRole(Certifier::ROLE_MINERVA);
            $user->addRole(Certifier::ROLE_CIVIL);
        }

        $app->em->flush();

        $this->json($certifier);
    }

    /**
     * Lista todos os certificadores cadastrados, com informações sobre o
     * status dos processos
     */
    function GET_listar() {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $this->requireAuthentication();
        $app = App::i();

        $nativeQuery = "
            WITH diligences AS (
                SELECT
                    f.certifier_id,
                    f.status,
                    count(*) AS qtd
                FROM (
                    SELECT
                        certifier_id,
                        CASE 
                            WHEN status = ANY(ARRAY['C','N']) THEN 'F'
                            ELSE status
                        END AS status
                    FROM culturaviva.diligence
                ) f
                GROUP BY f.certifier_id, f.status
            )
            SELECT 
                c.*,
                a.name AS agent_name,
                COALESCE(p.qtd, 0) AS diligences_p, 
                COALESCE(r.qtd, 0) AS diligences_r, 
                COALESCE(f.qtd, 0) AS diligences_f 
            FROM culturaviva.certifier c
            JOIN agent a ON a.id = c.agent_id
            LEFT JOIN diligences p ON p.certifier_id = c.id AND p.status = 'P'
            LEFT JOIN diligences r ON r.certifier_id = c.id AND r.status = 'R'
            LEFT JOIN diligences f ON f.certifier_id = c.id AND r.status = 'F'";

        $rsm = new ResultSetMapping();

        $fields = [
            'id',
            'agent_id',
            'agent_name',
            'is_active',
            'type',
            'created_at',
            'updated_at',
            'diligences_p',
            'diligences_r',
            'diligences_f',
        ];
        foreach ($fields as $field) {
            $prop = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $field))));
            $rsm->addScalarResult($field, $prop);
        }

        $certifiers = $app->em->createNativeQuery($nativeQuery, $rsm)->getResult();
        $this->json($certifiers);
    }

    function POST_find() {
        $params = [];
        if (isset($this->data['status']) && !empty($this->data['status'])) {
            $params['isActive'] = $this->data['status'];
        }
        if (isset($this->data['type']) && !empty($this->data['type'])) {
            $params['type'] = $this->data['type'];
        }
        $certifiers = App::i()->repo('\CulturaViva\Entities\Certifier')->findBy($params);
        $this->json($certifiers);
    }

}
