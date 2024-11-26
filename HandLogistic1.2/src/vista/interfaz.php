<?php 
require_once __DIR__ . '/../../vendor/autoload.php';
session_start();
use conexion\Conexion;

// Obtener categorías de la base de datos
$conexion = new Conexion();
$sql = "SELECT id, nombre FROM categoria";
$categoria = $conexion->consultar($sql); 
$conexion->cerrar();

if (!is_array($categoria)) { 
    $categoria = []; 
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Registro de Producto</title>
    <link href="../vista/css/formulario.css" rel="stylesheet"> 
    <link href="../vista/css/estilos.css" rel="stylesheet">
</head>
<body>
    <?php include 'MenuUsuario.php'; ?>
                
    <h1>Registro de Producto</h1>
    <form action="../controlador/ControladorProducto.php" method="post" id="interfaz">
        <label for="nombre">Nombre del Producto:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="item">Ítem:</label><br>
        <input type="text" id="item" name="item" required><br><br>

        <label for="categoria">Categoría:</label><br>
        <select name="categoria" id="categoria" class="form-control" required>
            <option value=""> --Seleccione una opción-- </option>
            <?php
            foreach ($categoria as $val_categoria) {
                echo "<option value=\"" . htmlspecialchars($val_categoria['id']) . "\">" . htmlspecialchars($val_categoria['nombre']) . "</option>";
            }
            ?>
        </select><br><br>

        <label for="ubicacion">Ubicación:</label><br>
        <input type="text" id="ubicacion" name="ubicacion" required><br><br>

        <label for="cantidad">Cantidad:</label><br>
        <input type="number" id="cantidad" name="cantidad" required><br><br>

        <input type="hidden" name="action" value="registrarProducto">
        <input type="submit" value="Registrar Producto">        
    </form>
</body>
</html>
