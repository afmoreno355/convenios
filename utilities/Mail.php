<?php

namespace Mail;

require_once dirname(__FILE__) . "/../Librerias/src/Exception.php";
require_once dirname(__FILE__) . "/../Librerias/src/PHPMailer.php";
require_once dirname(__FILE__) . "/../Librerias/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function enviar($correo) {
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = "dibier.marin.p@gmail.com"; //"direcciondeformacion@misena.edu.co";
        $mail->Password = "moyp gmqs cdoq houv"; //'Sen@2022*'; // Debes proporcionar tu contraseña aquí

        $mail->setFrom('dibier.marin.p@gmail.com', 'Dirección de Formación Profesional - SENA');
        $mail->addAddress($correo['email'], $correo['destinatario']);

        $mail->Subject = $correo['asunto'];
        $mail->Body = $correo['mensaje'];
        $mail->addAttachment($correo['adjunto']);

        // Envía el correo
        $mail->send();
        echo "Correo enviado con éxito.";

    } catch (\Exception $e) {
        die("No es posible enviar correo. " . $e->getMessage());
    }
}
