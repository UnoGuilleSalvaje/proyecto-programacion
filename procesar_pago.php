<?php
// Iniciar la sesión al principio de tu script
session_start();

if (isset($_SESSION['username'])) {
    // El usuario está logueado.

}

?>
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>

    body{
        background-image: url(imagesGACH/fondoOscuro1.jpg);
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
// session_start();

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
            // Si la actualización fue exitosa, muestra los detalles de la compra --------------------------------------------------------->
            // Suponiendo que ya tienes la información del carrito y los detalles del pedido
$cartItems = $_SESSION['cart'];
// $total = calcularTotalSinDescuento($cartItems);
?>
<?php
$modoPago = "Tarjeta de Débito"; // Cambiar según corresponda
$direccionEnvio = htmlspecialchars($_POST['direccion']);
$costoEnvio = $_POST['costoEnvio'];
$impuesto = $_POST['imp'];
$totalf = $_POST['totalConEnvioEImpuestos'];
$subtotal = $totalf - $costoEnvio - $impuesto;

            ?>
            
            <body style="box-sizing: border-box; margin: 0; padding: 0; width: 100%; word-break: break-word; -webkit-font-smoothing: antialiased; background-color: #f5dbce;">
  <div style="display: none; line-height: 0; font-size: 0;">Pagamento realizado com sucesso ✔</div>
 
  <table class="wrapper all-font-sans" width="100%" height="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
      <td align="center" style="padding: 24px;" width="100%">
        <table class="sm-w-full" width="500" cellpadding="0" cellspacing="0" role="presentation">
            <td align="left" class="sm-p-20 sm-dui17-b-t" style="border-radius: 2px; padding: 40px; position: relative; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, .1), 0 4px 6px -2px rgba(0, 0, 0, .05); vertical-align: top; z-index: 50;" bgcolor="#ffffff" valign="top">
              <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                <td style="text-align: left;" width="20%" align="left">
    <a href="index.php">
        <img style="margin-right: 20px;" src="media/g.png" alt="Logo" width="" height="40px">
    </a>
</td>

                  <td width="60%">
                    <h1 class="sm-text-lg all-font-roboto" style="font-weight: 700; line-height: 100%; margin: 0; margin-bottom: 4px; font-size: 24px;">Gands Movies</h1>
                    <p id="transaccion" class="sm-text-xs" style="margin: 0; color: #718096; font-size: 14px;"></p>
                    <p id="fechaHora" class="sm-text-xs" style="margin: 0; color: #718096; font-size: 14px;"></p>
                  </td>
                  <td style="text-align: right;" width="20%" align="right">
                    <a href="imprimePDF.php" target="_blank" style="text-decoration: none;">
                      <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="download" class="svg-inline--fa fa-download fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="border: 0; line-height: 100%; vertical-align: middle; font-size: 12px; color:#808080 ;" width=32>
                          <path fill="currentColor" d="M216 0h80c13.3 0 24 10.7 24 24v168h87.7c17.8 0 26.7 21.5 14.1 34.1L269.7 378.3c-7.5 7.5-19.8 7.5-27.3 0L90.1 226.1c-12.6-12.6-3.7-34.1 14.1-34.1H192V24c0-13.3 10.7-24 24-24zm296 376v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h146.7l49 49c20.1 20.1 52.5 20.1 72.6 0l49-49H488c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path>
                      </svg>
                  </a>
                  
                  </td>
                </tr>
              </table>
              <div style="line-height: 16px;">&zwnj;</div>

              <table class="sm-leading-32" style="line-height: 28px; font-size: 14px;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                  <td style="padding-top: 12px; padding-bottom: 12px;">
                    <div style="background-color: #edf2f7; height: 2px; line-height: 2px;">&zwnj;</div>
                  </td>
                </tr>
                <!-- Destinatario -->
                <tr>
                  <td class="sm-w-full sm-inline-block" style="font-weight: 700;" width="100%">Detalles</td>
                </tr>
                <tr>
                  <td class="sm-w-full sm-inline-block" style="text-align: left;" width="100%"><p style="margin-top: -1px;margin-bottom: -1px; font-weight: 600;">Direccion:</p></td>
                </tr>
                <tr>
                  <td class="sm-w-full sm-inline-block"  style="text-align: left;" width="100%"><p style="margin-bottom: -1px;margin-top: -1px;"><?php echo $direccionEnvio ?></p></td>
                </tr>
                <tr>
                  <td class="sm-w-full sm-inline-block" style="text-align: left;" width="100%"><p style="margin-bottom: -1px;margin-top: -1px; font-weight: 600;">Metodo de pago:</p></td>
                </tr>
                <tr>
                  <td class="sm-w-full sm-inline-block" style="text-align: left;" width="100%"><p style="margin-top: -1px;"><?php echo $modoPago ?></p></td>
                </tr>
                <!-- FIM Destinatario -->
                <!-- Lista de productos 
                <tr>
                  <td class="sm-w-full sm-inline-block" style="font-weight: 600;" width="100%">Productos comprados</td>
                </tr>
                <tr>
                  <td class="sm-w-full sm-inline-block" style="text-align: left;" width="50%"><p style="margin-top: -1px;margin-bottom: -1px;">Ready player one</p></td>
                </tr>
              -->
                
                <!-- FIM Origem -->
                <tr>
                  <td style="padding-top: 12px; padding-bottom: 12px;">
                    <div style="background-color: #edf2f7; height: 2px; line-height: 2px;">&zwnj;</div>
                  </td>
                </tr>
                <!-- ID PIX -->
                <tr>
                  <td class="sm-w-full sm-inline-block" style="font-weight: 600;" width="100%">Cobro de envio</td>
                </tr>
                <tr>
                  <td class="sm-w-full sm-inline-block" style="text-align: left;" width="100%"><p style="margin-top: -1px;margin-bottom: -1px;">$ <?php echo $costoEnvio?></p></td>
                </tr>
                <!-- FIM ID PIX -->
              </table>
              <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                  <td style="padding-top: 12px; padding-bottom: 12px;">
                    <div style="background-color: #edf2f7; height: 2px; line-height: 2px;">&zwnj;</div>
                  </td>
                </tr>
              </table>
              <table style="line-height: 28px; font-size: 14px;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                  <td class="sm-w-full sm-inline-block" style="font-weight: 600;" width="50%">Productos comprados</td>
                </tr>
                <?php
                // Asumiendo que $cartItems contiene los artículos del carrito de compras
                foreach ($cartItems as $item) {
                echo "<tr>";
                echo "<td style='color: #718096;' width='50%'>" . htmlspecialchars($item['title']) . " x" . htmlspecialchars($item['quantity']) . "</td>";
                // Cantidad
                echo "<td style='font-weight: 600; text-align: right;' width='50%' align='right'>MXN $" . number_format($item['quantity'] * $item['price'], 2) . "</td>";
                echo "</tr>";
                }

                
                ?>

                   <!-- FIM Origem -->
                <tr>
                  <td style="padding-top: 12px; padding-bottom: 12px;">
                    <div style="background-color: #edf2f7; height: 2px; line-height: 2px;">&zwnj;</div>
                  </td>
                </tr>

                <tr>
                  <td style="color: #718096;" width="50%">Subtotal:</td>
                  <td style="font-weight: 600; text-align: right;" width="50%" align="right">MXN $<?php echo $subtotal ?></td>
                </tr>
                <tr>
                  <td style="color: #718096;" width="50%">Impuesto:</td>
                  <td style="font-weight: 600; text-align: right;" width="50%" align="right">$<?php echo $impuesto?></td>
                </tr>
                <tr>
                  <td style="font-weight: 600; padding-top: 32px; color: #000000; font-size: 20px;" width="50%">Total a pagar:</td>
                  <td style="font-weight: 600; padding-top: 32px; text-align: right;font-size: 20px;" width="50%" align="right">MXN$ <?php echo number_format((float)$totalf, 2, '.', '');  ?></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <form action="imprimePDF.php" method="post">
    <input type="hidden" name="modoPago" value="<?php echo htmlspecialchars($modoPago); ?>">
    <input type="hidden" name="direccionEnvio" value="<?php echo htmlspecialchars($direccionEnvio); ?>">
    <input type="hidden" name="costoEnvio" value="<?php echo htmlspecialchars($costoEnvio); ?>">
    <input type="hidden" name="impuesto" value="<?php echo htmlspecialchars($impuesto); ?>">
    <input type="hidden" name="totalf" value="<?php echo htmlspecialchars($totalf); ?>">
    <input type="hidden" name="subtotal" value="<?php echo htmlspecialchars($subtotal); ?>">
    
    <!-- Aquí puedes agregar botones o triggers que el usuario puede utilizar para enviar el formulario -->
    <button type="submit" style="background-color: #e62429; color: white; border: none; border-radius: 4px; padding: 8px 15px; font-size: 16px; cursor: pointer; display: block; margin-left: auto; margin-right: auto;">Imprimir PDF</button>

</form>
  <script>
    function actualizarFechaHora() {
      // Obtener la fecha y hora actual
      var fechaActual = new Date();
  
      // Formatear la fecha y hora como deseado (en este caso, dd/mm/yyyy a las hh:mm)
      var formatoFechaHora = `${fechaActual.getDate()}/${fechaActual.getMonth() + 1}/${fechaActual.getFullYear()} a las ${fechaActual.getHours()}:${('0' + fechaActual.getMinutes()).slice(-2)}`;
  
      // Actualizar el contenido del elemento <p>
      document.getElementById('fechaHora').textContent = formatoFechaHora;
    }
  
    // Llamar a la función inicialmente
    actualizarFechaHora();
  
    // Actualizar la fecha y hora cada minuto (puedes ajustar este intervalo según tus necesidades)
    setInterval(actualizarFechaHora, 60000);
  </script>
  <script>
    function generarNumeroTransaccion() {
      // Generar un número de transacción aleatorio (puedes ajustar esta lógica según tus necesidades)
      var numeroTransaccion = Math.floor(Math.random() * 1000000000);
  
      // Actualizar el contenido del elemento <p>
      document.getElementById('transaccion').textContent = 'Transacción: ' + numeroTransaccion;
    }
  
    // Llamar a la función para generar el número de transacción inicialmente
    generarNumeroTransaccion();
  
    // Generar un nuevo número de transacción cada vez que se hace clic en el documento
    document.addEventListener('click', function() {
      generarNumeroTransaccion();
    });
  </script>
  <!-- Scripts, incluido el script para jsPDF, y cualquier otro contenido JavaScript aquí -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script>
            <?php
            return true;

// --------------------------------------------------------------------------------------------------------------------------------------------->
        } else {
            ?>
            <div class="alert alert-custom" role="alert">
    <strong>Oh no!</strong> Error al actualizar los datos <br><br>
    <button type="button" id="pdf" class="btn btn-custom i" onclick="window.location.href='index.php';">
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
