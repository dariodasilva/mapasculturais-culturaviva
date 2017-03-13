/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
SELECT
    insc.id
FROM culturaviva.inscricao insc
WHERE insc.estado = ANY(ARRAY['P','R'])
AND not exists (
        SELECT aval.id
        FROM culturaviva.avaliacao aval
        JOIN culturaviva.certificador cert
                on cert.id = aval.certificador_id
                AND cert.tipo = :tipo
        WHERE aval.inscricao_id = insc.id
)
