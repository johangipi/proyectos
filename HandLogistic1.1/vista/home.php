<?php
session_start();
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
    <h1>Bienvenido <?php echo htmlspecialchars($_SESSION['email']); ?></h1>
    <form method="post" action="../controlador/ActualizarRegistro.php">
        <label>Nombre</label>
        <input name="nombre" value="<?php echo htmlspecialchars($persona2->getNombre()); ?>" required autocomplete="off"/>
        <label>Apellido</label>
        <input name="apellido" value="<?php echo htmlspecialchars($persona2->getApellido()); ?>" required autocomplete="off"/>
        <label>Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($persona2->getEmail()); ?>" required autocomplete="off"/>
        <label>Contraseña</label>
        <input type="password" name="contrasena" required autocomplete="off">
        <hr/>
        <button type="submit">Actualizar</button>
    </form>
    
</body>
</html>


