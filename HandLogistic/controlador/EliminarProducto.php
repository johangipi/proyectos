<?php
session_start();
require_once '../conexion/conexion.php';
require_once '../modelo/Producto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'delete') {
    $id = intval($_POST['id']);

    $conexion = new Conexion();
    $sql = "DELETE FROM producto WHERE id = ?";
    $statement = $conexion->prepare($sql);
    $statement->execute([$id]);

    header('Location: ../vista/inventario.php'); // Redirigir de nuevo a la vista de inventario
    exit();
}
?>
