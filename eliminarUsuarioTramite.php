<?php
include 'conexiones/conexion.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM usuario_tramite WHERE id_ut = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Registro eliminado correctamente'); window.location.href = 'vistaAdmin.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el registro'); window.location.href = 'vistaAdmin.php';</script>";
    }

    $stmt->close();
} else {
    echo "ID de registro no especificado.";
}

$conexion->close();
?>
