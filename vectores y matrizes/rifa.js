var personas = [];

function agregarPersona() {
    var nombre = document.getElementById('nombre').value;
    var cedula = document.getElementById('cedula').value;
    var fechaNacimiento = document.getElementById('fechaNacimiento').value;
    var correo = document.getElementById('correo').value;
    var ciudadOrigen = document.getElementById('ciudadOrigen').value;
    var ciudadResidencia = document.getElementById('ciudadResidencia').value;
    var cantanteFavorito = document.getElementById('cantanteFavorito').value;
    var canciones = [
        document.getElementById('cancion1').value,
        document.getElementById('cancion2').value,
        document.getElementById('cancion3').value
    ];
    var persona = {
        nombre: nombre,
        cedula: cedula,
        fechaNacimiento: fechaNacimiento,
        correo: correo,
        ciudadOrigen: ciudadOrigen,
        ciudadResidencia: ciudadResidencia,
        cantanteFavorito: cantanteFavorito,
        canciones: canciones
    };
    personas.push(persona);
}

function mostrarPersona() {
    var posicion = document.getElementById('posicion').value;
    if (posicion >= 0 && posicion < personas.length) {
        var persona = personas[posicion];
        document.getElementById('infoPersona').innerHTML = 
            'Nombre: ' + persona.nombre +
            '<br>Cédula: ' + persona.cedula +
            '<br>Fecha de Nacimiento: ' + persona.fechaNacimiento +
            '<br>Correo: ' + persona.correo +
            '<br>Ciudad de Origen: ' + persona.ciudadOrigen +
            '<br>Ciudad de Residencia: ' + persona.ciudadResidencia +
            '<br>Cantante Favorito: ' + persona.cantanteFavorito +
            '<br>Canciones: ' + persona.canciones.join(', ');
    } else {
        document.getElementById('infoPersona').innerHTML = 'Posición inválida.';
    }
}
