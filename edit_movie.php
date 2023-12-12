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
// Conexión a la base de datos (asegúrate de reemplazar con tus propios detalles de conexión)
$conexion = new mysqli('localhost', 'root', '', 'db_peliculas');

// Verifica si se envió el formulario de edición
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recupera los datos del formulario
    $id = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $cantidad_existencia = $_POST['cantidad_existencia'];
    $agotado = $_POST['agotado'];
    $precio = $_POST['precio'];
    $tiene_descuento = $_POST['tiene_descuento'];
    $descuento = $_POST['descuento'];
    $genero = $_POST['genero'];

    // Maneja la carga del archivo de la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        $rutaCarpetaDestino = "media/posters/";

        // Asegúrate de que el archivo es una imagen
        $check = getimagesize($_FILES['imagen']['tmp_name']);
        if ($check !== false) {
            // Limpiar el nombre de archivo
            $nombreImagen = basename($_FILES['imagen']['name']);
            $extension = strtolower(pathinfo($nombreImagen, PATHINFO_EXTENSION));
            $nombreArchivo = $nombre . '.' . $extension; // nombre de la película + extensión
            $rutaCompleta = $rutaCarpetaDestino . $nombreArchivo;

            // Intentar mover el archivo cargado al destino
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaCompleta)) {
                // El archivo se cargó y movió correctamente
                $imagen = $nombreArchivo; // Actualiza el nombre de la imagen para la base de datos
            } else {
                // Error al mover el archivo
                echo "Hubo un error al subir el archivo.";
            }
        } else {
            echo "El archivo no es una imagen.";
        }
    }
    
    // Prepara la consulta SQL para actualizar los datos
    $stmt = $conexion->prepare("UPDATE peliculas SET nombre = ?, descripcion = ?, cantidad_existencia = ?, agotado = ?, precio = ?, imagen = ?, tiene_descuento = ?, descuento = ?, genero = ? WHERE id = ?");
    $stmt->bind_param("ssiidsdiss", $nombre, $descripcion, $cantidad_existencia, $agotado, $precio, $imagen, $tiene_descuento, $descuento, $genero, $id);
       
    // Ejecuta la consulta
    if ($stmt->execute()) {
        ?>
            <div class="alert alert-custom" role="alert">
    <strong>Éxito!</strong> Datos actualizados correctamente <br><br>
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
    }
    $stmt->close();
}

$conexion->close();
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>