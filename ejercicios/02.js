function nombreResolucion(ancho, alto) {
    if (ancho > 7680 && alto > 4320) {
        return '8k'
    } else if (ancho >= 3840 && alto >= 2160) {
        return '4k'
    } else if (ancho >= 2560 && alto >= 1440) {
        return 'wqhd'
    } else if (ancho >= 1920 && alto >= 1080) {
        return 'fhd'
    } else if (ancho >= 1280 && alto >= 720) {
        return 'hd'
    } else (ancho <= 1280 && alto <= 720) 
        return 'low definition'
    
}

let nombre = nombreResolucion (1000, 780);
console.log(nombre);