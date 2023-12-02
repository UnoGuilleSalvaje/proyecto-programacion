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
  
   $conexion = new mysqli($servidor,$cuenta,$password,$bd);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

$nombre = $_POST["nombre"];
$precio = $_POST["precio"];

$sql = "INSERT INTO productos (nombre, precio) VALUES ('$nombre', $precio)";
$result = $conn->query($sql);

if ($result === TRUE) {
    echo json_encode(array("message" => "Producto agregado con éxito"));
} else {
    echo json_encode(array("message" => "Error al agregar el producto: " . $conn->error));
}

$conn->close();
?>
