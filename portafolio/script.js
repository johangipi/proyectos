let menuVisible = false;
/* funcion que oculta o muestra el menu */
function mostrarOcultarMenu(){
    if (menuVisible){
        document.getElementById("nav").classList ="";
        menuVisible = false
    }else{
        document.getElementById("nav").classList ="responsive";
        menuVisible = true;
    }
}

function seleccionar(){
    /* OCULTA EL MENU CADA VEZ QUE SELECCIONA UNA OPCION */
    document.getElementById("nav").classList = "";
    menuVisible = false;
}
/* animacion skills */
function efectoHabilidades(){
    var skills = document.getElementById("skills");
    var distancia_skills = window.innerHeight -skills.getBoundingClientRect().top;
    if(distancia_skills >= 300){
        let habilidades = document.getElementsByClassName("progreso");
        habilidades [0].classList.add("Htmlcss");
        habilidades [1].classList.add("Java");
        habilidades [2].classList.add("Mysql");
        habilidades [3].classList.add("Js");
        habilidades [4].classList.add("comunicacion");
        habilidades [5].classList.add("Trabajo");
        habilidades [6].classList.add("creatividad");
        habilidades [7].classList.add("proyecto");
    }    
}

/* scrolling animaciones */
window.onscroll = function(){
    efectoHabilidades();
}



