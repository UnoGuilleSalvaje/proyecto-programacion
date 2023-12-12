<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

// Establecer la zona horaria de México
date_default_timezone_set('America/Mexico_City');

// Obtener la dirección de correo electrónico del usuario desde la URL
$correo_electronico = "trestamal@gmail.com";   // Reemplaza con la variable real obtenida desde tu código pagar.php

$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tamaldeverdeee@gmail.com'; // Cambia por tu dirección de correo
    $mail->Password = 'tpdj dimc aahg tbni'; // Cambia por tu contraseña
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->isHTML(true);

    // Configuración del remitente y destinatario
    $mail->setFrom('tamaldeverdeee@gmail.com', 'GANDS MOVIES'); // Cambia por tu dirección de correo y nombre
    $mail->addAddress($correo_electronico); // Usamos la dirección proporcionada por el usuario

    // Asunto del correo
    $subject = 'Recibo de compra';
    $mail->Subject = $subject;

    // Contenido del correo (recibo de compra)
    $message = '<h1 style="color:red;">GANDS MOVIES</h1>';
    $message .= '<h2>¡Gracias por su compra!</h2>';
    $message .= '<h2>Recibo de compra</h2>';
    $message .= '<p>Fecha y hora de la compra: ' . date('Y-m-d H:i:s') . '</p>';
    $message .= '<hr>'; // Línea de división

    // Agregar dirección y método de pago (reemplaza con las variables reales de tu código)
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion']; 
    $message .= '<h3>Nombre y dirección de envío</h3>';
    $message .= '<p>' .$nombre.$direccion. '</p>';
    $message .= '<hr>'; // Línea de división

    // Agregar cobro de envío (reemplaza con las variables reales de tu código)
    $cobro_envio = 'Cobro de envío: [Insertar detalles aquí]';
    $message .= '<p>' . $cobro_envio . '</p>';
    $message .= '<hr>'; // Línea de división

    // Agregar productos comprados y sus precios (reemplaza con las variables reales de tu código)
    $productos_comprados = '<h3>Productos comprados</h3>';
    $productos_comprados .= '<p>Producto 1: $10.00</p>';
    $productos_comprados .= '<p>Producto 2: $20.00</p>';
    $message .= $productos_comprados;
    $message .= '<hr>'; // Línea de división

    // Agregar subtotal, impuesto y total a pagar (reemplaza con las variables reales de tu código)
    $subtotal_impuesto_total = '<p>Subtotal: $30.00</p>';
    $subtotal_impuesto_total .= '<p>Impuesto: $3.00</p>';
    $subtotal_impuesto_total .= '<p>Total a pagar: $33.00</p>';
    $message .= $subtotal_impuesto_total;
    $message .= '<img src="https://img.freepik.com/foto-gratis/gafas-3d-entradas-cine-palomitas-maiz_23-2148470169.jpg?w=1060&t=st=1702259575~exp=1702260175~hmac=65dfc5bf7c63ef35ab8d02dfbe051d4d529593c6ee63961a424a661fa5b0794f" Width="700px";>';

    $message .= '</body>';
    $mail->Body = $message;

    // Adjunta una imagen al correo (reemplaza con la ruta real de tu imagen)
    //$imagen_path = 'public_html/media/firma.png';
    //$mail->addAttachment($imagen_path, 'Firma.jpg');

    // Envía el correo
    $mail->send();

    echo '<h2 style="font-family: "Raleway", sans-serif;">Se ha enviado el correo con éxito</h1>';
    // Resto del código aquí...

} catch (Exception $e) {
    echo '<h2 class="company-title">Hubo un error al enviar el correo</h1>';
    echo '<h3 class="text-title-section-1-1">Por favor verifique que su correo haya sido ingresado correctamente </h2>';
    echo 'El correo no se pudo enviar. Error: ' . $mail->ErrorInfo;
}
?>
