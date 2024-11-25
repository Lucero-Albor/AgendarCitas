<?php
include 'conexiones/sesion.php';
include 'conexiones/conexion.php';

// Verificar si se recibió la información del formulario
if (isset($_POST['usuarioId'])) {
    $id = $_POST['usuarioId'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $pass = $_POST['pass'];
    $rol = $_POST['rol'];

    // Actualizar los datos del usuario en la base de datos
    $sql = "UPDATE usuarios SET nombre='$nombre', apellidos='$apellidos', correo='$correo', pass='$pass', rol='$rol' WHERE id_usuario='$id'";

    if ($conexion->query($sql) === TRUE) {
        echo "<script>alert('Usuario actualizado correctamente'); window.location.href = 'vistaAdmin.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el usuario'); window.location.href = 'vistaAdmin.php';</script>";
    }
}
?>
