/**
 * Atualiza o estado da incrição
 */

UPDATE culturaviva.inscricao SET 
    estado = e.estado, 
    ts_finalizacao = CURRENT_TIMESTAMP
FROM (
    SELECT DISTINCT 
            insc.id,
            CASE avalp.estado WHEN 'D' THEN 'C' ELSE 'N' END AS estado
    FROM culturaviva.inscricao insc
    JOIN culturaviva.avaliacao avalp
        ON avalp.inscricao_id = insc.id
        AND avalp.estado = ANY(ARRAY['D','I'])
    JOIN culturaviva.avaliacao avalc
        ON avalc.inscricao_id = insc.id
        AND avalc.estado = ANY(ARRAY['D','I'])
    WHERE insc.estado = ANY(ARRAY['P','R'])
    AND avalp.id <> avalc.id
    AND avalp.estado = avalc.estado
) AS e 
WHERE culturaviva.inscricao.id = e.id


