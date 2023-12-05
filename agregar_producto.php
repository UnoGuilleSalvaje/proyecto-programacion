<?php
session_start();

$servidor = 'localhost';
$cuenta = 'root';
$password = '';
$bd = 'baseCompras';

$_SESSION['id'] = '';
$_SESSION['nom'] = '';
$_SESSION['cue'] = '';
$_SESSION['con'] = '';

$conexion = new mysqli($servidor, $cuenta, $password, $bd);

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

$nombre = $_POST["nombre"];
$precio = $_POST["precio"];

// Sentencia preparada para evitar inyecciones SQL
$stmt = $conexion->prepare("INSERT INTO productos (nombre, precio) VALUES (?, ?)");
$stmt->bind_param("sd", $nombre, $precio); // "s" para string, "d" para decimal

if ($stmt->execute()) {
    echo json_encode(array("message" => "Producto agregado con éxito"));
} else {
    echo json_encode(array("message" => "Error al agregar el producto: " . $stmt->error));
}

$stmt->close();
$conexion->close();
?>
