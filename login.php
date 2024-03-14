<?php 

session_start();
  $_SESSION["Auth"] = true; 
  session_destroy();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- L I B E R A N D O   C A C H E -->
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">

  <!-- REFRESCA LA PAGINA CADA 3mntos >
  <META HTTP-EQUIV="REFRESH" CONTENT="150; c:\"-->

  <!-- I C O N O S (DESDE ARCHIVOS LOCALES) VERSION bootstrap-icons-1.11.2 -->
  <link rel="stylesheet" href="./public/img/micons/font/bootstrap-icons.css">
  <script src="./public/js/jquery-3.7.0.min.js"></script>

  <!--E S T I L O S  P E R S O N A L I Z A D O S -->
  <link rel="stylesheet" href="./public/css/estilos.css">

<!-- VERSION bootstrap-5.1.3-dist-->
<link rel="stylesheet" href="./public/css/bootstrap.min.css">


  <title>Inicio de Sesion</title>

  <head>
    <title>Formulario de inicio de sesión</title>

  </head>

<body id="initfrm" >

  <div class="login">

    <form class="login-container" id="frminic" method="post" >
    <div id="imagpng"><img src="./public/img/micons/favicon_bosto1.png" alt="Trulli" width="325" height="248"> </div>

      <input type="hidden" id="CargarPagina" name="CargarPagina" value="PagPpal">

      <input id="username" name="username" class="form-control" type="text" placeholder="Usuario o email" autocomplete="none">
      <input id="password"  name="password" class="form-control" type="password" placeholder="Contraseña" autocomplete="none">

      <button id="togglepassword" class="bi bi-eye-slash btn-lg" title='Ver / Ocultar Contraseña' type="button" aria-label="Visualizar Contraseña como Texto Plano.
                 Aviso: Esto podria mostrar su contraseña en la pantalla." >
      </button>

      <button id="blogin" type="submit"><b> I n i c i a r &nbsp&nbsp&nbspS e s i o n</b> </button>

    </form>
    <script src="./public/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="./public/js/inicSesion.js"></script>
  </div>
  
</body>

</html>