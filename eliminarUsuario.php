<?php
include 'conexiones/sesion.php';
include 'conexiones/conexion.php';

// Verificar si se recibió el ID del usuario a eliminar
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el usuario de la base de datos
    $sql = "DELETE FROM usuarios WHERE id_usuario='$id'";

    if ($conexion->query($sql) === TRUE) {
        echo "<script>alert('Usuario eliminado correctamente'); window.location.href = 'vistaAdmin.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el usuario'); window.location.href = 'vistaAdmin.php';</script>";
    }
}
?>
