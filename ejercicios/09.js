let pairs = [
    [1, {name: "nicolas"}],
    [2, {name: "felipe"}],
    [3, {name: "johan"}],
];

let array = [{
    id: 1,
    name: 'nicolas',
}, {
    id: 2,
    name: 'felipe',
}, {
    id: 3,
    name: 'johan',
}];

function toCollection(arr){
    let collection = [];
    for(idx in arr) {
        let elemento = arr [idx];
        collection[idx] = elemento [1];
        collection[idx].id = elemento [0];
    }
    return collection;
};

let resultado = toCollection (pairs)
console.log(resultado);