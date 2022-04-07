<?php include "templates/header.php"; ?>

<?php
////// CONFIGURACIONES VARIAS
// Recupero la sesion
session_start();

// Para utilizar tildes
setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');

include("./funciones/db.php");
include("./funciones/aux.php");
include("./funciones/contenido.php");

// Compruebo si el usuario ha iniciado sesion
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    // Si esta loggeado le dejamos quedarse
} else {
    // Si no esta loggeado al index
    header('Location: /');
}

////// HTML 
// Procesado del HTML a mostrar
$title = "<h1 class=\"display-1 text-center\">Olimpiadas Maristas 2022</h1>";

if (isset($_POST['submit'])) {
    // Primero compruebo cuales son los cambios respecto a la base de datos
    $updates = get_updates();
    // Actualizo la base de datos con los cambios
    update_tablas($updates);
}

$db = connect_database();
$tabla_voley = get_tabla_editable($db, 'Voley');
$tabla_basket = get_tabla_editable($db, 'Basket');
$tabla_futsal = get_tabla_editable($db, 'Futsal');

$tabla_100m = get_tabla_atletismo_editable($db, '100m');
$tabla_200m = get_tabla_atletismo_editable($db, '200m');
$tabla_400m = get_tabla_atletismo_editable($db, '400m');

$db->close();

// Imprimo la pagina
echo $title;
echo "<div class=\"container-fluid text-center\">";
echo "	<form method=\"post\">";
echo "		<div class=\"container\">";
echo "			<a class=\"btn btn-danger\" href=\"/index.php\">Cerrar sesión y volver</a>&nbsp;";
echo "			<input type=\"submit\" name=\"submit\" class=\"btn btn-primary\" value=\"Aplicar cambios\">";
echo "		</div>";
echo "<br>";
include("./templates/ranking_editable.php");
echo "		<div class=\"row\">";
echo "			<div class=\"col\">";
echo  $tabla_100m;
echo "			</div>";
echo "			<div class=\"col\">";
echo  $tabla_200m;
echo "			</div>";
echo "			<div class=\"col\">";
echo  $tabla_400m;
echo "			</div>";
echo "		</div>";
echo "		<div class=\"row\">";
echo "			<div class=\"col\">";
echo  $tabla_voley;
echo "			</div>";
echo "			<div class=\"col\">";
echo  $tabla_basket;
echo "			</div>";
echo "			<div class=\"col\">";
echo  $tabla_futsal;
echo "			</div>";
echo "		</div>";
echo "	</form>";
echo "</div>";

?>

<?php include "templates/footer.php"; ?>
