<?php
require('mysql.php');
require('rol.php');
require('user.php');

       $id = $_POST['id'];
	   $nombre = $_POST['nombre'];
	   $apellido = $_POST['apellido'];
	   $username = $_POST['username'];
	   $password = $_POST['password'];
	   $email = $_POST['email'];
	   $rol = $_POST['rol'];


    if($id != null){

	    $mysql = new mysql();
	    $idRol = $mysql->obtenerIdRol($rol);
	    $mysql->updateUser($id, $nombre, $apellido, $username, $password, $email, $idRol);
    }

    else{
	    $mysql = new mysql();
	    $role = $mysql->obtenerRol($rol);
	    
	    $user = new user(null, $nombre, $apellido, $username, $password, $email, $role);

	    $mysql->createUser($user);
    }
    header('Location: index.php', true);
    die();
?>
