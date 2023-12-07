<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualización de Contraseña</title>

    <style>
        body {
            background-color: #080808; /* Fondo oscuro */
            font-family: 'Arial', sans-serif;
            color: #fff; /* Color del texto */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #242424; /* Color de fondo del formulario */
            border: 2px solid #fff; /* Borde blanco */
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 300px;
        }

        input[type="submit"] {
            background-color: #008080; /* Color del botón en tonos azules */
            color: #fff; /* Color del texto del botón */
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #006666; /* Color del botón en tonos azules al pasar el ratón */
        }

        .sex{
            background-color: #242424; /* Color de fondo del formulario */
            border: 2px solid #fff; /* Borde blanco */
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 300px;
        }

        
    </style>
</head>
<body>
    





<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar las respuestas del formulario de recuperación de contraseña
    $respuesta_seguridad = $_POST['respuesta_seguridad'];
    $nuevo_password = $_POST['nuevo_password'];
    $confirmar_nuevo_password = $_POST['confirmar_nuevo_password'];
    $artista_registrado = $_POST['artista_registrado'];
    $username = $_POST['Usuario'];
    // Validar la respuesta de seguridad
    if (validar_respuesta_seguridad($respuesta_seguridad, $artista_registrado)) {

        // Realizar la actualización de la contraseña en la base de datos
        actualizar_contrasena($username, $nuevo_password);

        //echo "Contraseña actualizada exitosamente.";
        // Redirigir a index.php
    //header("Location: index.php");
    //exit(); // Asegura que no se ejecuten más instrucciones después de la redirección
// Mostrar el botón de continuar

echo "<form action='index.php' method='post'>";
echo "<p>Contraseña actualizada exitosamente.</p>";
echo "<input type='submit' value='Continuar'>";
echo "</form>";

    } else {
        echo "<p id=sex style= 'color: red';>La respuesta de seguridad no es correcta. Inténtalo de nuevo.</p>";
    }
}

function validar_respuesta_seguridad($respuesta, $artista_registrado) {
    // Aquí comparas la respuesta proporcionada con el artista registrado
    return $respuesta === $artista_registrado;
}

function actualizar_contrasena($username, $nuevo_password) {
    // Realizar la actualización de la contraseña y resetear los intentos fallidos en la base de datos
    $host = 'localhost';
    $usuario_db = 'root';
    $contrasena_db = '';
    $nombre_db = 'baseinventario.sql';

    $conexion = new mysqli($host, $usuario_db, $contrasena_db, $nombre_db);

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Actualizar la contraseña
    $salt = password_hash($nuevo_password, PASSWORD_BCRYPT);
    $stmt = $conexion->prepare("UPDATE usuarios SET hashed_password = ? WHERE username = ?");
    $stmt->bind_param("ss", $salt, $username);
    $stmt->execute();
    $stmt->close();

    // Resetear los intentos fallidos
    $stmt_reset_intentos = $conexion->prepare("UPDATE usuarios SET intentos_fallidos = 0 WHERE username = ?");
    $stmt_reset_intentos->bind_param("s", $username);
    $stmt_reset_intentos->execute();
    $stmt_reset_intentos->close();

    $conexion->close();
}

?>
</body>
</html>