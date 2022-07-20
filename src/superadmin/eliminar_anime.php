<?php

require "../../db.php";

if (!isset($_GET["id_anime"]))
    header("Location: superadmin.php");


$database->queryNotResponse("DELETE FROM animes WHERE id_anime=$1", array(intval($_GET["id_anime"])));

header('Location: ' . $_SERVER['HTTP_REFERER']);
