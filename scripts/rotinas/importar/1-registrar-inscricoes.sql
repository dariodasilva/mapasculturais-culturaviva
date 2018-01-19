/**
 * Registra as inscricoes dos pontos de cultura
 */
INSERT INTO culturaviva.inscricao(agente_id, estado)
SELECT
    r.agent_id,
    'P'
FROM registration r
LEFT JOIN culturaviva.inscricao insc
    ON insc.agente_id = r.agent_id
WHERE r.opportunity_id = 1
AND r.status = 1
AND insc.id IS NULL
AND (insc.estado = 'P' OR insc.estado is null)
AND r.agent_id NOT IN (
	SELECT parent_id
	FROM agent a
	JOIN agent_meta am ON a.id=am.object_id
	JOIN seal_relation sr ON a.id=sr.object_id
	WHERE am.key = 'rcv_tipo' AND am.value = 'ponto' AND sr.seal_id = 6
);
