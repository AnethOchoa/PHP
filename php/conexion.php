<?php
    $servidor="localhost";
    $nombreBD="escuela";
    $usuario="root";
    $password="";
    $conexion= new mysqli($servidor, $usuario, $password,$nombreBD);
    if($conexion -> connect_error){
        die("No se pudo conectar a la base de datos");
    }
    
?>