/*
 Obtém avaliadores ativos, por tipo
 Usado na distribuição de avaliações
 */
SELECT
    cert.id
FROM culturaviva.certificador cert
WHERE cert.ativo = TRUE
AND cert.titular = TRUE
AND cert.tipo = :tipo
ORDER BY (
        SELECT count(0) as total
        FROM culturaviva.avaliacao aval
        WHERE aval.estado = ANY(ARRAY['P','A'])
        AND aval.certificador_id = cert.id
);