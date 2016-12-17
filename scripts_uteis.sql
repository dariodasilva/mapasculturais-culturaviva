
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

-- Registra o processo de certificacao
INSERT INTO culturaviva.subscription(agent_id, status)
    VALUES ((SELECT id FROM agent WHERE name = 'PontoCultura@local'), 'P');

-- Atribui processo para agente certificador (registrar pela interface)
INSERT INTO culturaviva.diligence(subscription_id, certifier_id, status)
    VALUES (
        (
            SELECT id 
            FROM culturaviva.subscription 
            WHERE agent_id = (SELECT id FROM agent WHERE name = 'PontoCultura@local')
        ), 
        (
            SELECT id 
            FROM culturaviva.certifier 
            WHERE agent_id = (
                SELECT id FROM agent 
                WHERE name = 
                    CASE 
                        /* alternar o booleano escolher o perfil */
                        WHEN true THEN 'AgenteCivil@local'
                        WHEN true THEN 'AgentePublico@local'
                        ELSE 'AgenteMinerva@local'
                    END
            )
        ),
        'P' 
    );













--------------------------------------------------------------------------------
-- CONSULTAS GENERICAS
--------------------------------------------------------------------------------

-- Status possiveis de diligencias (culturaviva.diligence.status)
-- [P] Pendent
-- [R] Under review
-- [C] Certified
-- [N] No certified


-- Quantidade de processos por certificador agrupado por status
SELECT
    d.certifier_id,
    d.status,
    count(*) AS qtd
FROM culturaviva.diligence d
GROUP BY d.certifier_id, d.status;


-- Quantidade de processos por certificador agrupado por status
-- Considerando os status "[C] Certified" e "[N] No certified" como "[F] Finalizado"
SELECT
    f.certifier_id,
    f.status,
    count(*) AS qtd
FROM (
    SELECT
        certifier_id,
        CASE 
            WHEN status = ANY(ARRAY['C','N']) THEN 'F'
            ELSE status
        END AS status
    FROM culturaviva.diligence
) f
GROUP BY f.certifier_id, f.status;



-- Listar certificadores com informações sobre os processos
WITH diligences AS (
    SELECT
        f.certifier_id,
        f.status,
        count(*) AS qtd
    FROM (
        SELECT
            certifier_id,
            CASE 
                WHEN status = ANY(ARRAY['C','N']) THEN 'F'
                ELSE status
            END AS status
        FROM culturaviva.diligence
    ) f
    GROUP BY f.certifier_id, f.status
)
SELECT 
    c.*,
    a.name AS agent_name,
    COALESCE(p.qtd, 0) AS diligences_p, 
    COALESCE(r.qtd, 0) AS diligences_r, 
    COALESCE(f.qtd, 0) AS diligences_f 
FROM culturaviva.certifier c
JOIN agent a ON a.id = c.agent_id
LEFT JOIN diligences p ON p.certifier_id = c.id AND p.status = 'P'
LEFT JOIN diligences r ON r.certifier_id = c.id AND r.status = 'R'
LEFT JOIN diligences f ON f.certifier_id = c.id AND r.status = 'F'
;