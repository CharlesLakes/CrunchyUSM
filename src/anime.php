<?php
require "../db.php";

session_start();
if (!isset($_SESSION["id_cuenta"]) || !isset($_GET["id_anime"]))
    header("location: /login.php");

$head = function () {
?>
    <link rel="stylesheet" href="css/anime.css">
<?php
};

function main()
{
    global $database;
    $anime = $database->queryResponse(
        "
        SELECT peliculas.id_anime as is_pelicula, animes.nombre, animes.descripcion, animes.foto, animes.puntuacion_media, animes.fecha
        FROM animes LEFT JOIN peliculas ON animes.id_anime = peliculas.id_anime 
        WHERE animes.id_anime=$1",
        array($_GET["id_anime"])
    );

    if (!$anime) return;

    $anime = $anime[0];

    $is_pelicula = $anime["is_pelicula"] != NULL;



    if ($is_pelicula == NULL) {
        $contenido = $database->queryResponse("SELECT id_capitulo,nombre,fecha FROM capitulos WHERE id_serie=$1", array($_GET["id_anime"]));
        $estado = $database->queryResponse("SELECT estado FROM series WHERE id_anime=$1", array($_GET["id_anime"]));
    }

    $is_calificado = $database->queryResponse("SELECT valor FROM calificaciones WHERE id_cuenta=$1 AND id_anime=$2", array($_SESSION["id_cuenta"], $_GET["id_anime"]));

    $is_visto = $database->queryResponse(
        "SELECT * FROM vistas WHERE id_cuenta=$1 AND id_anime=$2",
        array(intval($_SESSION["id_cuenta"]), intval($_GET["id_anime"]))
    );

    $comentarios = $database->queryResponse(
        "SELECT * FROM (SELECT cuentas.id_cuenta, comentarios.id_anime, comentarios.id_comentario, cuentas.nombre, usuarios.foto, comentarios.contenido, comentarios.fecha 
        FROM comentarios INNER JOIN cuentas ON comentarios.id_cuenta = cuentas.id_cuenta
        INNER JOIN usuarios
        ON cuentas.id_cuenta = usuarios.id_cuenta) as temporal
        WHERE temporal.id_anime=$1",
        array($_GET["id_anime"])
    );

    $generos = $database->queryResponse(
        "SELECT generos.nombre 
        FROM animes_generos 
        INNER JOIN generos
        ON animes_generos.id_genero = generos.id_genero
        WHERE animes_generos.id_anime = $1",
        array($_GET["id_anime"])
    );
    $generos = array_map(function ($valor) {
        return $valor["nombre"];
    }, $generos);


    include "../templates/anime.php";
}

include "../templates/index_template.php";
