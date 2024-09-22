function Usuario(nombre) {
    this.nombre = nombre;
}

console.log(Usuario.name);
console.log(Usuario.length);

const U = Usuario
let user = new U('johan');

console.log(user);

function of(fn, arg) {
    return new fn(arg);
}

let user1 = of(Usuario, 'johan');
console.log(user1);

function returned(){
    return function() {
        console.log('hola mundo');
    }
}

let saludo = returned();
saludo();