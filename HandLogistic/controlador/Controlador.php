<?php 

function login() {
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
    
}

function registro () {
    
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
}

function registrarProducto () {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idUsuario = $_SESSION['idUsuario'];
        $nombre = $_POST['nombre'];
        $item = $_POST['item'];
        $categoria = $_POST['categoria'];
        $ubicacion = $_POST['ubicacion'];
        $cantidad = intval($_POST['cantidad']);
        
    
        if ($idUsuario === null) {
            echo 'Error: ID de usuario no encontrado en la sesión.';
            exit();
        }
    
        $producto = new Producto($nombre, $item, $categoria, $ubicacion, $cantidad, $idUsuario);
        $query = $producto->registrarProducto();
        
        $conexion = new Conexion();
        $statement = $conexion->prepare($query);
        $result = $statement->execute();
    
        if ($result) {
            echo 'Producto registrado correctamente. ID de Usuario: ' . $idUsuario;
            header('Location: ../vista/interfaz.php');
            exit();
        } else {
            echo 'Error al registrar el producto.';
        }
    
        $conexion->cerrar();
    }
}

function eliminarUsuario() {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'delete') {
        $id = intval($_POST['id']);
    
        $conexion = new Conexion();
        $sql = "DELETE FROM personas WHERE id = ?";
        $statement = $conexion->prepare($sql);
        $statement->execute([$id]);
    
        header('Location: ../vista/usuarios.php'); // Redirigir de nuevo a la vista de inventario
        exit();
    }
}

function eliminarProducto () {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'delete') {
        $id = intval($_POST['id']);
    
        $conexion = new Conexion();
        $sql = "DELETE FROM producto WHERE id = ?";
        $statement = $conexion->prepare($sql);
        $statement->execute([$id]);
    
        header('Location: ../vista/inventario.php'); // Redirigir de nuevo a la vista de inventario
        exit();
    }
}

function disminuir () {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'decrease') {
        $id = intval($_POST['id']);
    
        $conexion = new Conexion();
        $sql = "UPDATE producto SET cantidad = cantidad - 1 WHERE id = ?";
        $statement = $conexion->prepare($sql);
        $statement->execute([$id]);
    
        header('Location: ../vista/inventario.php'); // Redirigir de nuevo a la vista de inventario
        exit();
    }
}

function cerrarSesion () {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {
        Persona::$user = null;
        header('Location: index.php');
        exit();
    }
}

function actualizarRegistro () {
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
}

?>