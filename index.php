<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Carrito de Compras</h1>
        <button onclick="logout()">Cerrar Sesión</button>
    </header>

    <main>
        <h2>Productos</h2>
        <ul id="productos-lista"></ul>

        <h2>Agregar Producto</h2>
        <form id="formulario-producto">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="precio">Precio:</label>
            <input type="number" step="0.01" id="precio" name="precio" required>

            <button type="button" onclick="agregarProducto()">Agregar</button>
        </form>
    </main>

    <script src="script.js"></script>
</body>
</html>
