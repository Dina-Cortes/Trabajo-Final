<?php include("../template/cabecera.php");?>

<?php
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";

$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/bd.php");
 





switch($accion){
        
        case "Agregar";
        
         $sentenciaSQL= $conexion->prepare("INSERT INTO datos (nombre,imagen) VALUES (:nombre,:imagen);");
         $sentenciaSQL->bindparam(':nombre', $txtNombre);
         $fecha=new Datetime();
         $nombrearchivo=($txtImagen!="")?$fecha->gettimestamp()."_".$_FILES["txtImagen"] ["name"]:"imagen.jpg";

         $tmpImagen= $_FILES ["txtImagen"]["tmp_name"];

         if ($tmpImagen!=""){
          move_uploaded_file($tmpImagen,"../../img/".$nombrearchivo);
         }



         $sentenciaSQL->bindparam(':imagen', $nombrearchivo);
         $sentenciaSQL->execute();
        

         
            break;

        case "Modificar";
            echo "Presionado botón modificar";
            $sentenciaSQL= $conexion->prepare("UPDATE datos SET nombre=:nombre WHERE id=:id");
            $sentenciaSQL->bindparam(':nombre', $txtNombre);
            $sentenciaSQL->bindparam(':id', $txtID);
            $sentenciaSQL->execute();

           if ($txtImagen!="") {
              $fecha=new Datetime();
             $nombrearchivo=($txtImagen!="")?$fecha->gettimestamp()."_".$_FILES["txtImagen"] ["name"]:"imagen.jpg";
             $tmpImagen= $_FILES ["txtImagen"]["tmp_name"];
             move_uploaded_file($tmpImagen,"../../img/".$nombrearchivo);
             $sentenciaSQL= $conexion->prepare("SELECT imagen FROM datos WHERE id=:id");
            $sentenciaSQL->bindparam(':id', $txtID);
            $sentenciaSQL->execute();
            $listadeservicioscontables=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if (isset($listadeservicioscontables["imagen"]) && ($listadeservicioscontables["imagen"] != "imagen.jpg")) {


              if (file_exists("../..img/".$listadeservicioscontables["imagen"])) {


                unlink("../../img/".$listadeservicioscontables["imagen"]);
              }
              





            }





            
           
            $sentenciaSQL= $conexion->prepare("UPDATE datos SET imagen=:imagen WHERE id=:id");
            $sentenciaSQL->bindparam(':imagen', $nombrearchivo);
            $sentenciaSQL->bindparam(':id', $txtID);
            $sentenciaSQL->execute();
          }




            break;
            
        case "Cancelar";
        
            echo "Presionado botón cancelar";
            break; 

        case "Seleccionar";

           $sentenciaSQL= $conexion->prepare("SELECT * FROM datos WHERE id=:id");
            $sentenciaSQL->bindparam(':id', $txtID);
            $sentenciaSQL->execute();
            $listadeservicioscontables=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            $txtNombre=$listadeservicioscontables['nombre'];
            $txtImagen=$listadeservicioscontables['imagen'];
        

            echo "Presionado botón Seleccionar";
            break; 

            case "Borrar";
            
            $sentenciaSQL= $conexion->prepare("SELECT imagen FROM datos WHERE id=:id");
            $sentenciaSQL->bindparam(':id', $txtID);
            $sentenciaSQL->execute();
            $listadeservicioscontables=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if (isset($listadeservicioscontables["imagen"]) && ($listadeservicioscontables["imagen"] != "imagen.jpg")) {


              if (file_exists("../..img/".$listadeservicioscontables["imagen"])) {


                unlink("../../img/".$listadeservicioscontables["imagen"]);
              }
              





            }

            $sentenciaSQL= $conexion->prepare("DELETE FROM datos WHERE id=:id");
            $sentenciaSQL->bindparam(':id', $txtID);
            $sentenciaSQL->execute();







           

            
            break; 
            
            







          
}

$sentenciaSQL= $conexion->prepare("SELECT*FROM datos");
$sentenciaSQL->execute();
$listadeservicioscontables=$sentenciaSQL->fetchall(PDO::FETCH_ASSOC);



?>

  <div class="col-md-5">

   <div class="card">
    <div class="card-header">
      Datos de servicios contables
     </div>

     <div class="card-body">
     <form method="POST" enctype="multipart/form-data">

     <div class="form-group">
        <label for="txtID"> ID: </label>
        <input type="text" required readonly class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID" placeholder="ID">
      </div>
 
     <div class="form-group">
       <label for="txtNombre"> Nombre:</label>
       <input type="text" required class="form-control"  value="<?php echo $txtNombre;?>" name="txtNombre" id="txtNombre" placeholder="Nombre" >
     </div>

      <div class="form-group">
       <label for="txtImagen"> Imagen:</label>
       <?php echo $txtImagen;?>
         <?php if($txtImagen!="") { ?>

          <img class="img-thumnail rounded" src="../../img/<?php echo $txtImagen;?>" width="50" alt="" srcset="">
          
          <?php } ?>

       <input type="file" required class="form-control"  name="txtImagen" id="txtImagen" placeholder="Nombre" >
      </div>


      <div class= "btn-group" role= "group" aria-label="">
       <button type= "submit" name="accion" <?php echo ($accion=="seleccionar")?"disabled":"";        ?>   value="Agregar" class= "btn btn-success">Agregar</button>
       <button type= "submit" name="accion" value="Modificar" class= "btn btn-warning">Modificar</button>
        <button type= "submit" name="accion" value="Cancelar" class= "btn btn-info">Cancelar</button>
      </div>

     </form>
      
    </div>

    








    </div>
  


 

  </div>

 <div class="col-md-7">
 <table class="table table-bordered">
 <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Imagen</th>
      <th>Acciones</th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($listadeservicioscontables as $datos){?>
   
    <tr>

      <td><?php echo $datos ['id'];?></td>
      <td><?php echo $datos ['nombre'];?></td>

      
      <td>
        
        <img src="../../img/<?php echo $datos ['imagen'];?>" width="50" alt="" srcset="">
      
      </td>
      
      
      <td>
        
        <form method="POST">
          <input type="hidden" name="txtID" id="txtID" value="<?php echo $datos['id']; ?>"/>

          <input type="submit" name="accion"value="Seleccionar" class="btn btn-primary"/>

          <input type="submit" name="accion"value="Borrar" class="btn btn-danger"/>




        </form>
      
      
      
      
      
      </td>




    </tr>
    <?php }?>
    </tbody>
  </table>

    
   </div>


<?php include("../template/pie.php");?>