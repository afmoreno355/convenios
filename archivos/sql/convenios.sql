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

-- Permissions

ALTER SEQUENCE public.documentaciones_id_documentacion_seq OWNER TO postgres;
GRANT ALL ON SEQUENCE public.documentaciones_id_documentacion_seq TO postgres;

-- DROP SEQUENCE public.estudios_previos_id_estudios_previos_seq;

CREATE SEQUENCE public.estudios_previos_id_estudios_previos_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;

-- Permissions

ALTER SEQUENCE public.estudios_previos_id_estudios_previos_seq OWNER TO postgres;
GRANT ALL ON SEQUENCE public.estudios_previos_id_estudios_previos_seq TO postgres;

-- DROP SEQUENCE public.solicitudes_id_solicitud_seq;

CREATE SEQUENCE public.solicitudes_id_solicitud_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;

-- Permissions

ALTER SEQUENCE public.solicitudes_id_solicitud_seq OWNER TO postgres;
GRANT ALL ON SEQUENCE public.solicitudes_id_solicitud_seq TO postgres;

-- DROP SEQUENCE public.solicitudes_id_solicitud_seq1;

CREATE SEQUENCE public.solicitudes_id_solicitud_seq1
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 2147483647
	START 1
	CACHE 1
	NO CYCLE;

-- Permissions

ALTER SEQUENCE public.solicitudes_id_solicitud_seq1 OWNER TO postgres;
GRANT ALL ON SEQUENCE public.solicitudes_id_solicitud_seq1 TO postgres;
-- public.solicitudes definition

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

-- Permissions

ALTER TABLE public.solicitudes OWNER TO postgres;
GRANT ALL ON TABLE public.solicitudes TO postgres;


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

-- Permissions

ALTER TABLE public.documentaciones OWNER TO postgres;
GRANT ALL ON TABLE public.documentaciones TO postgres;


-- public.estudios_previos definition

-- Drop table

-- DROP TABLE public.estudios_previos;

CREATE TABLE public.estudios_previos (
	id_estudios_previos serial4 NOT NULL,
	id_solicitud int4 NULL,
	identificacion_dependencia_requirente text NULL,
	descripcion_necesidad text NULL,
	analisis_conveniencia text NULL,
	maduracion_proyecto text NULL,
	especificaciones_tecnicas_objeto text NULL,
	analisis_sector text NULL,
	valor_total_aportes text NULL,
	desembolsos text NULL,
	disponibilidad_presupuestal_vigencias_futuras text NULL,
	modalidad_seleccion text NULL,
	criterios_seleccion_objetiva text NULL,
	analisis_riesgo text NULL,
	garantias text NULL,
	limitacion_mipymes text NULL,
	plazo_ejecucion text NULL,
	lugar_ejecucion text NULL,
	obligaciones_partes text NULL,
	forma_pago text NULL,
	control_vigilancia_contrato text NULL,
	acuerdos_comerciales text NULL,
	otros_aspectos text NULL,
	conceptos_tecnicos text NULL,
	fecha_sistema date NULL,
	CONSTRAINT estudios_previos_pk PRIMARY KEY (id_estudios_previos),
	CONSTRAINT estudios_previos_fk FOREIGN KEY (id_solicitud) REFERENCES public.solicitudes(id_solicitud)
);

-- Permissions

ALTER TABLE public.estudios_previos OWNER TO postgres;
GRANT ALL ON TABLE public.estudios_previos TO postgres;




-- Permissions

GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO public;
