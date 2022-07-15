<?php
$nombre = $database->queryResponse(
    "SELECT nombre FROM cuentas WHERE id_cuenta=$1",
    array($_SESSION["id_cuenta"])
)[0]["nombre"];
$foto = $database->queryResponse(
    "SELECT foto FROM usuarios WHERE id_cuenta=$1",
    array($_SESSION["id_cuenta"])
)[0]["foto"];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CrunchyUSM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/anime.css">

</head>

<body>
    <header>
        <div class="left-header">
            <div class="list-section">
                <a href="/index.php">
                    <button>
                        Inicio
                    </button>
                </a>
                <a href="">
                    <button>
                        Directorio
                    </button>
                </a>
            </div>
            <div class="search">
                <input type="text" id="input-search" placeholder="Buscador">
            </div>
        </div>
        <div class="right-header">
            <span class="user">
                <?php echo $nombre; ?>
            </span>
            <div class="container-image">
                <?php if ($foto == NULL) { ?>
                    <img src="/img/default.webp">
                <?php } else { ?> <img src="<?php echo $foto; ?>"> <?php }; ?>
            </div>
            <div class="account">
                <a href="/editar_perfil.php"><button>Editar perfil</button></a>
                <a href="/logout.php"><button>Cerrar</button></a>
            </div>
        </div>
    </header>
    <main style="margin-top:50px;min-height:100vh;">
        <?php main(); ?>
    </main>
    <script src="index.js"></script>
</body>

</html>