<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sprint - 2 </title >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="Estilos/style_index.css">

    <script type="text/javascript" src="javaScript/funciones_index.js"> </script>
</head>
<body>

    <?php require('mysql.php')?>
    <?php require('rol.php')?>
    <?php require('user.php')?>


    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"> Proyecto de Software 2021. </a>
            <button class="navbar-toggler" type="button"  data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php"> Listado </a>
                    </li>                    
                </ul>
            </div>
        </div>
    </nav>
     
   <div class="barra_operaciones">
    
       <button class="boton_agregar btn" data-bs-toggle="modal" data-bs-target="#Modal"> 
            <i class="fas fa-plus-circle icono_agregar"> </i>
       </button>


   </div>

    <div class="contenedor_tabla">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col"> Id </th>
                    <th scope="col"> Nombre </th>
                    <th scope="col"> Apellido </th>
                    <th scope="col"> Username </th>
                    <th scope="col"> Password </th>
                    <th scope="col"> Email </th>
                    <th scope="col"> Rol </th>
                    <th scope="col"> Opciones </th>
                </tr>
            </thead>
            <tbody>
            <?php  
                $mysql = new mysql();
                $resultado = $mysql->findAllUser();
                foreach ($resultado as $usuarios) {
            ?>
             <tr class="align-middle">
                    <th scope="row"> <?php echo $usuarios->getId() ?> </th>
                    <td> <?php echo $usuarios->getNombre() ?> </td>
                    <td> <?php echo $usuarios->getApellido() ?> </td>
                    <td> <?php echo $usuarios->getUsername() ?> </td>
                    <td> <?php echo $usuarios->getPassword() ?> </td>
                    <td> <?php echo $usuarios->getEmail() ?> </td>
                    <td> <?php echo $usuarios->getRol() ?> </td>
                    <td> 
                     
                         <button type="button" class="btn" onclick="solicitarConfirmacion('<?php echo $usuarios->getId();?>')">
                                <i class="fas fa-trash-alt"></i>
                         </button>

                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#Modal" onclick="cargarDatosModal('<?php echo $usuarios->getId(); ?>', '<?php echo $usuarios->getNombre(); ?>', '<?php echo $usuarios->getApellido(); ?>', '<?php echo $usuarios->getUsername(); ?>', '<?php echo $usuarios->getPassword(); ?>', '<?php echo $usuarios->getEmail(); ?>', '<?php echo $usuarios->getRol(); ?>')"> 
                                <i class="fas fa-edit"></i>       
                        </button>
                    </td>
            </tr>
                <?php };  
                ?>
            </tbody>
        </table>
    </div>


    <!--VENTANA MODAL DE EDICION -->

  <div class="modal fade modal-dialog-scrollable" id="Modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="exampleModalLabel"> Editar informacion de usuario </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="limpiar()"></button>
      </div>

      <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <form action="Alta_modificacion.php" method="POST"> 
                            <div class="row mb-3">

                                <input type="text" name="id" id="inputId" style="display: none;">

                                <label for="inputNombre" class="col-sm-4 col-form-label fw-bold"> Nombre </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputNombre" name="nombre" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputApellido" class="col-sm-4 col-form-label fw-bold"> Apellido </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputApellido" name="apellido" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputUsername" class="col-sm-4 col-form-label fw-bold"> Username </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputUsername" name="username" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-4 col-form-label fw-bold"> Password </label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="inputPassword" name="password" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-4 col-form-label fw-bold" > Email </label>
                                <div class="col-sm-8">
                                    <input type="Email" class="form-control" id="inputEmail" name="email" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputRol" class="col-sm-4 col-form-label fw-bold"> Rol </label>
                                <div class="col-sm-8">
                                    <select class="form-select" name="rol" id="select">
                                    <!--<option selected> Seleccione una opción </option>-->
                                        <?php
                                            $mysql = new mysql();
                                            $resultado = $mysql->findAllRol();
                                            print_r($resultado);
                                            foreach ($resultado as $rol) {
                                        ?>
                                        <option value='<?php echo $rol->getNombre() ?>'> <?php echo $rol->getNombre() ?> </option>
                                        <?php };  
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="limpiar()"> Cancelar </button>
                                  <button type="submit" class="btn btn-primary" > Guardar cambios </button>
                            </div>
                        </form>
                    </div>
        </div>

      </div>
    </div>
  </div>
</div>

</body>
</html>