<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>

    body{
        background-image: url(imagesGACH/fondo3.jpg);
        background-size: cover; /* Asegura que la imagen de fondo cubra todo el espacio disponible */
    }
        .alert-custom {
    background-color: #1e1e1e;
    color: #ffffff;
    border-color: #ec1d24;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    min-width: 300px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    z-index: 1050; /* Ensure it's above other items */
    border-radius: 5px;
    display: none; /* Initially hidden */
    animation: fadeIn 0.5s;
}

@keyframes fadeIn {
    0% { opacity: 0; }
    100% { opacity: 1; }
}

.alert-custom .btn-custom {
    background-color: #e62429;
    color: #ffffff;
    border: none;
}

.alert-custom .btn-custom i {
    margin-right: 5px;
}

/* Responsive centering */
@media (max-width: 576px) {
    .alert-custom {
        width: 90%;
    }
}

.i{
    display: block;
    margin: auto; /* Centra el botón horizontalmente */
}

    </style>
</head>

<?php
session_start();

// Asegúrate de que se ha iniciado la sesión y de que existe el carrito en la sesión
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    // Redirige al usuario al carrito o muestra un mensaje de error
    header('Location: tienda.php'); // Asumiendo que 'carrito.php' es la página de tu carrito
    exit();
}

$servidor = 'localhost';
$cuenta = 'root';
$password = '';
$bd = 'db_peliculas';

$conexion = new mysqli($servidor, $cuenta, $password, $bd);

if ($conexion->connect_error) {
    die("Error en la conexion: " . $conexion->connect_error);
}

$datosRecibidos = json_decode(file_get_contents('php://input'), true);
if (isset($datosRecibidos['cart'])) {

    // Obtener información del carrito
    $cartItems = $datosRecibidos['cart'];

    // Puedes realizar operaciones adicionales con la información del carrito aquí

    echo json_encode($response);
}
function disminuirCantidadProducto($conexion, $nombreProducto, $cantidadADisminuir) {
    // Primero, obtén la cantidad actual del producto en la base de datos
    $stmt = $conexion->prepare("SELECT cantidad_existencia FROM peliculas WHERE nombre = ?");
    $stmt->bind_param("s", $nombreProducto);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($fila = $resultado->fetch_assoc()) {
        $cantidadActual = $fila['cantidad_existencia'];
        
        // Calcula la nueva cantidad
        $nuevaCantidad = $cantidadActual - $cantidadADisminuir;
        
        // Asegúrate de que la nueva cantidad no sea negativa
        if ($nuevaCantidad < 0) {
            echo "No hay suficientes artículos en stock.";
            return false;
        }
        
        // Actualiza la cantidad en la base de datos
        $stmtUpdate = $conexion->prepare("UPDATE peliculas SET cantidad_existencia = ? WHERE nombre = ?");
        $stmtUpdate->bind_param("is", $nuevaCantidad, $nombreProducto);
        if ($stmtUpdate->execute()) {
            ?>
            <div class="alert alert-custom" role="alert">
    <strong>Éxito!</strong> Compra realizada con éxito <br><br>
    <button type="button" class="btn btn-custom i" onclick="window.location.href='index.php';">
        <i class="fas fa-home"></i>Inicio
    </button>
    </div>

    <script>
        window.onload = function() {
    document.querySelector('.alert-custom').style.display = 'block'; // To show the alert
};

</script>

<?php
            return true;
        } else {
            ?>
            <div class="alert alert-custom" role="alert">
    <strong>Oh no!</strong> Error al actualizar los datos <br><br>
    <button type="button" class="btn btn-custom i" onclick="window.location.href='index.php';">
        <i class="fas fa-home"></i>Inicio
    </button>
    </div>

    <script>
        window.onload = function() {
    document.querySelector('.alert-custom').style.display = 'block'; // To show the alert
};

</script>

<?php
            return false;
        }
    } else {
        echo "Producto no encontrado.";
        return false;
    }
}

// Luego, para cada artículo en el carrito, llama a esta función
foreach ($_SESSION['cart'] as $item) {
    disminuirCantidadProducto($conexion, $item['title'], $item['quantity']);
}

?>
