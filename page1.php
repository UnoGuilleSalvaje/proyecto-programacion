<?php
//Verifica si la entrada remember del formulario enviado no está vacía. Esto implica que el usuario marcó la opción "recordar" en el formulario.
if(!empty($_POST["remember"])){
    //Establece una cookie llamada "username" con el valor enviado en el formulario. Establece la cookie para que expire en una hora (3600 segundos).
    setcookie("username", $_POST["username"], time()+ 3600);
    //Establece una cookie llamada "password" con el valor enviado en el formulario. Establece la cookie para que expire en una hora (3600 segundos).
    setcookie("password", $_POST["password"], time()+ 3600);
    echo "Cookies Set Successfuly";
}else{
    //Establece la cookie "username" con un valor vacío, borrando la cookie
    setcookie("username", "");
    //Establece la cookie "password" con un valor vacío, borrando la cookie
    setcookie("password","");
    echo "Cookies Not Set";
}

?>

<p><a href="login.php">Go to Login Page</a></p>