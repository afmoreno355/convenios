<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once dirname(__FILE__) . "/../Librerias/src/Exception.php";
require_once dirname(__FILE__) . "/../Librerias/src/PHPMailer.php";
require_once dirname(__FILE__) . "/../Librerias/src/SMTP.php";

// Función para enviar un correo con una plantilla PHP como contenido y un archivo .zip adjunto
function enviarCorreoConPlantillaYAdjunto($destinatario, $plantilla, $archivoAdjunto) {
    // Crea una instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP de Gmail
        $mail->SMTPDebug = 2;  // Activa la depuración (cambia a 0 en producción)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;  // Puerto SMTP
        $mail->SMTPAuth = true;
        $mail->Username = '..........p@gmail.com'; // Tu dirección de correo
        $mail->Password = '............'; // Tu contraseña o contraseña de aplicación

        // Configuración del remitente y destinatario
        $mail->setFrom('dibier.marin.p@gmail.com', 'Dibier');
        $mail->addAddress($destinatario, 'Dibier');

        // Configuración del correo
        $mail->Subject = 'Correo con archivo adjunto';
        
        // Cargar el contenido de la plantilla
        ob_start();
        include $plantilla;
        $contenidoPlantilla = ob_get_clean();
        
        $mail->Body = $contenidoPlantilla;

        // Adjuntar un archivo .zip
        $mail->addAttachment($archivoAdjunto);

        // Envía el correo
        $mail->send();
        echo "Correo enviado con éxito.";
    } catch (Exception $e) {
        echo "Hubo un problema al enviar el correo: " . $mail->ErrorInfo;
    }
}

// Llama a la función con los parámetros deseados
$destinatario = '...............';
$plantilla = __DIR__ . '/../utilities/I.php';
$archivoAdjunto = __DIR__ . '/../archivos/convenios/57/CONCEPTO TÉCNICO_57_25-10-2023_03:32:27.pdf';
enviarCorreoConPlantillaYAdjunto($destinatario, $plantilla, $archivoAdjunto);
?>
