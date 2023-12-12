<?php
// Iniciar la sesión al principio de tu script
session_start();

if (isset($_SESSION['username'])) {
    // El usuario está logueado.
    // Puedes realizar acciones adicionales aquí, como mostrar el nombre de usuario.
    echo "Bienvenido, " . $_SESSION['username'];

}

?>

<head>
    <meta charSet="utf-8" />
    <title>GandsMovies.com | Sitio oficial GandsMovies</title>
    <meta name="title" content="GandsMovies.com | sitio oficual GandsMovies peliculas" />
    <meta property="og:type" content="website" />
    <link rel="icon" href="media/g.png" type="image/x-icon">
    <link rel="shortcut icon" href="media/g.png" type="image/x-icon" >
    <link rel="stylesheet" href="estilos/styles.css">
    <link href="index.html" rel="canonical" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #1e1e1e; /* Gris página */
}

form {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #151515; /* Gris más oscuro */
    color: #ffffff;
    border-radius: 5px;
}

label {
    display: block;
    margin-bottom: .5em;
    color: #ffffff;
}

input[type="text"],
input[type="number"],
input[type="file"],
textarea,
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
    border: 1px solid #ec1d24; /* Rojo GANDS Logo */
    background-color: #1e1e1e; /* Gris página */
    color: #ffffff;
}

input[type="submit"],
button {
    display: block;
    margin: auto; /* Centra el botón horizontalmente */
    width: 40%;
    padding: 10px;
    background-color: #e62429; /* Rojo botón */
    color: #ffffff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}


input[type="submit"]:hover,
button:hover {
    background-color: #ec1d24; /* Rojo GANDS Logo */
}

/* Agregando un poco de espacio alrededor del formulario */
.container-form {
    padding: 40px;
}

/* Estilos para los mensajes de error o confirmación */
.message {
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
    color: #ffffff;
}
.error {
    background-color: #ff3860;
}
.success {
    background-color: #23d160;
}

.home-link {
  position: absolute;
  top: 70px; /* Ajusta según sea necesario para la posición vertical */
  left: 50%;
  transform: translateX(-50%); /* Centra horizontalmente */
  z-index: 10; /* Asegura que la imagen esté encima de otros elementos */
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), /* Sombra interna */
               0 6px 20px 0 rgba(0, 0, 0, 1); /* Sombra externa más difuminada */
}

.home-link a {
  display: block;
  text-align: center; /* Centra la imagen en el enlace */
}

.home-link img {
  width: 100px; /* O el tamaño que prefieras */
  height: auto; /* Mantiene la relación de aspecto */
}

    </style>


    <noscript data-n-css=""></noscript>
    <script>
    //Añade un evento de clic a todas las imágenes con la clase 'img-table'
document.querySelectorAll('.img-table').forEach(function(img) {
  img.addEventListener('click', function() {
    //Agrega la clase 'shake' al hacer clic en la imagen
    img.classList.add('shake');
    
    //Remueve la clase 'shake' después de una animación
    setTimeout(function() {
      img.classList.remove('shake');
    }, 500); // 500 milisegundos = 0.5 segundos
  });
});

    </script>
</head>

<?php
$servidor = 'localhost';
$cuenta = 'root';
$password = '';
$bd = 'db_peliculas';
// Conexión a la base de datos
$conexion = new mysqli($servidor, $cuenta, $password, $bd);
if ($conexion->connect_errno) {
    die('Error en la conexión');
} else {
    // Conexión exitosa
    if (isset($_POST['submit'])) {
        // Obtenemos el id del formulario para eliminar
        $eliminar = $_POST['eliminar'];
        // Sentencia SQL para eliminar
        $sql = "DELETE FROM peliculas WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $eliminar);

        if ($stmt->execute()) {
            echo '<br> Registro borrado <br>';
        } else {
            echo 'Error al borrar el registro';
        }
        $stmt->close();
    }
    // Consulta de datos a la tabla peliculas
    $sql = 'SELECT * FROM peliculas';
    $resultado = $conexion->query($sql);
    if ($resultado->num_rows) {
        ?>
        <div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <legend>Eliminar Películas</legend>
                <br>
                <select class="browser-default custom-select" name='eliminar'>
                    <?php
                    while ($fila = $resultado->fetch_assoc()) {
                        echo '<option value="' . $fila["id"] . '">' . $fila["nombre"] . '</option>';
                    }
                    ?>
                </select>
                <br><br>
                <button type="submit" value="submit" name="submit">Eliminar</button>
            </form>
        </div>
        <?php
    } else {
        echo "No hay datos";
    }
    $conexion->close();
}
?>
