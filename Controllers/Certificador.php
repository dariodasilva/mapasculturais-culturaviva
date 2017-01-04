<?php

namespace CulturaViva\Controllers;

use MapasCulturais\App;
use CulturaViva\Entities\Certificador as CertificadorEntity;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * API usado no gerenciamento de agentes de certificação
 */
class Certificador extends \MapasCulturais\Controller {

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
            WITH avaliacoes AS (
                SELECT
                    f.certificador_id,
                    f.estado,
                    count(*) AS qtd
                FROM (
                    SELECT
                        certificador_id,
                        CASE
                            WHEN estado = ANY(ARRAY['D','I']) THEN 'F'
                            ELSE estado
                        END AS estado
                    FROM culturaviva.avaliacao
                    WHERE estado <> 'C'
                ) f
                GROUP BY f.certificador_id, f.estado
            )
            SELECT
                c.*,
                a.name AS agente_nome,
                COALESCE(ap.qtd, 0) AS avaliacoes_pendentes,
                COALESCE(aa.qtd, 0) AS avaliacoes_em_analise,
                COALESCE(af.qtd, 0) AS avaliacoes_finalizadas
            FROM culturaviva.certificador c
            JOIN agent a ON a.id = c.agente_id
            LEFT JOIN avaliacoes ap ON ap.certificador_id = c.id AND ap.estado = 'P'
            LEFT JOIN avaliacoes aa ON aa.certificador_id = c.id AND aa.estado = 'A'
            LEFT JOIN avaliacoes af ON af.certificador_id = c.id AND af.estado = 'F'";

        $rsm = new ResultSetMapping();

        $fields = [
            'id',
            'agente_id',
            'agente_nome',
            'ativo',
            'tipo',
            'ts_criacao',
            'ts_atualizacao',
            'avaliacoes_pendentes',
            'avaliacoes_em_analise',
            'avaliacoes_finalizadas',
        ];
        foreach ($fields as $field) {
            $prop = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $field))));
            $rsm->addScalarResult($field, $prop);
        }

        $rows = $app->em->createNativeQuery($nativeQuery, $rsm)->getResult();
        $this->json($rows);
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

}
