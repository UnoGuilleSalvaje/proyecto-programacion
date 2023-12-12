<?php
// Iniciar la sesión al principio de tu script
session_start();

if (isset($_SESSION['username'])) {
    // El usuario está logueado.
    // Puedes realizar acciones adicionales aquí, como mostrar el nombre de usuario.
    echo "Bienvenido, " . $_SESSION['username'];
}

?>

<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
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

?>


<div id="__next">
        <div id="terrigen-page" class="page">
            <div id="page-wrapper" class="page__body">
                <header class="page__header">

                    <!-- Barra de Navegación -->

                    <nav class="navigation__container">
                        <div class="navigation__container--navs 
                            navigation__container--fixed 
                            navigation__container--top">
                            <section class="desktopNav__container" data-top-component="desktop-nav"
                                data-page-position="nav">
                                <div class="desktopNav">
                                    <div class="desktopNav__upper">
                                        <div class="desktopNav__tabAndLogoContainer">
                                        <div class="insider desktopNav__tabContainer">
    <div class="insider desktopNav__tab">
        <img src="media/10307911.png" alt="" style="width: 20px; height: 20px; margin-top: 13px; margin-left: 7px !important;">
        <div class="user-menu__links">

            <?php
            // Verifica si el usuario está logueado
            if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
                // Usuario logueado
                echo '<p class="maravillas-title">Bienvenido, ' . htmlspecialchars($_SESSION['username']) . '</p>';
            } else {
                // Usuario no logueado
                echo '<a class="user-menu-tab sign-in" href="login_registro/index.php">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">INICIAR SESIÓN </font></font></a>
                        <span class="user-menu-tab separator">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">| </font></font></span>
                        <a class="user-menu-tab join-dropdown" href="login_registro/index.php">
                            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">REGISTRARSE</font>
                        </font></a>';
            }
            ?>
            <span class="user-menu-tab username"></span>
            <span class="user-menu-tab points"></span>
        </div> 
    </div>
