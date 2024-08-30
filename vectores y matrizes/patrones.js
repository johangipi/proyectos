function mergeArrays() {
    var array1 = document.getElementById('array1').value.split(',').map(Number);
    var array2 = document.getElementById('array2').value.split(',').map(Number);
    
    if (validateArray(array1) && validateArray(array2)) {
        var mergedArray = array1.concat(array2).sort((a, b) => a - b);
        document.getElementById('result').innerHTML = mergedArray.join(', ');
    } else {
        document.getElementById('result').innerHTML = 'Por favor, ingrese los números en orden ascendente.';
    }
}

function validateArray(array) {
    for (var i = 0; i < array.length - 1; i++) {
        if (array[i] > array[i + 1]) {
            return false;
        }
    }
    return true;
}
