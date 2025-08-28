// Adiciona favicon dinamicamente coroa.ico
(function() {
    let link = document.createElement('link');
    link.rel = 'shortcut icon';
    link.type = 'image/x-icon';
    link.href = '../../Escritorio/Escritorio_img/coroa.ico'; 
    document.head.appendChild(link);
})();

// função para voltar o valor de um elemento
function voltar(id,idinput) {
    let elemento = document.getElementById(id);
    let valorAtual = parseInt(elemento.innerHTML);

    let input = document.getElementById(idinput);

    
    if(valorAtual == 0){

        valorAtual = 0
        valorInput = 'negativo'; 
        
        elemento.innerHTML = valorAtual;
        console.log(`Novo valor: ${valorAtual}`);
    }
    else if(valorAtual < 0){

        valorInput = 'negativo'; 

        valorAtual++; 
        elemento.innerHTML = valorAtual;
        input.value = valorInput; // atualiza o valor do input
    }
    else{
        valorAtual--; // subtrai 1
        valorInput = 'negativo'; // subtrai 1 ao valor do input
        
        elemento.innerHTML = valorAtual;
        input.value = valorInput; // atualiza o valor do input
        console.log(`Novo valor: ${valorInput}`);
    }
    
}

// função para avançar o valor de um elemento
function avancar(id,idinput) {
    let elemento = document.getElementById(id);

    let valorAtual = document.getElementById(id).innerHTML;

    let input = document.getElementById(idinput);

    valorAtual++; // adiciona 1
    valorInput = 'positivo'; // subtrai 1 ao valor do input

    elemento.innerHTML = valorAtual;
    input.value = valorInput; // atualiza o valor do input
    console.log(`Novo valor: ${valorInput}`);
}

function select_radio(radioId) {
    // Marca o radio correspondente
    const radio = document.getElementById(radioId);
    if (radio) {
        radio.checked = true;
    }
}

//temperatura do estoque
//serve para atualizar os inputs com os valores dos divs
function atualizarInputs() {
    const elementos = document.querySelectorAll('.numero_abastecer');

    // Define intervalo
    const min = 0;
    const max = 20;

    elementos.forEach(el => {
        let quantidade = parseInt(el.textContent) || 0;

        // Calcula porcentagem no intervalo
        let percent = Math.max(0, Math.min(1, (quantidade - min) / (max - min)));

        // Interpola cor de verde (120°) para vermelho (0°)
        let hue = (1 - percent) * 120;

        el.style.color = `hsl(${hue}, 100%, 40%)`;
    });
}



// Seleciona o radio que está marcado
document.addEventListener('DOMContentLoaded', function() {
    
    // Obtém o valor do radio selecionado
    let id = document.querySelector('.iniciar-selecionado').id;
    let radioSplit = id.split('_').slice(1).join('_');
    let radioSelecionado = document.getElementById(radioSplit);
    
    //variavel para o elemento que será exibido let Estoques_Torno_Polimento_Sem_estoque = document.querySelector('.Estoques_Torno_Polimento_Sem_estoque');
    let Estoques_Torno_Polimento_Sem_estoque = document.getElementById('Estoques_Torno_Polimento_Sem_estoque');
    let Estoques_Torno_Polimento = document.querySelector('.semEstoque');
    
    if(id === "id2_" ) {
        console.error(`Radio com id ${id} não encontrado.`);
        
        Estoques_Torno_Polimento.style.display = 'none'; // Esconde o elemento
        Estoques_Torno_Polimento_Sem_estoque.style.display = 'flex'; // Esconde o elemento 
        return;

    }
    if (radioSelecionado) {
        Estoques_Torno_Polimento_Sem_estoque.style.display = 'none'; // Esconde o elemento

        let valor = radioSelecionado.value.replaceAll(' ', '_'); // troca espaços por _
        const idFinal = document.getElementById(valor);

        const labelRelacionado = document.querySelector(`label[for="${idFinal.id}"]`);

        console.log(`Valor selecionado: ${valor}`);
        
        idFinal.checked = true; // Marca o radio selecionado
        
        if (labelRelacionado) {
            labelRelacionado.classList.add('radio-selecionado'); // Adiciona a classe 'radio-selecionado' ao label relacionado
        }
    }
});

// Função para enviar o formulário
function enviar_form(formId) {
    
    const form = document.getElementById(formId);
    const formData = new FormData(form);
    
    for (let pair of formData.entries()) {
    console.log(pair[0]+ ': ' + pair[1]);
}

fetch('./repor2.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        

        console.log('Resposta do servidor:', data);
        
    })
    .catch(error => {
        alert('Erro ao enviar o formulário:', error);
    });

}

// funçoes que iniciam com a pagina 
atualizarInputs()