</div>
                                            
                                            <a class="desktopNav__logo" href="index.php">
                                                <span class="icon--svg icon--svg mvl-animated-logo" aria-hidden="true">
                                                    <img src="media/GANDS MOVIES ORIGINAL.png" alt=""><!--LOGO DEL SITIO-->
                                                </span>
                                            </a>
                                            
                                            <div class="desktopNav__right-links">
    <div class="desktopNav__tabContainer">
        <?php if (isset($_SESSION['username'])): ?>
            <div class="searchPromo__wrap">
                <br><br>
                <a href="logout.php" style="margin-right: 15px;"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
            </div>
        <?php else: ?>
            <!-- Usuario no logueado: Muestra la sección de login -->
            <a class="searchPromo desktopNav__tab" href="login.php">
                <img class="searchPromo__image" src="media/tickets.png" alt="GandsMovies logo" />
                <span class="maravillas-title">Descubre más</span>
            </a>
        <?php endif; ?>
    </div>

                                                <div class="search desktopNav__tabContainer ">
                                                    <a id="search" class="search desktopNav__tab" aria-label="search"
                                                        href="#">
                                                        <span
                                                            class="icon--svg icon--svg--black-fill icon--svg--black-stroke icon--search"
                                                            aria-hidden="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="19"
                                                                height="17" viewBox="0 0 19 17" fill-rule="evenodd">
                                                                <circle cx="6.5" cy="6.5" r="5.5">

                                                                </circle>
                                                                <path d="M14 14l3.536 3.536">

                                                                </path>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                    
                                    <!-- Links   -->
                                    <div class="desktopNav__lower">
                                        <ul class="desktopNav__linkContainer">
                                            <li class="desktopNav__linkWrapper">
                                                <a id="mvl-flyout-button-0" class="desktopNav__link mvl-flyout-button"
                                                    href="index.php">Inicio</a>
                                                <div class="desktopNav__flyout-container nav-flyout-container-0">
                                                   
                                                </div>
                                            </li>
                                            <li class="desktopNav__linkWrapper"><a id="mvl-flyout-button-1"
                                                    class="desktopNav__link mvl-flyout-button"
                                                    href="tienda.php">Películas</a>
                                                <div class="desktopNav__flyout-container nav-flyout-container-1">
                                                
                                                </div>
                                            </li>
                                            <li class="desktopNav__linkWrapper ">
                                                <a class="desktopNav__link" href="#" id="dropdownMenuButton1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Géneros
                                                </a>
                                                <ul class="dropdown-menu nav-flyout-container-2" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="mostrar_peliculas.php?genero=Accion">Acción</a></li>
                                                <li><a class="dropdown-item" href="mostrar_peliculas.php?genero=Comedia">Comedia</a></li>
                                                <li><a class="dropdown-item" href="mostrar_peliculas.php?genero=Drama">Drama</a></li>
                                                </ul>
                                            </li>
                                            <li class="desktopNav__linkWrapper"><a id="mvl-flyout-button-3"
                                                    class="desktopNav__link mvl-flyout-button"
                                                    href="#">Productos</a>
                                                <div class="desktopNav__flyout-container nav-flyout-container-3">
                                                 
                                                </div>
                                            </li>
                                            <li class="desktopNav__linkWrapper"><a id="mvl-flyout-button-4"
                                                    class="desktopNav__link mvl-flyout-button" href="about/AboutPage/about.php">Acerca de</a>
                                                <div class="desktopNav__flyout-container nav-flyout-container-4">
                                                   
                                                </div>
                                            </li>
                                            <li class="desktopNav__linkWrapper"><a id="mvl-flyout-button-5"
                                                    class="desktopNav__link mvl-flyout-button"
                                                    href="ayuda.php">Ayuda</a>
                                                <div class="desktopNav__flyout-container nav-flyout-container-5">
                                                   
                                                </div>
                                            </li>
                                            <li class="desktopNav__linkWrapper"><a id="mvl-flyout-button-6"
                                                    class="desktopNav__link mvl-flyout-button"
                                                    href="#">Contáctanos</a>
                                                <div class="desktopNav__flyout-container nav-flyout-container-6">
                                                    
                                                </div>
                                            </li>
<li class="desktopNav__linkWrapper">
    <?php
    // Verifica si el usuario está logueado y si su rol es 'admin'

    if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {  
        echo '<li class="desktopNav__linkWrapper ">
        <a class="desktopNav__link" href="AdministrarProductos.php" id="dropdownMenuButton1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Admin
        </a>
        <ul class="dropdown-menu nav-flyout-container-2" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="alta_producto.php">Altas</a></li>
        <li><a class="dropdown-item" href="editar_producto.php">Cambios</a></li>
        <li><a class="dropdown-item" href="eliminar_producto.php">Bajas</a></li>
        </ul>
    </li>';
    }
    ?>
</li>

                                        </ul>
                                    </div>
                                <!-- Fin de links -->

                                </div>
                            </section>
                        </div>
                    </nav>


<?php
// Conexión a la base de datos (asegúrate de reemplazar con tus propios detalles de conexión)
$servidor = 'localhost';
$cuenta = 'root';
$password = '';
$bd = 'db_peliculas';
//Se establece una conexión con la base de datos MySQL 
$conexion = new mysqli($servidor, $cuenta, $password, $bd);

// Verifica si la conexión fue exitosa
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$producto = null;

// Consulta para obtener todos los productos
$sql = "SELECT id, nombre FROM peliculas";
$resultado = $conexion->query($sql);

// Verifica si la consulta tiene resultados
if ($resultado->num_rows > 0) {
    // Inicio de la lista desplegable
    echo '<form action="" method="post">';
    echo '<select name="producto_id">';

    // Opciones de la lista desplegable
    while ($fila = $resultado->fetch_assoc()) {
        echo '<option value="' . $fila['id'] . '">' . $fila['nombre'] . '</option>';
    }

    // Fin de la lista desplegable
    echo '</select>';
    echo '<input type="submit" name="seleccionar_producto" value="Seleccionar Producto">';
    echo '</form>';
} else {
    echo "No hay productos disponibles.";
}

