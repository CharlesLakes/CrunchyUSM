<h2 style="margin:0;padding:10px;text-align:center;">Mayor Popularidad</h2>
<div class="anime-card-container">
    <?php
    foreach ($mayor_popularidad as $element) { ?>
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
<h2 style="margin:0;padding:10px;text-align:center;">Menor Popularidad</h2>
<div class="anime-card-container">
    <?php
    foreach ($menor_popularidad as $element) { ?>
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
<h2 style="margin:0;padding:10px;text-align:center;">Mas Comentados</h2>
<div class="anime-card-container">
    <?php
    foreach ($mas_comentados as $element) { ?>
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
<h2 style="margin:0;padding:10px;text-align:center;">Animes Recientes</h2>
<div class="anime-card-container">
    <?php
    foreach ($animes_recientes as $element) { ?>
        <div class="anime-card">
            <div class="anime-img">
                <img src="<?php echo $element["foto"]; ?>">
            </div>
            <div class="anime-details">
                <div class="miniinfo">
                    <?php if ($element["nombre_capitulo"] != NULL) { ?>
                        Episodio <?php echo $element["nombre_capitulo"];
                                } else { ?> Pelicula <?php } ?>

                </div>
                <div class="title">
                    <?php echo $element["nombre"]; ?>
                </div>
            </div>
            <a class="link" href="/contenido.php?<?php
                                                    if ($element["id_capitulo"] == NULL)
                                                        echo "id_pelicula=" . $element["id_anime"];
                                                    else
                                                        echo "id_capitulo=" . $element["id_capitulo"];
                                                    ?>"></a>
        </div>
    <?php
    }
    ?>
</div>