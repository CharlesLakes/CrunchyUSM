CREATE TABLE IF NOT EXISTS animes
(
    id_anime integer NOT NULL GENERATED ALWAYS AS IDENTITY,
    nombre varchar(128) NOT NULL,
    foto text,
    descripcion text,
    puntuacion_media real DEFAULT 0,
    fecha timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT animes_pkey PRIMARY KEY (id_anime)
);

CREATE TABLE IF NOT EXISTS cuentas
(
    id_cuenta integer NOT NULL GENERATED ALWAYS AS IDENTITY,
    nombre varchar(32) NOT NULL,
    correo varchar(128) NOT NULL,
    contrasena varchar(32) NOT NULL,
    fecha timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT cuentas_pkey PRIMARY KEY (id_cuenta)
);

CREATE TABLE IF NOT EXISTS usuarios
(
    id_cuenta integer NOT NULL,
    foto text,
    descripcion text,
    seguidores integer DEFAULT 0,
    animes_vistos integer DEFAULT 0,
    CONSTRAINT usuarios_pkey PRIMARY KEY (id_cuenta)
);

CREATE TABLE IF NOT EXISTS peliculas
(
    id_anime integer NOT NULL,
    duracion text,
    contenido text,
    CONSTRAINT peliculas_pkey PRIMARY KEY (id_anime)
);

CREATE TABLE IF NOT EXISTS series
(
    id_anime integer NOT NULL,
    estado boolean,
    CONSTRAINT series_pkey PRIMARY KEY (id_anime)
);

CREATE TABLE IF NOT EXISTS capitulos
(
    id_capitulo integer NOT NULL GENERATED ALWAYS AS IDENTITY,
    id_serie integer NOT NULL,
    nombre varchar(128),
    contenido text,
    fecha timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT capitulos_pkey PRIMARY KEY (id_capitulo),
    CONSTRAINT capitulos_fkey FOREIGN KEY (id_serie)
        REFERENCES series (id_anime)
);

CREATE TABLE IF NOT EXISTS generos
(
    id_genero integer NOT NULL GENERATED ALWAYS AS IDENTITY,
    nombre varchar(16),
    CONSTRAINT generos_pkey PRIMARY KEY (id_genero)
);


CREATE TABLE IF NOT EXISTS listas
(
    id_lista integer NOT NULL GENERATED ALWAYS AS IDENTITY,
    id_cuenta integer NOT NULL,
    nombre varchar(32) NOT NULL,
    visibilidad boolean DEFAULT FALSE,
    CONSTRAINT listas_pkey PRIMARY KEY (id_lista),
    CONSTRAINT listas_fkey FOREIGN KEY (id_cuenta)
        REFERENCES usuarios (id_cuenta)
);


CREATE TABLE IF NOT EXISTS super_usuarios
(
    id_cuenta integer NOT NULL,
    rol varchar(32),
    CONSTRAINT super_usuarios_pkey PRIMARY KEY (id_cuenta)
);

CREATE TABLE IF NOT EXISTS acciones
(
    id_accion integer NOT NULL,
    id_cuenta integer NOT NULL,
    accion varchar(128),
    CONSTRAINT acciones_pkey PRIMARY KEY (id_accion),
    CONSTRAINT acciones_fkey FOREIGN KEY (id_cuenta)
        REFERENCES super_usuarios (id_cuenta)
);
