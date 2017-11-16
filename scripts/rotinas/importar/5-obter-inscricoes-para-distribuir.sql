/**
 * Obtém inscrições na situações P e R que não possui avaliação para o tipo de certificador informado
 * ou possuem avaliação PENDENTE para o avaliador informado
 */
SELECT
    insc.id
FROM culturaviva.inscricao insc
WHERE insc.estado = ANY(ARRAY['P','R'])
AND (
    not exists (
        SELECT aval.id
        FROM culturaviva.avaliacao aval
        JOIN culturaviva.certificador cert
                on cert.id = aval.certificador_id
                AND cert.tipo = :tipo
        WHERE aval.estado <> 'C'
        AND aval.inscricao_id = insc.id
    )
    OR exists (
        SELECT aval.id
        FROM culturaviva.avaliacao aval
        JOIN culturaviva.certificador cert
                on cert.id = aval.certificador_id
                AND cert.tipo = :tipo
        WHERE aval.estado = 'P'
        AND aval.inscricao_id = insc.id
    )
)
AND insc.id IN (
    1192,1231,1234,1239,1244,1248,
    1259,1265,1269,1274,1275,1283,
    1286,1292,1301,1304,1308,1313,
    1314,1315,1319,1320,1324,1330,
    1339,1341,1342,1343,1347,1349,
    1355,1358,1361,1363,1366,1368,
    1369,1373,1374,1377,1378,1379,
    1380,1381,1383,1384,1387,1389,
    1390,1391,1392,1393,1394,1395,
    1399,1400,1403,1406,1407,1408,
    1410,1412,1413,1416,1418,1420,
    1421,1422,1423,1424,1427,1429,
    1433,1434,1436,1441,1443,1445,
    1450,1453,1458,1459,1372,1393,
    1433,1458,1493,1457) OR (insc.agente_id = 17569 AND insc.estado='R')
ORDER BY insc.id
