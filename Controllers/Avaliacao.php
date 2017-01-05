<?php

namespace CulturaViva\Controllers;

use CulturaViva\Util\NativeQueryUtil;
use MapasCulturais\App;

/**
 * Api base do processo de certificação
 */
class Avaliacao extends \MapasCulturais\Controller {

    // @todo
    protected $_user = 3;

    const MINERVA_DILIGENCE = 'M';

    function getUser() {
        return $this->_user;
    }

    /**
     * Lista a quantidade de avaliações validas existentes
     *
     * Considerando os status "[D] Deferido" e "[I] Indeferido" como "[F] Finalizado"
     *
     * Ignora avaliações cancelados
     *
     * Quando usuario é Agente da Area, traz o totalizador geral, quando o usuario é Certificador,
     * aplica filtra para totalizador deste usuario
     */
    function GET_total() {
        $this->requireAuthentication();
        $app = App::i();

        $usuario = $app->user;

        $agenteIdFiltro = $usuario->profile->id;
        if ($usuario->is('rcv_agente_area')) {
            // Agente da área pode ver os totais de todos os certificadores
            $agenteIdFiltro = 0;
        }

        $sql = "
            SELECT
                count(CASE WHEN avl.estado = 'P' THEN 1 END) as pendentes,
                count(CASE WHEN avl.estado = 'A' THEN 1 END) as em_analise,
                count(CASE WHEN avl.estado = ANY(ARRAY['D','I']) THEN 1 END) as finalizadas
            FROM culturaviva.avaliacao avl
            JOIN culturaviva.certificador cert ON cert.id = avl.certificador_id
            WHERE avl.estado <> 'C'
            AND (:agenteId = 0 OR cert.agente_id = :agenteId)";

        $campos = [
            'pendentes',
            'em_analise',
            'finalizadas'
        ];

        $parametros = [
            'agenteId' => $agenteIdFiltro
        ];

        $this->json((new NativeQueryUtil($sql, $campos, $parametros))->getSingleResult());
    }

    /**
     * Lista as avaliações de um certificador (ou de todos, caso usuario seja agente area)
     *
     * @param string $nome Permite filtrar a entidade da inscrição ou o agente responsável
     * @param string $estado Permite filtrar o estado da avaliação
     * @param string $pagina Paginação do resultado
     */
    function GET_listar() {
        $this->requireAuthentication();
        $app = App::i();

        $agenteId = $app->user->profile->id;
        if ($app->user->is('rcv_agente_area')) {
            // Agente da área pode ver avaliações de todos os certificadores
            $agenteId = 0;
        }

        $sql = "
            SELECT
                avl.*,
                cert.tipo AS certificador_tipo,
                agt.name AS certificador_nome,
                pnt.name AS ponto_nome,
                tp.value AS ponto_tipo
            FROM culturaviva.avaliacao avl
            JOIN culturaviva.inscricao insc ON insc.id = avl.inscricao_id
            JOIN culturaviva.certificador cert ON cert.id = avl.certificador_id
            JOIN agent agt ON agt.id = cert.agente_id
            JOIN agent pnt ON pnt.id = insc.agente_id
            JOIN user_meta tp ON tp.key = 'tipoPontoCulturaDesejado' AND tp.object_id = pnt.user_id
            WHERE avl.estado <> 'C'
            AND (:agenteId = 0 OR cert.agente_id = :agenteId)
            AND (:estado = '' OR avl.estado = :estado OR (:estado = 'F' AND avl.estado = ANY(ARRAY['D','I'])))
            AND (:nome = ''
                OR unaccent(lower(pnt.name)) LIKE unaccent(lower(:nome))
                OR unaccent(lower(agt.name)) LIKE unaccent(lower(:nome)))
            ORDER BY
                avl.ts_atualizacao DESC,
                insc.ts_criacao ASC";

        $campos = [
            'id',
            'inscricao_id',
            'certificador_id',
            'estado',
            'ts_finalizacao',
            'ts_criacao',
            'ts_atualizacao',
            'certificador_tipo',
            'certificador_nome',
            'ponto_nome',
            'ponto_tipo'
        ];

        $parametros = [
            'agenteId' => $agenteId,
            'estado' => isset($this->data['estado']) ? $this->data['estado'] : '',
            'nome' => isset($this->data['nome']) ? "%{$this->data['nome']}%" : ''
        ];

        $pagina = isset($this->data['pagina']) ? intval($this->data['pagina']) : 1;
        $this->json((new NativeQueryUtil($sql, $campos, $parametros))->paginate($pagina));
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
