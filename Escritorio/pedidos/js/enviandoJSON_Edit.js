function enviarParaJson(arquivo, nome, valor) {
    
    const dataAtual = document.getElementById('entrega').value;
    const conta = document.getElementById('nome_m').value;

        // Hora e minuto
    const agora = new Date();
    const hora = agora.getHours();
    const minutos = agora.getMinutes();
    const segundos = agora.getSeconds();

    let horaEntrega = `${hora.toString().padStart(2, '0')}:${minutos.toString().padStart(2, '0')}:${segundos.toString().padStart(2, '0')}`;

    if( document.getElementById('gravInternaM').value.trim() !== '' || document.getElementById('gravInternaF').value.trim() !== ''){
        
        var gravacao = 'sim'

    }else{
        var gravacao = ''
    }

    
    fetch('../../../arquivoJson/php/salvarPedido.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ arquivo, nome, valor, dataAtual, conta, gravacao, horaEntrega }) // Inclui a dataAtual no corpo
    })
    .then(response => response.json())
    .then(data => {
       // console.log('Salvo no JSON:', data);
    })
    .catch(error => {
        console.error('Erro ao salvar no JSON:', error);
    });
}

export function enviandoJson(dataDigitadaSplit1,dataDigitadaSplit2) {

    //Variaveis do P , PG e PE
    const select = document.getElementById('n_p');
    let valor = select.value; 
    let letras = valor.replace(/[^a-zA-Z]/g, ''); // remove tudo que não for letra
    console.log(letras)
    
    
    if(letras == "PF"){
        enviarParaJson('pedidos.json', select.options[select.selectedIndex].text + '-' + dataDigitadaSplit2 + '/' + dataDigitadaSplit1, "Indefinido");
    }
    else if(letras == "PG"){
        enviarParaJson('pedidosjsonpg.json', select.options[select.selectedIndex].text + '-' + dataDigitadaSplit2 + '/' + dataDigitadaSplit1, "Indefinido");
    }
    else if(letras == "PE"){
        enviarParaJson('pedidosjsonpe.json', select.options[select.selectedIndex].text + '-' + dataDigitadaSplit2 + '/' + dataDigitadaSplit1, "Indefinido");
    }

}