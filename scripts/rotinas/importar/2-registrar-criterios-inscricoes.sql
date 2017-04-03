/*
 Registra os criterios das inscricoes
 */
INSERT INTO culturaviva.inscricao_criterio (criterio_id, inscricao_id)
SELECT
        crit.id,
        insc.id
FROM culturaviva.inscricao insc
JOIN culturaviva.criterio crit ON  crit.ativo = TRUE
LEFT JOIN culturaviva.inscricao_criterio incrit
        on incrit.inscricao_id = insc.id
WHERE insc.estado = 'P'
AND incrit.inscricao_id IS NULL;