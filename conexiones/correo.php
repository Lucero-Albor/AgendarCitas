<?php
    include("./PHPMailer/src/PHPMailer.php");
    include("./PHPMailer/src/SMTP.php");
    include("./PHPMailer/src/Exception.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nombre = htmlspecialchars($_POST['nombres']);
        $apellido = htmlspecialchars($_POST['apellidos']);
        $correo = htmlspecialchars($_POST['correo']);
        $mail = new PHPMailer\PHPMailer\PHPMailer();

        try{
            $mail->isSMTP();
                $mail->Host = 'smtp.outlook.com';
                $mail->SMTPAuth=true;
                $mail->Username='meroko-449@hotmail.com';
                $mail->Password='virgencita';
                $mail->SMTPSecure='tls';
                $mail->Port='587';
                $mail->setFrom('meroko-449@hotmail.com', 'MiCita');
                //$mail->FromName='Admin';
                $mail->addAddress($correo,"$nombre $apellido");
                $mail->isHTML(true);
                $mail->Subject='Información';
                $mail->Body=file_get_contents("ficha.html");
                $mail->send();
        }

        catch(PHPMailer\PHPMailer\Exception $e){
            echo"No se pudo enviar el correo.";
        }
    }
?>