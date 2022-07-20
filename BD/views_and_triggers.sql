CREATE OR REPLACE VIEW animes_recientes AS
    ((SELECT 
        animes.id_anime, capitulos.id_capitulo, animes.nombre ,capitulos.nombre as nombre_capitulo, animes.foto, capitulos.fecha
        FROM capitulos INNER JOIN animes 
        ON animes.id_anime = capitulos.id_serie)
    UNION
    (SELECT 
        animes.id_anime, null, animes.nombre, null, animes.foto, animes.fecha 
        FROM peliculas INNER JOIN animes 
        ON animes.id_anime = peliculas.id_anime)
    ORDER BY fecha DESC
    LIMIT 20);


CREATE OR REPLACE VIEW mayor_popularidad AS
    ((SELECT 
        animes.id_anime, animes.nombre, 0 as is_pelicula, animes.foto, animes.puntuacion_media
        FROM capitulos INNER JOIN animes 
        ON animes.id_anime = capitulos.id_serie)
    UNION
    (SELECT 
        animes.id_anime, animes.nombre, 1 as is_pelicula, animes.foto, animes.puntuacion_media
        FROM peliculas INNER JOIN animes 
        ON animes.id_anime = peliculas.id_anime)
    ORDER BY puntuacion_media DESC
    LIMIT 5);


CREATE OR REPLACE VIEW menor_popularidad AS
    ((SELECT 
        animes.id_anime, animes.nombre, 0 as is_pelicula, animes.foto, animes.puntuacion_media
        FROM capitulos INNER JOIN animes 
        ON animes.id_anime = capitulos.id_serie)
    UNION
    (SELECT 
        animes.id_anime, animes.nombre, 1 as is_pelicula, animes.foto, animes.puntuacion_media
        FROM peliculas INNER JOIN animes 
        ON animes.id_anime = peliculas.id_anime)
    ORDER BY puntuacion_media ASC
    LIMIT 5);


CREATE OR REPLACE VIEW mas_comentados AS
    ((SELECT 
        temporal.id_anime, temporal.nombre, temporal.foto, 0 as is_pelicula, comentarios_animes.cantidad
        FROM 
        (SELECT 
            animes.id_anime, animes.nombre, animes.foto
            FROM series INNER JOIN animes 
            ON series.id_anime = animes.id_anime) as temporal
        INNER JOIN 
        (SELECT 
            id_anime, COUNT(id_anime) as cantidad 
            FROM comentarios 
            GROUP BY id_anime) as comentarios_animes
        ON temporal.id_anime = comentarios_animes.id_anime)
    UNION
    (SELECT 
        temporal.id_anime, temporal.nombre, temporal.foto, 1 as is_pelicula, comentarios_animes.cantidad
        FROM 
        (SELECT 
            animes.id_anime, animes.nombre, animes.foto
            FROM peliculas INNER JOIN animes 
            ON peliculas.id_anime = animes.id_anime) as temporal
        INNER JOIN 
        (SELECT 
            id_anime, COUNT(id_anime) as cantidad 
            FROM comentarios GROUP BY id_anime) as comentarios_animes
            ON temporal.id_anime = comentarios_animes.id_anime)
    ORDER BY cantidad DESC
    LIMIT 5);

CREATE OR REPLACE FUNCTION calificaciones_trigger_func()

    RETURNS trigger AS

$$
    BEGIN
        UPDATE animes
        SET puntuacion_media = 0;
        UPDATE animes
        SET puntuacion_media = auxiliar.promedio
        FROM  
            (SELECT id_anime,AVG(valor) as promedio FROM calificaciones GROUP BY id_anime) as auxiliar
        WHERE animes.id_anime = auxiliar.id_anime;
    RETURN NEW;
    END;
$$

LANGUAGE 'plpgsql';

CREATE TRIGGER calificaciones_trigger
    AFTER INSERT OR DELETE OR UPDATE
    ON calificaciones
    FOR EACH ROW
    EXECUTE PROCEDURE calificaciones_trigger_func();