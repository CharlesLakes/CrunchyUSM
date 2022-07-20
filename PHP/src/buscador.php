<?php
require "../db.php";


session_start();
if (!isset($_SESSION["id_cuenta"]) || !isset($_GET["q"]))
    header("location: /index.php");



$anime = $database->queryResponse("
    SELECT animes.id_anime, peliculas.id_anime as id_pelicula, animes.nombre, animes.foto 
    FROM animes LEFT JOIN peliculas 
    ON animes.id_anime=peliculas.id_anime
    WHERE strpos(animes.nombre,LOWER($1)) > 0;", array($_GET["q"]));



function main()
{
    global $anime;
?>
    <h2 style="margin:0;padding:10px;text-align:center;">Resultados para: <?php echo $_GET["q"]; ?></h2>
    <div class="anime-card-container">
        <?php
        foreach ($anime as $element) { ?>
            <div class="anime-card">
                <div class="anime-img">
                    <img src="<?php echo $element["foto"]; ?>">
                </div>
                <div class="anime-details">
                    <div class="miniinfo">
                        <?php echo $element["id_pelicula"] ? "Pelicula" : "Serie"; ?>

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
