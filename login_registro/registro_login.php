<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            background-color: #202020; /* Color de fondo inspirado en Marvel */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff; /* Color del texto */
        }

        .mensaje-error {
            background-color: #ff0000; /* Rojo brillante inspirado en Marvel */
            border: 2px solid #fff; /* Borde blanco */
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5); /* Sombra suave */
        }

        .mensaje-error h1 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #fff; /* Color del título */
        }

        body {
            background-color: #000; /* Fondo negro inspirado en Star Wars */
            font-family: 'Arial', sans-serif;
            color: #fff; /* Color del texto */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #111; /* Color de fondo del formulario */
            border: 2px solid #fff; /* Borde blanco */
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #ffe81f; /* Amarillo inspirado en Star Wars */
            color: #000; /* Color del texto del botón */
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #ffd000; /* Amarillo más oscuro al pasar el ratón */
        }
    </style>
</head>
<body>

<?php

$host = 'localhost';
$usuario_db = 'root';
$contrasena_db = '';
$nombre_db = 'baseinventario.sql';

$conexion = new mysqli($host, $usuario_db, $contrasena_db, $nombre_db);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}



// Registro de usuario
if (isset($_POST['form_type']) && $_POST['form_type'] === 'registro') {
    $nombre = $_POST['reg_nombre'];
    $apellido = $_POST['reg_apellido'];
    $username = $_POST['reg_username'];
    $email = $_POST['reg_email'];
    $artista = $_POST['reg_artista'];
    $password = $_POST['reg_password'];

    registrar_usuario($conexion, $nombre, $apellido, $username, $email, $artista, $password);
}

// Inicio de Sesión
if (isset($_POST['form_type']) && $_POST['form_type'] === 'login') {
    $username = $_POST['login_username'];
    $password = $_POST['login_password'];
    $user_captcha = $_POST['captcha_code'];
    if (isset($_POST['remember_me'])) {
        // El usuario marcó la casilla, entonces establece una cookie
        setcookie('rememberMe', '1', time() + (86400 * 30)); // Establece la cookie por 30 días
    } else {
        // El usuario no marcó la casilla, entonces borra la cookie si existe
        if (isset($_COOKIE['rememberMe'])) {
            setcookie('rememberMe', '', time() - 3600); // Borra la cookie
        }
    }
    

    // Obtener el valor del checkbox
    $remember_me = isset($_POST['remember_me']) ? $_POST['remember_me'] : 0;


    // Validar el código de verificación
    if (verificar_captcha($user_captcha)) {
        // El código de verificación es válido, continuar con la verificación del inicio de sesión
        verificar_login($conexion, $username, $password, $remember_me);
    } else {
        // El código de verificación es incorrecto, puedes redirigir al usuario o mostrar un mensaje de error
        echo "<div class='mensaje-error'>";
        echo "<h1>Error</h1>";
        echo "<p>Código de verificación incorrecto. Vuelve a intentarlo.</p>";
        echo "<p><a href='index.php'>Volver</a></p>";
        echo "</div>";
    }
}

// Función para verificar el código de verificación
function verificar_captcha($user_captcha) {
   // Obtener el código de verificación generado por capchat.php
   if (isset($_SESSION['captcha']) && !empty($_SESSION['captcha'])) {
    return strcasecmp($_SESSION['captcha'], $user_captcha) === 0;
} else {
    return false;
}
}


function registrar_usuario($conexion, $nombre, $apellido, $username, $email, $artista, $password) {
    $rol = 'user';  // Asignar el rol por defecto al registrar un nuevo usuario
    $salt = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellido, username, email, artista, hashed_password, rol) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $nombre, $apellido, $username, $email, $artista, $salt, $rol);
    $stmt->execute();
    $stmt->close();

     // Iniciar sesión y almacenar el nombre de usuario
     session_start();
     $_SESSION['username'] = $username;
     
     // Suponiendo que ya has verificado las credenciales del usuario y tienes su rol
// en una variable llamada $user_role obtenida de la base de datos.



 
     // Redirigir a la página bienvenida.php
     header("Location: bienvenida.php");
     exit();
    ///Aqui mandarlo al menu

}



