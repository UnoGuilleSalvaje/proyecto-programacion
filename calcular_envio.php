<?php
session_start();

function calcularTotalSinDescuento($cart) {
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['quantity'] * $item['price'];
    }
    return $total;
}

function calcularCostoEnvio($total, $porcentajeEnvio) {
    return $total * $porcentajeEnvio;
}

function calcularImpuesto($total, $pais) {
    switch ($pais) {
        case "Espana":
            return $total * 0.08; // 8% de impuesto
        case "Mexico":
            return $total * 0.05; // 5% de impuesto
        default:
            return 0;
    }
}

if (isset($_POST['pais'])) {
    $pais = $_POST['pais'];
    $costoEnvio = 0;
    $total = calcularTotalSinDescuento($_SESSION['cart']);

    if ($pais === "Espana") {
        $costoEnvio = calcularCostoEnvio($total, 0.1);
    }

    $impuesto = calcularImpuesto($total, $pais);
    $totalConEnvioEImpuestos = $total + $costoEnvio + $impuesto;

    echo json_encode(array(
        'costoEnvio' => $costoEnvio,
        'impuesto' => $impuesto,
        'totalConEnvioEImpuestos' => $totalConEnvioEImpuestos
    ));
    exit;
}
?>
