<?php
  include'conexiones/sesion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleIncapacidad.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <title>Incapacidad laboral</title>
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
                <h1><b>Incapacidad laboral</b></h1>
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
                <span><b>Lugar: </b></span>
                <select name="lugar" id="lugar">
                    <option value="Edificio A">Centro 1</option>
                    <option value="Edificio B">Centro 2</option>
                    <option value="Edificio C">Centro 3</option>
                   
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
        <span>Reporte médico</span><br><br>
    </div>
    <br><br>
</body>
</html>

<?php
 include'conexiones/conexion.php';

 if(isset($_POST['agendar'])){
     $lugar = $_POST["lugar"];
     $fecha = $_POST["fecha"];
     $hora = $_POST["hora"];


     $consulta1= "SELECT id_usuario FROM usuarios WHERE correo = '$correo' ";
     $sql1 = mysqli_query($conexion, $consulta1);
     $usuario = mysqli_fetch_assoc($sql1);
     $id_usuario = $usuario['id_usuario'];

     
     $consulta2= "SELECT n_lugar FROM lugar WHERE nombre = '$lugar' ";
     $sql2 = mysqli_query($conexion, $consulta2);
     $lugar = mysqli_fetch_assoc($sql2);
     $n_lugar = $lugar['n_lugar'];

    
     
     $consulta3= "SELECT num_tramite FROM tramites WHERE nombre = 'Incapacidad Laboral' ";
     $sql3 = mysqli_query($conexion, $consulta3);
     $tramite = mysqli_fetch_assoc($sql3);
     $num_tramite= $tramite['num_tramite'];

     $agendar = "INSERT INTO usuario_tramite (id_usuarios, n_lugar, num_tramite, fecha, hora)
     VALUES ('$id_usuario', '$n_lugar', '$num_tramite', '$fecha', '$hora')";

    $result = mysqli_query($conexion, $agendar);

    if($result){
        echo " <script lenguage='JavaScript'>
                alert('Los datos fueron guardados correctamente');
                location.assign('menuTramites.php);
                </script> ";
    }else{
        echo " <script lenguage='JavaScript'>
        alert('ERROR:Los datos no fueron guardados correctamente');
        location.assign('citaMedica.php');
        </script> ";
    }

 }


?>
