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
            WITH avaliacoes AS (
                SELECT
                    avl.id,
                    avl.inscricao_id,
                    avl.certificador_id,
                    cert.tipo AS certificador_tipo,
                    cert.agente_id,
                    agt.name AS certificador_nome,
                    CASE
                        WHEN avl.estado = ANY(ARRAY['D','I']) THEN 'F' ELSE estado
                    END AS estado
                FROM culturaviva.avaliacao avl
                JOIN culturaviva.certificador cert ON cert.id = avl.certificador_id
                JOIN agent agt ON agt.id = cert.agente_id
                WHERE estado <> 'C'
            )
            SELECT
                insc.id,
                insc.agente_id,
                insc.estado,
                ponto.name              AS ponto_nome,
                entidade.name           AS entidade_nome,
                tp.value                AS tipo_ponto_desejado,
                avl_c.id                AS avaliacao_civil_id,
                avl_c.estado            AS avaliacao_civil_estado,
                avl_c.certificador_nome AS avaliacao_civil_certificador,
                avl_p.id                AS avaliacao_publica_id,
                avl_p.estado            AS avaliacao_publica_estado,
                avl_p.certificador_nome AS avaliacao_publica_certificador,
                avl_m.id                AS avaliacao_minerva_id,
                avl_m.estado            AS avaliacao_minerva_estado,
                avl_m.certificador_nome AS avaliacao_minerva_certificador
            FROM culturaviva.inscricao insc
            JOIN registration reg
                on reg.agent_id = insc.agente_id
                AND reg.project_id = 1
            join agent_relation rel_entidade
                ON rel_entidade.object_id = reg.id
                AND rel_entidade.type = 'entidade'
                AND rel_entidade.object_type = 'MapasCulturais\Entities\Registration'
            join agent_relation rel_ponto
                ON rel_ponto.object_id = reg.id
                AND rel_ponto.type = 'ponto'
                AND rel_ponto.object_type = 'MapasCulturais\Entities\Registration'
            JOIN agent entidade ON entidade.id = rel_entidade.agent_id
            JOIN agent ponto ON ponto.id = rel_ponto.agent_id
            JOIN agent_meta tp
                ON tp.key = 'tipoPontoCulturaDesejado'
                AND tp.object_id = entidade.id
            LEFT JOIN avaliacoes avl_c
                ON insc.id = avl_c.inscricao_id
                AND avl_c.certificador_tipo = 'C'
            LEFT JOIN avaliacoes avl_p
                ON insc.id = avl_p.inscricao_id
                AND avl_p.certificador_tipo = 'P'
            LEFT JOIN avaliacoes avl_m
                ON insc.id = avl_m.inscricao_id
                AND avl_m.certificador_tipo = 'm'
            WHERE insc.estado <> 'C'
            AND (:agenteId = 0 OR COALESCE(avl_c.agente_id, avl_p.agente_id, avl_m.agente_id, 0) = :agenteId)
            AND (:estado = '' OR :estado = ANY(ARRAY[avl_c.estado,avl_p.estado, avl_m.estado]))
            AND (
                :nome = ''
                OR unaccent(lower(ponto.name)) LIKE unaccent(lower(:nome))
                OR unaccent(lower(entidade.name)) LIKE unaccent(lower(:nome))
                OR unaccent(lower(avl_c.certificador_nome)) LIKE unaccent(lower(:nome))
                OR unaccent(lower(avl_p.certificador_nome)) LIKE unaccent(lower(:nome))
                OR unaccent(lower(avl_m.certificador_nome)) LIKE unaccent(lower(:nome))
            )";


        $campos = [
            'id',
            'estado',
            'ponto_nome',
            'entidade_nome',
            'tipo_ponto_desejado',
            'avaliacao_civil_id',
            'avaliacao_civil_estado',
            'avaliacao_civil_certificador',
            'avaliacao_publica_id',
            'avaliacao_publica_estado',
            'avaliacao_publica_certificador',
            'avaliacao_minerva_id',
            'avaliacao_minerva_estado',
            'avaliacao_minerva_certificador'
        ];

        $parametros = [
            'agenteId' => $agenteId,
            'estado' => isset($this->data['estado']) ? $this->data['estado'] : '',
            'nome' => isset($this->data['nome']) ? "%{$this->data['nome']}%" : ''
        ];

        $pagina = isset($this->data['pagina']) ? intval($this->data['pagina']) : 1;
        $this->json((new NativeQueryUtil($sql, $campos, $parametros))->paginate($pagina));
    }

    /**
     * Obtém as informações de uma avaliação específica
     */
    function GET_obter() {
        $this->requireAuthentication();
        $app = App::i();

        $agenteId = $app->user->profile->id;
        if ($app->user->is('rcv_agente_area')) {
            // Agente da área pode ver avaliações de todos os certificadores
            $agenteId = 0;
        }

        $avaliacaoId = $this->getUrlData()['id'];

        $sql = "
            SELECT
                avl.*,
                cert.agente_id,
                (cert.agente_id = :agenteId) AS autoriza_edicao,
                cert.tipo           AS certificador_tipo,
                agt.name            AS certificador_nome,
                insc.estado         AS inscricao_estado,
                insc.ts_criacao     AS inscricao_ts_criacao,
                insc.ts_finalizacao AS inscricao_ts_finalizacao,
                ponto.name          AS ponto_nome,
                tp.value            AS ponto_cultura_desejado,
                dsc.value           AS ponto_descricao
            FROM culturaviva.avaliacao avl
            JOIN culturaviva.certificador cert
                ON cert.id = avl.certificador_id
            JOIN agent agt ON agt.id = cert.agente_id
            JOIN culturaviva.inscricao insc
                ON insc.id = avl.inscricao_id
            JOIN registration reg
                on reg.agent_id = insc.agente_id
                AND reg.project_id = 1
            join agent_relation rel_entidade
                ON rel_entidade.object_id = reg.id
                AND rel_entidade.type = 'entidade'
                AND rel_entidade.object_type = 'MapasCulturais\Entities\Registration'
            join agent_relation rel_ponto
                ON rel_ponto.object_id = reg.id
                AND rel_ponto.type = 'ponto'
                AND rel_ponto.object_type = 'MapasCulturais\Entities\Registration'
            JOIN agent ponto ON ponto.id = rel_ponto.agent_id
            JOIN agent_meta tp
                ON tp.key = 'tipoPontoCulturaDesejado'
                AND tp.object_id = rel_entidade.agent_id
            LEFT JOIN agent_meta dsc
                ON dsc.key = 'shortDescription'
                AND tp.object_id = ponto.user_id
            WHERE insc.estado <> 'C'
            AND avl.id = :id
            AND (:agenteId = 0 OR cert.agente_id = :agenteId)";

        $parametros = [
            'id' => $avaliacaoId,
            'agenteId' => $agenteId
        ];

        $campos = [
            'id',
            'inscricao_id',
            'certificador_id',
            'estado',
            'observacoes',
            'ts_finalizacao',
            'ts_criacao',
            'ts_atualizacao',
            'agente_id',
            'certificador_tipo',
            'certificador_nome',
            'inscricao_estado',
            'inscricao_ts_criacao',
            'inscricao_ts_finalizacao',
            'ponto_nome',
            'ponto_cultura_desejado',
            'ponto_descricao',
            'autoriza_edicao',
        ];

        $out = (new NativeQueryUtil($sql, $campos, $parametros))->getSingleResult();
        if ($out != null) {
            $out['criterios'] = $this->obterCriteriosAvaliacao($avaliacaoId);
        }

        $this->json($out);
    }

    /**
     * Obtém todos os critérios de uma avaliação
     *
     * @param type $avaliacaoId
     * @return type
     */
    private function obterCriteriosAvaliacao($avaliacaoId) {
        $sql = "
            SELECT
                crtr.id,
                crtr.ordem,
                crtr.descricao,
                avct.aprovado
            FROM culturaviva.avaliacao avl
            JOIN culturaviva.inscricao_criterio insct
                ON insct.inscricao_id = avl.inscricao_id
            JOIN culturaviva.criterio crtr
                ON crtr.id = insct.criterio_id
            LEFT JOIN culturaviva.avaliacao_criterio avct
                ON avct.avaliacao_id = avl.id
                AND avct.inscricao_id = avl.inscricao_id
            WHERE avl.id = :avaliacao";

        $parametros = ['avaliacao' => $avaliacaoId];


        $campos = [
            'id',
            'ordem',
            'descricao',
            'aprovado'
        ];

        return (new NativeQueryUtil($sql, $campos, $parametros))->getResult();
    }

}
