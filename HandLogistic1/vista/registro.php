<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
        <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../css/formularios.css" type="text/css"/>
    </head>
    <body>
    <?php include 'MenuUsuario.php'; ?>
        
        <h1>Registro</h1>
        
        
        <form method="post" action="../controlador/Registro.php">
            <label>Nombre</label>
            <input name="nombre" required autocomplete="off">
            <hr>
            <label>Apellido</label>
            <input name="apellido" required autocomplete="off">
            <hr>
            <label>Email</label>
            <input type="email" name="email" required autocomplete="off">
            <hr>
            <label>Contraseña</label>
            <input type="password" name="contrasena" required autocomplete="off">
            <hr/>
            <button type="submit">Guardar</button>
            
        </form>
        
    </body>
</html>
