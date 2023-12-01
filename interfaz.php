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
    <form action="agregar_producto.php" method="post">
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

    <label for="imagen">Imagen:</label>
    <input type="text" name="imagen" required>

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
include 'config.php';
            
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
