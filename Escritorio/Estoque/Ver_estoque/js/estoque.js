// função para voltar o valor de um elemento
function voltar(id) {
    let elemento = document.getElementById(id);
    let valorAtual = parseInt(elemento.innerHTML);

    
    if(valorAtual == 0){

        valorAtual = 0
        
        elemento.innerHTML = valorAtual;
        console.log(`Novo valor: ${valorAtual}`);
    }
    else{
        valorAtual--; // subtrai 1

        elemento.innerHTML = valorAtual;
        console.log(`Novo valor: ${valorAtual}`);
    }
    
}

// função para avançar o valor de um elemento
function avancar(id){
    let elemento = document.getElementById(id);
    let valorAtual = parseInt(elemento.innerHTML);

    valorAtual++; // subtrai 1

    elemento.innerHTML = valorAtual;
    console.log(`Novo valor: ${valorAtual}`);
}

// função para voltar a página
function voltarpagina(caminho) {
    window.location.href = caminho;

}

//enviar formulario
function submitForm(formulario, aquivo) {
    const form = document.getElementById(formulario);
    const formData = new FormData(form);

    fetch(aquivo, {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log('Resposta do servidor:', data);
        

        console.log('Atualização bem-sucedida');

        //Usado para tester a resposta do servidor
        //window.location.href = 'estoque_1.php';
    })
    .catch(error => {
        alert('Erro ao enviar o formulário:', error);
    });
    
}

//serve para atualizar os inputs com os valores dos divs
function atualizarInputs() {
    for (let i = 9; i <= 35; i++) {
        const divValue = document.getElementById(`id_${i}`);
        const input = document.getElementById(`input_${i}`);

        if (input) {
            input.value = divValue.textContent;
        }

        let quantidade = parseInt(divValue.textContent) || 0;

        // Define o intervalo de valores esperado
        let min = 0;
        let max = 25; // coloque aqui o valor máximo esperado

        // Calcula a porcentagem entre min e max
        let percent = Math.max(0, Math.min(1, (quantidade - min) / (max - min)));

        // Interpolação de verde (120°) → vermelho (0°) usando HSL
        let hue = percent * 120; // 0° vermelho → 120° verde
        divValue.style.color = `hsl(${hue}, 100%, 40%)`;
    }
}


// Atualiza os inputs ao carregar a página
atualizarInputs()



// Espera por uma ação do usuário para atualizar os inputs

// ---------------------------------------------------------------------------
// Função para enviar o formulário de Editar

function editar() {

    const buttonPdfDiv = document.getElementById('buttonPdf');
    const enviarExportar = document.getElementById('editar');

        const pdfDiv =  document.getElementById('PdfDivMae');
  
    if(pdfDiv.style.visibility == 'hidden'){
      pdfDiv.style.visibility = 'visible';
  
      document.getElementById('div_estoques').style.filter = 'brightness(0.65) contrast(0.85) blur(2px)';
      document.getElementById('cabecalho').style.filter = 'brightness(0.75) contrast(0.95) blur(2px)';
      document.getElementById('div_estoques').style.pointerEvents = 'none';
      document.getElementById('cabecalho').style.pointerEvents = 'none';
      
    }
    else{
      pdfDiv.style.visibility = 'hidden';
  
      document.getElementById('div_estoques').style.filter = '';
      document.getElementById('cabecalho').style.filter = '';
      document.getElementById('div_estoques').style.pointerEvents = 'auto';
      document.getElementById('cabecalho').style.pointerEvents = 'auto';
    }
  }

  function voltarEditar() {
    const pdfDiv =  document.getElementById('PdfDivMae');
  
    pdfDiv.style.visibility = 'hidden';
  
      document.getElementById('div_estoques').style.filter = '';
      document.getElementById('cabecalho').style.filter = '';
      document.getElementById('div_estoques').style.pointerEvents = 'auto';
      document.getElementById('cabecalho').style.pointerEvents = 'auto';
  }
