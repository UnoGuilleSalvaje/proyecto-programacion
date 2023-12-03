<?php
   session_start();
     
    $servidor='localhost';
    $cuenta='root';
    $password='';
    $bd='productos';
     
    $_SESSION['id'] = '';
    $_SESSION['nom'] = '';
    $_SESSION['des'] = '';
    $_SESSION['pre'] = '';
    $_SESSION['cant'] = '';
    $_SESSION['agot'] = '';
    $_SESSION['img'] = '';
    $_SESSION['tdes'] = '';
    $_SESSION['des'] = '';
   
    $conexion = new mysqli($servidor,$cuenta,$password,$bd);

    if ($conexion->connect_errno){
         die('Error en la conexion');
    }
    if(isset($_POST['submit'])){
        $modificar=$_POST['modificar'];
        $_SESSION['modificar2']=$modificar;
        $sql2="SELECT *
        FROM productos
        WHERE id='$modificar'";
        $resultado=$conexion->query($sql2);
        while($fila=$resultado->fetch_assoc()){
            $_SESSION['id'] =$fila['id'];
            $_SESSION['nom'] =$fila['nombre'];
            $_SESSION['dec'] = $fila['descripcion'];
            $_SESSION['pre'] = $fila['precio'];
            $_SESSION['cant'] = $fila['cantidadExistencia'];
            $_SESSION['agot'] = $fila['agotado'];
            $_SESSION['img'] = $fila['imagen'];
            $_SESSION['tdes'] = $fila['tiene_descuento'];
            $_SESSION['des'] = $fila['descuento'];
        }

    }

    if(isset($_POST['mod'])){
        $uno=$_POST['id2'];
        $dos=$_POST['nombre2'];
        $tres=$_POST['descripcion2'];
        $cuatro=$_POST['precio2'];
        $cinco=$_POST['cantidad_existencia2'];
        $seis=$_POST['agotado2'];
        $siete=$_POST['imagen2'];
        $ocho=$_POST['tiene_descuento2'];
        $nueve=$_POST['descuento2'];
        $modificar=$_SESSION['modificar2'];

        $ne = "UPDATE productos
        SET id='$uno',nombre='$dos',descripcion='$tres',precio='$cuatro',cantidad='$cinco',agotado='$seis',imagen='$siete',tiene_descuento='$ocho',descuento='$nueve'
        WHERE id='$modificar'";
        $fin=$conexion->query($ne);
    }
    // Crear producto
    function agregarProducto($nombre, $descripcion, $precio, $cantidadExistencia, $agotado, $imagen, $tieneDescuento, $descuento) {
        global $conexion;
        $sql = "INSERT INTO productos (nombre, descripcion, precio, cantidad_existencia, agotado, imagen, tiene_descuento, descuento)
                VALUES ('$nombre', '$descripcion', $precio, $cantidadExistencia, $agotado, '$imagen', $tieneDescuento, $descuento)";
        $result = $conexion->query($sql);
        return $result;
    }
    
    // Obtener todos los productos
    function obtenerProductos() {
        global $conexion;
        $sql = "SELECT * FROM productos";
        $result = $conexion->query($sql);
        $productos = [];
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }
        }
    
        return $productos;
    }
    
    // Actualizar producto
    function actualizarProducto($id, $nombre, $descripcion, $precio, $cantidadExistencia, $agotado, $imagen, $tieneDescuento, $descuento) {
        global $conexion;
        $sql = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio=$precio,
                cantidad_existencia=$cantidadExistencia, agotado=$agotado, imagen='$imagen',
                tiene_descuento=$tieneDescuento, descuento=$descuento
                WHERE id=$id";
        $result = $conexion->query($sql);
        return $result;
    }
    
    // Eliminar producto
    function eliminarProducto($id) {
        global $conexion;
        $sql = "DELETE FROM productos WHERE id=$id";
        $result = $conexion->query($sql);
        return $result;
    }
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em 0;
        }

        h1 {
            margin: 0;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        textarea,
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: #3498db;
            margin-left: 10px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Administración de Productos</h1>
    </header>

    <!-- Formulario para agregar producto -->
    <main>
    <form action="config.php" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required>
    
    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" required></textarea>
    
    <label for="precio">Precio:</label>
    <input type="number" name="precio" required>

    <label for="cantidad_existencia">Cantidad en existencia:</label>
    <input type="number" name="cantidad_existencia" required>

    <label for="agotado">Agotado:</label>
    <select name="agotado" required>
        <option value="0">No</option>
        <option value="1">Sí</option>
    </select>

    <label for="file">Subir la imagen</label>    
    <input type="file" name="file" id="file" class="form-control-file"   >

    <label for="tiene_descuento">Tiene descuento:</label>
    <select name="tiene_descuento" required>
        <option value="0">No</option>
        <option value="1">Sí</option>
    </select>
        <!-- Lista de productos -->
        <h2>Lista de Productos</h2>
        <ul>
        <button type="submit">Agregar Producto</button>
        <?php        
$productos = obtenerProductos();

foreach ($productos as $producto) {
    echo "<li>ID: {$producto['id']} - Nombre: {$producto['nombre']} - Descripción: {$producto['descripcion']} - 
          Cantidad en existencia: {$producto['cantidad_existencia']} - Agotado: {$producto['agotado']} - 
          Precio: {$producto['precio']} - Imagen: {$producto['imagen']} - Tiene descuento: {$producto['tiene_descuento']} - 
          Descuento: {$producto['descuento']}% 
          <a href='editar_producto.php?id={$producto['id']}'>Editar</a> 
          <a href='eliminar_producto.php?id={$producto['id']}'>Eliminar</a></li>";
}
?>
        
        </ul>
    </main>
</body>
</html>
