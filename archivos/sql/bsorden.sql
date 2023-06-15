CREATE TABLE IF NOT EXISTS public.bsorden
(
    idbs integer NOT NULL DEFAULT 'nextval('bsorden_id_seq'::regclass)',
    fcreacion timestamp without time zone NOT NULL,
    idexp character varying(10) COLLATE pg_catalog."default" NOT NULL,
    idcoor character varying(10) COLLATE pg_catalog."default",
    idabo character varying(10) COLLATE pg_catalog."default",
    idapoy character varying(10) COLLATE pg_catalog."default",
    idest character varying(4) COLLATE pg_catalog."default",
    CONSTRAINT bsorden_pk PRIMARY KEY (idbs),
    CONSTRAINT bsorden_fk FOREIGN KEY (idexp)
        REFERENCES public.persona (identificacion) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.bsorden
    OWNER to postgres;