<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
        <link rel="stylesheet" href="../vista/css/estilos.css">
    </head>
    <body>
        <?php include 'menu.php'; ?>

        
        <section id="banner">
        <div class="contenido-banner">
            <h3><span>DESARROLO DE SOFTWARE</span> <BR>SOFTWARE LOGISTICO TEXTIL</h3>
            <H5>para nuestra empresa de desarrollo es un pribilegio poder prestar nuestros servicios a su negocio de la mano de este proyecto <b>hand logistic</b>.</H5>
            <br><a href="iniciar.html" class="boton-empezar">EMPEZAR</a>
        </div>
    </section>

    <section id="contacto">
        <h4>CONTACTA CON NOSOTROS</h4>
        <form id="informacion" method="post">
            <div class="datos-form">
                <div class="nombre">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" 
                    placeholder="nombre">
                </div>
                <div class="email">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" 
                    placeholder="Email">
                </div>
            </div>
            <div class="mensaje">
                <label for="mensaje">Mensaje</label>
                <textarea name="mensaje" id="mensaje" 
                cols="30" rows="10" placeholder="mensaje"></textarea>
            </div>
            <div class="boton-formulario">
                <input id="boton-registrar" class="boton-saber-mas" value="Enviar mensaje" type="submit">
            </div>
        </form>
    </section>
    
    <footer>
        <p>&copy;2019 Naviscode</p>
    </footer>
    </body>
</html>
