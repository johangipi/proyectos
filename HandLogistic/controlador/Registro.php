<?php
require_once '../conexion/conexion.php';
require_once '../modelo/Persona.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    $persona = new Persona();
    $persona->setNombre($nombre);
    $persona->setApellido($apellido);
    $persona->setEmail($email);
    $persona->setContrasena($contrasena);

    $conexion = new Conexion();
    $sql = "INSERT INTO personas (nombre, apellido, email, contrasena) VALUES ('" . $persona->getNombre() . "', '" . $persona->getApellido() . "', '" . $persona->getEmail() . "', MD5('" . $persona->getContrasena() . "'))";
    $conexion->insertarActualizarEliminar($sql);
    $conexion->cerrar();

    header('Location: ../vista/index.php');
    exit();
}
?>
