<?php
require "../../db.php";


function addChapter()
{
    global $database;

    if (
        !isset($_POST["duracion"]) ||
        !isset($_POST["id_anime"])
    ) return;


    if ($_FILES["contenido"]["error"] != UPLOAD_ERR_OK) return;

    $id = $_POST["id_anime"];

    $splited = explode(".", $_FILES["contenido"]["name"]);
    $url = "/anime_contenido/pelicula" . strval($id) . "." . $splited[count($splited) - 1];
    move_uploaded_file($_FILES["contenido"]["tmp_name"], ".." . $url);

    $database->queryNotResponse(
        "UPDATE peliculas SET duracion = $2,contenido = $3 WHERE id_anime=$1",
        array(
            intval($_POST["id_anime"]),
            $_POST["duracion"],
            $url
        )
    );
}

addChapter();

header('Location: ' . $_SERVER['HTTP_REFERER']);
