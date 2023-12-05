<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="wel.css">
    

</head>
<body>
    <?php
      // Iniciar la sesión
    if (!isset($_SESSION)) {
        session_start();
    }

    // Verificar si el nombre del usuario está presente en la sesión
    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        $username = $_SESSION['username'];
       echo "<h1>Bienvenido <strong>$username</strong></h1><br><br>";
       echo "<p><a href='../index.php'>Continuar</a></p>"; 
    }
    ?>
</body>
</html>


		



