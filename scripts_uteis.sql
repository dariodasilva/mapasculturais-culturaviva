
-- ACESSAR BANCO DE DADOS
-- sudo -u postgres psql mapas

--------------------------------------------------------------------------------
-- CRIAÇÃO DE USUÁRIOS DE TESTE
--------------------------------------------------------------------------------

--------------------------------------------------------------------------------
-- Agente Area (Gestor)

INSERT INTO usr(auth_provider, auth_uid, email, last_login_timestamp, create_timestamp, status)
    VALUES (1, 1, 'AgenteArea@local', current_date, current_date, 1);

INSERT INTO agent(user_id, type, name, create_timestamp, status)
	SELECT id, 1, email, current_date, 1 FROM usr WHERE usr.email = 'AgenteArea@local';
    
UPDATE usr SET profile_id = (SELECT id FROM agent WHERE name = 'AgenteArea@local') 
    WHERE email = 'AgenteArea@local';

INSERT INTO role(usr_id, name)
	SELECT id, 'rcv_agente_area' FROM usr WHERE usr.email = 'AgenteArea@local';
    
    
--------------------------------------------------------------------------------
-- Agente Certificador da Sociedade Civil

INSERT INTO usr(auth_provider, auth_uid, email, last_login_timestamp, create_timestamp, status)
    VALUES (1, 1, 'AgenteCivil@local', current_date, current_date, 1);

INSERT INTO agent(user_id, type, name, create_timestamp, status)
	SELECT id, 1, email, current_date, 1 FROM usr WHERE usr.email = 'AgenteCivil@local';
    
UPDATE usr SET profile_id = (SELECT id FROM agent WHERE name = 'AgenteCivil@local') 
    WHERE email = 'AgenteCivil@local';

-- INSERT INTO role(usr_id, name)
-- 	SELECT id, 'rcv_certificador_civil' FROM usr WHERE usr.email = 'AgenteCivil@local';

    
--------------------------------------------------------------------------------
-- Agente Certificador do Poder Publico

INSERT INTO usr(auth_provider, auth_uid, email, last_login_timestamp, create_timestamp, status)
    VALUES (1, 1, 'AgentePublico@local', current_date, current_date, 1);

INSERT INTO agent(user_id, type, name, create_timestamp, status)
	SELECT id, 1, email, current_date, 1 FROM usr WHERE usr.email = 'AgentePublico@local';
    
UPDATE usr SET profile_id = (SELECT id FROM agent WHERE name = 'AgentePublico@local')
    WHERE email = 'AgentePublico@local';

-- INSERT INTO role(usr_id, name)
-- 	SELECT id, 'rcv_certificador_publico' FROM usr WHERE usr.email = 'AgentePublico@local';
    

--------------------------------------------------------------------------------
-- Agente Certificador do Poder Publico Com Voto de Minerva

INSERT INTO usr(auth_provider, auth_uid, email, last_login_timestamp, create_timestamp, status)
    VALUES (1, 1, 'AgenteMinerva@local', current_date, current_date, 1);

INSERT INTO agent(user_id, type, name, create_timestamp, status)
	SELECT id, 1, email, current_date, 1 FROM usr WHERE usr.email = 'AgenteMinerva@local';
    
UPDATE usr SET profile_id = (SELECT id FROM agent WHERE name = 'AgenteMinerva@local') 
    WHERE email = 'AgenteMinerva@local';

-- Possui duas roles, publico e minerva
-- INSERT INTO role(usr_id, name) SELECT id, 'rcv_certificador_publico' FROM usr 
--     WHERE usr.email = 'AgenteMinerva@local';
-- INSERT INTO role(usr_id, name) SELECT id, 'rcv_certificador_minerva' FROM usr 
--     WHERE usr.email = 'AgenteMinerva@local';



--------------------------------------------------------------------------------
-- Ponto de Cultura

INSERT INTO usr(auth_provider, auth_uid, email, last_login_timestamp, create_timestamp, status)
    VALUES (1, 1, 'PontoCultura@local', current_date, current_date, 1);

INSERT INTO agent(user_id, type, name, create_timestamp, status)
	SELECT id, 1, email, current_date, 1 FROM usr WHERE usr.email = 'PontoCultura@local';
    
UPDATE usr SET profile_id = (SELECT id FROM agent WHERE name = 'PontoCultura@local') 
    WHERE email = 'PontoCultura@local';
    
    
INSERT INTO user_meta(id, object_id, key, value)            
    SELECT  
        nextval('user_meta_id_seq'),
        usr.id,
        'tipoPontoCulturaDesejado', 
        'ponto'
    FROM usr WHERE usr.email = 'PontoCultura@local'
;

-- Registra a inscrição do ponto de cultura
INSERT INTO culturaviva.inscricao(agente_id, estado)
    VALUES ((SELECT id FROM agent WHERE name = 'PontoCultura@local'), 'P');

