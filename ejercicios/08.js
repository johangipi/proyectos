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

let pares = [
    [1, {id: 1, name: "nicolas"}],
    [2, {id: 2, name: "felipe"}],
    [3, {id: 3, name: "johan"}],
]

function toPairs(arr){
    let pairs = [];
    for (idx in arr) {
        let elemento = arr[idx];
        pairs [idx] = [elemento.id, elemento];
    }
    return pairs;
}

let resultado = toPairs(array);
console.log(resultado);