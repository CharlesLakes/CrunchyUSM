<?php

require "../../db.php";

session_start();

if (!isset($_SESSION["id_admin"]))
    header("location: /login.php");

if (!isset($_GET["id_anime"]))
    header("Location: superadmin.php");


$database->queryNotResponse("DELETE FROM animes WHERE id_anime=$1", array(intval($_GET["id_anime"])));
$database->queryNotResponse("DELETE FROM peliculas WHERE id_anime=$1", array(intval($_GET["id_anime"])));
$database->queryNotResponse("DELETE FROM series WHERE id_anime=$1", array(intval($_GET["id_anime"])));
$database->queryNotResponse("DELETE FROM capitulos WHERE id_serie=$1", array(intval($_GET["id_anime"])));

header('Location: ' . $_SERVER['HTTP_REFERER']);
