<?php 
require_once '../conexion/conexion.php';
// Consulta para obtener las categorias
$conn = new mysqli("localhost", "root", "", "ejercicio");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-form {
            display: inline;
        }

        .action-button {
            padding: 5px 10px;
            margin: 2px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .action-button.decrease {
            background-color: #4CAF50; /* Verde */
            color: white;
        }

        .action-button.delete {
            background-color: #f44336; /* Rojo */
            color: white;
        }

        .action-button:hover {
            opacity: 0.8;
        }
    </style>
    <link href="../css/estilos.css" rel="stylesheet">
</head>
<body>
<?php include 'MenuUsuario.php'; ?>
    <h1>Inventario de Productos</h1>
    <table class="tabla_usuarios">
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Incluir la conexión y modelo de Producto
            require_once '../conexion/conexion.php';
            require_once '../modelo/Persona.php';

            // Obtener los productos de la base de datos
            $conexion = new Conexion();
            $sql = "SELECT * FROM personas";
            $result = $conexion->consultar($sql);

            // Mostrar los productos en la tabla
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                echo "<td>" . htmlspecialchars($row['apellido']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>";
                echo "<form class='form_boton' method='POST' action='../controlador/EliminarUsuario.php' style='display:inline;'>";
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<button type='submit' name='action' value='delete'>Eliminar</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }

            $conexion->cerrar();
            ?>
        </tbody>
    </table>
</body>
</html>
