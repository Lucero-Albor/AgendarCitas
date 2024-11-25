<?php
  include'conexiones/sesion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styleMenuTramite.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="manifest" href="./manifest.json">
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <title>Trámites</title>

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
            <a class="nav-link dropdown-toggle" style="color: white;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
          <!-- <a style="color: white;" class="iniciaSesion" href="iniciarSesion.php">Iniciar sesión</a> -->
      </div>
    </div> 
  </nav>
  <h1 class="titulo">Inicia tus trámites en línea</h1>
  <span class="texto">Agenda tus propias citas para realizar tus trámites de manera sencilla</span>
  <br><br>

  <a style="color: white;" href="DatosCita.php" class="btn btn-warning"><b>Ver trámites</b></a>
                        <!-- cards -->
       <center>
        <div class="row align-items-start">
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <center>
                        <img src="images/afiliar.jpg" class="card-img-top" alt="...">
                    </center>
                    
                    <div class="card-body">
                      <h5 class="card-title">Afiliación</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a style="color: white;" href="afiliacion.php" class="btn btn-warning"><b>Tramitar</b></a>
                    </div>
                  </div>
            </div>

            <div class="col">
                <div class="card" style="width: 18rem;">
                    <center>
                        <img src="images/cita.jpg" class="card-img-top" alt="...">
                    </center>
                    
                    <div class="card-body">
                      <h5 class="card-title">Cita médica</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a style="color: white;" href="citaMedica.php" class="btn btn-warning"><b>Tramitar</b></a>
                    </div>
                  </div>
            </div>

            <div class="col">
                <div class="card" style="width: 18rem;">
                    <center>
                        <img src="images/carnet.jpg" class="card-img-top" alt="...">
                    </center>
                    <div class="card-body">
                      <h5 class="card-title">Solicitud carnet</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a style="color: white;" href="carnet.php" class="btn btn-warning"><b>Tramitar</b></a>
                    </div>
                  </div>
            </div>

            <div class="col">
              <div class="card" style="width: 18rem;">
                <center>
                    <img src="images/Incapacidad.jpg" class="card-img-top">
                </center>
                  <div class="card-body">
                    <h5 class="card-title">Incapacidad laboral</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a style="color: white;" href="incapacidad.php" class="btn btn-warning"><b>Tramitar</b></a>
                  </div>
                </div>
          </div>
         
        </div>
        <a style="color: white;" href="index.html" class="btn btn-warning btnSalir"><b>Salir</b></a>
        
    </center>
   <!-- Fin cards -->
<br><br>
   <footer>
    <center>
        <div class="row align-items-start">
            <div class="col">
                <span>Sistema de citas gubernamental</span>
            </div>

            <div class="col">
                <span><b>Contacto:</b> </span>
                <span>122-333-444-55</span>
            </div>

            <div class="col">
              <span><b>Soporte:</b> </span>
              <span>soporte@correo.com</span>
            </div>
        </div>
    </center>
  </footer>
</body>
</html>