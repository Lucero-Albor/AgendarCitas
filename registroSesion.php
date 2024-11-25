<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleRegistroSesion.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Registro</title>
</head>
<body>
    <nav style="background-color: #5A1746;" class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <img src="images/logo.png" width="40px">&nbsp;&nbsp;
            <a class="navbar-brand" style="color: white; font-size: 28px;" href="index.html">MiCita</a>
            <div  style="margin-left: 25%;" class="collapse navbar-collapse" id="navbarSupportedContent">
            </div>
        </div>
    </nav>
      
    <div class="container">
    <center>
        <form  class="formulario" method="post"  action="./conexiones/correo.php">
            <img src="images/logo.png" alt="" width="100px">
        <br>
            <font face="century gothic">
                <h1><b>Regístrate</b></h1>
            </font>
            <span><b>Nombres: </b></span>
            <input type="text" id="nombres" name="nombres" placeholder="Nombres" maxlength="50" required> <br>
            <span><b>Apellidos: </b></span>
            <input type="text" id="apellidos" name="apellidos" placeholder="Apellido" maxlength="50" required> <br>
            <span><b>Correo: </b></span>
            <input  type="email" name="correo" id="correo" placeholder="alguien@dominio.com" required> <br>
            <span><b>Contraseña: </b></span>
            <input type="password" id="pass" name="pass" placeholder="********" maxlength="50" required> <br>
            <a style="color: #D25B01;" href="iniciarSesion.php">Inicia sesión</a>
            <br>
            <font face="century gothic">
                <button class="botonIniciar" name="registro" type="submit">Registrar</button>
            </font>    
        </form>
    </center>
    </div>
</body>
</html>

<?php
    include'conexiones/conexion.php';

    if(isset($_POST['registro'])){
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $correo = $_POST['correo'];
        $pass = $_POST['pass'];
        $rol = 'Usuario';

        $buscar = "SELECT correo FROM usuarios WHERE correo = '$correo'";
        $buscar_correo = mysqli_query($conexion, $buscar);

        if (mysqli_num_rows($buscar_correo) > 0) {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo 
            '<script>
                swal({
                    title: "Correo ya registrado",
                    text: "Ingresa otra dirección de correo electrónico.",
                    icon: "error",
                    button: "Aceptar",
                });
            </script>';
        }

        else{
            $registrar = "INSERT INTO usuarios (nombre, apellidos, correo, pass, rol) 
                        VALUES ('$nombres', '$apellidos', '$correo', '$pass', '$rol')";
            $result = mysqli_query($conexion, $registrar);
            
            
            if ($result) {
                include'conexiones/correo.php';
                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo 
                '<script>
                    swal({
                        title: "Registro exitoso",
                        text: "Usuario registrado con éxito",
                        icon: "success",
                        button: "Iniciar sesión",    
                    })

                    .then((Okay) => {
                        if (Okay) {
                            window.location.href = "menuTramites.php";
                        } 
                    });
                </script>';
            } 
            
            else {
                echo 
                '<script>
                    swal({
                        title: "Error",
                        text: "Fallo de registro: ' . mysqli_error($conexion) . '",
                        icon: "error",
                    });
                </script>';
            }
        }

        
    }
?>