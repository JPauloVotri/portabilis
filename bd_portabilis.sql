--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.4
-- Dumped by pg_dump version 9.5.4

-- Started on 2016-10-13 19:15:07 BRT

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 2173 (class 1262 OID 12415)
-- Dependencies: 2172
-- Name: postgres; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON DATABASE postgres IS 'default administrative connection database';


--
-- TOC entry 1 (class 3079 OID 12397)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2176 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 182 (class 1259 OID 16407)
-- Name: aluno; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE aluno (
    id integer NOT NULL,
    cpf bigint,
    rg integer,
    data_nascimento date,
    nome character varying(40) NOT NULL,
    telefone character varying(20)
);


ALTER TABLE aluno OWNER TO postgres;

--
-- TOC entry 181 (class 1259 OID 16405)
-- Name: aluno_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE aluno_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE aluno_id_seq OWNER TO postgres;

--
-- TOC entry 2178 (class 0 OID 0)
-- Dependencies: 181
-- Name: aluno_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE aluno_id_seq OWNED BY aluno.id;


--
-- TOC entry 184 (class 1259 OID 16419)
-- Name: curso; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE curso (
    id integer NOT NULL,
    nome character varying(100),
    valor_inscricao numeric,
    periodo integer
);


ALTER TABLE curso OWNER TO postgres;

--
-- TOC entry 183 (class 1259 OID 16417)
-- Name: curso_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE curso_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE curso_id_seq OWNER TO postgres;

--
-- TOC entry 2181 (class 0 OID 0)
-- Dependencies: 183
-- Name: curso_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE curso_id_seq OWNED BY curso.id;


--
-- TOC entry 186 (class 1259 OID 16430)
-- Name: matricula; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE matricula (
    id integer NOT NULL,
    aluno_id integer,
    curso_id integer,
    data_matricula date,
    ano integer,
    ativo integer DEFAULT 1,
    pago integer
);


ALTER TABLE matricula OWNER TO postgres;

--
-- TOC entry 185 (class 1259 OID 16428)
-- Name: matricula_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE matricula_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE matricula_id_seq OWNER TO postgres;

--
-- TOC entry 2184 (class 0 OID 0)
-- Dependencies: 185
-- Name: matricula_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE matricula_id_seq OWNED BY matricula.id;


--
-- TOC entry 2034 (class 2604 OID 16410)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY aluno ALTER COLUMN id SET DEFAULT nextval('aluno_id_seq'::regclass);


--
-- TOC entry 2035 (class 2604 OID 16422)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY curso ALTER COLUMN id SET DEFAULT nextval('curso_id_seq'::regclass);


--
-- TOC entry 2036 (class 2604 OID 16433)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY matricula ALTER COLUMN id SET DEFAULT nextval('matricula_id_seq'::regclass);


--
-- TOC entry 2163 (class 0 OID 16407)
-- Dependencies: 182
-- Data for Name: aluno; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY aluno (id, cpf, rg, data_nascimento, nome, telefone) FROM stdin;
2	6915670939	0	1998-09-03	João Paulo	4888152851
\.


--
-- TOC entry 2186 (class 0 OID 0)
-- Dependencies: 181
-- Name: aluno_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('aluno_id_seq', 2, true);


--
-- TOC entry 2165 (class 0 OID 16419)
-- Dependencies: 184
-- Data for Name: curso; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY curso (id, nome, valor_inscricao, periodo) FROM stdin;
2	Engenharia de computação	0	3
\.


--
-- TOC entry 2187 (class 0 OID 0)
-- Dependencies: 183
-- Name: curso_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('curso_id_seq', 2, true);


--
-- TOC entry 2167 (class 0 OID 16430)
-- Dependencies: 186
-- Data for Name: matricula; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY matricula (id, aluno_id, curso_id, data_matricula, ano, ativo, pago) FROM stdin;
3	2	2	2016-10-13	2017	1	1
\.


--
-- TOC entry 2188 (class 0 OID 0)
-- Dependencies: 185
-- Name: matricula_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('matricula_id_seq', 3, true);


--
-- TOC entry 2039 (class 2606 OID 16448)
-- Name: aluno_cpf_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY aluno
    ADD CONSTRAINT aluno_cpf_key UNIQUE (cpf);


--
-- TOC entry 2041 (class 2606 OID 16412)
-- Name: aluno_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY aluno
    ADD CONSTRAINT aluno_pkey PRIMARY KEY (id);


--
-- TOC entry 2043 (class 2606 OID 16427)
-- Name: curso_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY curso
    ADD CONSTRAINT curso_pkey PRIMARY KEY (id);


--
-- TOC entry 2045 (class 2606 OID 16435)
-- Name: matricula_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY matricula
    ADD CONSTRAINT matricula_pkey PRIMARY KEY (id);


--
-- TOC entry 2046 (class 2606 OID 16436)
-- Name: matricula_aluno_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY matricula
    ADD CONSTRAINT matricula_aluno_id_fkey FOREIGN KEY (aluno_id) REFERENCES aluno(id);


--
-- TOC entry 2047 (class 2606 OID 16441)
-- Name: matricula_curso_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY matricula
    ADD CONSTRAINT matricula_curso_id_fkey FOREIGN KEY (curso_id) REFERENCES curso(id);


--
-- TOC entry 2175 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- TOC entry 2177 (class 0 OID 0)
-- Dependencies: 182
-- Name: aluno; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE aluno FROM PUBLIC;
REVOKE ALL ON TABLE aluno FROM postgres;
GRANT ALL ON TABLE aluno TO postgres;
GRANT ALL ON TABLE aluno TO jpaulo;


--
-- TOC entry 2179 (class 0 OID 0)
-- Dependencies: 181
-- Name: aluno_id_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE aluno_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE aluno_id_seq FROM postgres;
GRANT ALL ON SEQUENCE aluno_id_seq TO postgres;
GRANT ALL ON SEQUENCE aluno_id_seq TO jpaulo;


--
-- TOC entry 2180 (class 0 OID 0)
-- Dependencies: 184
-- Name: curso; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE curso FROM PUBLIC;
REVOKE ALL ON TABLE curso FROM postgres;
GRANT ALL ON TABLE curso TO postgres;
GRANT ALL ON TABLE curso TO jpaulo;


--
-- TOC entry 2182 (class 0 OID 0)
-- Dependencies: 183
-- Name: curso_id_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE curso_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE curso_id_seq FROM postgres;
GRANT ALL ON SEQUENCE curso_id_seq TO postgres;
GRANT ALL ON SEQUENCE curso_id_seq TO jpaulo;


--
-- TOC entry 2183 (class 0 OID 0)
-- Dependencies: 186
-- Name: matricula; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE matricula FROM PUBLIC;
REVOKE ALL ON TABLE matricula FROM postgres;
GRANT ALL ON TABLE matricula TO postgres;
GRANT ALL ON TABLE matricula TO jpaulo;


--
-- TOC entry 2185 (class 0 OID 0)
-- Dependencies: 185
-- Name: matricula_id_seq; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON SEQUENCE matricula_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE matricula_id_seq FROM postgres;
GRANT ALL ON SEQUENCE matricula_id_seq TO postgres;
GRANT ALL ON SEQUENCE matricula_id_seq TO jpaulo;


-- Completed on 2016-10-13 19:15:07 BRT

--
-- PostgreSQL database dump complete
--

