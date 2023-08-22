<?php include("template/cabecera.php"); ?> 

<?php
include("administrador/config/bd.php");
$sentenciaSQL= $conexion->prepare("SELECT * FROM datos");
$sentenciaSQL->execute();
$listadeservicioscontables=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);?>


<?php foreach($listadeservicioscontables as $listadeserv) {?>

  <div 
 
class="col-md-3">
    <div class="card">
      <img class="card-img-top" src="./img/<?php echo $listadeserv['imagen']; ?>" alt="">
      <div class="card-body">
        <h4 class="card-title"><?php echo $listadeserv['nombre']; ?></h4>
        <a name="" id="" class="btn btn-primary" href="https://www.dian.gov.co/impuestos/factura-electronica/Documents/Paso-a-paso-para-conocer-la-Solucion-Gratuita-de-Nomina-Electronica.pdf" role="button">Ver Mas</a>
      </div>
    </div>
  </div>
<?php } ?>


  
 

  <?php include("template/pie.php"); ?>