function verificar_login($conexion, $username, $password, $remember_me) {
    $max_intentos = 2;

    $stmt = $conexion->prepare("SELECT id, hashed_password, intentos_fallidos, artista, rol FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id, $stored_hashed_password, $intentos_fallidos, $artista, $rol);
    $stmt->fetch();
    $stmt->close();


    if ($intentos_fallidos >= $max_intentos) {
        mostrar_pregunta_seguridad($artista, $username);
        return;
    }

    if ($stored_hashed_password !== null && password_verify($password, $stored_hashed_password)) {
        // Inicio de sesión exitoso
        resetear_intentos_fallidos($conexion, $user_id);

        // Inicia sesión y almacena el nombre de usuario y el rol
        $_SESSION['username'] = $username;
        // Aquí guardas el rol en la sesión
        $_SESSION['rol'] = $rol;
        
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['username'] = $username;
        if ($remember_me) {
            setcookie("username", $username, time() + 3600 * 24 * 30, "/"); // Ejemplo de cookie para el nombre de usuario, válida por 30 días
        }

        header("Location: ../index.php");
        exit();
    } else {
        // Inicio de sesión fallido
        incrementar_intentos_fallidos($conexion, $user_id);
        echo "<div class='mensaje-error'>";
        echo "Inicio de sesión fallido. Nombre de usuario o contraseña incorrectos.<br>";
        echo "<p><a href='index.php'>Volver</a></p>";
        echo "</div>";

        if ($intentos_fallidos + 1 >= $max_intentos) {
            mostrar_pregunta_seguridad($artista, $username);
        }
    }
}
?>
<script>
function validarFormulario() {
    var password = document.getElementById("password").value;
            var repeatPassword = document.getElementById("repeatPassword").value;
            var mensajeError = document.getElementById("mensajeError");

            if (password !== repeatPassword) {
                mensajeError.innerHTML = "<p style= 'color: red';>Las contraseñas no coinciden.</p>";
                return false; // Evitar que el formulario se envíe si las contraseñas no coinciden
            } else {
                mensajeError.innerHTML = "";
                return true; // Permitir que el formulario se envíe si las contraseñas coinciden
            }
}
</script>
<?php
function mostrar_pregunta_seguridad($artista, $username) {
    // Muestra la pregunta de seguridad al usuario
   // echo "$username";
   echo "<form action='recuperar_contrasena.php' method='post' onsubmit='return validarFormulario()'>";
   echo "Tu cuenta ha sido bloqueada debido a múltiples intentos fallidos.<br>";
    echo "Por razones de seguridad, se requiere responder la siguiente pregunta:";
    echo "<p>Pregunta: Cual es tu artista favorito</p><br>";
    
    echo "<label for='respuesta_seguridad'>Respuesta: </label>";
    echo "<input type='text' name='respuesta_seguridad' required>";
    echo "<br><label for='nuevo_password'>Nuevo Password: </label>";
    echo "<input type='password' name='nuevo_password' id='password' required>";
    echo "<br><label for='confirmar_nuevo_password'>Confirmar Nuevo Password: </label>";
    echo "<input type='password' name='confirmar_nuevo_password' id='repeatPassword' required>";
    echo "<input type='hidden' name='artista_registrado' value='$artista'>";
    echo "<input type='hidden' name='Usuario' value='$username'>";
    /*<!-- Mensaje de ayuda en caso de no coincidir las contraseñas -->*/
    echo "<div id='mensajeError' style='color: black;'></div>";
    echo "<input type='submit' value='Recuperar Contraseña'>";
    echo "</form>";
}



function incrementar_intentos_fallidos($conexion, $user_id) {
    $stmt = $conexion->prepare("UPDATE usuarios SET intentos_fallidos = intentos_fallidos + 1 WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
}

function resetear_intentos_fallidos($conexion, $user_id) {
    $stmt = $conexion->prepare("UPDATE usuarios SET intentos_fallidos = 0 WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
}
$conexion->close();

?>
</body>
</html>