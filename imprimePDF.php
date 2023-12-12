<?php
require('fpdf/fpdf.php');

class PDF extends FPDF {
    function Header() {
        // Configurar imagen de fondo
        $this->Image('Media/fondoOscuro1.jpg', 0, 0, 210, 297);

        // Configurar imagen del logo de Gans Movies
        $logo = 'Media/GANDS MOVIES ORIGINAL.png'; // Reemplaza con la ruta de tu logotipo
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
        $this->Cell(0, 10, ' Gracias por tu compra en Gans Movies!', 0, 0, 'C');
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
$pdf->Cell(0, 10, 'Av. Universidad', 0, 1);
$pdf->Ln(5);

// Método de pago
$pdf->Cell(0, 10, 'Metodo de Pago:', 0, 1);
$pdf->Cell(0, 10, 'Tarjeta de Débito', 0, 1);
$pdf->Ln(5);

// Cobro de envío
$pdf->Cell(0, 10, 'Cobro de Envio:', 0, 1);
$pdf->Cell(0, 10, 'MXN $2.00', 0, 1);
$pdf->Ln(10);

// Línea de separación
$pdf->SetDrawColor(255); // Establecer el color de las líneas a blanco
$pdf->Cell(0, 0, '', 'T');
$pdf->Ln(5);

// Lista de productos (eliminé la tabla)
$pdf->Cell(0, 10, 'Productos Comprados:', 0, 1);
$pdf->Cell(0, 10, '- Ready Player One: MXN $5.00', 0, 1);
$pdf->Cell(0, 10, '- Mario Bros: MXN $5.00', 0, 1);
$pdf->Ln(5);

// Subtotal, impuesto y total a pagar
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(90, 10, 'Subtotal:', 0, 0, 'R');
$pdf->Cell(0, 10, 'MXN $10.00', 0, 1);

$pdf->Cell(90, 10, 'Impuesto:', 0, 0, 'R');
$pdf->Cell(0, 10, 'MXN $1.00', 0, 1);

$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(90, 10, 'Total a Pagar:', 0, 0, 'R');
$pdf->Cell(0, 10, 'MXN $11.00', 0, 1);

// Output the PDF en el navegador
$pdf->Output();
?>
