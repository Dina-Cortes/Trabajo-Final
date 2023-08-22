<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location:../index.php");
}
if ($_SESSION['usuario']=="ok") {
    $nombreUsuario=$_SESSION["nombreUsuario"];
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador proyecto</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    
    <?php $url="http://" .$_SERVER['HTTP_HOST']."/proyecto" ?>



    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="nav navbar-nav">
          
          <a class="nav-link" href="#">Administrador del proyecto final</a>
         
          <a class="nav-link" href="<?php echo $url;?>/administrador/inicio.php">inicio</a>

         
          <a class="nav-link"  href="<?php echo $url;?>/administrador/seccion/productos.php">Servicios contables</a>
        
          <a class="nav-link" href="<?php echo $url;?>/administrador/seccion/cerrar.php">Cerrar</a>



          <a class="nav-link" href="<?php echo $url;?>">Ver proyecto final</a>
          
        </div>
    </nav>
    
    





   <div class="container">
    <br/>
        <div class= "row">
          