<?php
    include'conexion.php';
    if(isset($_POST['registro'])){
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $correo = $_POST['correo'];
        $pass = $_POST['pass'];
        $rol = 'Usuario';

        $registrar = "INSERT INTO usuarios (nombre, apellidos, correo, pass, rol) 
                    VALUES ('$nombres', '$apellidos', '$correo', '$pass', '$rol')";
        $result = mysqli_query($conexion, $registrar);
        if ($result) {
            echo 'Registro exitoso';
        } 
        
        else {
            echo 'Fallo de registro';
        }
    }
    else{
        echo 'Error de envío';
    }
?>