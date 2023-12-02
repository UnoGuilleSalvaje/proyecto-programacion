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

$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

$productos = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
}

echo json_encode($productos);

$conn->close();
?>
