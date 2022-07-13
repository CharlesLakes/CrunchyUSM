<?php
include "../db.php";
include "../swal.php";

function processRegister()
{
    global $Swal, $database;
    $initialStatus = 1;

    if (!isset($_POST["email"]) ||
        !isset($_POST["username"]) ||
        !isset($_POST["password"])){
        header("Location: login.php");
        return;
    }


    $result = $database->queryResponse("SELECT id_cuenta FROM cuentas WHERE correo=$1 OR nombre=$2", array($_POST["email"], $_POST["username"]));
    if ($result){
        $Swal->msg(array(
            "title" => "Error!",
            "text" => "EL correo o el usuario ya existe.",
            "icon" => "error"
        ));

        include "../templates/login.php";
        return;
    }

    $database->queryNotResponse("INSERT INTO cuentas (nombre,correo,contrasena) VALUES ($1,$2,$3)", array($_POST["username"], $_POST["email"], $_POST["password"]));

    $result = $database->queryResponse("SELECT id_cuenta FROM cuentas WHERE correo=$1",array($_POST["email"]));

    $database->queryNotResponse("INSERT INTO usuarios (id_cuenta) VALUES ($1)",array($result[0]["id_cuenta"]));

    $initialStatus = 0;
    $Swal->msg(array(
        "title" => "Registrado con exito.",
        "text" => "Ahora solo tienes que iniciar sesión.",
        "icon" => "success"
    ));
    include "../templates/login.php";
}

processRegister();
