<?php
require "../../db.php";

$s_anime = "";
if (isset($_GET["anime"])) {
    $s_anime = $_GET["anime"];
}

$generos = $database->queryResponse(
    "SELECT * FROM generos"
);

$animes = $database->queryResponse(
    "SELECT * FROM animes WHERE strpos(LOWER(nombre),LOWER($1)) > 0 ORDER BY fecha DESC",
    array($s_anime)
);

$series = $database->queryResponse(
    "SELECT * FROM series INNER JOIN animes ON animes.id_anime = series.id_anime"
);

$peliculas = $database->queryResponse(
    "SELECT * FROM peliculas INNER JOIN animes on animes.id_anime = peliculas.id_anime"
);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://haubek.github.io/dist/css/component-chosen.min.css">
</head>

<body>
    <div class="container pt-3">
        <button class="btn btn-dark" id="add-anime">Añadir anime</button>
        <button class="btn btn-dark" id="add-cap">Añadir capitulo</button>
        <button class="btn btn-dark" id="add-pelicula">Añadir contenido de una pelicula</button>
        <div id="contenedor-froms" class="mb-4">
        </div>
        <button class="btn btn-outline-dark">Lista de animes</button>
        <button class="btn btn-outline-dark">Lista de videos</button>

        <div id="contenedor-av" class="d-flex justify-content-around flex-wrap mt-2">
            <form action="superadmin.php" method="GET" class="w-100">
                <input type="text" class="form form-control my-2" name="anime" placeholder="Buscar animes">
            </form>

            <?php
            foreach ($animes as $anime) {
            ?>
                <div class="card mb-3" style="width: 300px;height:300px;position:relative;overflow:hidden;">
                    <img src="<?php echo $anime["foto"]; ?>" class="card-img-top" style="width:100%;height:100%;object-fit:cover;">
                    <div class="card-body" style="position:absolute;bottom:0; background:white;width:100%;">
                        <h4><?php echo $anime["nombre"]; ?></h4>
                        <button class="btn btn-info">Editar</button>
                        <a class="btn btn-danger" href="eliminar_anime.php?id_anime=<?php echo $anime["id_anime"]; ?>">Eliminar</a>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>


    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        $("#animes").chosen();

        var addGenre = (e) => {
            $(e.target).remove();
            $("#new-genre").append(`
                <input class="form form-control mb-1" placeholder="Nuevo genero" name="nuevos_generos[]" type="text">
            `);
            $("#new-genre").append(`
                <button class="btn btn-outline-dark mas-genero">Añadir otro genero</button>
            `);

            $(".mas-genero").click(addGenre);
        };


        function status() {
            if ($("#check-movie").is(":checked"))
                $("#form-check").html(
                    `
                        <input class="form-check-input mb-2" type="checkbox" id="check-movie" name="pelicula" id="flexCheckDefault" checked="checked">
                        <label class="form-check-label" for="flexCheckDefault">
                            Es pelicula
                        </label>
                        `
                );
            else
                $("#form-check").html(`
                    <input class="form-check-input mb-2" type="checkbox" id="check-movie" name="pelicula">
                    <label class="form-check-label" for="check-movie">
                        Es pelicula
                    </label>
                    <input class="form-check-input mb-2" type="checkbox" id="check-status" name="estado">
                    <label class="form-check-label" for="check-status">
                        Estado anime
                    </label>
                `);


            $("#check-movie").click(status);
        }

        $("#add-anime").click(function() {
            $("#contenedor-froms").html(`
            <form action="agregar_anime.php" method="POST" enctype="multipart/form-data"  class="my-2">
                <input type="text" class="form form-control mb-2" name="nombre_anime" placeholder="Nombre anime">
                <div id="form-check">
                    <input class="form-check-input mb-2" type="checkbox" id="check-movie" name="pelicula">
                    <label class="form-check-label" for="check-movie">
                        Es pelicula
                    </label>
                    <input class="form-check-input mb-2" type="checkbox" id="check-status" name="estado">
                    <label class="form-check-label" for="check-status">
                        Estado anime
                    </label>
                </div>
                <textarea name="descripcion" class="form form-control mb-2" name="desc_anime" placeholder="Descripción anime"></textarea>
                <input type="file" name="img_anime" class="form form-control mb-2" accept="image/*" required>
                <select id="generos" name="generos[]" class="form-control form-control-chosen mb-4" data-placeholder="Buscar genero existente" multiple required>
                    <?php foreach ($generos as $genero) { ?>
                        <option value="<?php echo $genero["id_genero"]; ?>"><?php echo $genero["nombre"]; ?></option>
                    <?php } ?>
                </select>
                <div id="new-genre" class="my-2">
                    <input class="form form-control mb-1" placeholder="Nuevo genero" name="nuevos_generos[]" type="text">
                    <button type="button" class="btn btn-outline-dark mas-genero">Añadir otro genero</button>
                </div>
                <button class="btn btn-dark">Subir</button>
            </form>
            `);

            $("#generos").chosen();
            $(".mas-genero").click(addGenre);
            $("#check-movie").click(status);
        });


        $("#add-cap").click(function() {
            $("#contenedor-froms").html(`
            <form action="agregar_capitulo.php" method="POST" class="my-2" enctype="multipart/form-data">
                <input type="text" class="form form-control mb-2" placeholder="Nombre del capitulo" name="nombre_capitulo" required>
                <select id="animes" name="id_anime" class="form-control form-control-chosen" data-placeholder="Buscar serie" required>
                    <option selected disabled>Buscar la serie</option>
                    <?php foreach ($series as $anime) { ?>
                        <option value="<?php echo $anime["id_anime"]; ?>"><?php echo $anime["nombre"]; ?></option>
                    <?php } ?>
                </select>
                <input type="file" class="form form-control my-2" name="contenido" accept="video/*,imagen/*" required>
                <button class="btn btn-dark">Subir</button>
            </form>
            `);


            $("#animes").chosen();
        });

        $("#add-pelicula").click(function() {
            $("#contenedor-froms").html(`
            <form action="agregar_pelicula.php" method="POST" class="my-2" enctype="multipart/form-data">
                <select id="animes" name="id_anime" class="form-control form-control-chosen" data-placeholder="Buscar pelicula" required>
                    <option selected disabled>Buscar la pelicula</option>
                    <?php foreach ($peliculas as $anime) { ?>
                        <option value="<?php echo $anime["id_anime"]; ?>"><?php echo $anime["nombre"]; ?></option>
                    <?php } ?>
                </select>
                <input type="text" class="form form-control my-2" placeholder="Duración" name="duracion">
                <input type="file" class="form form-control mb-2" name="contenido" accept="video/*,imagen/*">
                <button class="btn btn-dark">Subir</button>
            </form>
            `);
        });
    </script>
</body>

</html>