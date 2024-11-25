<?php
include 'conexiones/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tramiteId = intval($_POST['tramiteId']); // ID del trámite
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $descripcion = $conexion->real_escape_string($_POST['descripcion']);

    // Validar que los campos no estén vacíos
    if (!empty($tramiteId) && !empty($nombre) && !empty($descripcion)) {
        $sql = "UPDATE tramites SET nombre = '$nombre', descripcion = '$descripcion' WHERE num_tramite = $tramiteId";

        if ($conexion->query($sql) === TRUE) {
            echo "Trámite actualizado exitosamente.";
            header("Location: vistaAdmin.php    ");
        } else {
            echo "Error al actualizar el trámite: " . $conexion->error;
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
} else {
    echo "Método no permitido.";
}
?>
