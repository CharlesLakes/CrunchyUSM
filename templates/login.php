<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="css/login.css">
    <script>
        var initialStatus = <?php echo $initialStatus ?>;
    </script>
</head>

<body>
    <div id="app">

        <form class="register" action="/register.php" method="POST">
            <h2>Registrar una Cuenta</h2>
            <div class="input-container" style="padding-bottom: 20px;">
                <label for="email">Correo</label>
                <input type="email" name="email">
            </div>
            <div class="input-container" style="padding-bottom: 20px;">
                <label for="username">Nombre de usuario</label>
                <input type="text" name="username">
            </div>
            <div class="input-container" style="padding-bottom: 20px;">
                <label for="password">Contraseña</label>
                <input type="password" name="password">
            </div>
            <div class="container-button">
                <button class="btn-login" style="margin-right:20px;">
                    Crear cuenta
                </button>
                <a href="#" class="toggle-status">Iniciar sesión</a>
            </div>
        </form>
        <form class="login" action="login.php"  method="POST">
            <h2>Iniciar sesión</h2>
            <div class="input-container" style="padding-bottom: 20px;">
                <label for="email">Correo o usuario</label>
                <input type="text" name="email">
            </div>
            <div class="input-container" style="padding-bottom: 20px;">
                <label for="password">Contraseña</label>
                <input type="password" name="password">
            </div>
            <div class="container-button">
                <button class="btn-login" style="margin-right:20px;">
                    Iniciar sesión
                </button>
                <a href="#" class="toggle-status">Crear cuenta</a>
            </div>

        </form>
        <div <?php
                if ($initialStatus) {
                ?> class="image-login active" <?php
                                        } else {
                                            ?> class="image-login" <?php
                                        }
                                    ?> id="image-login">
            <img src="img/crunchyUSM.png" alt="panel login">
        </div>
    </div>
    <script src="js/login.js"></script>
    <?php
    $Swal->execute();
    ?>


</body>

</html>
