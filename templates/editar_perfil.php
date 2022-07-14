<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar perfil</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="css/editar_perfil.css">
</head>

<body>
    <div id="app">
        <form action="editar_perfil.php" enctype="multipart/form-data" method="post" class="p-3">
            <div class="mb-2">
                <label for="user_img" class="form-label">Imagen de perfil: </label>
                <input class=" form form-control" type="file" id="user_img" name="user_img" accept="image/*">
            </div>
            <input type="text" class="form form-control mb-2" placeholder="Nuevo nombre de usuario" name="username">
            <input type="email" class="form form-control mb-2" placeholder="Nuevo Correo" name="email">
            <input type="password" name="password" class="form form-control mb-2" placeholder="Nueva contraseña">
            <button style="width: 100%;" class="btn btn-outline-dark">Actualizar</button>
        </form>
    </div>
    <?php
    $Swal->execute();
    ?>
    <script src="js/editar_perfil.js"></script>
</body>

</html>