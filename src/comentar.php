<?php
require "../db.php";

session_start();
if (!isset($_SESSION["id_cuenta"]))
    header("location: /index.php");


function acciones()
{
    global $database;

    if (!isset($_POST["accion"]))
        return;

    if (isset($_POST["id_anime"]) && isset($_POST["comentario"]) && $_POST["accion"] == "CREATE") {
        $database->queryNotResponse(
            "INSERT INTO comentarios (id_anime,id_cuenta,contenido) VALUES ($1,$2,$3);",
            array(
                intval($_POST["id_anime"]),
                intval($_SESSION["id_cuenta"]),
                $_POST["comentario"]
            )
        );

        return;
    }

    if (isset($_POST["id_comentario"]) && $_POST["accion"] == "DELETE") {
        $database->queryNotResponse(
            "DELETE FROM comentarios WHERE id_comentario=$1 AND id_cuenta=$2",
            array(intval($_POST["id_comentario"]), intval($_SESSION["id_cuenta"]))
        );

        return;
    }

    if (isset($_POST["comentario"]) && isset($_POST["id_comentario"]) && $_POST["accion"] == "UPDATE") {
        $database->queryNotResponse(
            "UPDATE comentarios SET contenido=$1 WHERE id_comentario=$2 AND id_cuenta=$3",
            array($_POST["comentario"], intval($_POST["id_comentario"]), intval($_SESSION["id_cuenta"]))
        );

        return;
    }
}


acciones();
header('Location: ' . $_SERVER['HTTP_REFERER'] . '#caja-comentarios');
