<?php
session_start();
if ($_POST) {
    if ($_POST['usuario'] == "proyecto" && $_POST['contraseña'] == "sistema") {
        $_SESSION['usuario']="ok";
        $_SESSION['nombreUsuario']="proyecto";
       header('location:inicio.php');


    }else {
        $mensaje="Error:El usuario o contraseña son incorrectos";
    }
}


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Administrador</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>

    <div class="container">
        <div class= "row">
        <div class= "col-md-4">


        </div>


            <div class="col-md-4">
        <br/><br/><br/>

        <div class="card">


        <div class="card-header">
            
            
            Login
            

          </div>
         
          <div class="card-body">

            <?php if(isset($mensaje)){?>
                <div class="alert alert-danger" role= "alert">
                    <?php echo $mensaje;?>


                </div>


            <?php } ?>
     
           <form method="POST">

              <div class="form-group">
               <label>Usuario</label>
               <input type="text" class="form-control" name="usuario" placeholder="Escribe tu usuario">
               </div>

               <div class="form group">

              <label=>Contraseña</label>

             <input type="password" class="form-control" name="contraseña" placeholder="Escribe tu contraseña">

             </div>

             <button type="submit" class="btn btn-primary">Entrar Al Administrador</button>

            </form>


        </div>





    </div>








  </div>
 





    
</body>
</html>