const user = { id: 1};

user.name = 'nicolas';
user.guardar = function () {
    console.log('guardando', user.name);
}

user.guardar();

delete user.name;
delete user.guardar;
console.log(user);

const user1 = Object.freeze({id: 1});
//const user1 = Object.seal({id: 1});
user1.name = 'nico';
user1.id = 2;
console.log(user1);