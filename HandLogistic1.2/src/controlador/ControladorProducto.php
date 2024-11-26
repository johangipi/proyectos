<?php 

namespace controlador; 
require __DIR__ . '/../../vendor/autoload.php';
session_start();
use conexion\Conexion;
use modelo\Producto;
class ControladorProducto {

    public function registrarProducto() { 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
            $idUsuario = $_SESSION['idUsuario']; 
            $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS); 
            $item = filter_input(INPUT_POST, 'item', FILTER_SANITIZE_SPECIAL_CHARS); 
            $categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_SPECIAL_CHARS); 
            $ubicacion = filter_input(INPUT_POST, 'ubicacion', FILTER_SANITIZE_SPECIAL_CHARS); 
            $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT); 
            
            if ($idUsuario && $nombre && $item && $categoria && $ubicacion && $cantidad !== false) { 
                $conexion = new Conexion(); 
                $sql = "INSERT INTO producto (nombre, item, categoria, ubicacion, cantidad, idUsuario) VALUES (:nombre, :item, :categoria, :ubicacion, :cantidad, :idUsuario)";
                $stmt = $conexion->prepare($sql); 
                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':item', $item);
                $stmt->bindParam(':categoria', $categoria);
                $stmt->bindParam(':ubicacion', $ubicacion);
                $stmt->bindParam(':cantidad', $cantidad);
                $stmt->bindParam(':idUsuario', $idUsuario);
                
                $result = $stmt->execute(); 
                
                if ($result) { 
                    echo 'Producto registrado correctamente. ID de Usuario: ' . $idUsuario; 
                    header('Location: ../vista/interfaz.php'); 
                    exit(); 
                } else { 
                    echo 'Error al registrar el producto.'; 
                } 
                $conexion->cerrar(); 
            } else { 
                echo 'Datos inválidos.'; 
            } 
        } 
    }

    public function eliminarProducto() { 
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'eliminar') { 
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT); 
            
            if ($id !== false) { 
                $conexion = new Conexion(); 
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'disminuir') { 
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT); 
            
            if ($id !== false) { 
                $conexion = new Conexion(); 
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
}

$controlador = new ControladorProducto(); 
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') { 
    $action = $_POST['action'] ?? ''; 
    
    switch ($action) { 
        case 'registrarProducto': 
            $controlador->registrarProducto(); 
            break; 
        case 'eliminar': 
            $controlador->eliminarProducto(); 
            break; 
        case 'disminuir': 
            $controlador->disminuir(); 
            break;
        default:
            echo 'Acción no válida';
    }
}

?>

