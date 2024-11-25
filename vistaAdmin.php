<?php
  include'conexiones/sesion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleVistaAdmin.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <title>Vista Administrador</title>
</head>
<body>
    <nav style="background-color: #5A1746;" class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <img src="images/logo.png" width="40px">&nbsp;&nbsp;
            <a class="navbar-brand" style="color: white; font-size: 28px;" href="index.html">MiCita</a>
            <div class="collapse navbar-collapse"></div>
            <span style="color: white;" id="user"><?php echo $n_completo;?></span>
            <a style="color: white; margin-right: 10px;" href="conexiones/cerrar_conexion.php">Cerrar sesión</a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="header-container position-relative">
            <img src="images/logo.png" class="logo">
            <h1 class="title">Vista administrador</h1>
        </div>



        <div class="d-flex justify-content-center my-3">
            <button class="btn btn-outline-secondary mx-2">Usuarios</button>
            <button class="btn btn-outline-secondary mx-2">Trámites</button>
            <button class="btn btn-outline-secondary mx-2">Lugar</button>
            <button class="btn btn-outline-secondary mx-2">Usuario-Trámite</button>
        </div>

        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-warning mx-2">Editar</button>
            <button class="btn btn-warning mx-2" onclick="window.location.href='registroAdministrador.php'">Registrar</button>
        </div>

        <table class="table table-bordered text-center">
            <thead style="background-color: #EAA724; color: white;">
                <tr>
                    <th>ID usuario</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>Contraseña</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'conexiones/conexion.php';

                $sql = "SELECT id_usuario, nombre, apellidos, correo, pass, rol FROM usuarios";
                $result = $conexion->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id_usuario']}</td>
                                <td>{$row['nombre']}</td>
                                <td>{$row['apellidos']}</td>
                                <td>{$row['correo']}</td>
                                <td>{$row['pass']}</td>
                                <td>{$row['rol']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No se encontraron registros</td></tr>";
                }

                $conexion->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
