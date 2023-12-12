<head>
    <link rel="stylesheet" href="estilosGACH.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
</head>
<!-- Inicio del formulario con clases -->
<div class="home-link">
  <a href="index.php">
    <img src="imagesGACH/logo.jpg">
  </a>
</div>

<div class="login-box">
    <h2>Login</h2>
    <form action="page1.php" method="post" class="styled-form">
        <!-- Campo de entrada para el nombre de usuario -->
        <div class="user-box">
            <input type="text" name="username" id="username" required
                   value="<?php if (isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>">
            <label for="username">Username</label>
        </div>
        <br>

        <!-- Campo de entrada para la contraseña -->
        <div class="user-box">
            <input type="password" name="password" id="password" required
                   value="<?php if (isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>">
            <label for="password">Password</label>
        </div>
        <br>

        <!-- Checkbox para recordar el usuario y la contraseña -->
<div class="checkbox-container">
    <input type="checkbox" name="remember" id="remember" class="checkbox">
    <label for="remember" class="checkbox-label">Recordar usuario y contraseña</label>
</div>

        <br>
        
        <!-- Botón para enviar el formulario -->
        <a href="javascript:void(0);" onclick="document.querySelector('.styled-form').submit();">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Login
        </a>
    </form>
</div>

