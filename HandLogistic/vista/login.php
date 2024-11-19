<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
        <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../css/formulario.css" type="text/css"/>
    </head>
    <body>
        
    <?php include 'menu.php'; ?>
    
        
        <form action="../controlador/Login.php" method="POST">
        
            <h3>Email</h3>
            <input type="email" name="email">
            <h3>Contraseña</h3>
            <input type="password" name="contrasena">
            <button name="btn_log" type="submit">Login</button>
           
        </form>
    </body>
</html>