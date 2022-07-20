<?php

require "../../db.php";


function add()
{
    global $database;

    if (
        !isset($_POST["nombre_anime"]) ||
        !isset($_POST["descripcion"]) ||
        !isset($_POST["generos"]) ||
        count($_POST["generos"]) == 0 ||
        !isset($_POST["nuevos_generos"])
    ) return;

    $id = $database->queryResponse(
        "INSERT INTO animes (nombre,descripcion) VALUES ($1,$2) RETURNING id_anime",
        array($_POST["nombre_anime"], $_POST["descripcion"])
    )[0]["id_anime"];

    $generos = $_POST["generos"];

    if (isset($_POST["pelicula"]) && $_POST["pelicula"] == "on")
        $database->queryNotResponse(
            "INSERT INTO peliculas (id_anime) VALUES ($1)",
            array(intval($id))
        );
    else {
        $estado = false;
        if (isset($_POST["estado"]) && $estado == "on")
            $estado = true;
        $database->queryNotResponse(
            "INSERT INTO series (id_anime,estado) VALUES ($1,$2)",
            array(intval($id), intval($estado))
        );
    };

    if ($_FILES["img_anime"]["error"] == UPLOAD_ERR_OK) {
        $splited = explode(".", $_FILES["img_anime"]["name"]);
        $url = "/anime_img/" . strval($id) . "." . $splited[count($splited) - 1];
        move_uploaded_file($_FILES["img_anime"]["tmp_name"], ".." . $url);

        $database->queryNotResponse(
            "UPDATE animes SET foto=$1 WHERE id_anime=$2",
            array($url, intval($id))
        );
    }

    if (count($_POST["nuevos_generos"]) > 0) {
        foreach ($_POST["nuevos_generos"] as $genero) {
            if ($genero != "")
                $id_genero = $database->queryResponse("INSERT INTO generos (nombre) VALUES ($1) RETURNING id_genero", array($genero))[0]["id_genero"];
            array_push($generos, $id_genero);
        }
    }

    foreach ($generos as $genero) {
        $id_genero = intval($genero);

        $database->queryNotResponse(
            "INSERT INTO animes_generos (id_anime,id_genero) VALUES ($1,$2)",
            array($id, $id_genero)
        );
    }
}


add();
header('Location: ' . $_SERVER['HTTP_REFERER']);
