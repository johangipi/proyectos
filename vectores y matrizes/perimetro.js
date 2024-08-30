function mostrarCamposPerimetro() {
  var figura = document.getElementById("figuraPerimetro").value;
  var campos = document.getElementById("camposPerimetro");
  campos.innerHTML = '';
  
  switch(figura) {
    case 'cuadrado':
      campos.innerHTML = '<input id="ladoPerimetro" type="number" placeholder="Lado">';
      break;
    case 'rectangulo':
      campos.innerHTML = '<input id="largoPerimetro" type="number" placeholder="Largo"><br><input id="anchoPerimetro" type="number" placeholder="Ancho">';
      break;
    case 'triangulo':
      campos.innerHTML = '<input id="lado1Perimetro" type="number" placeholder="Lado 1"><br><input id="lado2Perimetro" type="number" placeholder="Lado 2"><br><input id="lado3Perimetro" type="number" placeholder="Lado 3">';
      break;
    case 'circulo':
      campos.innerHTML = '<input id="radioPerimetro" type="number" placeholder="Radio">';
      break;
  }
}

function calcularPerimetro() {
  var figura = document.getElementById("figuraPerimetro").value;
  var resultado = document.getElementById("resultadoPerimetro");
  var perimetro;
  
  switch(figura) {
    case 'cuadrado':
      var lado = document.getElementById("ladoPerimetro").value;
      perimetro = 4 * lado;
      break;
    case 'rectangulo':
      var largo = document.getElementById("largoPerimetro").value;
      var ancho = document.getElementById("anchoPerimetro").value;
      perimetro = 2 * (parseInt(largo) + parseInt(ancho));
      break;
    case 'triangulo':
      var lado1 = document.getElementById("lado1Perimetro").value;
      var lado2 = document.getElementById("lado2Perimetro").value;
      var lado3 = document.getElementById("lado3Perimetro").value;
      perimetro = parseInt(lado1) + parseInt(lado2) + parseInt(lado3);
      break;
    case 'circulo':
      var radio = document.getElementById("radioPerimetro").value;
      perimetro = 2 * Math.PI * radio;
      break;
  }
  
  resultado.innerHTML = 'El perímetro es: ' + perimetro;
}

function mostrarCamposArea() {
  var figura = document.getElementById("figuraArea").value;
  var campos = document.getElementById("camposArea");
  campos.innerHTML = '';
  
  switch(figura) {
    case 'cuadrado':
      campos.innerHTML = '<input id="ladoArea" type="number" placeholder="Lado">';
      break;
    case 'rectangulo':
      campos.innerHTML = '<input id="largoArea" type="number" placeholder="Largo"><br><input id="anchoArea" type="number" placeholder="Ancho">';
      break;
    case 'triangulo':
      campos.innerHTML = '<input id="baseArea" type="number" placeholder="Base"><br><input id="alturaArea" type="number" placeholder="Altura">';
      break;
    case 'circulo':
      campos.innerHTML = '<input id="radioArea" type="number" placeholder="Radio">';
      break;
  }
}

function calcularArea() {
  var figura = document.getElementById("figuraArea").value;
  var resultado = document.getElementById("resultadoArea");
  var area;
  
  switch(figura) {
    case 'cuadrado':
      var lado = document.getElementById("ladoArea").value;
      area = lado * lado;
      break;
    case 'rectangulo':
      var largo = document.getElementById("largoArea").value;
      var ancho = document.getElementById("anchoArea").value;
      area = largo * ancho;
      break;
    case 'triangulo':
      var base = document.getElementById("baseArea").value;
      var altura = document.getElementById("alturaArea").value;
      area = 0.5 * base * altura;
      break;
    case 'circulo':
      var radio = document.getElementById("radioArea").value;
      area = Math.PI * radio * radio;
      break;
  }
  
  resultado.innerHTML = 'El área es: ' + area;
}
