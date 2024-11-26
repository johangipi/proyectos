<?php

namespace controlador; 
require __DIR__ . '/../../vendor/autoload.php';
session_start();
use conexion\conexion;
use modelo\Persona;
use PDO;
  
class Controlador { 
    
    public function login() { 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL); 
            $contrasena = filter_input(INPUT_POST, 'contrasena', FILTER_SANITIZE_SPECIAL_CHARS); 
            
            $persona = new Persona(); 
            $persona->setEmail($email); 
            $persona->setContrasena($contrasena); 
            
            $conexion = new conexion(); 
            $query = $persona->credenciales(); 
            $stmt = $conexion->prepare($query); 
            $stmt->execute(); 
            $result = $stmt->fetch(PDO::FETCH_ASSOC); 
            
            if ($result) { 
                // Obtener el ID del usuario
                $idUsuario = $result['id']; 
                // Asegúrate de que 'id' es el nombre de la columna del ID en tu base de datos 
                $email = $result['email']; 
                // Iniciar sesión y almacenar el ID del usuario en la sesión 
                session_start(); 
                $_SESSION['idUsuario'] = $idUsuario; 
                $_SESSION['email'] = $email;
                header('Location: /src/vista/home.php'); 
                exit(); 
            } else { 
                echo "Email o contraseña incorrectos."; 
            } $conexion->cerrar(); 
        } 
    }

public function cerrarSesion() { 
        if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') { 
            session_start(); 
            session_unset(); 
            session_destroy(); 
            header('Location: ../vista/index.php'); 
            exit(); 
        } 
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS); 
    $controlador = new Controlador(); 
    switch ($action) { 
        case 'login': 
            $controlador->login(); 
            break;  
        case 'cerrarSesion': 
            $controlador->cerrarSesion(); 
            break; 
        default: 
            echo "Acción no reconocida."; 
            break; 
        }
    }

?>