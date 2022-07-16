<?php
require "../db.php";

session_start();
if (!isset($_SESSION["id_cuenta"]) || !isset($_GET["id_anime"]))
    header("location: /index.php");


$is_visto = $database->queryResponse(
    "SELECT * FROM vistas WHERE id_cuenta=$1 AND id_anime=$2",
    array(intval($_SESSION["id_cuenta"]), intval($_GET["id_anime"]))
);
if ($is_visto)
    $database->queryNotResponse(
        "DELETE FROM vistas WHERE id_cuenta=$1 AND id_anime=$2",
        array(intval($_SESSION["id_cuenta"]), intval($_GET["id_anime"]))
    );
else
    $database->queryNotResponse("INSERT INTO vistas (id_cuenta,id_anime) VALUES ($1,$2)", array(intval($_SESSION["id_cuenta"]), intval($_GET["id_anime"])));


header('Location: ' . $_SERVER['HTTP_REFERER']);
