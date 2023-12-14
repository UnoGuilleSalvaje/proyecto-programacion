<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1.0"
		/>
		<title>Tienda</title>
        <link rel="stylesheet" href="estilos/styles.css">
		<link rel="stylesheet" href="estilos/estilos.css" />
        <link rel="icon" href="media/g.png" type="image/x-icon">
        <link rel="shortcut icon" href="media/g.png" type="image/x-icon" >

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWecw7o4Lg5L3M4anMK8XQ6/JD4pky3uK6PAx9F0RJK5hNgLl4mJ7L6yHuhf"
        crossorigin="anonymous"
        />

        <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Incluir SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="estilos/filtro.css">
    <script>
function showLoginAlert() {
  Swal.fire({
    title: 'Iniciar Sesión Requerido',
    text: 'Para añadir productos al carrito, primero debes estar logueado.',
    icon: 'warning',
    background: '#1e1e1e', // Gris página
    showCancelButton: true,
    confirmButtonColor: '#e62429', // Rojo botón
    cancelButtonColor: '#151515', // Gris más oscuro
    confirmButtonText: 'Ir a Iniciar Sesión',
    cancelButtonText: 'Cancelar',
    customClass: {
      popup: 'swal-custom-popup',
      title: 'swal-custom-title',
      content: 'swal-custom-content',
      confirmButton: 'swal-custom-confirm',
      cancelButton: 'swal-custom-cancel'
    }
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = 'login_registro/index.php';
    }
  });
}
</script>

<style>
  .swal-custom-popup {
    background-color: #1e1e1e; /* Gris página */
  }
  .swal-custom-title {
    color: #ffffff; /* Color del título en blanco */
  }
  .swal-custom-content {
    color: #ffffff; /* Color del contenido en blanco */
  }
  .swal-custom-confirm {
    background-color: #e62429; /* Rojo botón */
  }
  .swal-custom-cancel {
    background-color: #151515; /* Gris más oscuro */
  }

  
</style>

	</head>

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

                                                <div class="search desktopNav__tabContainer">
                                                    <a id="search" class="search desktopNav__tab" aria-label="search"
                                                        href="#">
<?php
if (isset($_SESSION['username']) && $_SESSION['username'] == true) {
    // El contenido que quieres mostrar a usuarios logueados
?>
 <div class="container-icon">
				<div class="container-cart-icon" >
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-cart" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
  <path d="M3 3h18v2H3z"/>
  <path d="M3 8h18l-1.5 9H4.5L3 8z"/>
  <circle cx="6" cy="19" r="2"/>
  <circle cx="17" cy="19" r="2"/>
</svg>

					<div class="count-products ">
						<span id="contador-productos">0</span>
					</div>
				</div>

				<div class="container-cart-products hidden-cart">
					<div class="row-product hidden">
						<div class="cart-product">
							<div class="info-cart-product">
								<span class="cantidad-producto-carrito"></span>
								<p class="titulo-producto-carrito">El carrito se encuentra vacío</p>
								<span class="precio-producto-carrito">$0</span>
							</div>
							<svg
								xmlns="http://www.w3.org/2000/svg"
								fill="none"
								viewBox="0 0 24 24"
								stroke-width="1.5"
								stroke="red"
								class="icon-close"
							>
								<path
									stroke-linecap="round"
									stroke-linejoin="round"
									d="M6 18L18 6M6 6l12 12"
								/>
							</svg>
						</div>
					</div>

					<div class="cart-total hidden">
						<h3>Total:</h3>
						<span class="total-pagar">$0</span>
					</div>
					<p class="cart-empty invisible">El carrito está vacío</p>
				</div>
			</div>

            <?php
} else{
    
?>

<?php
}
?>

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
                                                    href="Contactanos/index.php">Contáctanos</a>
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
<br><br><br>

<h1 class="txt">PELÍCULAS</h1>
<p style="margin-left: 50px; margin-right: 50px;">Explora nuestro extenso catálogo de películas, donde encontrarás desde los clásicos atemporales hasta los éxitos contemporáneos. Cada película ha sido seleccionada para garantizar que tengas acceso a una diversidad de géneros y estilos, adecuados para cualquier preferencia o estado de ánimo. Nuestro objetivo es proporcionarte no solo entretenimiento, sino también la oportunidad de descubrir nuevas historias y aventurarte en mundos desconocidos, todo desde el confort de tu hogar.</p>
<br>

<div class="container-items" style="margin-left: 50px; margin-right: 50px;";>
        <?php
