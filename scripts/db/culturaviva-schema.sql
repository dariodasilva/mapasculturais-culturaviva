
DROP SCHEMA culturaviva CASCADE;

CREATE SCHEMA culturaviva;

ALTER SCHEMA culturaviva OWNER TO vagrant;

--
-- Name: subscription_id_seq; Type: SEQUENCE; Schema: culturaviva; Owner: vagrant
--

CREATE SEQUENCE culturaviva.subscription_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE culturaviva.subscription_id_seq OWNER TO vagrant;

--
-- Name: subscription; Type: TABLE; Schema: culturaviva; Owner: vagrant; Tablespace:
--

CREATE TABLE culturaviva.subscription (
                id integer DEFAULT nextval('culturaviva.subscription_id_seq'::regclass) NOT NULL,
                agent_id INTEGER NOT NULL,
                status CHAR NOT NULL,
                created_at TIMESTAMP without time zone DEFAULT now() NOT NULL,
                updated_at TIMESTAMP without time zone NULL,
                CONSTRAINT subscription_pk PRIMARY KEY (id)
);
COMMENT ON COLUMN culturaviva.subscription.id IS 'Primary key of subscription table.';
COMMENT ON COLUMN culturaviva.subscription.agent_id IS 'Agent of subscription foreign key.';
COMMENT ON COLUMN culturaviva.subscription.status IS 'Status of subscription:

P - Pendent
C - Certified
N - No certified
R - Resubscribe';
COMMENT ON COLUMN culturaviva.subscription.created_at IS 'When the registry was created.';
COMMENT ON COLUMN culturaviva.subscription.updated_at IS 'When the registry was updated.';

ALTER TABLE culturaviva.subscription OWNER TO vagrant;


--
-- Name: certifier_id_seq; Type: SEQUENCE; Schema: culturaviva; Owner: vagrant
--

CREATE SEQUENCE culturaviva.certifier_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE culturaviva.certifier_id_seq OWNER TO vagrant;

--
-- Name: certifier; Type: TABLE; Schema: culturaviva; Owner: vagrant; Tablespace:
--

CREATE TABLE culturaviva.certifier (
                id INTEGER DEFAULT nextval('culturaviva.certifier_id_seq'::regclass) NOT NULL,
                agent_id INTEGER NOT NULL,
                is_active BOOLEAN NOT NULL,
                type CHAR NOT NULL,
                created_at TIMESTAMP without time zone DEFAULT now() NOT NULL,
                updated_at TIMESTAMP without time zone,
                CONSTRAINT certifier_pk PRIMARY KEY (id),
                -- Nao permite mais de um cadastro por agente/tipo
                CONSTRAINT certifier_agent_type_uk UNIQUE (agent_id, type)
);
COMMENT ON COLUMN culturaviva.certifier.id IS 'Primary key of certifier table.';
COMMENT ON COLUMN culturaviva.certifier.agent_id IS 'Foreign key of agent table (mapas)';
COMMENT ON COLUMN culturaviva.certifier.is_active IS 'Status of activity to certifier.';
COMMENT ON COLUMN culturaviva.certifier.type IS 'Type of certifier

S - Person of civil society
P - Public power member
M - Certifier with Minerva Vote';
COMMENT ON COLUMN culturaviva.certifier.created_at IS 'When the registry was created.';
COMMENT ON COLUMN culturaviva.certifier.updated_at IS 'When the registry was updated.';


ALTER TABLE culturaviva.certifier OWNER TO vagrant;


--
-- Name: diligence_id_seq; Type: SEQUENCE; Schema: culturaviva; Owner: vagrant
--

CREATE SEQUENCE culturaviva.diligence_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE culturaviva.diligence_id_seq OWNER TO vagrant;

--
-- Name: diligence; Type: TABLE; Schema: culturaviva; Owner: vagrant; Tablespace:
--

CREATE TABLE culturaviva.diligence (
                id INTEGER DEFAULT nextval('culturaviva.diligence_id_seq'::regclass) NOT NULL,
                subscription_id INTEGER NOT NULL,
                certifier_id INTEGER NOT NULL,
                status CHAR NOT NULL,
                is_recognized BOOLEAN NOT NULL DEFAULT true,
                is_experienced BOOLEAN NOT NULL DEFAULT true,
                justification VARCHAR(1000),
                created_at TIMESTAMP without time zone DEFAULT now() NOT NULL,
                updated_at TIMESTAMP without time zone NULL,
                CONSTRAINT diligence_pk PRIMARY KEY (id),
                CONSTRAINT diligence_uk UNIQUE (certifier_id, subscription_id),
                CONSTRAINT diligence_subscription_fk FOREIGN KEY (subscription_id)
                    REFERENCES culturaviva.subscription (id)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION
                    NOT DEFERRABLE,
                CONSTRAINT diligence_certifier_fk FOREIGN KEY (certifier_id)
                    REFERENCES culturaviva.certifier (id)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION
                    NOT DEFERRABLE
);
COMMENT ON COLUMN culturaviva.diligence.id IS 'Primary key of diligence table.';
COMMENT ON COLUMN culturaviva.diligence.subscription_id IS 'Primary key of subscription table.';
COMMENT ON COLUMN culturaviva.diligence.certifier_id IS 'Primary key of certifier table.';
COMMENT ON COLUMN culturaviva.diligence.status IS 'Status of diligence.

P - Pendent
R - Under review
C - Certified
N - No certified';
COMMENT ON COLUMN culturaviva.diligence.is_recognized IS 'It indicates whether the agent is recognized.';
COMMENT ON COLUMN culturaviva.diligence.is_experienced IS 'It indicates whether the agent is experienced';
COMMENT ON COLUMN culturaviva.diligence.justification IS 'Justification to diligence.';
COMMENT ON COLUMN culturaviva.diligence.created_at IS 'When the registry was created.';
COMMENT ON COLUMN culturaviva.diligence.updated_at IS 'When the registry was updated.';


ALTER TABLE culturaviva.diligence OWNER TO vagrant;

--
-- Name: configuration; Type: TABLE; Schema: culturaviva; Owner: vagrant; Tablespace:
--

CREATE TABLE culturaviva.configuration (
                id INTEGER NOT NULL,
                civil INTEGER NOT NULL,
                government INTEGER NOT NULL,
                created_at TIMESTAMP without time zone DEFAULT now() NOT NULL,
                updated_at TIMESTAMP without time zone NULL,
                CONSTRAINT configuration_pk PRIMARY KEY (id)
);
COMMENT ON COLUMN culturaviva.configuration.id IS 'Primary key of configuration table.';
COMMENT ON COLUMN culturaviva.configuration.civil IS 'Civil agent number.';
COMMENT ON COLUMN culturaviva.configuration.government IS 'Government agent number.';
COMMENT ON COLUMN culturaviva.configuration.created_at IS 'When the registry was created.';
COMMENT ON COLUMN culturaviva.configuration.updated_at IS 'When the registry was updated.';


ALTER TABLE culturaviva.configuration OWNER TO vagrant;

------------------



