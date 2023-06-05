-- DROP SCHEMA public;

CREATE SCHEMA public AUTHORIZATION postgres;

COMMENT ON SCHEMA public IS 'standard public schema';

-- DROP SEQUENCE public.id_solicitudes_seq;

CREATE SEQUENCE public.id_solicitudes_seq
	INCREMENT BY 1
	MINVALUE 1
	MAXVALUE 9223372036854775807
	START 1
	CACHE 1
	NO CYCLE;-- public.estado_solicitudes definition

-- Drop table

-- DROP TABLE public.estado_solicitudes;

CREATE TABLE public.estado_solicitudes (
	id_estado int4 NOT NULL,
	estado_secop_ii varchar(50) NULL,
	estado_completado bool NULL,
	aprobado_equipo bool NULL,
	autorizado_coordinador bool NULL,
	estado varchar(50) NULL,
	fecha_registro date NULL,
	CONSTRAINT estado_solicitudes_pk PRIMARY KEY (id_estado)
);


-- public.estudios_previos definition

-- Drop table

-- DROP TABLE public.estudios_previos;

CREATE TABLE public.estudios_previos (
	id_estudios_previos int4 NOT NULL,
	identificacion_dependencia_requirente varchar NULL,
	descripcion_necesidad varchar NULL,
	justificacion varchar NULL,
	analisis_conveniencia varchar NULL,
	maduracion_proyecto varchar NULL,
	objeto varchar NULL,
	alcance_objeto varchar NULL,
	especificaciones_tecnicas_objeto varchar NULL,
	analisis_sector varchar NULL,
	valor_total_aportes varchar NULL,
	desembolsos varchar NULL,
	disponibilidad_presupuestal_vigencias_futuras varchar NULL,
	modalidad_seleccion varchar NULL,
	criterios_seleccion_objetiva varchar NULL,
	analisis_riesgo varchar NULL,
	garantias varchar NULL,
	limitacion_mipymes varchar NULL,
	plazo_ejecucion varchar NULL,
	lugar_ejecucion varchar NULL,
	obligaciones_partes varchar NULL,
	forma_pago varchar NULL,
	control_vigilancia_contrato varchar NULL,
	acuerdos_comerciales varchar NULL,
	otros_aspectos varchar NULL,
	conceptos_tecnicos varchar NULL,
	fecha_registro date NULL,
	CONSTRAINT estudios_previos_pk PRIMARY KEY (id_estudios_previos)
);


-- public.paa definition

-- Drop table

-- DROP TABLE public.paa;

CREATE TABLE public.paa (
	id_paa int4 NOT NULL,
	valor_paa varchar NULL,
	mes_inicio_paa varchar NULL,
	codigo_unspsc varchar NULL,
	fecha_registro date NULL,
	CONSTRAINT paa_pk PRIMARY KEY (id_paa)
);


-- public.documentos_solicitudes definition

-- Drop table

-- DROP TABLE public.documentos_solicitudes;

CREATE TABLE public.documentos_solicitudes (
	id_documentos_solicitud int4 NOT NULL,
	memorando varchar(200) NULL,
	id_estudios_previos int4 NOT NULL,
	anexo_tecnico varchar(200) NULL,
	analisis_sector varchar(200) NULL,
	solicitud_concepto_tecnico varchar(200) NULL,
	propuesta_tecnica_economica varchar(200) NULL,
	matriz_riesgos varchar(200) NULL,
	certificacion_disponibilidad_presupuestal varchar(200) NULL,
	id_paa int4 NULL,
	proyecto_autorizacion varchar(200) NULL,
	fecha_registro date NULL,
	CONSTRAINT documentos_solicitudes_pk PRIMARY KEY (id_documentos_solicitud),
	CONSTRAINT documentos_solicitudes_fk FOREIGN KEY (id_estudios_previos) REFERENCES public.estudios_previos(id_estudios_previos)
);


-- public.solicitudes definition

-- Drop table

-- DROP TABLE public.solicitudes;

CREATE TABLE public.solicitudes (
	id_solicitud int4 NOT NULL,
	area_competente varchar(50) NOT NULL,
	tecnico_experto varchar(50) NOT NULL,
	mes_publicacion varchar(50) NOT NULL,
	tipo_regulacion_especial_sena varchar(50) NOT NULL,
	tipo_estatuto_general_contratacion varchar(50) NOT NULL,
	id_estado int4 NULL,
	id_documentos_solicitud int4 NULL,
	abogado varchar(50) NULL,
	nombre_convenio varchar(50) NULL,
	fecha_registro date NULL,
	id_paa int NULL,
	id_estudios_previos int NULL,
	CONSTRAINT solicitudes_pk PRIMARY KEY (id_solicitud),
	CONSTRAINT solicitudes_fk FOREIGN KEY (id_estado) REFERENCES public.estado_solicitudes(id_estado),
	CONSTRAINT solicitudes_fk_1 FOREIGN KEY (id_documentos_solicitud) REFERENCES public.documentos_solicitudes(id_documentos_solicitud)
);


-- public.convenios source

CREATE OR REPLACE VIEW public.convenios
AS SELECT s.id_solicitud AS id,
    s.nombre_convenio AS nombre,
    s.area_competente AS area,
    s.abogado,
    s.tecnico_experto,
    s.mes_publicacion AS mes,
    e.estado
   FROM solicitudes s
     JOIN estado_solicitudes e ON s.id_estado = e.id_estado;
