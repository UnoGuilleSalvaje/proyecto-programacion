<!--Aqui va el menu o La pagian que quieran unir y si lo quieren cambiar de pagina esta en registro_login.php-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">
<link href="//cloud.typenetwork.com/projects/2153/fontface.css/" rel="stylesheet" type="text/css">
<style>
    

.bentonsansextracompressedblack {
    font-family: "Benton Sans Ex Comp Bla";
    font-style: Normal;
    font-weight: Normal;
}
@keyframes zoomOut {
            0% {
                transform: scale(2.0);
            }

            100% {
                transform: scale(1.0);
            }
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }

        .fadeOut {
            animation-name: fadeOut;
            animation: fadeOut 9s 1; /* Solo una iteración */
        }

        .gif {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            animation: fadeOut 9s 1; /* Solo una iteración */
        }

        /* Nuevos estilos */

        html {
            background: #550703;
            width: 100%;
            height: 100%;
            overflow-x: hidden;
            overflow-y: hidden;
        }

        .wrapper {
            margin-top: 10%;
        }

        .marvel {
            border: solid 1px #fff;
            padding: 8px 4px 0 0;
            animation: zoomOut 9s ease-in-out 1; /* Solo una iteración */
            margin: auto auto;
            text-align: center;
            color: #fff;
            width: 1000px;
            margin-top: 50px;
            font-size: 15em;
            line-height: .80;
            font-family: "Benton Sans Ex Comp Bla", sans-serif;
        }

        .studios {
            font-family: "Orbitron", sans-serif;
            animation: zoomOut 9s ease-in-out 1; /* Solo una iteración */
            font-weight: bolder;
            color: #fff;
            letter-spacing: 67px;
            text-align: center;
            position: relative;
            margin: 7px 15px 7px 85px;
        }

        body {
            background: #550703;
        }
    </style>
</head>
<body>
    <?php
    // bienvenida.php

    // Iniciar la sesión
    session_start();

    // Verificar si el nombre del usuario está presente en la sesión
    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo "<div class='wrapper'>";
        echo "<div class='marvel fadeOut'>GANDS</div>";
        echo "<div class='studios fadeOut'>Movies</div><br>";
        echo "<div  class='studios fadeOut'>!Bienvenido: </div><br>";
        echo "<div style='color: yellow'; class='studios fadeOut'> $username</div><br>";
        echo "<p class='studios fadeOut'><a href='../index.php'>Continuar</a></p>";
        echo "</div>";
       
    } else {
        // Si el nombre del usuario no está presente en la sesión, mostrar un mensaje predeterminado
        echo "¡Bienvenido! Registro exitoso.";
    }
    ?>
</body>
</html>