// Verificar si se ha seleccionado un producto
if (isset($_POST['seleccionar_producto']) && !empty($_POST['producto_id'])) {
    $producto_id = $_POST['producto_id'];
    // Consulta para obtener los detalles del producto seleccionado
    $sql = "SELECT * FROM peliculas WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $producto = $resultado->fetch_assoc();
    } else {
        echo "Producto no encontrado.";
    }
    $stmt->close();
}

// Cierra la conexión a la base de datos
$conexion->close();

if ($producto): ?>
<form action="edit_movie.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_producto" value="<?php echo $producto['id']; ?>">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>">

    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>

    <label for="cantidad_existencia">Cantidad en existencia:</label>
    <input type="number" name="cantidad_existencia" value="<?php echo $producto['cantidad_existencia']; ?>">

    <label for="agotado">Agotado:</label>
    <select name="agotado" required>
        <option value="0" <?php // Si no está agotado, imprime 'selected' ?>>No</option>
        <option value="1" <?php // Si está agotado, imprime 'selected' ?>>Sí</option>
    </select>

    <label for="precio">Precio:</label>
    <input type="number" name="precio" step="0.01" value="<?php echo $producto['precio']; ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" name="imagen">
    <img src="media/posters/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="Imagen actual del producto" style="max-width:200px; display: block; margin-left: auto; margin-right: auto;">

    <label for="tiene_descuento">Tiene descuento:</label>
<select name="tiene_descuento" id="tiene_descuento">
    <option value="0" <?php echo $producto['tiene_descuento'] == '0' ? 'selected' : ''; ?>>No</option>
    <option value="1" <?php echo $producto['tiene_descuento'] == '1' ? 'selected' : ''; ?>>Sí</option>
</select>


    <label for="descuento">Descuento:</label>
    <input type="number" name="descuento" step="0.01" value="<?php echo $producto['descuento']; ?>">

    <label for="genero">Género:</label>
    <input type="text" name="genero" value="<?php echo $producto['genero']; ?>">

    <br><br>
    <input type="submit" name="editar_producto" value="Actualizar Producto">
</form>
<?php endif;
?>


<br><br><br>
                   <!--Aqui inicia nuestro footer -->
                <footer class="page__footer">
                    <footer class="main-footer">
                        <div class="main-footer__full-content">
                            <div class="main-footer__links"><a class="main-footer__logo" href="index.html">
                                <span class="icon--svg main-footer__logo--svg" aria-hidden="true">
                                      <!--Icono G-->    <img src="media/g.png" alt="" style="width: 90%; height: 96%; margin-left: 19px; ">
                                </span></a>
                                <nav class="main-footer__primary-links" aria-label="Primary footer navigtion">
                                    <ul>
                                        <li class="main-footer__link"><a href="#">Inicio</a>
                                        </li>
                                        <li class="main-footer__link"><a href="#">Catálogos</a>
                                        </li>
                                        <li class="main-footer__link"><a href="#">Estrenos</a>
                                        </li>
                                        <li class="main-footer__link"><a href="#">Eventos Especiales</a>
                                        </li>
                                    </ul>
                                </nav>
                                <nav class="main-footer__secondary-links" aria-label="Secondary footer navigtion">
                                    <ul>
                                        <li class="main-footer__link"><a href="#">Ofertas o Descuentos</a></li>
                                        <li class="main-footer__link"><a href="#">Como Funciona</a>
                                        </li>
                                        <li class="main-footer__link"><a href="#">Soporte o Ayuda</a></li>
                                        <li class="main-footer__link"><a href="#">GandsMovies.com</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <nav class="main-footer__promo-links" aria-label="Promotional footer navigtion">
                                <div class="main-footer__promotion">
                                        <div class="main-footer__promotion-image-wrapper">
                                            <figure class="img__wrapper "><img
                                                    src="media/U.png" style="width: 40px; height: 40px; margin-left: 25px;" 
                                                   
                                                    alt="--Imagen" class="main-footer__promotion-image" />
                                            </figure>
                                        </div>
                                        <div class="main-footer__promotion-info">
                                            <h4 class="main-footer__promotion-title">Únete a nosotros</h4>
                                            <p class="main-footer__promotion-description"> Crea tu portal para explorar emociones intensas</p>
                                        </div>
                                    </div>
                                 <!--Aqui inicia nuestro footer -->
                                <div class="main-footer__promotion">
                                     
                                        <div class="main-footer__promotion-image-wrapper">
                                            <figure class="img__wrapper "><img
                                                    src="media/E.png" style="width: 40px; height: 40px; margin-left: 25px;"
                                                    
                                                    alt="Marvel Unlimited Logo" class="main-footer__promotion-image" />
                                            </figure>
                                        </div>
                                        <div class="main-footer__promotion-info">
                                            <h4 class="main-footer__promotion-title">Encuentra la Magia en cada Pantalla</h4>
                                            <p class="main-footer__promotion-description">Encuentra +300 películas disponibles</p>
                                        </div>
                                    </div>
                            </nav>
        