// Asegúrate de que el usuario haya enviado los datos del formulario
if (isset($_GET['precio_minimo']) && isset($_GET['precio_maximo'])) {

    // Conexión a la base de datos
$servidor = 'localhost';
$cuenta = 'root';
$password = '';
$bd = 'db_peliculas';
$conexion = new mysqli($servidor, $cuenta, $password, $bd);

if ($conexion->connect_errno) {
    die('Error en la conexión: ' . $conexion->connect_error);
}

    $precioMinimo = $_GET['precio_minimo'];
    $precioMaximo = $_GET['precio_maximo'];

    // Ajusta tu consulta SQL para filtrar por el rango de precios
    $query = "SELECT * FROM peliculas WHERE precio >= ? AND precio <= ?";

    if ($stmt = $conexion->prepare($query)) {
        // Vincula los rangos de precios como parámetros de tipo double (d)
        $stmt->bind_param("dd", $precioMinimo, $precioMaximo);

        // Ejecuta la declaración
        $stmt->execute();

        // Obtiene los resultados
        $resultado = $stmt->get_result();

        // Verifica si hay resultados
        if ($resultado->num_rows > 0) {
            // Mostrar cada película en un div
            while ($pelicula = $resultado->fetch_assoc()) {
                $descuentoTexto = $pelicula['tiene_descuento'] == '1' ? $pelicula['descuento'] . '%' : 'No';
                $estado = $pelicula['agotado'] == '1' ? 'Agotado' : 'En existencia';
                $estado = $pelicula['cantidad_existencia'] <= '0' ? 'Agotado' : 'En existencia';
                $precioConDescuento = $pelicula['tiene_descuento'] == '1' ? $pelicula['precio'] * (1 - ($pelicula['descuento'] / 100)) : $pelicula['precio'];
        
                // Calcular el precio antes del descuento si hay descuento aplicado
                $precioSinDescuento = "";
                if ($pelicula['tiene_descuento'] == '1') {
                    $precioAntesDelDescuento = $pelicula['precio'] / (1 - ($pelicula['descuento'] / 100));
                    $precioSinDescuento = "<p class='price'>Precio original: <del>\$" . number_format($precioAntesDelDescuento, 2) . "</del></p>";
                }
        
                // Formar el nombre del archivo de imagen
                $nombreArchivo = $pelicula['nombre'];
                $nombreImg = "media/posters/" . $nombreArchivo . ".jpg";
        
                if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
                    // Usuario logueado
                    echo "<div class='item' data-cantidad-existencia='{$pelicula['cantidad_existencia']}'>
                        <figure>
                            <img src='{$nombreImg}' alt='{$pelicula['nombre']}' />
                        </figure>
                        <div class='info-product'>
                            <h2>{$pelicula['nombre']}</h2>
                            <p>ID: {$pelicula['id']}</p>
                            <p class='descripcion-producto'>Descripción: {$pelicula['descripcion']}</p>
                            <p>Cantidad en existencia: {$pelicula['cantidad_existencia']}</p>
                            <p>Estado: {$estado}</p>
                            $precioSinDescuento
                            <p class='price'>Precio: \$" . number_format($pelicula['precio'], 2) . "</p>
                            <p>Descuento: {$descuentoTexto}</p>
                            <p>Género: {$pelicula['genero']}</p>
                            
                            
                            <button class='btn-add-cart'>Añadir al carrito</button>
                        </div>
                      </div>";
                } else {
                    // Usuario no logueado
                    echo "<div class='item' data-cantidad-existencia='{$pelicula['cantidad_existencia']}'>
                    <figure>
                        <img src='{$nombreImg}' alt='{$pelicula['nombre']}' />
                    </figure>
                    <div class='info-product'>
                        <h2>{$pelicula['nombre']}</h2>
                        <p>ID: {$pelicula['id']}</p>
                        <p class='descripcion-producto'>Descripción: {$pelicula['descripcion']}</p>
                        <p>Cantidad en existencia: {$pelicula['cantidad_existencia']}</p>
                        <p>Estado: {$estado}</p>
                        <p class='price'>Precio: \$" . number_format($pelicula['precio'], 2) . "</p>
                        <p>Descuento: {$descuentoTexto}</p>
                        <p>Género: {$pelicula['genero']}</p>
                        
                        
                        <button class='btn-login-required' onclick='showLoginAlert()'>Iniciar sesión para comprar</button>
                    </div>
                  </div>";
                } }
            } else {
            echo "<p>No se encontraron películas en el rango de precio seleccionado.</p>";
        }
        
        // Cierra la declaración
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conexion->error;
    }
} else {
    echo "<p>Por favor, selecciona un rango de precios.</p>";
}

?>
</div>