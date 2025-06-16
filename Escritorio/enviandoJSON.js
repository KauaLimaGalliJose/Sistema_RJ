function enviarParaJson(arquivo, nome, valor) {
    
    const dataAtual = document.getElementById('entrega').value;
    const conta = document.getElementById('nome_m').value;

     if(document.getElementById('grav_internaInput').value.trim() !== '' ){
        
        var gravacao = 'sim'

    }else{
        var gravacao = ''
    }

    
    fetch('../arquivoJson/salvarPedido.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ arquivo, nome, valor, dataAtual, conta, gravacao }) // Inclui a dataAtual no corpo
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
    
    if(select.options[1].selected){
        enviarParaJson('pedidos.json', select.options[select.selectedIndex].text + '-' + dataDigitadaSplit2 + '/' + dataDigitadaSplit1, "torno");
    }
    else if(select.options[2].selected){
        enviarParaJson('pedidosPg.json', select.options[select.selectedIndex].text + '-' + dataDigitadaSplit2 + '/' + dataDigitadaSplit1, "escritorio");
    }
    else if(select.options[3].selected){
        enviarParaJson('pedidosPe.json', select.options[select.selectedIndex].text + '-' + dataDigitadaSplit2 + '/' + dataDigitadaSplit1, "escritoriope");
    }

}