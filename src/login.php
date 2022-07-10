<?php
include "../db.php";
include "../swal.php";

session_start();


// process
function processRequests()
{

    global $Swal, $database;
    $initialStatus = 0;

    if (!isset($_POST["email"]) || !isset($_POST["password"])) {
        include "../templates/login.php";
        return;
    }


    $result = $database->queryResponse("SELECT id_cuenta FROM cuentas WHERE correo=$1 AND contrasena=$2", array($_POST["email"], $_POST["password"]));

    if ($result) {
        $_SESSION["id_cuenta"] = $result[0]["id_cuenta"];
        header("Location: index.php");
        return;
    }
    $Swal->msg(array(
        "title" => "Error!",
        "text" => "La cuenta es invalida.",
        "icon" => "error"
    ));
    include "../templates/login.php";
}


if (array_key_exists("id_cuenta", $_SESSION))
    header("Location: index.php");
else
    processRequests();
