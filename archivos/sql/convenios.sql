-- DROP SCHEMA public;

CREATE SCHEMA public AUTHORIZATION pg_database_owner;

COMMENT ON SCHEMA public IS 'standard public schema';

-- DROP SEQUENCE public.documentaciones_id_documentacion_seq;

CREATE SEQUENCE public.documentaciones_id_documentacion_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;
-- DROP SEQUENCE public.solicitudes_id_solicitud_seq;

CREATE SEQUENCE public.solicitudes_id_solicitud_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;-- public.documentaciones definition

-- Drop table

-- DROP TABLE public.documentaciones;

CREATE TABLE public.documentaciones (
	id_documentacion serial4 NOT NULL,
	id_solicitud int4 NULL,
	memorando varchar NULL,
	estudios_previos varchar NULL,
	anexo_tecnico varchar NULL,
	analisis_tecnico varchar NULL,
	concepto_tecnico varchar NULL,
	propuesta_tecnica_economica varchar NULL,
	matriz_riesgos varchar NULL,
	certificado_disponibilidad_presupuestal varchar NULL,
	certificado_paa varchar NULL,
	proyecto_autorizacion varchar NULL,
	fecha_sistema date NULL
);


-- public.solicitudes definition

-- Drop table

-- DROP TABLE public.solicitudes;

CREATE TABLE public.solicitudes (
	id_solicitud serial4 NOT NULL,
	codigo_area int4 NULL,
	abogado varchar NULL,
	tecnico_experto varchar NULL,
	objeto text NULL,
	alcance text NULL,
	especificaciones_tecnicas text NULL,
	fecha_sistema date NULL,
	estado varchar NULL,
	justificacion text NULL,
	nombre varchar NULL,
	mes_publicacion varchar NULL,
	CONSTRAINT solicitudes_pk PRIMARY KEY (id_solicitud)
);
