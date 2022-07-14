<?php
require "../db.php";


session_start();

if (!isset($_SESSION["id_cuenta"]))
    header("location: /login.php");


function inicio()
{
    global $database;
    $result = $database->queryResponse("SELECT * FROM animes_recientes;", array());

?>
    <h2 style="margin:0;padding:10px;text-align:center;">Animes Recientes</h2>
    <div class="anime-card-container">
        <?php
        foreach ($result as $element) { ?>
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
<?php
}


function main()
{
    inicio();
}

include "../templates/index_template.php";
