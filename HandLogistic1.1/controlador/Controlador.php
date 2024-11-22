<?php

require_once '../modelo/Persona.php';
require_once '../modelo/Producto.php';

class Controlador { 

    private $modelo;

    public function __construct() {
        $this->modelo = new Persona();
    }
    
    public function login() {

        if (isset($_POST['email']) && isset($_POST['contrasena'])) {

            $this->modelo->set("email", $_POST['email']);
            $this->modelo->set("contrasena", $_POST['contrasena']);
            $sql = $this->modelo->credenciales();
            $sql = new $sql;
            $array = mysqli_fetch_array($sql);
            $email = $array['4'];
            $contrasena = $array['5'];

                if ($email != null && $contrasena != null) {
                    $this->iniciarVariables($array['0'], $email);
                } else {
                    echo 'Usuario o Contraseña incorrecta!!';
                }
            header('Location: ../vista/home.php');
        } else {
            echo 'El usuario y Contraseña son requeridos!!';
        }
    }
    
    private function iniciarVariables($idUsuario, $email) { 
        session_start(); 
        $_SESSION['idUsuario'] = $idUsuario; 
        $_SESSION['email'] = $email; 
        header('Location: ../vista/home.php'); 
        exit(); 
    }

    public function registro(){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING); 
        $apellido = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_STRING); 
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL); 
        $contrasena = filter_input(INPUT_POST, 'contrasena', FILTER_SANITIZE_STRING); 
        
        if ($nombre && $apellido && $email && $contrasena) { 
            $persona = new Persona(); 
            $persona->setNombre($nombre); 
            $persona->setApellido($apellido); 
            $persona->setEmail($email); 
            $persona->setContrasena($contrasena); 
            $conexion = new conexion(); 
            $sql = "INSERT INTO personas (nombre, apellido, email, contrasena) VALUES (:nombre, :apellido, :email, MD5(:contrasena))"; 
            $stmt = $conexion->prepare($sql); 
            $stmt->execute([ ':nombre' => $persona->getNombre(), ':apellido' => $persona->getApellido(), ':email' => $persona->getEmail(), ':contrasena' => $persona->getContrasena() ]); $conexion->cerrar(); header('Location: ../vista/index.php'); 
            exit(); 
        } else {
            echo 'Datos invalidos.';
        }
    }
}


public function registrarProducto() { 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
        session_start(); 
        $idUsuario = $_SESSION['idUsuario']; 
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING); 
        $item = filter_input(INPUT_POST, 'item', FILTER_SANITIZE_STRING); 
        $categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_STRING); 
        $ubicacion = filter_input(INPUT_POST, 'ubicacion', FILTER_SANITIZE_STRING); 
        $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT); 
        
        if ($idUsuario && $nombre && $item && $categoria && $ubicacion && $cantidad !== false) { 
            $producto = new Producto($nombre, $item, $categoria, $ubicacion, $cantidad, $idUsuario); 
            $query = $producto->registrarProducto(); 
            
            $conexion = new conexion(); 
            $stmt = $conexion->prepare($query); 
            $result = $stmt->execute(); 
            
            if ($result) { 
                echo 'Producto registrado correctamente. ID de Usuario: ' . $idUsuario; 
                header('Location: ../vista/interfaz.php'); 
                exit(); 
            } else { 
                echo 'Error al registrar el producto.'; 
            } $conexion->cerrar(); 
        } else { 
            echo 'Datos inválidos.'; 
        } 
    } 
}

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

public function eliminarProducto() { 
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'delete') { 
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT); 
        
        if ($id !== false) { 
            $conexion = new conexion(); 
            $sql = "DELETE FROM producto WHERE id = ?"; 
            $stmt = $conexion->prepare($sql); 
            $stmt->execute([$id]); 
            $conexion->cerrar(); 
            header('Location: ../vista/inventario.php'); 
            exit(); 
        } else { 
            echo 'ID inválido.'; 
        } 
    } 
}

public function disminuir() { 
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'decrease') { 
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT); 
        
        if ($id !== false) { 
            $conexion = new conexion(); 
            $sql = "UPDATE producto SET cantidad = cantidad - 1 WHERE id = ?"; 
            $stmt = $conexion->prepare($sql); 
            $stmt->execute([$id]); 
            $conexion->cerrar(); 
            header('Location: ../vista/inventario.php'); 
            exit(); 
        } else { 
            echo 'ID inválido.'; 
        } 
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

public function actualizarRegistro() { 
    session_start();

    $persona = new Persona(); 
    $persona2 = new Persona(); 

    $conexion = new conexion(); 
    $sql = "SELECT * FROM personas WHERE email = :email"; 
    $stmt = $conexion->prepare($sql); 
    $stmt->execute([':email' => $_SESSION['email']]); 
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    
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
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING); 
        $apellido = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_STRING); 
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL); 
        $contrasena = filter_input(INPUT_POST, 'contrasena', FILTER_SANITIZE_STRING); 
        $persona->setNombre($nombre); 
        $persona->setApellido($apellido); 
        $persona->setEmail($email); 
        $persona->setContrasena($contrasena); 
        $sql = $persona->actualizar(); 
        // Depuración: Imprime la consulta SQL 
        //die("Consulta SQL: $sql<br>");
        $stmt = $conexion->prepare($sql); 
        // Depuración: Verifica si el statement se prepara correctamente 
        if (!$stmt) { 
            $errorInfo = $conexion->errorInfo(); 
            die("Error al preparar la consulta: " . $errorInfo[2] . "<br>"); 
        } 
        $result = $stmt->execute(); 
        // Depuración: Verifica el resultado de la consulta 
        if ($result) { 
            echo "Registro actualizado correctamente.<br>"; 
            header('Location: ../vista/home.php'); 
            exit(); 
        } else { 
            $errorInfo = $stmt->errorInfo(); 
            die("Error al actualizar el registro: " . $errorInfo[2] . "<br>"); 
        } 
        $conexion->cerrar(); 
    }
}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    /* $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS); */ 
    $action = $_GET['action'];
    $controlador = new Controlador(); 
    switch ($action) { 
        case 'login': 
            $controlador->login(); 
            break; 
        case 'registro': 
            $controlador->registro(); 
            break;
        case 'registrarProducto':
            $controlador->registrarProducto();
            break;
        case 'eliminarUsuario':
            $controlador->eliminarUsuario();
            break;
        case 'eliminarProducto':
            $controlador->eliminarProducto();
            break;
        case 'actualizarRegistro': 
            $controlador->actualizarRegistro(); 
            break;
        case 'disminuir': 
            $controlador->disminuir(); 
            break; 
        case 'cerrarSesion': 
            $controlador->cerrarSesion(); 
            break; 
         
        }
    }

?>