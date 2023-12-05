<?php session_start();  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway|Ubuntu" rel="stylesheet">

    <!-- Estilos -->
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="Style6.css">
    <link rel="shortcut icon" href="../media/g.png" type="image/x-icon" >
    <script src="js/load_captcha.js"></script>
    <style>
    .recordar-checkbox {
        margin-top: 10px;
        margin-bottom: 5px; /* Ajusta la distancia entre el checkbox y el texto */
  
    }
    #mi_parrafo span {
    color: white;
}

</style>


    <title>Formulario Login y Registro de Usuarios</title>
</head>
<body>  

    <header class="top-header"></header>
    <div class="home-link">
        <a href="../index.php">
            <img src="../imagesGACH/logo.jpg">
        </a>
    </div>
    <br><br><br><br>
      <div>
        <div class="starsec"></div>
        <div class="starthird"></div>
        <div class="starfourth"></div>
        <div class="starfifth"></div>
      </div>

     
   <!-- Formularios -->
    <div class="contenedor-formularios">
        <!-- Links de los formularios -->
        <ul class="contenedor-tabs">
            <li class="tab tab-segunda active"><a href="#iniciar-sesion">Iniciar Sesión</a></li>
            <li class="tab tab-primera"><a href="#registrarse">Registrarse</a></li>
        </ul>

        <!-- Contenido de los Formularios -->
        <div class="contenido-tab">
            <!-- Iniciar Sesion -->
            
            <div id="iniciar-sesion">
    <h1>Iniciar Sesión</h1>
    <form action="registro_login.php" method="post">
        <input type="hidden" name="form_type" value="login"> <!-- Campo oculto para identificar el tipo de formulario -->
        <!-- Usuario -->
<div class="contenedor-input">
    <label>
        Usuario <span class="req">*</span>
    </label>
    <?php
    // Verificar si hay una cookie de usuario almacenada
    $default_username = "";
    if (isset($_COOKIE['username'])) {
        $default_username = $_COOKIE['username'];
    }
    ?>
    <input type="text" name="login_username" value="<?php echo $default_username; ?>" required>
</div>

        <div class="contenedor-input">
            <label>
                Contraseña <span class="req">*</span>
            </label>
            <input type="password" name="login_password" required>
        </div>

        <div class="contenedor-input">
    <label>
        Código de Verificación <span class="req">*</span>
    </label>
    <input type="text" name="captcha_code" required>
</div>
<!--<img src="capchat.php" alt="Captcha"> -->
<img style="border: 1px solid #D3D0D0" src="capchat.php?rand=<?php echo rand(); ?>" id='captcha'>

<div class="checkbox-container">
    <input type="checkbox" style="margin-left: -250px;" name="remember_me" id="remember_me" class="recordar-checkbox">
    <span for="remember_me" style="margin-left: 40px;" class="checkbox-label">Recordar usuario y contraseña</span>
</div>



<div class="col-md-8"><br>
       <a href="javascript:void(0)" id="reloadCaptcha">Recargar codigo</a> 
    </div>
        <p class="forgot"><a href="#">Se te olvidó la contraseña?</a></p>
        <input type="submit" class="button button-block" value="Iniciar Sesión">
        
    </form>
</div>
       <!-- Registrarse -->
<div id="registrarse">
    <h1>Registrarse</h1>
    <form action="registro_login.php" method="post" onsubmit="return validarFormulario()">
        <input type="hidden" name="form_type" value="registro"> <!-- Campo oculto para identificar el tipo de formulario -->
        <div class="fila-arriba">
            <div class="contenedor-input">
                <label>
                    Nombre <span class="req">*</span>
                </label>
                <input type="text" name="reg_nombre" required>
            </div>

            <div class="contenedor-input">
                <label>
                    Apellido <span class="req">*</span>
                </label>
                <input type="text" name="reg_apellido" required>
            </div>
        </div>
        <div class="contenedor-input">
            <label>
                Usuario <span class="req">*</span>
            </label>
            <input type="text" name="reg_username" required>
        </div>
        <div class="contenedor-input">
            <label>
                Email <span class="req">*</span>
            </label>
            <input type="email" name="reg_email" required>
        </div>
        <div class="contenedor-input">
            <label>
                Artista favorito (Pregunta de seguridad) <span class="req">*</span>
            </label>
            <input type="text" name="reg_artista" required>
        </div>
        <div class="contenedor-input">
            <label>
                Contraseña <span class="req">*</span>
            </label>
            <input type="password" name="reg_password" id="password" required> <!-- Añade id="password" -->
        </div>

        <div class="contenedor-input">
            <label>
                Repetir Contraseña <span class="req">*</span>
            </label>
            <input type="password" name="reg_repeat_password" id="repeatPassword" required> <!-- Añade id="repeatPassword" -->
        </div>

        <!-- Mensaje de ayuda en caso de no coincidir las contraseñas -->
        <div id="mensajeError" style="color: Yellow;"></div>

        <input type="submit" class="button button-block" value="Registrarse">
    </form>

    <!-- Script JavaScript para validar las contraseñas -->
    <script>
        function validarFormulario() {
            var password = document.getElementById("password").value;
            var repeatPassword = document.getElementById("repeatPassword").value;
            var mensajeError = document.getElementById("mensajeError");

            if (password !== repeatPassword) {
                mensajeError.innerHTML = "Las contraseñas no coinciden.";
                return false; // Evitar que el formulario se envíe si las contraseñas no coinciden
            } else {
                mensajeError.innerHTML = "";
                return true; // Permitir que el formulario se envíe si las contraseñas coinciden
            }
        }
        </script>
 



     </div>
        </div>
    </div>
    </div>

   <script src="jquery.js"></script>
   <script src="js/main.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script id="rendered-js">
    $(document).ready(function () {
    
      $(".contenedor-formularios").find("input, textarea").on("keyup blur focus", function (e) {
    
        var $this = $(this),
        label = $this.prev("label");
    
        if (e.type === "keyup") {
          if ($this.val() === "") {
            label.removeClass("active highlight");
          } else {
            label.addClass("active highlight");
          }
        } else if (e.type === "blur") {
          if ($this.val() === "") {
            label.removeClass("active highlight");
          } else {
            label.removeClass("highlight");
          }
        } else if (e.type === "focus") {
          if ($this.val() === "") {
            label.removeClass("highlight");
          } else
          if ($this.val() !== "") {
            label.addClass("highlight");
          }
        }
    
      });
    
      $(".tab a").on("click", function (e) {
    
        e.preventDefault();
    
        $(this).parent().addClass("active");
        $(this).parent().siblings().removeClass("active");
    
        target = $(this).attr("href");
    
        $(".contenido-tab > div").not(target).hide();
    
        $(target).fadeIn(600);
    
      });
    
    });
    //# sourceURL=pen.js
        </script>
</body>
</html>
