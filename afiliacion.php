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
    <link rel="manifest" href="./manifest.json">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <title>Afiliación</title>
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
                <span style="color: white;" id="user"><?php echo $n_completo;?></span>&nbsp;&nbsp;
                <a style="color: white;" href="conexiones/cerrar_conexion.php">Cerrar sesión</a>
                <!-- <a style="color: white;" class="iniciaSesion" href="iniciarSesion.html">Iniciar sesión</a> -->
          </div>
        </div> 
    </nav>

    <div class="container">
        <form  class="formulario" method="post">
            <font face="century gothic">
                <h1><b>Afiliación</b></h1>
            </font>
            <font face="century gothic">
                <span><b>Nombres: </b></span>
                <input type="text" name="nombres" id="nombre" value="<?php echo htmlspecialchars($nombre); ?>" readonly> <br>
                <span><b>Apellidos: </b></span>
                <input type="text" id="apellidos" name="apellidos" value="<?php echo htmlspecialchars($apellidos); ?>" readonly> <br>
                <span><b>Lugar: </b></span>
                <input type="text" name="lugar" id="lugar" value="Ventanilla de nuevo derechoambiente" readonly><br>
                <span><b>Fecha: </b></span>
                <input type="date" name="fecha" id="fecha" required> <br>
                <span><b>Hora: </b></span>
                <select name="hora" id="hora">
                    <option value="9">09:00 am</option>
                    <option value="10">10:00 am</option>
                    <option value="11">11:00 am</option>
                    <option value="12">12:00 pm</option>
                    <option value="13">01:00 pm</option>
                    <option value="14">02:00 pm</option>
                    <option value="15">03:00 pm</option>
                    <option value="16">04:00 pm</option>
                    <option value="17">05:00 pm</option>
                    <option value="18">06:00 pm</option>
                    <option value="19">07:00 pm</option>
                    <option value="20">08:00 pm</option>
                </select>
                <span name="tramite" value="1"></span>
            </font>
            <center>
                <font face="century gothic">
                    <button class="botonIniciar" type="submit" name="agendar">Agendar</button>
                </font>
            </center>
        </form>
    </div>

    <div class="contenedorDatos">
        <h2>Documentación a traer: </h2> <br>
        <span>Identificación oficial</span><br><br>
        <span>CURP</span><br><br>
        <span>Correo electrónico</span><br><br>
        <span>Comprobante de domicilio</span><br><br>
    </div>
    <br>
    <form action="" method="post">
        <span name="tramite" value="1"></span>
        <a style="color: white; margin-left:70%;" href="DatosCita.php" class="btn btn-warning" type="submit" name="btntramite"><b>Ver trámites</b></a>
    </form>
    <br>
</body>
</html>

<?php

include 'conexiones/conexion.php';

