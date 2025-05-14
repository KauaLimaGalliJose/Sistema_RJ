function atualizarRelogio() {
    const agora = new Date();
    const horas = String(agora.getHours()).padStart(2, '0');
    const minutos = String(agora.getMinutes()).padStart(2, '0');
    const segundos = String(agora.getSeconds()).padStart(2, '0');

    document.getElementById('relogio').innerHTML = `${horas}<span class="ponto">:</span>${minutos}<span class="ponto">:</span>${segundos}`;
}

setInterval(atualizarRelogio, 1000);
atualizarRelogio(); // Chama a função uma vez para não esperar 1 segundo inicial


function abrir(){
 const config = document.getElementById('div_config');

      // Alterna entre mostrar e esconder
      if (config.style.display === "flex") {
        config.style.display = "none"; // Esconde
    } else {
        config.style.display = "flex";

    }
}
 
function fechar(){
    document.getElementById('div_config').style.display = 'none';

}
function tema_1(){

    document.getElementById('botao').style.backgroundColor = 'rgb(28, 218, 37)';
    document.body.style.backgroundColor = 'rgb(85, 90, 88)';
    document.getElementById('logo').style.backgroundColor = 'rgb(28, 218, 37)';
    document.getElementById('header').style.backgroundColor = 'rgb(5, 138, 63)';
    document.getElementById('div_config').style.backgroundColor = 'rgb(85, 90, 88)';

}

function tema_2(){

    document.getElementById('botao').style.backgroundColor = 'rgb(250, 207, 143)';
    document.body.style.backgroundColor = 'azure';
    document.getElementById('logo').style.backgroundColor = 'rgb(250, 207, 143)';
    document.getElementById('header').style.backgroundColor = 'rgb(241, 178, 84)';
    document.getElementById('div_config').style.backgroundColor = 'azure';
}