<?php
 session_start();
////AQUI MANDA AUTOMATICAMENTE EL CORREO
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 
 require './PHPMailer/src/Exception.php';
 require './PHPMailer/src/PHPMailer.php';
 require './PHPMailer/src/SMTP.php';
 
 
 // Establecer la zona horaria de México
 date_default_timezone_set('America/Mexico_City');
 // Obtener la dirección de correo electrónico del usuario desde la URL
 //$correo_electronico = $_GET["correo_electronico"];
 $correo_electronico = "trestamal@gmail.com";   /////////////////////////////aqui poner el correo del usuario
   
     $mail = new PHPMailer(true);
     $mail->isSMTP();
     $mail->Host = 'smtp.gmail.com';
     $mail->SMTPAuth = true;
     $mail->Username = 'tamaldeverdeee@gmail.com'; // Cambia por tu dirección de correo
     $mail->Password = 'tpdj dimc aahg tbni'; // Cambia por tu contraseña
     $mail->Port = 465;
     $mail->SMTPSecure = 'ssl';
     $mail->isHTML(true);
 
     $mail->setFrom('tamaldeverdeee@gmail.com', 'GANDS MOVIES'); // Cambia por tu dirección de correo y nombre
     $mail->addAddress($correo_electronico); // Usamos la dirección proporcionada por el usuario
 
     // Asunto del correo
     $subject = 'Recibo de compra';
     $mail->Subject = $subject;
 
     // Cuerpo del correo
     $message = '<h1 style="color:red;">GANDS MOVIES</h1>';
     $message .= '<h1>!Gracias por su compra!</h1>';
     $message .= '<h2>Recibo de compra</h2>';
     $message .= '<p>Fecha y hora de la compra: ' . date('Y-m-d H:i:s') . '</p>';
     $message .= '<hr>'; // Línea de división
 
     // Agregar dirección y método de pago
     $message .= '<p>Dirección y método de pago: [Insertar detalles aquí]</p>';
     $message .= '<hr>'; // Línea de división
 
     // Agregar cobro de envío
     $message .= '<p>Cobro de envío: [Insertar detalles aquí]</p>';
     $message .= '<hr>'; // Línea de división
 
     // Agregar productos comprados y sus precios
     $message .= '<h3>Productos comprados</h3>';
     $message .= '<p>Producto 1: $10.00</p>';
     $message .= '<p>Producto 2: $20.00</p>';
     $message .= '<hr>'; // Línea de división
 
     // Agregar subtotal, impuesto y total a pagar
     $message .= '<p>Subtotal: $30.00</p>';
     $message .= '<p>Impuesto: $3.00</p>';
     $message .= '<p>Total a pagar: $33.00</p>';
     $message .= '<img src="https://img.freepik.com/foto-gratis/gafas-3d-entradas-cine-palomitas-maiz_23-2148470169.jpg?w=1060&t=st=1702259575~exp=1702260175~hmac=65dfc5bf7c63ef35ab8d02dfbe051d4d529593c6ee63961a424a661fa5b0794f" Width="700px";>';

     $mail->Body = $message;
     $mail->send();


     //////////////////AQUI MANDA EN WEB EL TICKET
  ?>
<!DOCTYPE html>
<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <meta charset="utf8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="x-apple-disable-message-reformatting">
  <title>Recibo Pagamento via PIX</title>
<link rel="stylesheet" href="styles.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

</head>
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
                    <img style=" margin-right: 20px;" src="Media/gans2.png" alt="" width="" height="40px">
                  <!--  <svg width="64" height="64" style="border: 0; line-height: 100%; vertical-align: left;" viewBox="0 0 166 166" fill="none" xmlns="http://www.w3.org/2000/svg">
                       