-- Atribui avaliação para agente certificador (registrar pela interface)
INSERT INTO culturaviva.avaliacao(inscricao_id, certificador_id, estado)
    VALUES (
        (
            SELECT id 
            FROM culturaviva.inscricao 
            WHERE agente_id = (SELECT id FROM agent WHERE name = 'PontoCultura@local')
        ), 
        (
            SELECT id 
            FROM culturaviva.certificador 
            WHERE agente_id = (SELECT id FROM agent WHERE name = 'AgenteCivil@local')
            AND ativo = true    
            AND tipo = 'C'
        ),
        'P' 
    );













--------------------------------------------------------------------------------
-- CONSULTAS GENERICAS
--------------------------------------------------------------------------------

-- Status possiveis de avaliações (culturaviva.avaliacao.estado)
-- [P] Pendente
-- [A] Em Análise
-- [D] Deferido
-- [I] Indeferido
-- [C] Cancelado


-- Quantidade de processos por certificador agrupado por status
SELECT
    d.certifier_id,
    d.status,
    count(*) AS qtd
FROM culturaviva.diligence d
GROUP BY d.certifier_id, d.status;


-- Quantidade de processos por certificador agrupado por status
-- Considerando os status "[D] Deferido" e "[I] Indeferido" como "[F] Finalizado"
-- Ignora processos cancelados
SELECT
    f.certificador_id,
    f.estado,
    count(*) AS qtd
FROM (
    SELECT
        certificador_id,
        CASE 
            WHEN estado = ANY(ARRAY['D','I']) THEN 'F'
            ELSE estado
        END AS estado
    FROM culturaviva.avaliacao
    WHERE estado <> 'C'
) f
GROUP BY f.certificador_id, f.estado;



-- Listar certificadores com informações sobre as avaliações
-- Considerando os status "[D] Deferido" e "[I] Indeferido" como "[F] Finalizado"
-- Ignora processos cancelados
WITH avaliacoes AS (
    SELECT
        f.certificador_id,
        f.estado,
        count(*) AS qtd
    FROM (
        SELECT
            certificador_id,
            CASE
                WHEN estado = ANY(ARRAY['D','I']) THEN 'F'
                ELSE estado
            END AS estado
        FROM culturaviva.avaliacao
        WHERE estado <> 'C'
    ) f
    GROUP BY f.certificador_id, f.estado
)
SELECT
    c.*,
    a.name AS agente_nome,
    COALESCE(ap.qtd, 0) AS avaliacoes_pendentes,
    COALESCE(aa.qtd, 0) AS avaliacoes_em_analise,
    COALESCE(af.qtd, 0) AS avaliacoes_finalizadas
FROM culturaviva.certificador c
JOIN agent a ON a.id = c.agente_id
LEFT JOIN avaliacoes ap ON ap.certificador_id = c.id AND ap.estado = 'P'
LEFT JOIN avaliacoes aa ON aa.certificador_id = c.id AND aa.estado = 'A'
LEFT JOIN avaliacoes af ON af.certificador_id = c.id AND af.estado = 'F'
;



-- Totalizadores de avaliações por AGENTE
-- Considerando os status "[D] Deferido" e "[I] Indeferido" como "[F] Finalizado"
-- Ignora processos cancelados
SELECT
    count(CASE WHEN avl.estado = 'P' THEN 1 END) as pendentes,
    count(CASE WHEN avl.estado = 'A' THEN 1 END) as em_analise,
    count(CASE WHEN avl.estado = ANY(ARRAY['D','I']) THEN 1 END) as finalizadas
FROM culturaviva.avaliacao avl
JOIN culturaviva.certificador cert ON cert.id = avl.certificador_id        
WHERE avl.estado <> 'C'
AND cert.agente_id = :agenteId
;


-- Listagem/Filtro de avaliações por status
-- Ordena por atualizações mais recentes e inscrições mais antigas
SELECT
    avl.*,
    cert.tipo AS certificador_tipo,
    agt.name AS certificador_nome,
    pnt.name AS ponto_nome,
    tp.value AS ponto_tipo    
FROM culturaviva.avaliacao avl
JOIN culturaviva.inscricao insc ON insc.id = avl.inscricao_id
JOIN culturaviva.certificador cert ON cert.id = avl.certificador_id
JOIN agent agt ON agt.id = cert.agente_id
JOIN agent pnt ON pnt.id = insc.agente_id
JOIN user_meta tp ON tp.key = 'tipoPontoCulturaDesejado' AND tp.object_id = pnt.user_id
WHERE avl.estado <> 'C'
AND (:agenteId = 0 OR cert.agente_id = :agenteId)
AND (:nome == '' OR unaccent(lower(pnt.name)) LIKE unaccent(lower(:nome)))
ORDER BY 
    avl.ts_atualizacao DESC,
    insc.ts_criacao ASC
    
user_id
rcv_tipo
tipoPontoCulturaDesejado
     'ponto' => 'Ponto',
     'pontao' => 'Pontão'


























