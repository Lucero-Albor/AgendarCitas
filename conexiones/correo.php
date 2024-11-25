<?php
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombres = htmlspecialchars($_POST['nombres']);
    $apellidos = htmlspecialchars($_POST['apellidos']);
    $correo = htmlspecialchars($_POST['correo']);

    $mail = new PHPMailer();

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'lucerito856@gmail.com'; 
        $mail->Password = 'fcfjmkequecyxigu'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('lucerito856@gmail.com', 'MiCita');
        $mail->addAddress($correo, "$nombres $apellidos");
        $mail->isHTML(true);
        $mail->Subject = 'Registro';

        // Verificar archivo ficha.html
        if (!file_exists("../ficha.html")) {
            throw new Exception("El archivo ficha.html no se encontró.");
        }
        $mail->Body = file_get_contents("../ficha.html");

        if ($mail->send()) {
            // echo "Correo enviado correctamente.";
            header("Location: ../index.html"); 
            exit; 
        } else {
            echo "Error al enviar el correo: " . $mail->ErrorInfo;
        }
    } catch (Exception $e) {
        echo "No se pudo enviar el correo. Error: {$e->getMessage()}";
    }
} else {
    echo "No se enviaron los datos necesarios.";
}




    // include("./PHPMailer/src/PHPMailer.php");
    // include("./PHPMailer/src/SMTP.php");
    // include("./PHPMailer/src/Exception.php");

    // if($_SERVER["REQUEST_METHOD"] == "POST"){
    //     $nombres = htmlspecialchars($_POST['nombres']);
    //     $apellidos = htmlspecialchars($_POST['apellidos']);
    //     $correo = htmlspecialchars($_POST['correo']);
    //     $mail = new PHPMailer\PHPMailer\PHPMailer();

    //     try{
    //         $mail->isSMTP();
    //             $mail->Host = 'smtp.outlook.com';
    //             $mail->SMTPAuth=true;
    //             $mail->Username='meroko-449@hotmail.com';
    //             $mail->Password='virgencita';
    //             $mail->SMTPSecure='tls';
    //             $mail->Port='587';
                
    //             $mail->setFrom($correo, $nombres);
    //             $mail->AddAddress($correo, "$nombres $apellidos");
    //             $mail->isHTML(true);
    //             $mail->Subject='Información';
    //             $mail->Body=file_get_contents("ficha.html");
    //             $mail->send();
    //     }

    //     catch(PHPMailer\PHPMailer\Exception $e){
    //         echo"No se pudo enviar el correo.";
    //     }
    // }
    // else{
    //     echo "No se enviaron los datos necesarios";
    // }
?>