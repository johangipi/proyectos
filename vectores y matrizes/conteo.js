var edades = [];
var menores = 0;
var mayores = 0;
var adultosMayores = 0;
var minEdad = 120;
var maxEdad = 0;
var sumaEdades = 0;

for (var i = 0; i < 10; i++) {
    var edad = parseInt(prompt("Ingrese la edad de la persona " + (i + 1) + ":"));
    while (edad < 1 || edad > 120 || isNaN(edad)) {
        edad = parseInt(prompt("Edad inválida. Ingrese la edad de la persona " + (i + 1) + ":"));
    }
    edades.push(edad);
    sumaEdades += edad;
    if (edad < 18) {
        menores++;
    } else if (edad < 60) {
        mayores++;
    } else {
        adultosMayores++;
    }
    if (edad < minEdad) {
        minEdad = edad;
    }
    if (edad > maxEdad) {
        maxEdad = edad;
    }
}

var promedioEdades = sumaEdades / 10;

console.log("Edades ingresadas: " + edades.join(", "));
console.log("Cantidad de menores de edad: " + menores);
console.log("Cantidad de mayores de edad: " + mayores);
console.log("Cantidad de adultos mayores: " + adultosMayores);
console.log("Edad más baja: " + minEdad);
console.log("Edad más alta: " + maxEdad);
console.log("Promedio de edades: " + promedioEdades.toFixed(2));
