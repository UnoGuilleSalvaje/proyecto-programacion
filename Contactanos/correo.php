<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>

    body{
        background-image: url(../imagesGACH/fondo3.jpg);
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
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host = 'smtp-mail.outlook.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'vanianayeli2011@hotmail.com';
        $mail->Password = 'Vamozunapa555';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('vanianayeli2011@hotmail.com', 'GANDS MOVIES');

        $mail->addAddress($email, $name); 

        $mail->isHTML(true); // Debes activar el HTML para el correo.
$mail->CharSet = 'UTF-8'; // Asegúrate de establecer la codificación a UTF-8.

// Agregar imagen al principio del mensaje HTML
$bodyContent = '<img src="https://drive.google.com/uc?export=view&id=1KovmA3D_g4DXx8gwMlChlRB_UBeDCtFG" alt="GANDS MOVIES" width="200"><br>';


$mail->Subject = '¡Gracias por Contactarnos!';
$message = "Hemos recibido su mensaje y queremos asegurarle que le daremos seguimiento a la brevedad posible. 
Si su consulta requiere una respuesta urgente, nos esforzaremos en proporcionarle la información necesaria en el menor tiempo posible.
Valoramos su elección de GANDS MOVIES y nos comprometemos a brindarle el mejor servicio. Esperamos poder asistirle en todo lo que requiera.
Atentamente, El Equipo de GANDS MOVIES";

// Concatena el cuerpo del mensaje con la información del usuario
$bodyContent .= nl2br("Email: " . htmlspecialchars($email) . "\nEstimado usuario: " . htmlspecialchars($message));
$mail->Body = $bodyContent;

$mail->send();

        ?>
            <div class="alert alert-custom" role="alert">
    <strong>Éxito!</strong> Mensaje enviado correctamnte, en brevedad lo atenderemos <br><br>
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
    } catch (Exception $e) {
?>
<div class="alert alert-custom" role="alert">
<strong>Oh no!</strong> Error al enviar el mensaje. <br><br>
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
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>