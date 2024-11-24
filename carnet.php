<?php
  include'conexiones/sesion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleAfiliacion.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <title>Solicitar carnet</title>
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
                        <li><a class="dropdown-item" href="#">Afiliación</a></li>
                        <li><a class="dropdown-item" href="#">Cita médica</a></li>
                        <li><a class="dropdown-item" href="#">Solicitud carnet</a></li>
                        <li><a class="dropdown-item" href="#">Incapacidad laboral</a></li>
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

    <div class="container">
        <form  class="formulario" method="post">
            <font face="century gothic">
                <h1><b>Solicitud de carnet</b></h1>
            </font>
            <font face="century gothic">
                <span><b>Nombres: </b></span>
                <input type="text" name="nombres" id="nombre" value="<?php echo htmlspecialchars($nombre); ?>" readonly> <br>
                <span><b>Apellidos: </b></span>
                <input type="text" id="apelidos" name="apellidos" value="<?php echo htmlspecialchars($apellidos); ?>" readonly> <br>
                <span><b>Fecha: </b></span>
                <input type="date" name="fecha" id="fecha" required> <br>
                <span><b>Hora: </b></span>
                <select name="hora" id="hora">
                    <option value="horario1">09:00 am</option>
                    <option value="horario2">10:00 am</option>
                    <option value="horario3">11:00 am</option>
                    <option value="horario4">12:00 pm</option>
                    <option value="horario5">01:00 pm</option>
                    <option value="horario6">02:00 pm</option>
                    <option value="horario7">03:00 pm</option>
                    <option value="horario8">04:00 pm</option>
                    <option value="horario9">05:00 pm</option>
                    <option value="horario10">06:00 pm</option>
                    <option value="horario11">07:00 pm</option>
                    <option value="horario12">08:00 pm</option>
                </select>
                <span><b>Lugar: </b></span>
                <select name="lugar" id="lugar">
                    <option value="Centro1">Centro 1</option>
                    <option value="Centro2">Centro 2</option>
                    <option value="Centro3">Centro 3</option>
                    <option value="Centro4">Centro 4</option>
                </select><br><br>
            </font>
            <center>
                <font face="century gothic">
                    <button class="botonIniciar">Agendar</button>
                </font>
            </center>
        </form>
    </div>

    <div class="contenedorDatos">
        <h2>Documentación a traer: </h2> <br>
        <span>Número de asegurado</span><br><br>
        <span>Identificación oficial</span><br><br>
        <span>CURP</span><br><br>
        <span>Correo electrónico</span><br><br>
        <span>Comprobante de domicilio</span><br><br>
    </div>
    <br><br>
</body>
</html>