<?php
    include'conexiones/conexion.php';
    session_start();
    if (isset($_SESSION['correo'])) {
        $correo = $_SESSION['correo'];
        $nombre = "SELECT nombre, apellidos FROM usuarios WHERE correo = '$correo'";
        $result = mysqli_query($conexion, $nombre);
        $user = mysqli_fetch_assoc($result);
        $nombre = $user['nombre'];
        $apellidos = $user['apellidos'];
        $n_completo = $nombre . ' ' . $apellidos;
    } 

    else {
        echo "Inicia sesión para continuar.";
    }
?>