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

//Verifica si el método de la solicitud es POST y si hay un archivo de imagen presente en la solicitud.
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['imagen'])) {
    $servidor = 'localhost';
    $cuenta = 'root';
    $password = '';
    $bd = 'db_peliculas';
    //Se establece una conexión con la base de datos MySQL 
    $conexion = new mysqli($servidor, $cuenta, $password, $bd);

    if ($conexion->connect_errno) {
        die('Error en la conexión');
    }

    //Se toma el nombre de la película enviado a través del formulario y se le agrega la extensión .jpg para
    //formar el nombre del archivo de la imagen.
    $nombrePelicula = $_POST['nombre'];
    $nombreImagen = $nombrePelicula . '.jpg';

    //La imagen se mueve desde la ubicación temporal a la carpeta "media/posters" en el servidor.
    
    $target_dir = "media/posters/";
    $target_file = $target_dir . $nombreImagen;


    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
        $stmt = $conexion->prepare("INSERT INTO peliculas (nombre, descripcion, cantidad_existencia, agotado, precio, imagen, tiene_descuento, descuento, genero) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiddssds", $_POST['nombre'], $_POST['descripcion'], $_POST['cantidad_existencia'], $_POST['agotado'], $_POST['precio'], $nombreImagen, $_POST['tiene_descuento'], $_POST['descuento'], $_POST['genero']);
        
        if ($stmt->execute()) {
            ?>
            <div class="alert alert-custom" role="alert">
    <strong>Éxito!</strong> Producto agregado correctamente <br><br>
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
<strong>Oh no!</strong> Error al agregar el producto. <br><br>
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
} else {
?>
<div class="alert alert-custom" role="alert">
<strong>Oh no!</strong> Error al subir la imagen. <br><br>
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
$conexion->close();


}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>