-- DROP SCHEMA public;

CREATE SCHEMA public AUTHORIZATION pg_database_owner;

COMMENT ON SCHEMA public IS 'standard public schema';

-- DROP SEQUENCE public.solicitudes_id_solicitud_seq;

CREATE SEQUENCE public.solicitudes_id_solicitud_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;-- public.solicitudes definition

-- Drop table

-- DROP TABLE public.solicitudes;

CREATE TABLE public.solicitudes (
	id_solicitud serial4 NOT NULL,
	nombre varchar NULL,
	codigo_area int4 NULL,
	mes_publicacion varchar NULL,
	estado varchar NULL,
	abogado varchar NULL,
	tecnico_experto varchar NULL,
	objeto text NULL,
	alcance text NULL,
	especificaciones_tecnicas text NULL,
	justificacion text NULL,
	fecha_sistema date NULL,
	CONSTRAINT solicitudes_pk PRIMARY KEY (id_solicitud)
);

