<?php
   session_start();
     
    $servidor='localhost';
    $cuenta='root';
    $password='';
    $bd='productos';
     
    $_SESSION['id'] = '';
    $_SESSION['nom'] = '';
    $_SESSION['cue'] = '';
    $_SESSION['con'] = '';
   
    $conexion = new mysqli($servidor,$cuenta,$password,$bd);

    if ($conexion->connect_errno){
         die('Error en la conexion');
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