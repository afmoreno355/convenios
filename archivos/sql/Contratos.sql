CREATE TABLE IF NOT EXISTS public."Contratos"
(
    id integer NOT NULL,
    codigocontratos character varying(3) COLLATE pg_catalog."default",
    nombrecontratos character varying(100) COLLATE pg_catalog."default",
    detalle character varying(500) COLLATE pg_catalog."default"
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public."Contratos"
    OWNER to postgres;