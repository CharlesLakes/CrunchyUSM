<?php
require "../db.php";


session_start();

if (!isset($_SESSION["id_cuenta"]) || !isset($_POST["id_anime"]) || !isset($_POST["puntuacion"]))
    header("location: /index.php");


$is_calificado = $database->queryResponse("SELECT valor FROM calificaciones WHERE id_cuenta=$1 AND id_anime=$2", array($_SESSION["id_cuenta"], $_POST["id_anime"]));
if ($_POST["puntuacion"] == "delete") {
    $database->queryNotResponse(
        "DELETE FROM calificaciones WHERE id_cuenta=$1 AND id_anime=$2",
        array(
            intval($_SESSION["id_cuenta"]),
            intval($_POST["id_anime"])
        )
    );
} else if ($is_calificado) {
    $database->queryNotResponse(
        "UPDATE calificaciones SET valor = $3 WHERE id_cuenta=$1 AND id_anime=$2 ",
        array(intval($_SESSION["id_cuenta"]), intval($_POST["id_anime"]), intval($_POST["puntuacion"]))
    );
} else {
    $database->queryNotResponse(
        "INSERT INTO calificaciones (id_cuenta,id_anime,valor) VALUES ($1,$2,$3)",
        array(intval($_SESSION["id_cuenta"]), intval($_POST["id_anime"]), intval($_POST["puntuacion"]))
    );
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
