<?php
require "../db.php";
require "../swal.php";


session_start();

if (!isset($_SESSION["id_cuenta"]))
    header("location: /login.php");


function main()
{
    global $database, $Swal;

    if (
        !isset($_FILES["user_img"]) &&
        !isset($_POST["username"]) &&
        !isset($_POST["email"]) &&
        !isset($_POST["password"])
    ) {
        return;
    }


    if ($_FILES["user_img"]["error"] == UPLOAD_ERR_OK) {
        $splited = explode(".", $_FILES["user_img"]["name"]);
        if (count($splited) > 1)
            $dir = "/user_img/" . strval($_SESSION["id_cuenta"]) . "." . $splited[count($splited) - 1];
        else
            $dir = "/user_img/" . $_SESSION["id_cuenta"];
        move_uploaded_file($_FILES["user_img"]["tmp_name"], realpath(dirname(__FILE__)) . $dir);

        $database->queryNotResponse(
            "UPDATE usuarios SET foto=$1 WHERE id_cuenta=$2",
            array($dir, $_SESSION["id_cuenta"])
        );
    }

    if (
        strlen($_POST["username"]) > 0 &&
        !$database->queryResponse("SELECT * FROM cuentas WHERE nombre=$1", array($_POST["username"]))
    ) {

        $database->queryNotResponse(
            "UPDATE cuentas SET nombre = $1 WHERE id_cuenta = $2",
            array($_POST["username"], $_SESSION["id_cuenta"])
        );
    } else if (strlen($_POST["username"]) > 0) {
        $Swal->msg(array(
            "title" => "Error!",
            "text" => "El nombre de usuario ya existe.",
            "icon" => "error"
        ));

        return;
    }


    if (
        strlen($_POST["email"]) > 0 &&
        !$database->queryResponse("SELECT * FROM cuentas WHERE correo=$1", array($_POST["email"]))
    ) {

        $database->queryNotResponse(
            "UPDATE cuentas SET correo = $1 WHERE id_cuenta = $2",
            array($_POST["email"], $_SESSION["id_cuenta"])
        );
    } else if (strlen($_POST["email"]) > 0) {
        $Swal->msg(array(
            "title" => "Error!",
            "text" => "El nombre de email ya existe.",
            "icon" => "error"
        ));

        return;
    }

    if (strlen($_POST["password"]) > 0) {

        $database->queryNotResponse(
            "UPDATE cuentas SET contrasena = $1 WHERE id_cuenta = $2",
            array($_POST["password"], $_SESSION["id_cuenta"])
        );
    }



    $Swal->msg(array(
        "title" => "Hecho!",
        "text" => "Tus datos han sido actualizados.",
        "icon" => "success"
    ), '() => {window.location = "/index.php";}');
}

main();
include "../templates/editar_perfil.php";