<!--Aqui inicia nuestro footer -->

<nav class="main-footer__follow" aria-label="Social footer navigtion">
<h4 class="main-footer__title">Síguenos en nuestras redes sociales</h4>
<ul class="social-links footer__social">
    <li class="footer__social__img"><a target="_blank"
            aria-label="follow us on Facebook, opens a new window" class=""
            href="https://www.facebook.com/"><span class="icon--svg icon--svg--gray-fill icon--facebook "
                aria-hidden="true">
                <!--Facebook -->
                <svg xmlns="http://www.w3.org/2000/s" width="18"
                    height="18" viewBox="0 0 18 18">
                    <!--icono de facebook-->
                    <path fill-rule="evenodd"
                        d="M9.426 17.647H.974A.974.974 0 010 16.673V.974C0 .436.436 0 .974 0h15.7c.537 0 .973.436.973.974v15.699a.974.974 0 01-.974.974h-4.497v-6.834h2.294l.343-2.663h-2.637v-1.7c0-.772.214-1.297 1.32-1.297h1.41V2.77a18.853 18.853 0 00-2.055-.105c-2.033 0-3.425 1.241-3.425 3.52V8.15h-2.3v2.663h2.3v6.834z">
                    </path>
                </svg></span></a></li>
    <li class="footer__social__img"><a target="_blank"
            aria-label="follow us on Twitter, opens a new window" class=""
            href="https://twitter.com/"><span
                class="icon--svg icon--svg--gray-fill icon--twitter"
                aria-hidden="true">
                <!--twitter-->
                <svg xmlns="http://www.w3.org/2000/svg" width="18"
                    height="18" viewBox="0 0 18 18">
                    <!--icono de twitter-->
                    <path
                        d="M3.5 5.1l3.8 5L4 13.6c-1.9 1.8-3.1 3.6-2.8 3.9.3.3 1.7-.8 3.1-2.5 3.2-3.8 4.1-3.8 6.4 0 1.3 2.2 2.5 3 4.5 3H18l-3.6-5-3.7-5.1L13.9 4c1.8-2.2 2.8-4 2.3-4-.4 0-1.8 1.3-3 3-1.3 1.6-2.6 3-3 3-.4 0-1.6-1.4-2.7-3C6.1.9 4.7 0 2.7 0H-.2l3.7 5.1zm6.3 3.3c5.3 7.6 5.8 8.6 4.4 8.6C13.4 17 3 2.7 3 1.6c0-2 2.3.3 6.8 6.8z">
                    </path>
                </svg></span></a></li>
    <li class="footer__social__img"><a target="_blank"
            aria-label="follow us on Instagram, opens a new window" class=""
            href="https://www.instagram.com/"><span
                class="icon--svg icon--svg--gray-fill" aria-hidden="true">
                <!--Instagram-->
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                    viewBox="0 0 18 18">
                    <!--logo de instagram-->
                    <path fill-rule="evenodd"
                        d="M15.441 15.993H2.206a.552.552 0 01-.552-.552V7.17H3.86c-.287.414-.384 1.185-.384 1.675 0 2.953 2.408 5.356 5.368 5.356 2.96 0 5.368-2.403 5.368-5.356 0-.49-.069-1.25-.425-1.675h2.206v8.272a.552.552 0 01-.552.552M8.844 5.458a3.39 3.39 0 013.394 3.386 3.39 3.39 0 01-3.394 3.386A3.39 3.39 0 015.45 8.844a3.39 3.39 0 013.393-3.386m4.391-3.252h1.655c.304 0 .551.247.551.551v1.655a.552.552 0 01-.551.551h-1.655a.552.552 0 01-.551-.551V2.757c0-.304.247-.551.551-.551M15.55 0H2.098A2.095 2.095 0 000 2.093v13.461c0 1.156.94 2.093 2.098 2.093h13.451a2.095 2.095 0 002.098-2.093V2.093C17.647.937 16.707 0 15.549 0">
                    </path>

                </svg></span></a></li>
    <li class="footer__social__img">
        <a target="_blank"
            aria-label="follow us on Tumblr, opens a new window" class=""
            href="https://www.tumblr.com/">
            <span class="icon--svg icon--svg--gray-fill" aria-hidden="true">
                <!--Tumblr-->
                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="18"
                    viewBox="0 0 11 18">
                    <!--icono de Tumblr-->
                    <path fill-rule="evenodd"
                        d="M8.535 14.5c-1.532.038-1.83-1-1.842-1.751V7.217h3.844v-2.69h-3.83V0H3.904a.147.147 0 00-.138.133C3.602 1.518 2.904 3.949 0 4.922v2.295h1.937v5.806c0 1.988 1.58 4.812 5.749 4.745 1.407-.022 2.969-.569 3.314-1.04l-.92-2.535c-.356.158-1.037.295-1.545.307z">
                    </path>

                </svg></span></a></li>
    <li class="footer__social__img">
        <a target="_blank"
            aria-label="follow us on Youtube, opens a new window" class=""
            href="https://www.youtube.com/">
            <span class="icon--svg icon--svg--gray-fill" aria-hidden="true">
                <!--Youtube-->
                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="15"
                    viewBox="0 0 21 15">
                    <!--icono de youtube-->
                    <path fill-rule="evenodd"
                        d="M8.109 9.73l-.001-5.679 5.522 2.85-5.521 2.83zm12.124-6.663s-.2-1.393-.812-2.006c-.778-.806-1.649-.81-2.048-.856C14.513 0 10.223 0 10.223 0h-.009s-4.29 0-7.15.205c-.4.046-1.27.05-2.048.856-.612.613-.812 2.006-.812 2.006S0 4.703 0 6.338v1.534c0 1.636.204 3.272.204 3.272s.2 1.392.812 2.006c.778.805 1.8.78 2.254.864 1.635.155 6.949.203 6.949.203s4.294-.006 7.154-.21c.4-.048 1.27-.052 2.048-.857.612-.614.812-2.006.812-2.006s.204-1.636.204-3.272V6.338c0-1.635-.204-3.271-.204-3.271z">
                    </path>

                </svg></span></a></li>
    <li class="footer__social__img"><a target="_blank"
            aria-label="follow us on Snapchat, opens a new window" class=""
             href="https://www.snapchat.com/"><span class="icon--svg icon--svg--gray-fill" aria-hidden="true">
                <!--Snaptchat-->
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="17"
                    viewBox="0 0 19 17">
                    <!--icono de Snapchat-->
                    <path fill-rule="evenodd"
                        d="M9.155.003C8.74.003 7.91.057 7.02.421c-.51.207-.968.488-1.363.834-.47.412-.853.92-1.138 1.51-.418.865-.319 2.322-.24 3.492.01.127.018.258.027.385a.784.784 0 01-.307.054c-.236 0-.516-.07-.833-.207a.798.798 0 00-.317-.06c-.188 0-.387.051-.56.145-.216.117-.356.283-.394.468-.025.121-.024.362.266.607.16.134.393.258.696.369.079.028.173.056.273.085.346.102.87.255 1.006.552.07.15.04.348-.088.587a5.67 5.67 0 01-.95 1.368c-.347.374-.73.686-1.136.928a4.386 4.386 0 01-1.594.575c-.221.033-.379.215-.366.421a.5.5 0 00.045.176c.09.194.297.358.633.502.411.176 1.026.325 1.827.44.04.072.083.25.112.373.03.13.062.264.107.406.05.153.176.337.502.337.123 0 .265-.025.43-.055.24-.043.569-.103.98-.103.227 0 .463.019.7.055.459.07.853.328 1.31.626.669.436 1.425.93 2.582.93.031 0 .063 0 .094-.003.038.002.085.003.135.003 1.157 0 1.913-.494 2.581-.93.458-.299.852-.556 1.31-.626.238-.036.473-.055.701-.055.393 0 .703.046.98.096.182.033.322.049.43.049.26 0 .435-.12.502-.332.044-.139.076-.27.107-.402.027-.114.07-.298.111-.37.802-.116 1.417-.264 1.828-.44.335-.144.542-.308.632-.5a.485.485 0 00.046-.177c.013-.206-.145-.388-.366-.422-2.498-.38-3.624-2.75-3.67-2.85-.138-.26-.167-.457-.098-.608.136-.296.66-.45 1.006-.551.1-.03.195-.057.273-.086.341-.124.585-.259.746-.412.192-.182.229-.357.227-.472-.006-.277-.236-.523-.6-.643a1.151 1.151 0 00-.407-.072.976.976 0 00-.378.071 2.267 2.267 0 01-.779.205.753.753 0 01-.258-.052l.023-.335.003-.05c.08-1.17.18-2.628-.238-3.493a4.731 4.731 0 00-1.144-1.515A4.822 4.822 0 0011.66.415 5.836 5.836 0 009.523 0l-.368.003z">
                    </path>
                </svg></span></a></li>
    <li class="footer__social__img"><a target="_blank"
            aria-label="follow us on Pinterest, opens a new window" class=""
            href="https://www.pinterest.com.mx/"><span class="icon--svg icon--svg--gray-fill" aria-hidden="true">
                <!--Pinterest-->
                <svg xmlns="http://www.w3.org/2000/sv" width="18" height="16"
                    viewBox="0 0 18 16">
                    <!-- icono Pinterest-->
                    <path fill-rule="evenodd"
                        d="M0 8c0 3.275 2.216 6.09 5.388 7.327-.025-.558-.004-1.23.156-1.837l1.158-4.359s-.287-.51-.287-1.266c0-1.185.774-2.07 1.736-2.07.818 0 1.214.546 1.214 1.2 0 .732-.525 1.826-.795 2.84-.226.849.478 1.54 1.42 1.54 1.705 0 2.854-1.946 2.854-4.253 0-1.753-1.329-3.065-3.745-3.065-2.73 0-4.43 1.809-4.43 3.83 0 .698.23 1.189.592 1.569.167.176.19.245.13.447-.043.146-.142.501-.184.641-.06.203-.244.276-.45.2-1.258-.456-1.843-1.68-1.843-3.056 0-2.272 2.156-4.998 6.432-4.998 3.436 0 5.698 2.212 5.698 4.583 0 3.139-1.962 5.483-4.857 5.483-.97 0-1.885-.466-2.198-.996 0 0-.523 1.843-.633 2.198-.19.617-.564 1.234-.906 1.714.81.212 1.665.328 2.55.328 4.97 0 9-3.582 9-8s-4.03-8-9-8-9 3.582-9 8z">
                    </path>
                </svg></span></a></li>
</ul>
</nav>
</div>
<p class="copy_right">&copy; 2023 Gands Movies. Todos los derechos reservados. Prohibida la reproducción sin autorización.</p>
</footer>

</div>  
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>