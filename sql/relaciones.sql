CREATE TABLE IF NOT EXISTS usuarios_usuarios
(
    id_seguidor integer NOT NULL,
    id_seguido integer NOT NULL
);

CREATE TABLE IF NOT EXISTS vistas
(
    id_cuenta integer NOT NULL,
    id_anime integer NOT NULL,
    fecha timestamp with time zone DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS comentarios
(
    id_cuenta integer NOT NULL,
    id_anime integer NOT NULL,
    contenido text,
    fecha timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT comentarios_cuentas_fkey FOREIGN KEY (id_cuenta)
        REFERENCES usuarios (id_cuenta),
    CONSTRAINT comentarios_animes_fkey FOREIGN KEY (id_anime)
        REFERENCES animes(id_anime)
);


CREATE TABLE IF NOT EXISTS calificaciones
(
    id_cuenta integer NOT NULL,
    id_anime integer NOT NULL,
    valor NUMERIC(3),
    CONSTRAINT calificaciones_cuentas_fkey FOREIGN KEY (id_cuenta)
        REFERENCES usuarios (id_cuenta),
    CONSTRAINT califiaciones_animes_fkey FOREIGN KEY (id_anime)
        REFERENCES animes(id_anime)
);


CREATE TABLE IF NOT EXISTS listas_animes
(
    id_lista integer NOT NULL,
    id_anime integer NOT NULL
);

CREATE TABLE IF NOT EXISTS animes_generos
(
    id_anime integer NOT NULL,
    id_genero integer NOT NULL
);



