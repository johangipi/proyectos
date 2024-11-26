<?php
require __DIR__ . '/../../vendor/autoload.php'; 
session_start();
use modelo\Persona; 
use conexion\Conexion;
$email = isset($_SESSION['email']) ? $_SESSION['email'] : ''; 
$persona2 = new Persona(); 
// Obtener datos de la persona desde la base de datos 
$conexion = new \conexion\conexion(); 
$sql = "SELECT * FROM personas WHERE email = :email"; 
$stmt = $conexion->prepare($sql); 
$stmt->execute([':email' => $email]); 
$result = $stmt->fetch(\PDO::FETCH_ASSOC); 
if ($result) { 
    $nombre = $result['nombre']; 
    $apellido = $result['apellido']; 
    $email = $result['email']; 
    $contrasena = $result['contrasena']; 
} else { 
    $nombre = ''; 
    $apellido = ''; 
    $email = ''; 
    $contrasena = ''; 
} 
$conexion->cerrar();
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Página PHP</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.xjsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../vista/css/formulario.css" type="text/css"/>
    <link rel="stylesheet" href="../vista/css/estilos.css" type="text/css"/>
</head>
<body>
    <?php include 'MenuUsuario.php'?>
    <h1>Bienvenido <?php echo htmlspecialchars($email ?: 'Invitado'); ?></h1>
    <form method="post" action="../controlador/ControladorPersona.php">
        <h3>Nombre</h3>
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required autocomplete="off"/>
        <h3>Apellido</h3>
        <input type="text" name="apellido" value="<?php echo htmlspecialchars($persona2->getApellido()); ?>" required autocomplete="off"/>
        <h3>Email</h3>
        <input type="email" name="email" value="<?php echo htmlspecialchars($persona2->getEmail()); ?>" required autocomplete="off"/>
        <h3>Contraseña</h3>
        <input type="password" name="contrasena" value="<?php echo htmlspecialchars($contrasena); ?>" required autocomplete="off"/>
        <input type="hidden" name="action" value="actualizarRegistro">
        <hr/>
        <button type="submit">Actualizar</button>
    </form>
    <form method="post" action="../controlador/Controlador.php" style="display: inline;"> 
        <input type="hidden" name="action" value="cerrarSesion"> 
        <button type="submit" class="btn btn-danger">Cerrar Sesión</button> 
    </form>
    
</body>
</html>