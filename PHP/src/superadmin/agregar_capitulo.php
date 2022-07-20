<?php
require "../../db.php";

session_start();

if (!isset($_SESSION["id_admin"]))
    header("location: /login.php");

function addChapter()
{
    global $database;

    if (
        !isset($_POST["nombre_capitulo"]) ||
        !isset($_POST["id_anime"])
    ) return;


    if ($_FILES["contenido"]["error"] != UPLOAD_ERR_OK) return;

    $id = $database->queryResponse(
        "INSERT INTO capitulos (id_serie,nombre,contenido) VALUES ($1,$2,$3) RETURNING id_capitulo",
        array(
            intval($_POST["id_anime"]),
            $_POST["nombre_capitulo"],
            NULL
        )
    )[0]["id_capitulo"];

    $splited = explode(".", $_FILES["contenido"]["name"]);
    $url = "/anime_contenido/" . strval($id) . "." . $splited[count($splited) - 1];
    move_uploaded_file($_FILES["contenido"]["tmp_name"], ".." . $url);

    $database->queryNotResponse(
        "UPDATE capitulos SET contenido=$1 WHERE id_capitulo = $2",
        array($url, intval($id))
    );
}

addChapter();

header('Location: ' . $_SERVER['HTTP_REFERER']);
