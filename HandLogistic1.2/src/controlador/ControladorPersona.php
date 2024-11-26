<?php 
namespace controlador; 
require __DIR__ . '/../../vendor/autoload.php';
use conexion\conexion;
use modelo\Persona;
use PDO;

class ControladorPersona {
    
    public function registro(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
            $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS); 
            $apellido = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_SPECIAL_CHARS); 
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL); 
            $contrasena = filter_input(INPUT_POST, 'contrasena', FILTER_SANITIZE_SPECIAL_CHARS); 
            
            if ($nombre && $apellido && $email && $contrasena) { 
                $persona = new Persona(); 
                $persona->setNombre($nombre); 
                $persona->setApellido($apellido); 
                $persona->setEmail($email); 
                $persona->setContrasena($contrasena); 
                $conexion = new conexion(); 
                $sql = "INSERT INTO personas (nombre, apellido, email, contrasena) VALUES (:nombre, :apellido, :email, MD5(:contrasena))"; 
                $stmt = $conexion->prepare($sql); 
                $stmt->execute([ 
                    ':nombre' => $persona->getNombre(), 
                    ':apellido' => $persona->getApellido(), 
                    ':email' => $persona->getEmail(), 
                    ':contrasena' => $persona->getContrasena() ]); 
                $conexion->cerrar(); 
                header('Location: ../vista/index.php'); 
                exit(); 
            } else {
                echo 'Datos invalidos.';
            }
        }
    }

    public function actualizarRegistro() { 
        session_start(); 
        $persona = new Persona(); 
        $conexion = new conexion(); 
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'actualizarRegistro') { 
            $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS); 
            $apellido = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_SPECIAL_CHARS); 
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL); 
            $contrasena = filter_input(INPUT_POST, 'contrasena', FILTER_SANITIZE_SPECIAL_CHARS); 
            if ($nombre && $apellido && $email && $contrasena) { 
                $persona->setNombre($nombre); 
                $persona->setApellido($apellido); 
                $persona->setEmail($email); 
                $persona->setContrasena($contrasena); 
                
                $sql = $persona->actualizar(); 
                $stmt = $conexion->prepare($sql); 
                $result = $stmt->execute(); 
                
                if ($result) { 
                    echo "Registro actualizado correctamente.<br>"; 
                    header('Location: ../vista/home.php'); 
                    exit(); 
                } else { 
                    $errorInfo = $stmt->errorInfo(); 
                    die("Error al actualizar el registro: " . htmlspecialchars($errorInfo[2]) . "<br>"); 
                } 
                $conexion->cerrar(); 
            } else { 
                echo 'Todos los campos son obligatorios.'; 
            } 
        } else { 
            echo 'Método de solicitud no válido o acción no especificada.'; 
        } 
    }
/*     public function actualizarRegistro() { 
            session_start();
        $persona = new Persona();   
        $conexion = new conexion(); 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
            $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS); 
            $apellido = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_SPECIAL_CHARS); 
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL); 
            $contrasena = filter_input(INPUT_POST, 'contrasena', FILTER_SANITIZE_SPECIAL_CHARS); 

            $persona->setNombre($nombre); 
            $persona->setApellido($apellido); 
            $persona->setEmail($email); 
            $persona->setContrasena($contrasena);

        $sql = "UPDATE personas SET nombre = :nombre, apellido = :apellido, email = :email, contrasena = MD5(:contrasena) WHERE email = :old_email"; 
        $stmt = $conexion->prepare($sql); 

        echo "SQL: $sql<br>"; 
        print_r([ 
            ':nombre' => $persona->getNombre(), 
            ':apellido' => $persona->getApellido(), 
            ':email' => $persona->getEmail(), 
            ':contrasena' => $persona->getContrasena(), 
            ':old_email' => $_SESSION['email'] 
        ]); 
        echo "<br>"; 

        $result = $stmt->execute([ 
                ':nombre' => $persona->getNombre(), 
                ':apellido' => $persona->getApellido(), 
                ':email' => $persona->getEmail(), 
                ':contrasena' => $persona->getContrasena(), 
                ':old_email' => $_SESSION['email'] ]); 
                
            if ($result) { 
                echo "Registro actualizado correctamente.<br>"; 
                header('Location: ../vista/home.php'); 
                exit(); 
            } else { 
                $errorInfo = $stmt->errorInfo(); 
                die("Error al actualizar el registro: " . htmlspecialchars($errorInfo[2]) . "<br>"); 
            } $conexion->cerrar(); 
        } else { 
            echo 'Método de solicitud no válido o acción no especificada.'; 
        } 
    } */

    public function eliminarUsuario() { 
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'delete') { 
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT); 
            
            if ($id !== false) { 
                $conexion = new conexion(); 
                $sql = "DELETE FROM personas WHERE id = ?"; 
                $stmt = $conexion->prepare($sql); 
                $stmt->execute([$id]); 
                $conexion->cerrar(); 
                
                header('Location: ../vista/usuarios.php'); 
                exit(); 
            } else { 
                echo 'ID inválido.'; 
            } 
        } 
    }
}

$controlador = new ControladorPersona(); 
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']) { 
    $action = $_POST['action'] ?? ''; 
    
    switch ($action) { 
        case 'registro': 
            $controlador->registro(); 
            break; 
        case 'actualizarRegistro': 
            $controlador->actualizarRegistro(); 
            break; 
        case 'delete': 
            $controlador->eliminarUsuario(); 
            break;
        default:
            echo 'accion no valida';
    }
}
?>