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

	   $mysql = new mysql();
	   $role = $mysql->obtenerRol($rol);
	   $user = new user($id, $nombre, $apellido, $username, $password, $email, $role);

    if($id != null){
	    $mysql->updateUser($user);
    }

    else{
	    $mysql->createUser($user);
    }
    header('Location: index.php', true);
    die();
?>
