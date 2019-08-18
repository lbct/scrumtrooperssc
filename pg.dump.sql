--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: administrador; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE administrador (
    id integer NOT NULL,
    usuario_id integer NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.administrador OWNER TO seslab;

--
-- Name: administrador_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE administrador_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.administrador_id_seq OWNER TO seslab;

--
-- Name: administrador_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE administrador_id_seq OWNED BY administrador.id;


--
-- Name: asigna_funcion; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE asigna_funcion (
    id integer NOT NULL,
    rol_id integer NOT NULL,
    funcion_id integer NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.asigna_funcion OWNER TO seslab;

--
-- Name: asigna_funcion_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE asigna_funcion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.asigna_funcion_id_seq OWNER TO seslab;

--
-- Name: asigna_funcion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE asigna_funcion_id_seq OWNED BY asigna_funcion.id;


--
-- Name: asigna_rol; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE asigna_rol (
    id integer NOT NULL,
    usuario_id integer NOT NULL,
    rol_id integer NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.asigna_rol OWNER TO seslab;

--
-- Name: asigna_rol_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE asigna_rol_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.asigna_rol_id_seq OWNER TO seslab;

--
-- Name: asigna_rol_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE asigna_rol_id_seq OWNED BY asigna_rol.id;


--
-- Name: aula; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE aula (
    id integer NOT NULL,
    codigo_aula character varying(25) NOT NULL,
    nombre_aula character varying(255) NOT NULL,
    capacidad_aula integer DEFAULT 1 NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.aula OWNER TO seslab;

--
-- Name: aula_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE aula_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.aula_id_seq OWNER TO seslab;

--
-- Name: aula_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE aula_id_seq OWNED BY aula.id;


--
-- Name: auxiliar; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE auxiliar (
    id integer NOT NULL,
    usuario_id integer NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.auxiliar OWNER TO seslab;

--
-- Name: auxiliar_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE auxiliar_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.auxiliar_id_seq OWNER TO seslab;

--
-- Name: auxiliar_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE auxiliar_id_seq OWNED BY auxiliar.id;


--
-- Name: clase; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE clase (
    id integer NOT NULL,
    gestion_id integer NOT NULL,
    aula_id integer NOT NULL,
    horario_id integer NOT NULL,
    grupo_docente_id integer NOT NULL,
    dia smallint NOT NULL,
    semana_actual_sesion smallint DEFAULT 0::smallint NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.clase OWNER TO seslab;

--
-- Name: clase_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE clase_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.clase_id_seq OWNER TO seslab;

--
-- Name: clase_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE clase_id_seq OWNED BY clase.id;


--
-- Name: docente; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE docente (
    id integer NOT NULL,
    usuario_id integer NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.docente OWNER TO seslab;

--
-- Name: docente_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE docente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.docente_id_seq OWNER TO seslab;

--
-- Name: docente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE docente_id_seq OWNED BY docente.id;


--
-- Name: envio_practica; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE envio_practica (
    id integer NOT NULL,
    sesion_estudiante_id integer NOT NULL,
    en_laboratorio boolean DEFAULT false NOT NULL,
    archivo character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.envio_practica OWNER TO seslab;

--
-- Name: envio_practica_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE envio_practica_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.envio_practica_id_seq OWNER TO seslab;

--
-- Name: envio_practica_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE envio_practica_id_seq OWNED BY envio_practica.id;


--
-- Name: estudiante; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE estudiante (
    id integer NOT NULL,
    usuario_id integer NOT NULL,
    codigo_sis character varying(15) DEFAULT ''::character varying NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.estudiante OWNER TO seslab;

--
-- Name: estudiante_clase; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE estudiante_clase (
    id integer NOT NULL,
    clase_id integer NOT NULL,
    estudiante_id integer NOT NULL,
    grupo_a_docente_id integer NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.estudiante_clase OWNER TO seslab;

--
-- Name: estudiante_clase_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE estudiante_clase_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.estudiante_clase_id_seq OWNER TO seslab;

--
-- Name: estudiante_clase_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE estudiante_clase_id_seq OWNED BY estudiante_clase.id;


--
-- Name: estudiante_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE estudiante_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.estudiante_id_seq OWNER TO seslab;

--
-- Name: estudiante_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE estudiante_id_seq OWNED BY estudiante.id;


--
-- Name: fecha_inscripcion; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE fecha_inscripcion (
    id integer NOT NULL,
    inicio_inscripcion timestamp(0) without time zone NOT NULL,
    fin_inscripcion timestamp(0) without time zone NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.fecha_inscripcion OWNER TO seslab;

--
-- Name: fecha_inscripcion_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE fecha_inscripcion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.fecha_inscripcion_id_seq OWNER TO seslab;

--
-- Name: fecha_inscripcion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE fecha_inscripcion_id_seq OWNED BY fecha_inscripcion.id;


--
-- Name: funcion; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE funcion (
    id integer NOT NULL,
    descripcion character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.funcion OWNER TO seslab;

--
-- Name: funcion_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE funcion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.funcion_id_seq OWNER TO seslab;

--
-- Name: funcion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE funcion_id_seq OWNED BY funcion.id;


--
-- Name: gestion; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE gestion (
    id integer NOT NULL,
    periodo_id integer NOT NULL,
    anho_gestion character varying(4) NOT NULL,
    activa boolean DEFAULT false NOT NULL,
    inicio date NOT NULL,
    fin date NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.gestion OWNER TO seslab;

--
-- Name: gestion_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE gestion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.gestion_id_seq OWNER TO seslab;

--
-- Name: gestion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE gestion_id_seq OWNED BY gestion.id;


--
-- Name: grupo_a_docente; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE grupo_a_docente (
    id integer NOT NULL,
    docente_id integer NOT NULL,
    grupo_docente_id integer NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.grupo_a_docente OWNER TO seslab;

--
-- Name: grupo_a_docente_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE grupo_a_docente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.grupo_a_docente_id_seq OWNER TO seslab;

--
-- Name: grupo_a_docente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE grupo_a_docente_id_seq OWNED BY grupo_a_docente.id;


--
-- Name: grupo_docente; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE grupo_docente (
    id integer NOT NULL,
    materia_id integer NOT NULL,
    detalle_grupo_docente character varying(255),
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.grupo_docente OWNER TO seslab;

--
-- Name: grupo_docente_auxiliar; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE grupo_docente_auxiliar (
    id integer NOT NULL,
    grupo_docente_id integer NOT NULL,
    auxiliar_id integer NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.grupo_docente_auxiliar OWNER TO seslab;

--
-- Name: grupo_docente_auxiliar_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE grupo_docente_auxiliar_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.grupo_docente_auxiliar_id_seq OWNER TO seslab;

--
-- Name: grupo_docente_auxiliar_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE grupo_docente_auxiliar_id_seq OWNED BY grupo_docente_auxiliar.id;


--
-- Name: grupo_docente_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE grupo_docente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.grupo_docente_id_seq OWNER TO seslab;

--
-- Name: grupo_docente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE grupo_docente_id_seq OWNED BY grupo_docente.id;


--
-- Name: guia_practica; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE guia_practica (
    id integer NOT NULL,
    archivo character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.guia_practica OWNER TO seslab;

--
-- Name: guia_practica_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE guia_practica_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.guia_practica_id_seq OWNER TO seslab;

--
-- Name: guia_practica_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE guia_practica_id_seq OWNED BY guia_practica.id;


--
-- Name: horario; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE horario (
    id integer NOT NULL,
    hora_inicio time(0) without time zone NOT NULL,
    hora_fin time(0) without time zone NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.horario OWNER TO seslab;

--
-- Name: horario_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE horario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.horario_id_seq OWNER TO seslab;

--
-- Name: horario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE horario_id_seq OWNED BY horario.id;


--
-- Name: iniciar_sesion; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE iniciar_sesion (
    id integer NOT NULL,
    usuario_id integer NOT NULL,
    fecha timestamp(0) without time zone NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.iniciar_sesion OWNER TO seslab;

--
-- Name: iniciar_sesion_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE iniciar_sesion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.iniciar_sesion_id_seq OWNER TO seslab;

--
-- Name: iniciar_sesion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE iniciar_sesion_id_seq OWNED BY iniciar_sesion.id;


--
-- Name: inicio_clase; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE inicio_clase (
    id integer NOT NULL,
    sesion_id integer NOT NULL,
    inicio_sesion timestamp(0) without time zone NOT NULL,
    fin_sesion timestamp(0) without time zone NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.inicio_clase OWNER TO seslab;

--
-- Name: inicio_clase_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE inicio_clase_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.inicio_clase_id_seq OWNER TO seslab;

--
-- Name: inicio_clase_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE inicio_clase_id_seq OWNED BY inicio_clase.id;


--
-- Name: materia; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE materia (
    id integer NOT NULL,
    gestion_id integer NOT NULL,
    codigo_materia character varying(15) NOT NULL,
    nombre_materia character varying(255) NOT NULL,
    detalle_materia character varying(1023) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.materia OWNER TO seslab;

--
-- Name: materia_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE materia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.materia_id_seq OWNER TO seslab;

--
-- Name: materia_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE materia_id_seq OWNED BY materia.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE migrations (
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO seslab;

--
-- Name: periodo; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE periodo (
    id integer NOT NULL,
    descripcion character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.periodo OWNER TO seslab;

--
-- Name: periodo_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE periodo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.periodo_id_seq OWNER TO seslab;

--
-- Name: periodo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE periodo_id_seq OWNED BY periodo.id;


--
-- Name: rol; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE rol (
    id integer NOT NULL,
    descripcion character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.rol OWNER TO seslab;

--
-- Name: rol_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE rol_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.rol_id_seq OWNER TO seslab;

--
-- Name: rol_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE rol_id_seq OWNED BY rol.id;


--
-- Name: sesion; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE sesion (
    id integer NOT NULL,
    clase_id integer NOT NULL,
    auxiliar_terminal_id integer,
    guia_practica_id integer NOT NULL,
    semana integer NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.sesion OWNER TO seslab;

--
-- Name: sesion_estudiante; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE sesion_estudiante (
    id integer NOT NULL,
    sesion_id integer NOT NULL,
    estudiante_clase_id integer NOT NULL,
    auxiliar_comentario_id integer,
    auxiliar_lista_id integer,
    comentario_auxiliar character varying(1023),
    asistencia_sesion boolean DEFAULT false NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.sesion_estudiante OWNER TO seslab;

--
-- Name: sesion_estudiante_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE sesion_estudiante_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sesion_estudiante_id_seq OWNER TO seslab;

--
-- Name: sesion_estudiante_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE sesion_estudiante_id_seq OWNED BY sesion_estudiante.id;


--
-- Name: sesion_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE sesion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sesion_id_seq OWNER TO seslab;

--
-- Name: sesion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE sesion_id_seq OWNED BY sesion.id;


--
-- Name: usuario; Type: TABLE; Schema: public; Owner: seslab; Tablespace: 
--

CREATE TABLE usuario (
    id integer NOT NULL,
    username character varying(63) NOT NULL,
    password character varying(100) NOT NULL,
    nombre character varying(100) NOT NULL,
    apellido character varying(100) NOT NULL,
    correo character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.usuario OWNER TO seslab;

--
-- Name: usuario_id_seq; Type: SEQUENCE; Schema: public; Owner: seslab
--

CREATE SEQUENCE usuario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuario_id_seq OWNER TO seslab;

--
-- Name: usuario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: seslab
--

ALTER SEQUENCE usuario_id_seq OWNED BY usuario.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY administrador ALTER COLUMN id SET DEFAULT nextval('administrador_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY asigna_funcion ALTER COLUMN id SET DEFAULT nextval('asigna_funcion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY asigna_rol ALTER COLUMN id SET DEFAULT nextval('asigna_rol_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY aula ALTER COLUMN id SET DEFAULT nextval('aula_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY auxiliar ALTER COLUMN id SET DEFAULT nextval('auxiliar_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY clase ALTER COLUMN id SET DEFAULT nextval('clase_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY docente ALTER COLUMN id SET DEFAULT nextval('docente_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY envio_practica ALTER COLUMN id SET DEFAULT nextval('envio_practica_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY estudiante ALTER COLUMN id SET DEFAULT nextval('estudiante_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY estudiante_clase ALTER COLUMN id SET DEFAULT nextval('estudiante_clase_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY fecha_inscripcion ALTER COLUMN id SET DEFAULT nextval('fecha_inscripcion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY funcion ALTER COLUMN id SET DEFAULT nextval('funcion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY gestion ALTER COLUMN id SET DEFAULT nextval('gestion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY grupo_a_docente ALTER COLUMN id SET DEFAULT nextval('grupo_a_docente_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY grupo_docente ALTER COLUMN id SET DEFAULT nextval('grupo_docente_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY grupo_docente_auxiliar ALTER COLUMN id SET DEFAULT nextval('grupo_docente_auxiliar_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY guia_practica ALTER COLUMN id SET DEFAULT nextval('guia_practica_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY horario ALTER COLUMN id SET DEFAULT nextval('horario_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY iniciar_sesion ALTER COLUMN id SET DEFAULT nextval('iniciar_sesion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY inicio_clase ALTER COLUMN id SET DEFAULT nextval('inicio_clase_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY materia ALTER COLUMN id SET DEFAULT nextval('materia_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY periodo ALTER COLUMN id SET DEFAULT nextval('periodo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY rol ALTER COLUMN id SET DEFAULT nextval('rol_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY sesion ALTER COLUMN id SET DEFAULT nextval('sesion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY sesion_estudiante ALTER COLUMN id SET DEFAULT nextval('sesion_estudiante_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY usuario ALTER COLUMN id SET DEFAULT nextval('usuario_id_seq'::regclass);


--
-- Data for Name: administrador; Type: TABLE DATA; Schema: public; Owner: seslab
--

COPY administrador (id, usuario_id, created_at, updated_at) FROM stdin;
1	1	2019-08-14 23:45:09	2019-08-14 23:45:09
\.


--
-- Name: administrador_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('administrador_id_seq', 2, true);


--
-- Data for Name: asigna_funcion; Type: TABLE DATA; Schema: public; Owner: seslab
--

COPY asigna_funcion (id, rol_id, funcion_id, created_at, updated_at) FROM stdin;
1	1	1	2019-08-14 23:45:09	2019-08-14 23:45:09
\.


--
-- Name: asigna_funcion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('asigna_funcion_id_seq', 1, true);


--
-- Data for Name: asigna_rol; Type: TABLE DATA; Schema: public; Owner: seslab
--

COPY asigna_rol (id, usuario_id, rol_id, created_at, updated_at) FROM stdin;
1	1	1	2019-08-14 23:45:09	2019-08-14 23:45:09
2	2	5	2019-08-15 16:12:07	2019-08-15 16:12:07
3	3	5	2019-08-15 16:12:26	2019-08-15 16:12:26
6	5	5	2019-08-15 17:06:30	2019-08-15 17:06:30
7	6	5	2019-08-15 17:14:18	2019-08-15 17:14:18
8	7	5	2019-08-15 17:30:34	2019-08-15 17:30:34
9	8	5	2019-08-15 17:43:43	2019-08-15 17:43:43
10	9	5	2019-08-15 17:49:23	2019-08-15 17:49:23
11	10	5	2019-08-15 17:54:25	2019-08-15 17:54:25
12	11	5	2019-08-15 18:04:10	2019-08-15 18:04:10
13	12	5	2019-08-15 18:16:05	2019-08-15 18:16:05
24	18	5	2019-08-16 15:08:49	2019-08-16 15:08:49
25	19	5	2019-08-16 15:53:32	2019-08-16 15:53:32
26	20	5	2019-08-17 10:37:56	2019-08-17 10:37:56
27	21	5	2019-08-18 10:58:54	2019-08-18 10:58:54
\.


--
-- Name: asigna_rol_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('asigna_rol_id_seq', 27, true);


--
-- Data for Name: aula; Type: TABLE DATA; Schema: public; Owner: seslab
--



--
-- Name: aula_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('aula_id_seq', 3, true);


--
-- Data for Name: auxiliar; Type: TABLE DATA; Schema: public; Owner: seslab
--


--
-- Name: auxiliar_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('auxiliar_id_seq', 2, true);


--
-- Data for Name: clase; Type: TABLE DATA; Schema: public; Owner: seslab
--

--
-- Name: clase_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('clase_id_seq', 1, true);


--
-- Data for Name: docente; Type: TABLE DATA; Schema: public; Owner: seslab
--

--
-- Name: docente_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('docente_id_seq', 5, true);


--
-- Data for Name: envio_practica; Type: TABLE DATA; Schema: public; Owner: seslab
--

COPY envio_practica (id, sesion_estudiante_id, en_laboratorio, archivo, created_at, updated_at) FROM stdin;
\.


--
-- Name: envio_practica_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('envio_practica_id_seq', 9, true);


--
-- Data for Name: estudiante; Type: TABLE DATA; Schema: public; Owner: seslab
--

COPY estudiante (id, usuario_id, codigo_sis, created_at, updated_at) FROM stdin;
1	2	201900808	2019-08-15 16:12:07	2019-08-15 16:12:07
2	3	201900792	2019-08-15 16:12:26	2019-08-15 16:12:26
4	5	201809663	2019-08-15 17:06:30	2019-08-15 17:06:30
5	6	201902480	2019-08-15 17:14:18	2019-08-15 17:14:18
6	7	201904928	2019-08-15 17:30:34	2019-08-15 17:30:34
7	8	201900820	2019-08-15 17:43:43	2019-08-15 17:43:43
8	9	201910095	2019-08-15 17:49:23	2019-08-15 17:49:23
9	10	201606622	2019-08-15 17:54:25	2019-08-15 17:54:25
10	11	201910113	2019-08-15 18:04:10	2019-08-15 18:04:10
11	12	201809379	2019-08-15 18:16:05	2019-08-15 18:16:05
14	18	201401232	2019-08-16 15:08:49	2019-08-16 15:08:49
15	19	201904968	2019-08-16 15:53:32	2019-08-16 15:53:32
16	20	201506772	2019-08-17 10:37:56	2019-08-17 10:37:56
17	21	201900801	2019-08-18 10:58:54	2019-08-18 10:58:54
\.


--
-- Data for Name: estudiante_clase; Type: TABLE DATA; Schema: public; Owner: seslab
--

COPY estudiante_clase (id, clase_id, estudiante_id, grupo_a_docente_id, created_at, updated_at) FROM stdin;
\.


--
-- Name: estudiante_clase_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('estudiante_clase_id_seq', 2, true);


--
-- Name: estudiante_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('estudiante_id_seq', 17, true);


--
-- Data for Name: fecha_inscripcion; Type: TABLE DATA; Schema: public; Owner: seslab
--

COPY fecha_inscripcion (id, inicio_inscripcion, fin_inscripcion, created_at, updated_at) FROM stdin;
\.


--
-- Name: fecha_inscripcion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('fecha_inscripcion_id_seq', 2, true);


--
-- Data for Name: funcion; Type: TABLE DATA; Schema: public; Owner: seslab
--

COPY funcion (id, descripcion, created_at, updated_at) FROM stdin;
1	Añadir Administrador	2019-08-14 23:45:09	2019-08-14 23:45:09
2	Editar Administrador	2019-08-14 23:45:09	2019-08-14 23:45:09
3	Borrar Administrador	2019-08-14 23:45:09	2019-08-14 23:45:09
4	Añadir Gestión	2019-08-14 23:45:09	2019-08-14 23:45:09
5	Editar Gestión	2019-08-14 23:45:09	2019-08-14 23:45:09
6	Borrar Gestión	2019-08-14 23:45:09	2019-08-14 23:45:09
7	Añadir Docente	2019-08-14 23:45:09	2019-08-14 23:45:09
8	Editar Docente	2019-08-14 23:45:09	2019-08-14 23:45:09
9	Borrar Docente	2019-08-14 23:45:09	2019-08-14 23:45:09
10	Añadir Auxiliar De Laboratorio	2019-08-14 23:45:09	2019-08-14 23:45:09
11	Editar Auxiliar De Laboratorio	2019-08-14 23:45:09	2019-08-14 23:45:09
12	Borrar Auxiliar De Laboratorio	2019-08-14 23:45:09	2019-08-14 23:45:09
13	Añadir Auxiliar De Terminal	2019-08-14 23:45:09	2019-08-14 23:45:09
14	Editar Auxiliar De Terminal	2019-08-14 23:45:09	2019-08-14 23:45:09
15	Borrar Auxiliar De Terminal	2019-08-14 23:45:09	2019-08-14 23:45:09
16	Editar Estudiante	2019-08-14 23:45:09	2019-08-14 23:45:09
17	Borrar Estudiante	2019-08-14 23:45:09	2019-08-14 23:45:09
\.


--
-- Name: funcion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('funcion_id_seq', 17, true);


--
-- Data for Name: gestion; Type: TABLE DATA; Schema: public; Owner: seslab
--


--
-- Name: gestion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('gestion_id_seq', 1, true);


--
-- Data for Name: grupo_a_docente; Type: TABLE DATA; Schema: public; Owner: seslab
--


--
-- Name: grupo_a_docente_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('grupo_a_docente_id_seq', 2, true);


--
-- Data for Name: grupo_docente; Type: TABLE DATA; Schema: public; Owner: seslab
--


--
-- Data for Name: grupo_docente_auxiliar; Type: TABLE DATA; Schema: public; Owner: seslab
--

--
-- Name: grupo_docente_auxiliar_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('grupo_docente_auxiliar_id_seq', 2, true);


--
-- Name: grupo_docente_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('grupo_docente_id_seq', 1, true);


--
-- Data for Name: guia_practica; Type: TABLE DATA; Schema: public; Owner: seslab
--

--
-- Name: guia_practica_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('guia_practica_id_seq', 4, true);


--
-- Data for Name: horario; Type: TABLE DATA; Schema: public; Owner: seslab
--

COPY horario (id, hora_inicio, hora_fin, created_at, updated_at) FROM stdin;
1	06:45:00	08:15:00	2019-08-14 23:45:09	2019-08-14 23:45:09
2	08:15:00	09:45:00	2019-08-14 23:45:09	2019-08-14 23:45:09
3	09:45:00	11:15:00	2019-08-14 23:45:09	2019-08-14 23:45:09
4	11:15:00	12:45:00	2019-08-14 23:45:09	2019-08-14 23:45:09
5	12:45:00	14:15:00	2019-08-14 23:45:09	2019-08-14 23:45:09
6	14:15:00	15:45:00	2019-08-14 23:45:09	2019-08-14 23:45:09
7	15:45:00	17:15:00	2019-08-14 23:45:09	2019-08-14 23:45:09
8	17:15:00	18:45:00	2019-08-14 23:45:09	2019-08-14 23:45:09
9	18:45:00	20:15:00	2019-08-14 23:45:09	2019-08-14 23:45:09
10	20:15:00	21:45:00	2019-08-14 23:45:09	2019-08-14 23:45:09
\.


--
-- Name: horario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('horario_id_seq', 10, true);


--
-- Data for Name: iniciar_sesion; Type: TABLE DATA; Schema: public; Owner: seslab
--

COPY iniciar_sesion (id, usuario_id, fecha, created_at, updated_at) FROM stdin;
\.


--
-- Name: iniciar_sesion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('iniciar_sesion_id_seq', 1, false);


--
-- Data for Name: inicio_clase; Type: TABLE DATA; Schema: public; Owner: seslab
--

--
-- Name: inicio_clase_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('inicio_clase_id_seq', 3, true);


--
-- Data for Name: materia; Type: TABLE DATA; Schema: public; Owner: seslab
--

--
-- Name: materia_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('materia_id_seq', 1, true);


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: seslab
--

COPY migrations (migration, batch) FROM stdin;
2019_03_22_000000_crear_tabla_usuario	1
2019_03_22_000001_crear_tabla_periodo	1
2019_03_22_000002_crear_tabla_gestion	1
2019_03_22_000003_crear_tabla_materia	1
2019_03_22_000005_crear_tabla_grupo_docente	1
2019_03_22_000007_crear_tabla_administrador	1
2019_03_22_000007_crear_tabla_auxiliar	1
2019_03_22_000007_crear_tabla_docente	1
2019_03_22_000007_crear_tabla_estudiante	1
2019_03_23_000008_crear_tabla_iniciar_sesion	1
2019_03_23_000009_crear_tabla_rol	1
2019_03_23_000010_crear_tabla_asigna_rol	1
2019_03_23_000011_crear_tabla_funcion	1
2019_03_23_000012_crear_tabla_asigna_funcion	1
2019_03_23_000013_crear_tabla_grupo_a_docente	1
2019_03_23_000014_crear_tabla_aula	1
2019_03_23_000014_crear_tabla_horario	1
2019_03_23_000015_crear_tabla_clase	1
2019_03_23_000016_crear_tabla_estudiante_clase	1
2019_03_23_000016_crear_tabla_guia_practica	1
2019_03_23_000017_crear_tabla_sesion	1
2019_03_23_000019_crear_tabla_sesion_estudiante	1
2019_03_23_000020_crear_tabla_envio_practica	1
2019_03_23_000021_crear_tabla_grupo_docente_auxiliar	1
2019_06_28_000022_crear_tabla_fecha_inscripcion	1
2019_06_29_000023_crear_tabla_inicio_clase	1
\.


--
-- Data for Name: periodo; Type: TABLE DATA; Schema: public; Owner: seslab
--

COPY periodo (id, descripcion, created_at, updated_at) FROM stdin;
1	Primer Semestre	2019-08-14 23:45:09	2019-08-14 23:45:09
2	Segundo Semestre	2019-08-14 23:45:09	2019-08-14 23:45:09
3	Invierno	2019-08-14 23:45:09	2019-08-14 23:45:09
4	Verano	2019-08-14 23:45:09	2019-08-14 23:45:09
\.


--
-- Name: periodo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('periodo_id_seq', 4, true);


--
-- Data for Name: rol; Type: TABLE DATA; Schema: public; Owner: seslab
--

COPY rol (id, descripcion, created_at, updated_at) FROM stdin;
1	Administrador	2019-08-14 23:45:09	2019-08-14 23:45:09
2	Docente	2019-08-14 23:45:09	2019-08-14 23:45:09
3	AuxiliarLaboratorio	2019-08-14 23:45:09	2019-08-14 23:45:09
4	AuxiliarTerminal	2019-08-14 23:45:09	2019-08-14 23:45:09
5	Estudiante	2019-08-14 23:45:09	2019-08-14 23:45:09
\.


--
-- Name: rol_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('rol_id_seq', 5, true);


--
-- Data for Name: sesion; Type: TABLE DATA; Schema: public; Owner: seslab
--

--
-- Data for Name: sesion_estudiante; Type: TABLE DATA; Schema: public; Owner: seslab
--

--
-- Name: sesion_estudiante_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('sesion_estudiante_id_seq', 3, true);


--
-- Name: sesion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('sesion_id_seq', 4, true);


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: seslab
--

COPY usuario (id, username, password, nombre, apellido, correo, created_at, updated_at) FROM stdin;
1	admin	$2y$10$CixTdwOs6Z/dBmGVJmOq0uOa5SXpv8iXHzdsRD5f.6AJY9zXCb46e	Administrador		scrumtrooperssc@gmail.com	2019-08-14 23:45:09	2019-08-14 23:45:09
3	Marcelo Sivila	$2y$10$K/.jLoiSS9gJ73vcVohmauCH7CGOyWbw68/T.q7NrjSeECtG093Du	Sammy Marcelo	Sivila Sanchez	Marcelo7650988@gmail.com	2019-08-15 16:12:26	2019-08-15 16:41:10
5	201809663	$2y$10$r6vYUJFQ5hY5eA.XvfapIOQzjqoqE1tJS9Q.WDVkjCQOJprEmO1ou	Carlos Fernando 	Rojas Guzman	car_lito_30@Hotmail.com	2019-08-15 17:06:30	2019-08-15 17:06:30
6	Willams 	$2y$10$UfzrcmA2aOMYBWKVF3TDne7m4MILvtS.RH5nMZDLsExH9uakNaQ/O	Willams	Cervantes Coaquera 	willamscervantes.12345@gmail.com	2019-08-15 17:14:18	2019-08-15 17:14:18
7	Josequiroz	$2y$10$5TzY1VOKi3Aiba2OJYHsxOcR9BOSatUlrDnLIiorh7V80pU/SPqeS	Jose	Quiroz	joseyangela896321@gmail.com	2019-08-15 17:30:34	2019-08-15 17:30:34
8	12907205	$2y$10$qpuKRTnY68YrhpSpQocrA.kARfslXyrXMk3KiDdky9hS/Fw3mIMte	Gladys	Borraz	borrazgg@gmail.com	2019-08-15 17:43:43	2019-08-15 17:43:43
9	mio.xd	$2y$10$44wZ1sgMNInJPeyhiX5gqerBp/86JZLEzYT1FrFZd.es0JcRzK5eK	Luis	Quena	Mio.xD@hotmail.com	2019-08-15 17:49:23	2019-08-15 17:49:23
10	alejo01	$2y$10$27m1gqFETwAZJ3.RnV0yz.A4eCy6T/CRtaPPadcUFZO50a7zZ7iJC	Alejandro	Colque Gonzales	alejandro.c.gonzales@gmail.com	2019-08-15 17:54:25	2019-08-15 17:54:25
11	201910113	$2y$10$YthH9mAeH588Bg9jUXFWUuNkqD9N/x34b8GxUB3BI7yt.j55VOyIu	Cristian caleb	Rojas rios	cristianryc396@gmail.com	2019-08-15 18:04:10	2019-08-15 18:04:10
12	Lefor1	$2y$10$UR6MB6DEn3sEdByGJO/SWuF8ENk9t.XfXNexbWWvO/lLcaONXT6vy	Wilmar 	Huarachi Garcia 	lolskill34@gmail.com	2019-08-15 18:16:05	2019-08-15 18:16:05
2	Jhennifer Farjuri	$2y$10$a14s36ZcGh97pHLabf6ZMOpg7Baj/c4RdIujbjQAffMNCHoBbpK2C	Jhennifer 	Farjuri Saavedra 	jhennimufasa1323@gmail.com	2019-08-15 16:12:07	2019-08-16 02:54:56
18	201401232	$2y$10$uNqodbcbILkdTHreT1MLzOcf/MrkgsN5WKPHaUP.0Y3z60M5K.hXy	Eduardo	Salvatierra Huanca	salvatierrahuancaeduardo@gmail.com	2019-08-16 15:08:49	2019-08-16 15:08:49
19	8855834	$2y$10$s3uwWX2lvM/c2cQzWgbQAe4KZcdM9GD3OI0f3wu8DQPvEGieNT3Y6	Arturo	Rojas Azurduy 	arturojas.ara@gmail.com	2019-08-16 15:53:32	2019-08-16 15:53:32
20	Bocky	$2y$10$X1ec7uM.M4gyEq5S1j9Q5eN3EJIUFCHH.eKADA622UDxLs7hGllue	Oliver	Chiri	catastro75@gmail.com	2019-08-17 10:37:56	2019-08-17 10:37:56
21	maicol007	$2y$10$fHB6tN9XUNxl1VoVIVlXpuq9gvfS46jQwgiVWgBj0okI70q52kraW	Maicol Danilo	Aparicio Mostajo	mada_mo_ap@hotmail.com	2019-08-18 10:58:54	2019-08-18 10:58:54
\.


--
-- Name: usuario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: seslab
--

SELECT pg_catalog.setval('usuario_id_seq', 21, true);


--
-- Name: administrador_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY administrador
    ADD CONSTRAINT administrador_pkey PRIMARY KEY (id);


--
-- Name: asigna_funcion_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY asigna_funcion
    ADD CONSTRAINT asigna_funcion_pkey PRIMARY KEY (id);


--
-- Name: asigna_rol_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY asigna_rol
    ADD CONSTRAINT asigna_rol_pkey PRIMARY KEY (id);


--
-- Name: aula_codigo_aula_unique; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY aula
    ADD CONSTRAINT aula_codigo_aula_unique UNIQUE (codigo_aula);


--
-- Name: aula_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY aula
    ADD CONSTRAINT aula_pkey PRIMARY KEY (id);


--
-- Name: auxiliar_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY auxiliar
    ADD CONSTRAINT auxiliar_pkey PRIMARY KEY (id);


--
-- Name: clase_gestion_id_aula_id_horario_id_dia_unique; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY clase
    ADD CONSTRAINT clase_gestion_id_aula_id_horario_id_dia_unique UNIQUE (gestion_id, aula_id, horario_id, dia);


--
-- Name: clase_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY clase
    ADD CONSTRAINT clase_pkey PRIMARY KEY (id);


--
-- Name: docente_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY docente
    ADD CONSTRAINT docente_pkey PRIMARY KEY (id);


--
-- Name: envio_practica_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY envio_practica
    ADD CONSTRAINT envio_practica_pkey PRIMARY KEY (id);


--
-- Name: estudiante_clase_clase_id_estudiante_id_unique; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY estudiante_clase
    ADD CONSTRAINT estudiante_clase_clase_id_estudiante_id_unique UNIQUE (clase_id, estudiante_id);


--
-- Name: estudiante_clase_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY estudiante_clase
    ADD CONSTRAINT estudiante_clase_pkey PRIMARY KEY (id);


--
-- Name: estudiante_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY estudiante
    ADD CONSTRAINT estudiante_pkey PRIMARY KEY (id);


--
-- Name: fecha_inscripcion_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY fecha_inscripcion
    ADD CONSTRAINT fecha_inscripcion_pkey PRIMARY KEY (id);


--
-- Name: funcion_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY funcion
    ADD CONSTRAINT funcion_pkey PRIMARY KEY (id);


--
-- Name: gestion_anho_gestion_periodo_id_unique; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY gestion
    ADD CONSTRAINT gestion_anho_gestion_periodo_id_unique UNIQUE (anho_gestion, periodo_id);


--
-- Name: gestion_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY gestion
    ADD CONSTRAINT gestion_pkey PRIMARY KEY (id);


--
-- Name: grupo_a_docente_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY grupo_a_docente
    ADD CONSTRAINT grupo_a_docente_pkey PRIMARY KEY (id);


--
-- Name: grupo_docente_auxiliar_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY grupo_docente_auxiliar
    ADD CONSTRAINT grupo_docente_auxiliar_pkey PRIMARY KEY (id);


--
-- Name: grupo_docente_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY grupo_docente
    ADD CONSTRAINT grupo_docente_pkey PRIMARY KEY (id);


--
-- Name: guia_practica_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY guia_practica
    ADD CONSTRAINT guia_practica_pkey PRIMARY KEY (id);


--
-- Name: horario_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY horario
    ADD CONSTRAINT horario_pkey PRIMARY KEY (id);


--
-- Name: iniciar_sesion_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY iniciar_sesion
    ADD CONSTRAINT iniciar_sesion_pkey PRIMARY KEY (id);


--
-- Name: inicio_clase_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY inicio_clase
    ADD CONSTRAINT inicio_clase_pkey PRIMARY KEY (id);


--
-- Name: materia_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY materia
    ADD CONSTRAINT materia_pkey PRIMARY KEY (id);


--
-- Name: periodo_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY periodo
    ADD CONSTRAINT periodo_pkey PRIMARY KEY (id);


--
-- Name: rol_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY rol
    ADD CONSTRAINT rol_pkey PRIMARY KEY (id);


--
-- Name: sesion_estudiante_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY sesion_estudiante
    ADD CONSTRAINT sesion_estudiante_pkey PRIMARY KEY (id);


--
-- Name: sesion_estudiante_sesion_id_estudiante_clase_id_unique; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY sesion_estudiante
    ADD CONSTRAINT sesion_estudiante_sesion_id_estudiante_clase_id_unique UNIQUE (sesion_id, estudiante_clase_id);


--
-- Name: sesion_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY sesion
    ADD CONSTRAINT sesion_pkey PRIMARY KEY (id);


--
-- Name: usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id);


--
-- Name: usuario_username_unique; Type: CONSTRAINT; Schema: public; Owner: seslab; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_username_unique UNIQUE (username);


--
-- Name: administrador_usuario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY administrador
    ADD CONSTRAINT administrador_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE CASCADE;


--
-- Name: asigna_funcion_funcion_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY asigna_funcion
    ADD CONSTRAINT asigna_funcion_funcion_id_foreign FOREIGN KEY (funcion_id) REFERENCES funcion(id) ON DELETE CASCADE;


--
-- Name: asigna_funcion_rol_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY asigna_funcion
    ADD CONSTRAINT asigna_funcion_rol_id_foreign FOREIGN KEY (rol_id) REFERENCES rol(id) ON DELETE CASCADE;


--
-- Name: asigna_rol_rol_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY asigna_rol
    ADD CONSTRAINT asigna_rol_rol_id_foreign FOREIGN KEY (rol_id) REFERENCES rol(id) ON DELETE CASCADE;


--
-- Name: asigna_rol_usuario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY asigna_rol
    ADD CONSTRAINT asigna_rol_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE CASCADE;


--
-- Name: auxiliar_usuario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY auxiliar
    ADD CONSTRAINT auxiliar_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE CASCADE;


--
-- Name: clase_aula_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY clase
    ADD CONSTRAINT clase_aula_id_foreign FOREIGN KEY (aula_id) REFERENCES aula(id) ON DELETE CASCADE;


--
-- Name: clase_gestion_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY clase
    ADD CONSTRAINT clase_gestion_id_foreign FOREIGN KEY (gestion_id) REFERENCES gestion(id) ON DELETE CASCADE;


--
-- Name: clase_grupo_docente_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY clase
    ADD CONSTRAINT clase_grupo_docente_id_foreign FOREIGN KEY (grupo_docente_id) REFERENCES grupo_docente(id) ON DELETE CASCADE;


--
-- Name: clase_horario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY clase
    ADD CONSTRAINT clase_horario_id_foreign FOREIGN KEY (horario_id) REFERENCES horario(id) ON DELETE CASCADE;


--
-- Name: docente_usuario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY docente
    ADD CONSTRAINT docente_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE CASCADE;


--
-- Name: envio_practica_sesion_estudiante_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY envio_practica
    ADD CONSTRAINT envio_practica_sesion_estudiante_id_foreign FOREIGN KEY (sesion_estudiante_id) REFERENCES sesion_estudiante(id) ON DELETE CASCADE;


--
-- Name: estudiante_clase_clase_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY estudiante_clase
    ADD CONSTRAINT estudiante_clase_clase_id_foreign FOREIGN KEY (clase_id) REFERENCES clase(id) ON DELETE CASCADE;


--
-- Name: estudiante_clase_estudiante_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY estudiante_clase
    ADD CONSTRAINT estudiante_clase_estudiante_id_foreign FOREIGN KEY (estudiante_id) REFERENCES estudiante(id) ON DELETE CASCADE;


--
-- Name: estudiante_clase_grupo_a_docente_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY estudiante_clase
    ADD CONSTRAINT estudiante_clase_grupo_a_docente_id_foreign FOREIGN KEY (grupo_a_docente_id) REFERENCES grupo_a_docente(id) ON DELETE CASCADE;


--
-- Name: estudiante_usuario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY estudiante
    ADD CONSTRAINT estudiante_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE CASCADE;


--
-- Name: gestion_periodo_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY gestion
    ADD CONSTRAINT gestion_periodo_id_foreign FOREIGN KEY (periodo_id) REFERENCES periodo(id) ON DELETE CASCADE;


--
-- Name: grupo_a_docente_docente_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY grupo_a_docente
    ADD CONSTRAINT grupo_a_docente_docente_id_foreign FOREIGN KEY (docente_id) REFERENCES docente(id) ON DELETE CASCADE;


--
-- Name: grupo_a_docente_grupo_docente_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY grupo_a_docente
    ADD CONSTRAINT grupo_a_docente_grupo_docente_id_foreign FOREIGN KEY (grupo_docente_id) REFERENCES grupo_docente(id) ON DELETE CASCADE;


--
-- Name: grupo_docente_auxiliar_auxiliar_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY grupo_docente_auxiliar
    ADD CONSTRAINT grupo_docente_auxiliar_auxiliar_id_foreign FOREIGN KEY (auxiliar_id) REFERENCES auxiliar(id) ON DELETE CASCADE;


--
-- Name: grupo_docente_auxiliar_grupo_docente_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY grupo_docente_auxiliar
    ADD CONSTRAINT grupo_docente_auxiliar_grupo_docente_id_foreign FOREIGN KEY (grupo_docente_id) REFERENCES grupo_docente(id) ON DELETE CASCADE;


--
-- Name: grupo_docente_materia_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY grupo_docente
    ADD CONSTRAINT grupo_docente_materia_id_foreign FOREIGN KEY (materia_id) REFERENCES materia(id) ON DELETE CASCADE;


--
-- Name: iniciar_sesion_usuario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY iniciar_sesion
    ADD CONSTRAINT iniciar_sesion_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE CASCADE;


--
-- Name: inicio_clase_sesion_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY inicio_clase
    ADD CONSTRAINT inicio_clase_sesion_id_foreign FOREIGN KEY (sesion_id) REFERENCES sesion(id) ON DELETE CASCADE;


--
-- Name: materia_gestion_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY materia
    ADD CONSTRAINT materia_gestion_id_foreign FOREIGN KEY (gestion_id) REFERENCES gestion(id) ON DELETE CASCADE;


--
-- Name: sesion_auxiliar_terminal_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY sesion
    ADD CONSTRAINT sesion_auxiliar_terminal_id_foreign FOREIGN KEY (auxiliar_terminal_id) REFERENCES auxiliar(id) ON DELETE CASCADE;


--
-- Name: sesion_clase_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY sesion
    ADD CONSTRAINT sesion_clase_id_foreign FOREIGN KEY (clase_id) REFERENCES clase(id) ON DELETE CASCADE;


--
-- Name: sesion_estudiante_auxiliar_comentario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY sesion_estudiante
    ADD CONSTRAINT sesion_estudiante_auxiliar_comentario_id_foreign FOREIGN KEY (auxiliar_comentario_id) REFERENCES auxiliar(id) ON DELETE CASCADE;


--
-- Name: sesion_estudiante_auxiliar_lista_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY sesion_estudiante
    ADD CONSTRAINT sesion_estudiante_auxiliar_lista_id_foreign FOREIGN KEY (auxiliar_lista_id) REFERENCES auxiliar(id) ON DELETE CASCADE;


--
-- Name: sesion_estudiante_estudiante_clase_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY sesion_estudiante
    ADD CONSTRAINT sesion_estudiante_estudiante_clase_id_foreign FOREIGN KEY (estudiante_clase_id) REFERENCES estudiante_clase(id) ON DELETE CASCADE;


--
-- Name: sesion_estudiante_sesion_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY sesion_estudiante
    ADD CONSTRAINT sesion_estudiante_sesion_id_foreign FOREIGN KEY (sesion_id) REFERENCES sesion(id) ON DELETE CASCADE;


--
-- Name: sesion_guia_practica_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: seslab
--

ALTER TABLE ONLY sesion
    ADD CONSTRAINT sesion_guia_practica_id_foreign FOREIGN KEY (guia_practica_id) REFERENCES guia_practica(id) ON DELETE CASCADE;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

