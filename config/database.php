<?php 
$host = "127.0.0.1";
$user = "root";
$password = "";
$db = "bd_tienda";
$port = 3306; 


try {
    $con = new mysqli($host, $user, $password, $db, $port);
} catch (mysqli_connect_error $e) {
    die("error de conexion: " . $e->getMessage());
} 
?> 