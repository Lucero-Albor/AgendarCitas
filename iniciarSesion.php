<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleInicioSesion.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="manifest" href="./manifest.json">
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <title>Inicio sesión</title>
</head>
<body >
    <div class="fondo">
   
        <nav style="background-color: #5A1746;" class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <img src="images/logo.png" width="40px">&nbsp;&nbsp;
                <a class="navbar-brand" style="color: white; font-size: 28px;" href="index.html">MiCita</a>
                <div  style="margin-left: 25%;" class="collapse navbar-collapse" id="navbarSupportedContent"></div>
            </div>
        </nav>
        <div class="container">
            <form  class="formulario" method="post">
                <center>
                    <img src="images/logo.png" alt="">
                </center>
                
                    <font face="century gothic">
                        <h1><b>Inicia sesión</b></h1>
                    </font>
                <font face="century gothic">
                    <span><b>Correo: </b></span>
                    <input type="text" name="correo" id="correo" placeholder="nombre@dominio.com" required> <br>
                    <span><b>Contraseña: </b></span>
                    <input type="password" id="pass" name="pass" placeholder="********" maxlength="50" required> <br>
                </font>
                <center>
                    <font face="century gothic">
                        <a href="registroSesion.php">Registrarse</a>
                        <button class="botonIniciar" name="sesion" type="submit">Iniciar</button>
                    </font>
                </center>
            </form>
        </div>
    </div>
</body>
</html>

<?php
    include'conexiones/conexion.php';
    session_start();

    if(isset($_POST['sesion'])){
        $correo = $_POST['correo'];
        $pass = $_POST['pass'];
        
        $sql = "SELECT pass FROM usuarios WHERE correo = '$correo'";
        $result = $conexion->query($sql);
        $row = $result->fetch_assoc();
        $contra = $row['pass'];

        if($contra === $pass){
            $nombre = "SELECT nombre FROM usuarios WHERE correo = '$correo'";
            $rnombre = $conexion->query($nombre);
            $name = $rnombre->fetch_assoc();
            $n = $name['nombre'];

            $_SESSION['correo'] = $correo;
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo 
            '<script>
                swal({
                    title: "Bienvenido",
                    text: "Hola, ' .$n.'",
                    icon: "success",
                    button: "Iniciar sesión",    
                })

                    .then((Okay) => {
                        if (Okay) {
                            window.location.href = "menuTramites.php";
                        } 
                    })
            </script>';
        }
        else{
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo 
            '<script>
                swal({
                    title: "Error de contraseña",
                    text: "Verifica que tu contraseña sea correcta",
                    icon: "error"
                })
            </script>';
        }
    }
?>