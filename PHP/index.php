<?php include "templates/header.php"; ?>

<?php
////// CONFIGURACIONES VARIAS 
// Cierra sesion si habia alguna abierta
session_start();
session_destroy();

setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');

include("./funciones/db.php");
include("./funciones/aux.php");
include("./funciones/contenido.php");

////// HTML 
// Procesado del HTML a mostrar
$title = "<h1 class=\"display-1 text-center\">Olimpiadas Maristas 2022</h1>";

$db = connect_database();


$tabla_voley = get_tabla($db, 'Voley');
$tabla_basket = get_tabla($db, 'Basket');
$tabla_futsal = get_tabla($db, 'Futsal');

$tabla_100m = get_tabla_atletismo($db, '100m');
$tabla_200m = get_tabla_atletismo($db, '200m');
$tabla_400m = get_tabla_atletismo($db, '400m');

$db->close();

// Mostrar HTML
echo $title;
echo "<div class=\"container-fluid text-center\">";
include("./templates/ranking.php");
echo "	<div class=\"row\">";
echo "		<div class=\"col\">";
echo  $tabla_100m;
echo "		</div>";
echo "		<div class=\"col\">";
echo  $tabla_200m;
echo "		</div>";
echo "		<div class=\"col\">";
echo  $tabla_400m;
echo "		</div>";
echo "	</div>";
echo "	<div class=\"row\">";
echo "		<div class=\"col\">";
echo  $tabla_voley;
echo "		</div>";
echo "		<div class=\"col\">";
echo  $tabla_basket;
echo "		</div>";
echo "		<div class=\"col\">";
echo  $tabla_futsal;
echo "		</div>";
echo "	</div>";
echo "	<a class=\"btn btn-warning\" href=\"/login.php\">Editar</a>";
echo "</div>";

?>

<?php include "templates/footer.php"; ?>