<path d="M128.887 126.429C122.402 126.429 116.304 123.904 111.719 119.321L86.9306 94.5328C85.191 92.7877 82.1571 92.7931 80.4174 94.5328L55.5385 119.412C50.953 123.994 44.855 126.519 38.3705 126.519H33.4858L64.8803 157.914C74.6855 167.718 90.5825 167.718 100.388 157.914L131.873 126.429H128.887Z" fill="#32BCAD"/>
<path d="M38.3705 38.7476C44.8549 38.7476 50.953 41.2731 55.5376 45.8562L80.4166 70.739C82.2083 72.5308 85.1342 72.5385 86.9306 70.7367L111.719 45.9464C116.304 41.3633 122.402 38.8385 128.887 38.8385H131.872L100.388 7.35388C90.5824 -2.45126 74.6854 -2.45126 64.8803 7.35388L33.4866 38.7476H38.3705Z" fill="#32BCAD"/>
<path d="M157.914 64.8805L138.888 45.854C138.469 46.0219 138.015 46.1268 137.537 46.1268H128.887C124.414 46.1268 120.036 47.9403 116.876 51.1024L92.0874 75.8912C89.7686 78.2108 86.7207 79.3721 83.6752 79.3721C80.6273 79.3721 77.5818 78.2108 75.2622 75.8936L50.3809 51.0123C47.2204 47.8501 42.8433 46.0366 38.3705 46.0366H27.7337C27.2805 46.0366 26.8561 45.9294 26.4558 45.7786L7.35385 64.8805C-2.45128 74.6848 -2.45128 90.5818 7.35385 100.388L26.455 119.489C26.8553 119.338 27.2805 119.231 27.7337 119.231H38.3705C42.8433 119.231 47.2204 117.417 50.3809 114.255L75.2599 89.3762C79.7567 84.8833 87.5952 84.881 92.0874 89.3786L116.876 114.164C120.036 117.327 124.414 119.141 128.887 119.141H137.537C138.016 119.141 138.469 119.245 138.888 119.413L157.914 100.388C167.719 90.5818 167.719 74.6848 157.914 64.8805Z" fill="#32BCAD"/>
</svg>-->
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
                  <td class="sm-w-full sm-inline-block"  style="text-align: left;" width="100%"><p style="margin-bottom: -1px;margin-top: -1px;">Av. Universidad</p></td>
                </tr>
                <tr>
                  <td class="sm-w-full sm-inline-block" style="text-align: left;" width="100%"><p style="margin-bottom: -1px;margin-top: -1px; font-weight: 600;">Metodo de pago:</p></td>
                </tr>
                <tr>
                  <td class="sm-w-full sm-inline-block" style="text-align: left;" width="100%"><p style="margin-top: -1px;">Tarjeta de debito</p></td>
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
                  <td class="sm-w-full sm-inline-block" style="text-align: left;" width="100%"><p style="margin-top: -1px;margin-bottom: -1px;">MXN $2.00</p></td>
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
                <tr>
                  <td style="color: #718096;" width="50%">Ready player one</td>
                  <td style="font-weight: 600; text-align: right;" width="50%" align="right">MXN $5.00</td>
                </tr>
                <tr>
                  <td style="color: #718096;" width="50%">Mario bros</td>
                  <td style="font-weight: 600; text-align: right;" width="50%" align="right">MXN $5.00</td>
                </tr>

                   <!-- FIM Origem -->
                <tr>
                  <td style="padding-top: 12px; padding-bottom: 12px;">
                    <div style="background-color: #edf2f7; height: 2px; line-height: 2px;">&zwnj;</div>
                  </td>
                </tr>

                <tr>
                  <td style="color: #718096;" width="50%">Subtotal:</td>
                  <td style="font-weight: 600; text-align: right;" width="50%" align="right">MXN $10.00</td>
                </tr>
                <tr>
                  <td style="color: #718096;" width="50%">Impuesto:</td>
                  <td style="font-weight: 600; text-align: right;" width="50%" align="right">MXN $1.00</td>
                </tr>
                <tr>
                  <td style="font-weight: 600; padding-top: 32px; color: #000000; font-size: 20px;" width="50%">Total a pagar:</td>
                  <td style="font-weight: 600; padding-top: 32px; text-align: right;font-size: 20px;" width="50%" align="right">MXN$ 11.00</td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
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
    // ... (El resto de tu código JavaScript)

    // Función para generar el PDF
    function generarPDF() {
      // Crear una instancia de jsPDF
      var pdf = new jsPDF();

      // Obtener el contenido del cuerpo del documento
      var contenidoHTML = document.body.innerHTML;

      // Agregar el contenido al PDF
      pdf.fromHTML(contenidoHTML, 15, 15);

      // Abrir el PDF en una nueva ventana/tab o descargarlo directamente
      // (puedes ajustar esto según tus necesidades)
      pdf.output('dataurlnewwindow');
    }

    // ... (El resto de tu código JavaScript)
  </script>
</body>
</html>
