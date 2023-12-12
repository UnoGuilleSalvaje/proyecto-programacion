<?php
session_start();

// Verificar si se envió un código de descuento
if (isset($_POST['codigo_descuento']) && $_POST['codigo_descuento'] === '123456') {
    // Obtener el total actual del carrito
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['quantity'] * $item['price'];
    }

    // Aplicar un descuento del 10%
    $descuento = 0.10;
    $descuentoTotal = $total * $descuento;
    $totalConDescuento = $total - $descuentoTotal;

    // Actualizar el total en la sesión
    $_SESSION['descuento_aplicado'] = true;
    $_SESSION['total_con_descuento'] = $totalConDescuento;
    
    // Redireccionar de vuelta a la página de pago
    header('Location: pagar.php');
    exit();
} else {
    // Redireccionar en caso de un código de descuento incorrecto
    header('Location: pagar.php?error=1');
    exit();
}
?>
