<?php
    include "./conexion.php";
    $id= $_POST['id'];
    $nombre= $_POST['nombre'];
    $ap= $_POST['ap'];
    $email= $_POST['em'];
    $p1= $_POST['p1'];
    $p2= $_POST['p2'];
   
    if(trim($p1)=="" && trim($p2)==""){
        $conexion->query("update usuarios set
            nombre='$nombre',
            apellido='$ap',
            email='$email' where id='$id'")or die($conexion->error);
            header("Location: ../users.php?success=Actualizado correctamente");
    }else{
        if($p1==$p2){
            $pass=sha1($p1);
            $conexion->query("update usuarios set
            nombre='$nombre',
            apellido='$ap',
            email='$email', 
            password='$pass'
            where id=$id")or die($conexion->error);
            
            header("Location: ../users.php?success=Actualizado correctamente");
        }else{
            //hay error
            header("Location: ../users.php?error=Los campos no coinciden");
        }
    }
    
?>