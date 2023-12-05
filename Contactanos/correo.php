<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host = 'smtp-mail.outlook.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'vanianayeli2011@hotmail.com';
        $mail->Password = 'Vamozunapa555';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('vanianayeli2011@hotmail.com', 'Vania');

        $mail->addAddress($email, $name); 

        $mail->isHTML(false);
        $mail->Subject = 'GRACIAS POR CONTACTARNOS, RECIBIMOS TU MENSAJE';
        $mail->Body = "Te aseguramos que estamos revisando tu mensaje con atencion y nos pondremos en contacto contigo a la brevedad posible. Si tu consulta requiere una respuesta inmediata, haremos nuestro mejor esfuerzo para proporcionarte la informacion que necesitas en el menor tiempo posible.
        Gracias nuevamente por elegirnos. Estamos ansiosos por atenderte y esperamos poder ayudarte en lo que necesites :)";

        $mail->send();
        echo 'SE ACABA DE MANDAR TU MENSAJE, EN BREVEDAD LO ATENDEREMOS';
    } catch (Exception $e) {
        echo "El mensaje no pudo ser enviado. Error: {$mail->ErrorInfo}";
    }
}
?>