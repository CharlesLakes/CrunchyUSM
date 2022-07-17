<?php

require "../db.php";

session_start();
if (!isset($_SESSION["id_cuenta"]))
    header("location: /index.php");

$animes = $database->queryResponse(
    "SELECT animes.id_anime, peliculas.id_anime as is_pelicula, animes.foto, animes.nombre
    FROM animes LEFT JOIN peliculas
    ON animes.id_anime = peliculas.id_anime"
);
$generos = $database->queryResponse(
    "SELECT * FROM generos"
);


if (isset($_GET["generos"]) && count($_GET["generos"]) > 0) {
    $temp = "(" . implode(",", $_GET["generos"]) . ")";
    $animes = $database->queryResponse(
        "SELECT animes.id_anime, animes_generos.id_genero, peliculas.id_anime as is_pelicula, animes.foto, animes.nombre
            FROM animes LEFT JOIN peliculas
            ON animes.id_anime = peliculas.id_anime
        INNER JOIN 
            animes_generos ON animes_generos.id_anime = animes.id_anime
            WHERE animes_generos.id_genero IN " . $temp
    );
    $animes_reg = array();
    $animes = array_filter($animes, function ($valor) {
        global $animes_reg;
        if (in_array($valor["id_anime"], $animes_reg))
            return false;
        array_push($animes_reg, $valor["id_anime"]);
        return true;
    });
}





function main()
{
    global $animes, $generos;
?>

    <form action="generos.php" class="p-2">
        <select id="generos" name="generos[]" class="form-control form-control-chosen" data-placeholder="Ingresa los generos" multiple>
            <?php foreach ($generos as $genero) { ?>
                <option value="<?php echo $genero["id_genero"]; ?>"><?php echo $genero["nombre"]; ?></option>
            <?php } ?>
        </select>
        <button class="btn btn-outline-dark mt-2">Filtrar</button>
    </form>


    <script>
        $(document).ready(() => {
            $("#generos").chosen();
        })
    </script>
    <div class="anime-card-container">
        <?php
        foreach ($animes as $element) { ?>
            <div class="anime-card">
                <div class="anime-img">
                    <img src="<?php echo $element["foto"]; ?>">
                </div>
                <div class="anime-details">
                    <div class="miniinfo">
                        <?php echo $element["is_pelicula"] ? "Pelicula" : "Serie"; ?>

                    </div>
                    <div class="title">
                        <?php echo $element["nombre"]; ?>
                    </div>
                </div>
                <a class="link" href="/anime.php?id_anime=<?php echo $element["id_anime"]; ?>"></a>
            </div>
        <?php
        }
        ?>
    </div>
<?php
}

include "../templates/index_template.php";
