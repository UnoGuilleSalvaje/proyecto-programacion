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

    <script>
        // Función para actualizar el total en la página
    function actualizarTotal(total) {
            const totalElement = document.getElementById('total');
            totalElement.innerText = '$' + total.toFixed(2);
        }

        // Ejemplo de cómo podrías usar esta función después de realizar una solicitud AJAX al servidor
        // Aquí asumo que tienes algún evento o función que maneja la respuesta del servidor
        function handleDescuentoResponse(response) {
            if (response.success) {
                // Actualizar el total en la página
                actualizarTotal(response.total);
            } else {
                // Manejar el caso de descuento no aplicado
                console.error('No se pudo aplicar el descuento.');
            }
        }
    </script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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
    background-color: #e62429; /* Rojo botón */
    color: #ffffff; /* Texto en blanco */
    padding: 15px 32px; /* Padding más grande para un botón más grande */
    font-size: 16px; /* Tamaño de fuente más grande */
    border: none;
    border-radius: 8px; /* Esquinas redondeadas */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave para un efecto elevado */
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.swal-custom-confirm:hover {
    background-color: #ec1d24; /* Un rojo más oscuro para el efecto hover */
}


        .swal-custom-cancel {
            background-color: #151515;
            /* Gris más oscuro */
        }


        body {
            font-family: 'Poppins', sans-serif;
            background-image: url(media/fondo2.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: white;
        }
        .payment-container {
            background-color: rgba(255, 255, 255);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            flex-direction: row;
            /* Cambiado de column a row */
            align-items: flex-start;
            /* Para alinear al inicio */
        }

        .cart-container {
            width: 33%;
            /* Un tercio del espacio */
            margin-right: 20px;
            /* Espacio entre el contenedor del carrito y la tabla */
        }

        .cart-container h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .payment-form {
            width: 100%;
            /* Dos tercios del espacio */
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin: 15px;
        }

        .payment-form label {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .payment-form input {
            padding: 10px;
            border: 1px solid #ec1d24;
            border-radius: 5px;
            font-size: 14px;
        }

        .payment-form button {
            padding: 10px;
            background-color: #e62429;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .payment-form button:hover {
            background-color: #ec1d24;
        }

        .discount-form {
            border-spacing: 20px;
            border: white;
        }

        .discount-form label {
            font-size: 15px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .discount-form input {
            padding: 10px;
            border: 1px solid #ec1d24;
            border-radius: 5px;
            font-size: 14px;
        }

        .discount-form button {
            padding: 10px;
            background-color: #e62429;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Work+Sans:wght@800&display=swap');

    </style>

</head>
<bodyt>

    <!-- Barra de Navegación -->

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

    <!-- incliur formas de pago como paypay y su incono, asi como formulario para tarjeta y direccion -->
    <div class="payment-container">


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
                    $total = isset($_SESSION['descuento_aplicado']) && $_SESSION['descuento_aplicado']
                        ? $_SESSION['total_con_descuento']
                        : calcularTotalSinDescuento($_SESSION['cart']);
                        $costoEnvio = 0;

                }
                
                // mostrar valor que trae total

                $_POST['total'] = $total;
                function calcularTotalSinDescuento($cart)
                {
                    $total = 0;
                    foreach ($cart as $item) {
                        $total += $item['quantity'] * $item['price'];
                    }
                    return $total;
                }
                ?>
                <tr>
    <td colspan="3" style="text-align: right;"><strong>Gastos de Envío:</strong></td>
    <td><strong id="gastos-envio">$0.00</strong></td>
</tr>

<tr>
    <td colspan="3" style="text-align: right;"><strong>Impuesto:</strong></td>
    <td><strong id="impuesto">$0.00</strong></td>
</tr>


<tr>
    <td colspan="3" style="text-align: right;"><strong>Total:</strong></td>
    <td><strong id="total">$<?php echo number_format($total, 2); ?></strong></td>
</tr>

                <!-- icono de paypal, mastercard y visa -->
                <tr style="border: white; border-bottom: 127px solid white;">
                    <td colspan="1" style="text-align: right;">
                        <img src="media/PayPal.webp" alt="" style="width: 100px; height: 50px; display:flex; justify-content: space-evenly;">
                    </td>
                    <td colspan="2" style="text-align: right;">
                        <img src="media/visa.png" alt="" style="width: 140px; height: 50px; display:flex; justify-content: space-evenly;">
                    </td>
                    <td colspan="1" style="text-align: right;">
                        <img src="media/Oxxo_Logo.png" alt="" style="width: 100px; height: 50px; display:flex; justify-content: space-evenly;">

                    </td>
                    <!-- discount form -->
                <tr class="discount-form">
                    <td colspan="4" style="text-align: left;">
                    <form id="discount-form">
    <label for="discount-code">Código de descuento:</label>
    <input type="text" id="discount-code">
    <button type="button" id="apply-discount">Aplicar</button>
</form>

<script>
$(document).ready(function() {
    $('#pais').on('change', function() {
        var paisSeleccionado = $(this).val();
        $.ajax({
            type: 'POST',
            url: 'calcular_envio.php',
            data: { pais: paisSeleccionado },
            success: function(response) {
                var data = JSON.parse(response);
                actualizarGastosEnvio(data.costoEnvio);
                actualizarImpuesto(data.impuesto);
                actualizarTotal(data.totalConEnvioEImpuestos);
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    });


    function actualizarGastosEnvio(costoEnvio) {
    $('#gastos-envio').text('$' + costoEnvio.toFixed(2));
}

function actualizarImpuesto(impuesto) {
    $('#impuesto').text('$' + impuesto.toFixed(2));
}

function actualizarTotal(nuevoTotal) {
    $('#total').text('$' + nuevoTotal.toFixed(2));
}


    $('#apply-discount').on('click', function() {
        var discountCode = $('#discount-code').val();
        $.ajax({
            type: 'POST',
            url: 'aplicar_descuento.php', // La URL del script PHP que maneja el descuento
            data: { discount: discountCode },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {
    actualizarTotal(data.totalConDescuento);
    Swal.fire({
    title: 'Descuento Aplicado',
    text: 'El descuento ha sido aplicado con éxito.',
    icon: 'success',
    customClass: {
        popup: 'swal-custom-popup',
        title: 'swal-custom-title',
        content: 'swal-custom-content',
        confirmButton: 'swal-custom-confirm'
    },
    buttonsStyling: false,
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'Excelente'
});
} else {
    Swal.fire({
    title: 'Error',
    text: 'Código de descuento no válido.',
    icon: 'error',
    customClass: {
        popup: 'swal-custom-popup',
        title: 'swal-custom-title',
        content: 'swal-custom-content',
        confirmButton: 'swal-custom-confirm',
        cancelButton: 'swal-custom-cancel'
    },
    buttonsStyling: false,
    confirmButtonColor: '#d33',
    confirmButtonText: 'Intentar de nuevo'
});
}

            },
            error: function() {
                Swal.fire({
    title: 'Error',
    text: 'No se pudo aplicar el descuento',
    icon: 'error',
    customClass: {
        popup: 'swal-custom-popup',
        title: 'swal-custom-title',
        content: 'swal-custom-content',
        confirmButton: 'swal-custom-confirm',
        cancelButton: 'swal-custom-cancel'
    },
    buttonsStyling: false,
    confirmButtonColor: '#d33',
    confirmButtonText: 'Intentar de nuevo'
});
            }
        });
    });
});

function actualizarTotal(total) {
    $('#total').text('$' + total.toFixed(2));
}

</script>
                    </td>
                </tr>
            </tbody>
        </table>



        <!-- Formulario para enviar la información del carrito y detalles de pago -->
        <form class="payment-form" id="payment-form" action="procesar_pago.php" method="POST">
            <!-- Información del carrito (productos, cantidades, precios) -->
            <input type="hidden" name="cart" value='<?php echo json_encode($_SESSION['cart']); ?>'>

            <!-- Campos de información del comprador -->
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required>

            <label for="pais">País:</label>
<select name="pais" id="pais" required>
    <option value="Mexico">México</option>
    <option value="Espana">España</option>
    <!-- Añade más países según sea necesario -->
</select>
<form action="procesar_pago.php" method="post">
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" required>

            <!-- Campos de información de tarjeta (solo un ejemplo, puedes ajustar según tu necesidad) -->
            <label for="numero_tarjeta">Número de tarjeta:</label>
            <input type="text" name="numero_tarjeta" required>

            <label for="fecha_expiracion">Fecha de expiración:</label>
            <input type="text" name="fecha_expiracion" placeholder="MM/AA" required>

            <label for="cvv">CVV:</label>
            <input type="text" name="cvv" required>

            <!-- Botón de pago y envia correo con los datos de la compra con enviar_correp.php-->   
            <button type="submit" id="btnPago">Pagar</button>
</form>
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            
<script>
    $(document).ready(function () {
        $('#btnPagar').on('click', function () {
            // Envía el formulario usando AJAX
            $.ajax({
                type: 'POST',
                url: 'procesar_pago.php', // Ajusta la URL al archivo que procesa el pago
                data: $('#payment-form').serialize(), // Serializa el formulario
                success: function (response) {
                    // Aquí puedes realizar acciones después de procesar el pago (si es necesario)
                    console.log(response);

                    // Después de procesar el pago, envía el correo
                    $.ajax({
                        type: 'POST',
                        url: 'enviar_correo.php', // Ajusta la URL al archivo que envía el correo
                        data: $('#payment-form').serialize(), // Puedes enviar los datos del formulario al script de envío de correo
                        success: function (correoResponse) {
                            // Aquí puedes realizar acciones después de enviar el correo
                            console.log(correoResponse);
                        },
                        error: function (error) {
                            console.error('Error al enviar el correo:', error);
                        }
                    });
                },
                error: function (error) {
                    console.error('Error al procesar el pago:', error);
                }
            });
        });
    });
</script>

        </form>
    </div>

    


    <!-- Incluir SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Tu archivo JavaScript -->
    <script src="scripts/index.js"></script>




    </div>
    </table>
    </body>


</html>