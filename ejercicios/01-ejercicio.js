function cualEsMayor (a, b) {
    if (a > b) {
        return a + "es mayor que" + b;
    } else if (a < b) {
        return b + "es mayor que" + a;
    } else {
        return a + "y" + b + "son iguales";
    }
}

let mayor = cualEsMayor (10, 5);

console.log(mayor);