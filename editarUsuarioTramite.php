<?php
include 'conexiones/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuarioTramiteId = intval($_POST['usuarioTramiteId']); // ID del usuario-trámite
    $idUsuario = intval($_POST['idUsuario']);
    $idLugar = intval($_POST['idLugar']);
    $idTramite = intval($_POST['idTramite']);
    $fecha = $conexion->real_escape_string($_POST['fecha']);
    $hora = $conexion->real_escape_string($_POST['hora']);

    // Validar que los campos no estén vacíos
    if (!empty($usuarioTramiteId) && !empty($idUsuario) && !empty($idLugar) && !empty($idTramite) && !empty($fecha) && !empty($hora)) {
        $sql = "UPDATE usuario_tramite SET id_usuarios = $idUsuario, n_lugar = $idLugar, num_tramite = $idTramite, fecha = '$fecha', hora = '$hora' WHERE id_ut = $usuarioTramiteId";

        if ($conexion->query($sql) === TRUE) {
            echo "Usuario-Trámite actualizado exitosamente.";
            header("Location: vistaAdmin.php");
        } else {
            echo "Error al actualizar el usuario-trámite: " . $conexion->error;
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
} else {
    echo "Método no permitido.";
}
?>
