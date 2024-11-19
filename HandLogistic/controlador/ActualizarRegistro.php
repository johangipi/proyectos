<?php
session_start();
require_once '../conexion/conexion.php';
require_once '../modelo/Persona.php';

$persona = new Persona(); 
$persona2 = new Persona(); 

$conexion = new Conexion();
$sql = "SELECT * FROM personas WHERE email = '" . $_SESSION['email'] . "'";
$result = $conexion->consultar($sql);

// Depuración: Verifica el resultado de la consulta inicial
if ($result && count($result) > 0) {
    $persona2->setNombre($result[0]['nombre']);
    $persona2->setApellido($result[0]['apellido']);
    $persona2->setEmail($result[0]['email']);
    $persona2->setContrasena($result[0]['contrasena']);
} else {
    die("No se encontraron resultados para el email: " . $_SESSION['email'] . "<br>");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    $persona->setNombre($nombre);
    $persona->setApellido($apellido);
    $persona->setEmail($email);
    $persona->setContrasena($contrasena);

    $sql = $persona->actualizar();

    // Depuración: Imprime la consulta SQL
    //die("Consulta SQL: $sql<br>");
    
    $statement = $conexion->prepare($sql);
    // Depuración: Verifica si el statement se prepara correctamente
    if (!$statement) {
        die("Error al preparar la consulta: " . $conexion->$errorInfo()[2] . "<br>");
    }
    
    $result = $statement->execute();

    // Depuración: Verifica el resultado de la consulta
    if ($result) {
        echo "Registro actualizado correctamente.<br>";
        header('Location: ../vista/home.php');
        exit();
    } else {
        $errorInfo = $statement->errorInfo();
        die("Error al actualizar el registro: " . $errorInfo[2] . "<br>");
    }

    $conexion->cerrar();
}
?>
