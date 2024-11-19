<?php
session_start();
require_once '../conexion/conexion.php'; // Ajusta la ruta si es necesario
require_once '../modelo/Persona.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    $persona = new Persona();
    $persona->setEmail($email);
    $persona->setContrasena($contrasena);

    $conexion = new Conexion();
    $query = $persona-> credenciales();
    $result = $conexion-> consultar($query); 

    foreach($result as $value){
    
        if ($value['id'] != null) {
            // Credenciales correctas
            iniciarVariables($value['id'], $value['email']);

            header('Location: ../vista/home.php'); // Redirigir a la página de inicio
            exit();
        } else {
            // Credenciales incorrectas
            echo 'Email o contraseña incorrectos.';
        }

    }
    
}

    function iniciarVariables($idUsuario, $email){
        session_start();
        $_SESSION['idUsuario'] = $idUsuario;
        $_SESSION['email'] = $email;
        header('Location: ../vista/home.php');
}

$conexion->cerrar();
