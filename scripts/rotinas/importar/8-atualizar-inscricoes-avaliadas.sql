/**
 * Atualiza o estado da incrição
 */
WITH deferidas AS (
    SELECT
        insc.id,
        'C'::CHAR AS estado
    FROM culturaviva.inscricao insc
    WHERE insc.estado = ANY(ARRAY['P','R'])
    AND (
        SELECT COUNT(0)
        FROM culturaviva.avaliacao av
        WHERE av.inscricao_id = insc.id
        AND av.estado = 'D'
    ) = 2
),
indeferidas AS (
    SELECT
        insc.id,
        'N'::CHAR AS estado
    FROM culturaviva.inscricao insc
    WHERE insc.estado = ANY(ARRAY['P','R'])
    AND (
        SELECT COUNT(0)
        FROM culturaviva.avaliacao av
        WHERE av.inscricao_id = insc.id
        AND av.estado = 'I'
    ) = 2
),
todas AS (
    SELECT  * FROM deferidas
    UNION ALL
    SELECT * FROM indeferidas
)
UPDATE culturaviva.inscricao SET
    estado = e.estado,
    ts_finalizacao = CURRENT_TIMESTAMP
FROM ( SELECT id, estado FROM todas ) AS e
WHERE culturaviva.inscricao.id = e.id


