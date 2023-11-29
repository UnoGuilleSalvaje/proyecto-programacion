<?php
session_start();
     
$servidor='localhost';
$cuenta='root';
$password='';
$bd='baseCompras';
 
$_SESSION['id'] = '';
$_SESSION['nom'] = '';
$_SESSION['cue'] = '';
$_SESSION['con'] = '';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

$id = $_GET["id"];

$sql = "DELETE FROM productos WHERE id = $id";
$result = $conn->query($sql);

if ($result === TRUE) {
    echo json_encode(array("message" => "Producto eliminado con éxito"));
} else {
    echo json_encode(array("message" => "Error al eliminar el producto: " . $conn->error));
}

$conn->close();
?>
