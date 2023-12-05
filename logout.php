<?php
// Inicia la sesión
session_start();

// Vacía y destruye la sesión
$_SESSION = array();
session_destroy();

// Redirige al usuario a la página de inicio (o cualquier otra página que elijas)
header("Location: index.php");
exit();
?>
