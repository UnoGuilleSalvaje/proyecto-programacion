<?php
session_start();

$datosRecibidos = json_decode(file_get_contents('php://input'), true);
if (isset($datosRecibidos['cart'])) {
    $_SESSION['cart'] = $datosRecibidos['cart'];
    echo json_encode($_SESSION['cart']);
} else {
    echo json_encode(['error' => 'No se recibió el carrito']);
}
?>
