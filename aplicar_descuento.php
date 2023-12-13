<?php
session_start();

// Este script debe recibir un código de descuento y responder con el total actualizado
if (isset($_POST['discount'])) {
    $discountCode = $_POST['discount'];
    $descuentoAplicado = false;
    $totalConDescuento = 0;

    // Verifica si el código de descuento es "GANDSESLAONDA" para un descuento general
    if ($discountCode === "GANDSESLAONDA") {
        $descuentoAplicado = true;
        $descuento = 0.1; // Por ejemplo, un 10% de descuento general
        $totalConDescuento = calcularTotalConDescuento($_SESSION['cart'], $descuento);
        $_SESSION['total_con_descuento'] = $totalConDescuento;
    } 
    // Verifica si el código de descuento es "IAMBATMAN" y aplica descuento específico
    else if ($discountCode === "IAMBATMAN") {
        foreach ($_SESSION['cart'] as $index => $item) {
            if ($item['title'] === 'The Dark Knight') {
                $_SESSION['cart'][$index]['price'] *= 0.5;
                $descuentoAplicado = true;
            }
        }
        $totalConDescuento = calcularTotalSinDescuento($_SESSION['cart']);
        $_SESSION['total_con_descuento'] = $totalConDescuento;
    }

    // La respuesta debe contener si el descuento fue aplicado y el total con descuento
    echo json_encode(array(
        'success' => $descuentoAplicado,
        'totalConDescuento' => $totalConDescuento
    ));
    exit;
}

// Calcula el total con un descuento general aplicado
function calcularTotalConDescuento($cart, $descuento) {
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['quantity'] * $item['price'];
    }
    return $total - ($total * $descuento);
}

// Calcula el total sin descuento
function calcularTotalSinDescuento($cart) {
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['quantity'] * $item['price'];
    }
    return $total;
}

?>
