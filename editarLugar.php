<?php
include 'conexiones/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $n_lugar = intval($_POST['n_lugar']); // ID del lugar
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $domicilio = $conexion->real_escape_string($_POST['domicilio']);
    $departamento = $conexion->real_escape_string($_POST['departamento']);

    // Validar que los campos no estén vacíos
    if (!empty($n_lugar) && !empty($nombre) && !empty($domicilio) && !empty($departamento)) {
        $sql = "UPDATE lugar SET nombre = '$nombre', domicilio = '$domicilio', departamento = '$departamento' WHERE n_lugar = $n_lugar";

        if ($conexion->query($sql) === TRUE) {
            echo "Lugar actualizado exitosamente.";
            header("Location: vistaAdmin.php");
        } else {
            echo "Error al actualizar el lugar: " . $conexion->error;
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
} else {
    echo "Método no permitido.";
}
?>
