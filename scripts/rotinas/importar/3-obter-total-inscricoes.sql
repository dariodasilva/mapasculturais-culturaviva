/*
 Obtém o total de inscrições pendentes
 Usado no cálculo de distribuição para os avaliadores
 */
SELECT
    COUNT(0) AS total
FROM culturaviva.inscricao insc
LEFT JOIN culturaviva.avaliacao aval ON aval.inscricao_id = insc.id
WHERE aval.inscricao_id IS NULL
AND insc.estado = ANY(ARRAY['P','R']);