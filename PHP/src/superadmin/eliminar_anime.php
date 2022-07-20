<?php

require "../../db.php";

session_start();

if (!isset($_SESSION["id_admin"]))
    header("location: /login.php");

if (!isset($_GET["id_anime"]))
    header("Location: superadmin.php");


$database->queryNotResponse("DELETE FROM animes WHERE id_anime=$1", array(intval($_GET["id_anime"])));

header('Location: ' . $_SERVER['HTTP_REFERER']);
