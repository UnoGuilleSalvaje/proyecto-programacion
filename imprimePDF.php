<?php
session_start();

// imprimePDF.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $modoPago = $_POST['modoPago'] ?? 'No especificado';
    $direccionEnvio = $_POST['direccionEnvio'] ?? 'No especificada';
    $costoEnvio = $_POST['costoEnvio'] ?? '0';
    $impuesto = $_POST['impuesto'] ?? '0';
    $totalf = $_POST['totalf'] ?? '0';
    $subtotal = $_POST['subtotal'] ?? '0';

    // Aquí puedes agregar el código para generar el PDF utilizando estos valores
}
$cartItems = $_SESSION['cart'];

require('fpdf/fpdf.php');

class PDF extends FPDF {
    function Header() {
        // Configurar imagen de fondo
        $this->Image('media/fondoOscuro1.jpg', 0, 0, 210, 297);

        // Configurar imagen del logo de Gans Movies
        $logo = 'media/GANDS MOVIES ORIGINAL.png'; // Reemplaza con la ruta de tu logotipo
        $this->Image($logo, 75, 20, 60); // Aumenté el tamaño de la imagen y la centré horizontalmente
        $this->Ln(30); // Aumenté la distancia entre la imagen y el título del recibo

        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(255); // Establecer el color del texto a blanco
        $this->Cell(0, 10, 'Recibo de Compra - Gans Movies', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(255); // Establecer el color del texto a blanco
        $this->Cell(0, 10, ' Gracias por tu compra en Gands Movies!', 0, 0, 'C');
    }
}

date_default_timezone_set('America/Mexico_City');

$pdf = new PDF();
$pdf->AddPage();

$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(255); // Establecer el color del texto a blanco

// Información de fecha y hora
$pdf->Cell(0, 10, 'Fecha y Hora: ' . date('d/m/Y H:i'), 0, 1);
$pdf->Ln(5);

// Número de transacción
//$pdf->Cell(0, 10, 'Numero de Transaccion: ' . mt_rand(100000000, 999999999), 0, 1);
//$pdf->Ln(10);

// Dirección de envío
$pdf->Cell(0, 10, 'Direccion de Envio:', 0, 1);
$pdf->Cell(0, 10, $direccionEnvio, 0, 1);
$pdf->Ln(5);

// Método de pago
$pdf->Cell(0, 10, 'Metodo de Pago:', 0, 1);
$pdf->Cell(0, 10, $modoPago, 0, 1);
$pdf->Ln(5);

// Cobro de envío
$pdf->Cell(0, 10, 'Cobro de Envio:', 0, 1);
$pdf->Cell(0, 10, $costoEnvio, 0, 1);
$pdf->Ln(10);

// Línea de separación
$pdf->SetDrawColor(255); // Establecer el color de las líneas a blanco
$pdf->Cell(0, 0, '', 'T');
$pdf->Ln(5);

// Lista de productos (eliminé la tabla) ------------------------------------->
$pdf->Cell(0, 10, 'Productos Comprados:', 0, 1);

foreach ($cartItems as $item) {
    $producto = htmlspecialchars($item['title']) . " x" . htmlspecialchars($item['quantity']);
    $precio = "MXN $" . number_format($item['quantity'] * $item['price'], 2);
    
    $pdf->Cell(0, 10, '- ' . $producto . ': ' . $precio, 0, 1);
}

$pdf->Ln(5);


// Subtotal, impuesto y total a pagar
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(90, 10, 'Subtotal:', 0, 0, 'R');
$pdf->Cell(0, 10,'$' . $subtotal, 0, 1);

$pdf->Cell(90, 10, 'Impuesto:', 0, 0, 'R');
$pdf->Cell(0, 10,'$' . $impuesto, 0, 1);

$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(90, 10, 'Total a Pagar:', 0, 0, 'R');
$pdf->Cell(0, 10,'$' . $totalf, 0, 1);

// Output the PDF en el navegador
$pdf->Output();
?>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

// Establecer la zona horaria de México
date_default_timezone_set('America/Mexico_City');

// Asegúrate de que hay un usuario logueado
if (isset($_SESSION['username'])) {
    $usuarioLogeado = $_SESSION['username'];

    $usuarioLogeado = $_SESSION['username'];

    $servidor = 'localhost';
    $cuenta = 'root';
    $password = '';
    // Asegúrate de que el nombre de la base de datos es el correcto y no lleva la extensión .sql
    $bd = 'baseinventario.sql';

    $conexion = new mysqli($servidor, $cuenta, $password, $bd);

    // Preparar la consulta SQL
    $query = "SELECT email FROM usuarios WHERE username = ?";

    // Preparar la declaración (statement)
    if ($stmt = $conexion->prepare($query)) {
        // Vincular parámetros
        $stmt->bind_param("s", $usuarioLogeado);

        // Ejecutar la declaración
        $stmt->execute();

        // Vincular resultado variables
        $stmt->bind_result($correo_electronico);

        // Obtener valores
        if ($stmt->fetch()) {
            // Aquí ya tienes el correo electrónico en la variable $correo_electronico
        }
        
        // Cerrar declaración
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conexion->error;
    }

    // La variable $correo_electronico ahora contiene el correo del usuario logueado
    // Puedes utilizar esta variable como necesites a continuación
} else {
    echo "Usuario no logueado.";
}

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
    $nombre = 'Estimado usuario';
    $direccion = $_POST['direccion']; 
    $message .= '<h3>Dirección de envío</h3>';
    $message .= '<p>' . $direccionEnvio . '</p>';
    $message .= '<hr>'; // Línea de división

    // Agregar cobro de envío (reemplaza con las variables reales de tu código)
    $cobro_envio = 'Cobro de envío: [Insertar detalles aquí]';
    $message .= '<p> Cobro de envío: $' . $costoEnvio . '</p>';
    $message .= '<hr>'; // Línea de división

    // Suponiendo que $cartItems contiene los artículos del carrito de compras
$productos_comprados = '<h3>Productos comprados</h3>';

foreach ($cartItems as $item) {
    $titulo = htmlspecialchars($item['title']);
    $cantidad = htmlspecialchars($item['quantity']);
    $precioTotal = number_format($item['quantity'] * $item['price'], 2);
    $productos_comprados .= "<p>{$titulo} x{$cantidad}: MXN \${$precioTotal}</p>";
}

$message .= $productos_comprados;
$message .= '<hr>'; // Línea de división


    // Agregar subtotal, impuesto y total a pagar (reemplaza con las variables reales de tu código)
    $subtotal_impuesto_total = '<p>Subtotal: $' . $subtotal . '</p>';
    $subtotal_impuesto_total .= '<p>Impuesto: $' . $impuesto . '</p>';
    $subtotal_impuesto_total .= '<p>Total a pagar: $' . $totalf . '</p>';
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
