<?php
session_start();
require_once '../conexion/conexion.php';
require_once '../modelo/Producto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUsuario = $_SESSION['idUsuario'];
    $nombre = $_POST['nombre'];
    $item = $_POST['item'];
    $categoria = $_POST['categoria'];
    $ubicacion = $_POST['ubicacion'];
    $cantidad = intval($_POST['cantidad']);
    

    if ($idUsuario === null) {
        echo 'Error: ID de usuario no encontrado en la sesión.';
        exit();
    }

    $producto = new Producto($nombre, $item, $categoria, $ubicacion, $cantidad, $idUsuario);
    $query = $producto->registrarProducto();
    
    $conexion = new Conexion();
    $statement = $conexion->prepare($query);
    $result = $statement->execute();

    if ($result) {
        echo 'Producto registrado correctamente. ID de Usuario: ' . $idUsuario;
        header('Location: ../vista/interfaz.php');
        exit();
    } else {
        echo 'Error al registrar el producto.';
    }

    $conexion->cerrar();
}
?>

    