<?php
require "../db.php";

session_start();
if (!isset($_SESSION["id_cuenta"]) || !isset($_GET["id_anime"]))
    header("location: /login.php");



function main()
{
    global $database;
    $anime = $database->queryResponse("SELECT nombre,descripcion,foto,puntuacion_media FROM animes WHERE id_anime=$1", array($_GET["id_anime"]))[0];
    $is_pelicula = $database->queryResponse("SELECT * FROM peliculas WHERE id_anime=$1", array($_GET["id_anime"]));



    if ($is_pelicula == NULL) {
        $contenido = $database->queryResponse("SELECT id_capitulo,nombre,fecha FROM capitulos WHERE id_serie=$1", array($_GET["id_anime"]));
        $estado = $database->queryResponse("SELECT estado FROM series WHERE id_anime=$1", array($_GET["id_anime"]));
    }

    $is_calificado = $database->queryResponse("SELECT valor FROM calificaciones WHERE id_cuenta=$1 AND id_anime=$2", array($_SESSION["id_cuenta"], $_GET["id_anime"]));
?>
    <div class="anime">
        <div class="left">
            <img src="<?php echo $anime["foto"]; ?>" />
        </div>
        <div class="right">
            <div>
                Nombre: <?php echo $anime["nombre"]; ?>
            </div>
            <div>
                Puntuación media: <?php echo $anime["puntuacion_media"] ? $anime["puntuacion_media"] : 0; ?>
            </div>
            <div>
                Tipo: <?php echo $is_pelicula ? "Pelicula" : "Serie"; ?>
            </div>
            <div>
                Generos: Sexo
            </div>
            <?php if (!$is_pelicula) { ?>
                <div>
                    Estado: <?php echo $estado == "t" ? "Concluida" : "Finalizada"; ?>
                </div>
            <?php } ?>
            <div>
                Descripción:
                <p class="desc">
                    <?php echo $anime["descripcion"]; ?>
                </p>
            </div>
            <div>
                <button class="btn btn-danger">No Visto</button>
                <button class="btn btn-warning" style="color:white;">Agregar a una lista</button>
                <form action="puntuacion.php" method="POST" class="mt-2" style="display: flex;align-items:center;">
                    <input type="hidden" name="id_anime" value="<?php echo $_GET["id_anime"]; ?>">
                    <?php if ($is_calificado) { ?>
                        <select class="form form-control" style="display: inline-block;min-width:100px;width:auto;" name="puntuacion">
                            <option value="1" <?php echo $is_calificado[0]["valor"] == 1 ? "selected" : "" ?>>1</option>
                            <option value="2" <?php echo $is_calificado[0]["valor"] == 2 ? "selected" : "" ?>>2</option>
                            <option value="3" <?php echo $is_calificado[0]["valor"] == 3 ? "selected" : "" ?>>3</option>
                            <option value="4" <?php echo $is_calificado[0]["valor"] == 4 ? "selected" : "" ?>>4</option>
                            <option value="5" <?php echo $is_calificado[0]["valor"] == 5 ? "selected" : "" ?>>5</option>
                        </select>
                    <?php } else { ?>
                        <select class="form form-control" style="display: inline-block;min-width:100px;width:auto;" name="puntuacion">
                            <option selected disabled>-- puntuación --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    <?php } ?>

                    <button class="btn btn-warning" style="margin-left:10px;color:white;">Guardar puntaución</button>
                </form>

            </div>
        </div>
    </div>
    <div class="video-list">
        <?php
        if ($is_pelicula) {
        ?>
            <a href="" style="color:white;">
                <div class="video-redirect">
                    <div class="left">
                        <?php echo $anime["nombre"]; ?>
                    </div>
                    <div class="right"><?php echo date("d/m/Y", strtotime($anime["fecha"])); ?></div>
                </div>
            </a>

            <?php
        } else {
            foreach ($contenido as $result) {
            ?>
                <a href="contenido.php?id_capitulo=<?php echo $result["id_capitulo"]; ?>" style="color:white;">
                    <div class="video-redirect">
                        <div class="left">
                            Episodio <?php echo $result["nombre"]; ?>
                        </div>
                        <div class="right"><?php echo date("d/m/Y", strtotime($result["fecha"])); ?></div>
                    </div>
                </a>
        <?php }
        } ?>
    </div>
<?php
}

include "../templates/index_template.php";
