CREATE TABLE IF NOT EXISTS usuarios_usuarios
(
    id_seguidor integer NOT NULL,
    id_seguido integer NOT NULL,
    CONSTRAINT usuarios_usuarios_pkey PRIMARY KEY (id_seguidor,id_seguido)
);

CREATE TABLE IF NOT EXISTS vistas
(
    id_cuenta integer NOT NULL,
    id_anime integer NOT NULL,
    fecha timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT vistas_pkey PRIMARY KEY (id_cuenta,id_anime)
);

CREATE TABLE IF NOT EXISTS comentarios
(
    id_cuenta integer NOT NULL,
    id_anime integer NOT NULL,
    contenido text,
    fecha timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT comentarios_pkey PRIMARY KEY (id_cuenta,id_anime)
);


CREATE TABLE IF NOT EXISTS calificaciones
(
    id_cuenta integer NOT NULL,
    id_anime integer NOT NULL,
    valor NUMERIC(3),
    CONSTRAINT calificaciones_pkey PRIMARY KEY (id_cuenta,id_anime)
);


CREATE TABLE IF NOT EXISTS listas_animes
(
    id_lista integer NOT NULL,
    id_anime integer NOT NULL,
    CONSTRAINT listas_animes_pkey PRIMARY KEY (id_lista,id_anime)
);

CREATE TABLE IF NOT EXISTS animes_generos
(
    id_anime integer NOT NULL,
    id_genero integer NOT NULL,
    CONSTRAINT animes_generos_pkey PRIMARY KEY (id_anime,id_genero)
);



