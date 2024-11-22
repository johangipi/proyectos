<?php 
require_once '../conexion/conexion.php';
// Consulta para obtener las categorias
$conn = new mysqli("localhost", "root", "", "ejercicio");
$categoria = $conn->query("SELECT * FROM categoria");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
        <link href="../vista/css/formulario.css" rel="stylesheet"> 
        <link href="../vista/css/estilos.css" rel="stylesheet">
    </head>
    <body>
    <?php include 'MenuUsuario.php'; ?>
                
    <h1>Registro de Producto</h1>
    <form action="../controlador/RegistrarProducto.php" method="post" class="formProducto">

        

        <label for="nombre">Nombre del Producto:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="item">Ítem:</label><br>
        <input type="text" id="item" name="item" required><br><br>

            <label for="categoria">Categoría:</label><br>
            <select name="categoria" id="categoria" class="from-control">
            <option value=""> --Seleccione una opción -- </option>
                <?php
                foreach($categoria as $val_categoria){
                    ?>
                    <option value="<?= $val_categoria['id'] ?>"><?= $val_categoria['nombre']?></option>
                    <?php
                }
                ?>
            </select><br><br>
        

        <label for="ubicacion">Ubicación:</label><br>
        <input type="text" id="ubicacion" name="ubicacion" required><br><br>

        <label for="cantidad">Cantidad:</label><br>
        <input type="number" id="cantidad" name="cantidad" required><br><br>

        <input type="submit" value="Registrar Producto">        
    </form>

    </body>
</html>