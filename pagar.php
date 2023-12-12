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

    // Mostrar información del carrito (esto es solo un ejemplo)
    $response = [
        'success' => true,
        'message' => '¡Información del carrito recibida con éxito!',
        'cartItems' => $cartItems,
    ];

    echo json_encode($response);
} else {
    $response = [
        'success' => false,
        'message' => 'No se recibió la información del carrito.',
    ];

    echo json_encode($response);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tienda</title>
    <link rel="stylesheet" href="estilos/styles.css">
    <link rel="stylesheet" href="estilos/estilos.css" />
    <link rel="icon" href="media/g.png" type="image/x-icon">
    <link rel="shortcut icon" href="media/g.png" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWecw7o4Lg5L3M4anMK8XQ6/JD4pky3uK6PAx9F0RJK5hNgLl4mJ7L6yHuhf" crossorigin="anonymous" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Incluir SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="index.js"></script>

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
            background-color: #1e1e1e;
            /* Gris página */
        }

        .swal-custom-title {
            color: #ffffff;
            /* Color del título en blanco */
        }

        .swal-custom-content {
            color: #ffffff;
            /* Color del contenido en blanco */
        }

        .swal-custom-confirm {
            background-color: #e62429;
            /* Rojo botón */
        }

        .swal-custom-cancel {
            background-color: #151515;
            /* Gris más oscuro */
        }

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Work+Sans:wght@800&display=swap');

    </style>

</head>
<bodyt>

    <!-- Barra de Navegación -->

    <nav class="navigation__container">
        <div class="navigation__container--navs 
                            navigation__container--fixed 
                            navigation__container--top">
            <section class="desktopNav__container" data-top-component="desktop-nav" data-page-position="nav">
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
                                    <?php if (isset($_SESSION['username'])) : ?>
                                        <div class="searchPromo__wrap">
                                            <br><br>
                                            <a href="logout.php" style="margin-right: 15px;"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                                        </div>
                                    <?php else : ?>
                                        <!-- Usuario no logueado: Muestra la sección de login -->
                                        <a class="searchPromo desktopNav__tab" href="login.php">
                                            <img class="searchPromo__image" src="media/tickets.png" alt="GandsMovies logo" />
                                            <span class="maravillas-title">Descubre más</span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </nav>
     <!-- Pantalla de pago -->
     <h2>Resumen del Carrito</h2>

<!-- Tabla para mostrar los productos del carrito -->
<table class="table">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($item['title']) . '</td>';
            echo '<td>' . htmlspecialchars($item['quantity']) . '</td>';
            echo '<td>$' . number_format($item['price'], 2) . '</td>';
            echo '<td>$' . number_format($item['quantity'] * $item['price'], 2) . '</td>';
            echo '</tr>';
            $total += $item['quantity'] * $item['price'];
        }
        ?>
        <tr>
            <td colspan="3" style="text-align: right;"><strong>Total:</strong></td>
            <td><strong>$<?php echo number_format($total, 2); ?></strong></td>
        </tr>
    </tbody>
</table>

<!-- Incluir aquí el formulario de pago o el botón de compra... -->

<!-- Incluir SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- Tu archivo JavaScript -->
<script src="scripts/index.js"></script>
        
        
        
    
    </div>
</table>
</body>
</html>