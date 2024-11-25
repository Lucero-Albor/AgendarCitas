<?php
  include'conexiones/sesion.php';   
  
    $sql = "SELECT usuario_tramite.id_ut, lugar.nombre, lugar.departamento, usuario_tramite.fecha, usuario_tramite.hora
           FROM usuario_tramite
           JOIN usuarios
           ON usuario_tramite.id_usuarios = usuarios.id_usuario
           JOIN lugar
           ON usuario_tramite.n_lugar = lugar.n_lugar
           WHERE usuarios.correo = ?";

    if ($stmt = mysqli_prepare($conexion, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $correo); 
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $datos = mysqli_fetch_assoc($result);
            $n_tramite = $datos['id_ut'];
            $lugar = $datos['nombre'];
            $departamento = $datos['departamento'];
            $fecha = $datos['fecha'];
            $hora = $datos['hora'];
        } 
        else {
            echo "No se encontraron resultados para el correo proporcionado.";
        }
        mysqli_stmt_close($stmt);
    }
?>
  
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleDatosCita.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <title>Datos Cita</title>
</head>
<body>
    <nav style="background-color: #5A1746;" class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <img src="images/logo.png" width="40px">&nbsp;&nbsp;
            <a class="navbar-brand" style="color: white; font-size: 28px;" href="index.html">MiCita</a>
            <div  style="margin-left: 25%;" class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Desplegable 1-->
                    <li class="nav-item dropdown tramite">
                        <a class="nav-link dropdown-toggle " style="color: white;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Trámites
                        </a>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="afiliacion.php">Afiliación</a></li>
                        <li><a class="dropdown-item" href="citaMedica.php">Cita médica</a></li>
                        <li><a class="dropdown-item" href="carnet.php">Solicitud carnet</a></li>
                        <li><a class="dropdown-item" href="incapacidad.php">Incapacidad laboral</a></li>
                        </ul>
                    </li>
                    <!-- Fin desplegable -->
                </ul>
                <span style="color: white;" id="user"><?php echo $n_completo;?></span>
                <a style="color: white;" href="conexiones/cerrar_conexion.php">Cerrar sesión</a>
                <!-- <a style="color: white;" class="iniciaSesion" href="iniciarSesion.html">Iniciar sesión</a> -->
          </div>
        </div> 
    </nav>

    <div class="contenedorDatos">
       <center><h2>Datos Cita: </h2> <br></center> 
        <span>Número de trámite: <?php echo $n_tramite; ?></span><br><br>
        <span>Nombre del solicitante: <?php echo $n_completo?></span><br><br>
        <span>Lugar: <?php echo $lugar; ?></span><br><br>
        <span>Departamento: <?php echo $departamento; ?></span><br><br>
        <span>Fecha: <?php echo $fecha; ?></span><br><br>
        <span>Hora: <?php echo $hora.':00'; ?></span><br><br>
    </div>
</body>
</html>
