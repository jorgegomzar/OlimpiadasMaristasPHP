<?php include "templates/header.php"; ?>

<?php
session_start();
include("./funciones/db.php");

if (isset($_POST) and isset($_POST["username"]) and isset($_POST["passwd"])){

    $post_username = $_POST["username"];
    $post_passwd = $_POST["passwd"];

    $conn = connect_database();

    $sql = "SELECT * FROM mods";
    $res = safe_query($conn, $sql);

    if ($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $db_username = $row["username"];
            $db_passwd = $row["passwd"];
        
            if(strcmp($db_username,$post_username) === 0 and strcmp($db_passwd,$post_passwd) === 0) {
                // Login correcto
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $post_username;
            }
        }
    }

    $conn->close();

}

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    // Si esta loggeado le reenviamos a update.php
    header('Location: /update.php');
} else {
    // Si no esta loggeado le dejamos quedarse
}

?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-4">Inicia sesión</h2>
      <hr>
      <form method="post">
        <div class="form-group">
          <label for="nombre">Usuario</label>
          <input type="text" name="username" id="username" class="form-control">
        </div>
        <div class="form-group">
          <label for="edad">Contraseña</label>
          <input type="password" name="passwd" id="passwd" class="form-control">
        </div>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-primary" value="Enviar">
          <a class="btn btn-primary" href="/">Regresar al inicio</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include "templates/footer.php"; ?>