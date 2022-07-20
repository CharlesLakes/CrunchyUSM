<?php
require "../db.php";


session_start();

if (!isset($_SESSION["id_cuenta"]))
    header("location: /login.php");


function inicio()
{
    global $database;
    $mayor_popularidad = $database->queryResponse("SELECT * FROM mayor_popularidad;", array());
    $menor_popularidad = $database->queryResponse("SELECT * FROM menor_popularidad;", array());
    $mas_comentados = $database->queryResponse("SELECT * FROM mas_comentados;", array());;
    $animes_recientes = $database->queryResponse("SELECT * FROM animes_recientes;", array());

    include "../templates/inicio.php";
}


function main()
{
    inicio();
}

include "../templates/index_template.php";
