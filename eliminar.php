<?php 
require('mysql.php');
    $id = $_GET['id'];
    $mysql = new mysql();
    $mysql->deleteUser($id);
    header('Location: index.php', true);
    die();
?>