-- DROP SCHEMA public;

CREATE SCHEMA public AUTHORIZATION postgres;

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
	NO CYCLE;
-- DROP SEQUENCE public.solicitudes_id_solicitud_seq1;

CREATE SEQUENCE public.solicitudes_id_solicitud_seq1
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
	justificacion text NULL,
	fecha_sistema date NULL,
	CONSTRAINT solicitudes_pk PRIMARY KEY (id_solicitud)
);


-- public.documentaciones definition

-- Drop table

-- DROP TABLE public.documentaciones;

CREATE TABLE public.documentaciones (
	id_documentacion serial4 NOT NULL,
	id_solicitud int4 NULL,
	memorando varchar NULL,
	estudios_previos varchar NULL,
	anexo_tecnico varchar NULL,
	analisis_sector varchar NULL,
	concepto_tecnico varchar NULL,
	propuesta_tecnica_economica varchar NULL,
	matriz_riesgos varchar NULL,
	certificado_disponibilidad_presupuestal varchar NULL,
	certificado_paa varchar NULL,
	proyecto_autorizacion varchar NULL,
	fecha_sistema date NULL,
	CONSTRAINT documentaciones_fk FOREIGN KEY (id_solicitud) REFERENCES public.solicitudes(id_solicitud)
);
