/** 
 * Remover avaliações de avaliadores inativos 
 */

UPDATE culturaviva.avaliacao SET estado = 'C'
WHERE certificador_id IN (
	SELECT 
	    id
	FROM culturaviva.certificador cert
	WHERE cert.ativo = FALSE
);
