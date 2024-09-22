let user = {
    id: 1,
    name: 'johan',
    age: 21,
};

for (let propiedad in user) {
    console.log(propiedad, user[propiedad]);
}

let animales = ['perro', 'gato', 'conejo'];
for (let indice of animales) {
    console.log(indice, animales[indice]);
}