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
            Generos: <?php echo implode(", ", $generos); ?>
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
            <?php if ($is_visto) {
            ?>
                <a href="visto.php?id_anime=<?php echo $_GET["id_anime"]; ?>"><button class="btn btn-success">Visto</button></a>
            <?php
            } else { ?>
                <a href="visto.php?id_anime=<?php echo $_GET["id_anime"]; ?>"><button class="btn btn-danger">No Visto</button></a>
            <?php } ?>
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


<div class="comentarios-anime p-2 mb-2" id="caja-comentarios">
    <form action="comentar.php" method="POST">
        <input type="hidden" name="accion" value="CREATE">
        <input type="hidden" name="id_anime" value="<?php echo $_GET["id_anime"]; ?>">
        <textarea name="comentario" class="form form-control mb-2"></textarea>
        <button class="btn btn-outline-light">Comentar</button>
    </form>
    <?php
    if ($comentarios) {
        foreach ($comentarios as $comentario) {
    ?>
            <div class="comentario p-2" id="comentario-<?php echo $comentario["id_comentario"]; ?>">
                <div class="perfil">
                    <div class="foto">
                        <img src="<?php echo $comentario["foto"]; ?>">
                    </div>
                    <span class="nombre">
                        <?php echo $comentario["nombre"]; ?>
                    </span>
                </div>
                <div class="contenido">
                    <p>
                        <?php echo htmlentities($comentario["contenido"]); ?>
                    </p>
                </div>
                <?php if (intval($_SESSION["id_cuenta"]) == intval($comentario["id_cuenta"])) { ?>
                    <div class="acciones">
                        <button class="btn btn-info mb-2 editar" data-id="<?php echo $comentario["id_comentario"]; ?>">Editar</button>
                        <form action="comentar.php" method="POST">
                            <input type="hidden" name="id_comentario" value="<?php echo $comentario["id_comentario"]; ?>">
                            <input type="hidden" name="accion" value="DELETE">
                            <button class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                <?php } ?>
            </div>
    <?php }
    } ?>
</div>