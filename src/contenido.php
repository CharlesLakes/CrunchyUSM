<?php
require "../db.php";

session_start();
if (!isset($_SESSION["id_cuenta"]))
    header("location: /login.php");

$result;
$flag = isset($_GET["id_pelicula"]);
if (isset($_GET["id_pelicula"]))
    $result = $database->queryResponse("
        SELECT animes.id_anime as id_pelicula,animes.nombre, peliculas.contenido FROM (
            SELECT animes.id_anime,animes.nombre, peliculas.contenido 
            FROM peliculas INNER JOIN animes ON animes.id_anime = peliculas.id_anime
        ) WHERE id_anime = $1;
    ", array($_GET["id_pelicula"]))[0];
else if (isset($_GET["id_capitulo"]))
    $result = $database->queryResponse("
        SELECT id_capitulo,nombre,contenido FROM capitulos WHERE id_capitulo = $1
    ", array($_GET["id_capitulo"]))[0];
else
    header("location: /index.php");


function main()
{
    global $result, $flag;
?>
    <h2 style="padding:10px;text-align:center;box-sizing:border-box;margin:0px 5px;"><?php
                                                                                        if ($flag)
                                                                                            echo $result["nombre"];
                                                                                        else echo "Episodio " . $result["nombre"];

                                                                                        ?></h2>
    <div style="width:100%;padding-top:56.25%;position:relative;margin-top:0x;">
        <iframe style="width:100%;height:100%;position:absolute;top:0;left:0;" class="player_conte" src="<?php echo $result["contenido"]; ?>" width="565" height="318" scrolling="no" frameborder="0" allowfullscreen="true"></iframe>
    </div>
<?php
}


include "../templates/index_template.php";