if (isset($_POST['agendar'])) {
    // Asegurarse de que el usuario esté autenticado
    if (!isset($_SESSION['correo'])) {
        echo '<script>alert("El usuario no está autenticado.");</script>';
        exit;
    }

    $correo = $_SESSION['correo'];
    $lugar = $_POST['lugar'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];

    // Obtener ID del usuario
    $consulta_u = "SELECT id_usuario FROM usuarios WHERE correo = '$correo'";
    $sql_cu = mysqli_query($conexion, $consulta_u);
    $usuario = mysqli_fetch_assoc($sql_cu);

    // Obtener número de lugar
    $consulta_l = "SELECT n_lugar FROM lugar WHERE departamento = '$lugar'";
    $sql_lu = mysqli_query($conexion, $consulta_l);
    $datos_lugar = mysqli_fetch_assoc($sql_lu);

    // Obtener número de trámite
    $consulta_t = "SELECT num_tramite FROM tramites WHERE nombre = 'Afiliación'";
    $sql_t = mysqli_query($conexion, $consulta_t);
    $tramite = mysqli_fetch_assoc($sql_t);

    // Verificar que se obtuvo toda la información necesaria
    if ($usuario && $datos_lugar && $tramite) {
        $id_usuario = $usuario['id_usuario'];
        $n_lugar = $datos_lugar['n_lugar'];
        $num_tramite = $tramite['num_tramite'];

        // Verificar si ya existe una cita en ese horario
        $verificar = "SELECT fecha, hora FROM usuario_tramite 
                      WHERE num_tramite = '$num_tramite' AND fecha = '$fecha' AND hora = '$hora'";
        $existente = mysqli_query($conexion, $verificar);

        if (mysqli_num_rows($existente) > 0) {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo 
            '<script>
                swal({
                    title: "Cita no disponible",
                    text: "La hora seleccionada para la fecha indicada no está disponible, seleccione otra.",
                    icon: "error",
                    button: "Aceptar",
                });
            </script>';
        } else {
            // Insertar nueva cita
            $agendar = "INSERT INTO usuario_tramite (id_usuarios, n_lugar, num_tramite, fecha, hora)
                        VALUES ('$id_usuario', '$n_lugar', '$num_tramite', '$fecha', '$hora')";

            $result = mysqli_query($conexion, $agendar);

            if ($result) {
                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo 
                '<script>
                    swal({
                        title: "Cita agendada",
                        text: "El registro de su cita se ha agendado correctamente.",
                        icon: "success",
                        button: "Aceptar",
                    });
                </script>';
            } else {
                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo 
                '<script>
                    swal({
                        title: "Fallo de agenda",
                        text: "Su cita no se ha agendado debido a problemas con el sistema. Intente más tarde.",
                        icon: "error",
                        button: "Aceptar",
                    });
                </script>';
                echo "Error de MySQL: " . mysqli_error($conexion);
            }
        }
    } else {
        echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
        echo 
        '<script>
            swal({
                title: "Error de datos",
                text: "No se pudo obtener la información del usuario, lugar o trámite.",
                icon: "error",
                button: "Aceptar",
            });
        </script>';
    }
}

    // if(isset($_POST['agendar'])){
    //     $lugar = $_POST['lugar'];
    //     $fecha = $_POST['fecha'];
    //     $hora = $_POST['hora'];
        
    //     $consulta_u = "SELECT id_usuario FROM usuarios WHERE correo = '$correo'";
    //     $sql_cu = mysqli_query($conexion, $consulta_u);
    //     $usuario = mysqli_fetch_assoc($sql_cu);
    //     $id_usuario = $usuario['id_usuario'];

    //     $consulta_l = "SELECT n_lugar from lugar WHERE departamento = '$lugar'";
    //     $sql_lu = mysqli_query($conexion, $consulta_l);
    //     $lugar = mysqli_fetch_assoc($sql_lu);
    //     $n_lugar = $lugar['n_lugar'];

    //     $consulta_t = "SELECT num_tramite FROM  tramites WHERE nombre = 'Afiliación'";
    //     $sql_t = mysqli_query($conexion, $consulta_t);
    //     $tramite = mysqli_fetch_assoc($sql_t);
    //     $num_tramite = $tramite['num_tramite'];    

    //     $verificar = "SELECT fecha, hora FROM usuario_tramite 
    //                 WHERE num_tramite ='$num_tramite' AND fecha = '$fecha' AND hora = '$hora'";    
    //     $existente = mysqli_query($conexion, $verificar);

    //     if (mysqli_num_rows($existente) > 0) {
    //         echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
    //         echo 
    //         '<script>
    //             swal({
    //                 title: "Cita no disponible",
    //                 text: "La hora seleccionada para la fecha indicada no está disponible, seleccione otra.",
    //                 icon: "error",
    //                 button: "Aceptar",
    //             });
    //         </script>';
    //     }

    //     else{
    //         $agendar = "INSERT INTO usuario_tramite (id_usuarios, n_lugar, num_tramite, fecha, hora)
    //                 VALUES ('$id_usuario', '$n_lugar', '$num_tramite', '$fecha', '$hora')";
            
    //         $result = mysqli_query($conexion, $agendar);
    //         if ($result) {
    //             echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
    //             echo 
    //             '<script>
    //                 swal({
    //                     title: "Cita agendada",
    //                     text: "El registro de su cita se ha agendado correctamente.",
    //                     icon: "success",   
    //                 })
    //             </script>';
    //         } 
            
    //         else {
    //             echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
    //             echo 
    //             '<script>
    //                 swal({
    //                     title: "Fallo de agenda",
    //                     text: "Su cita no se ha agendado debido a problemas con el sistema. Intente más tarde.",
    //                     icon: "error",   
    //                 })
    //             </script>';
    //         }
    //     }
    // }
?>