// Atualiza a página
setInterval(function() {
    window.onload = function() {
      document.getElementById('formulario').submit();
    };
    location.reload();
  }, 3600000); //30 Minutos

// Função para enviar dados para um arquivo JSON
function enviarParaJson(arquivo, nome, gravacao) {
    fetch('../arquivoJson/salvarPedidoGravacao.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ arquivo, nome, gravacao }) // Inclui o nome do arquivo no corpo
    })
    .then(response => response.json())
    .then(data => {
       // console.log('Salvo no JSON:', data);
    })
    .catch(error => {
        console.error('Erro ao salvar no JSON:', error);
    });
}

function dataAtualFormatada() {
    const hoje = new Date();
    const ano = hoje.getFullYear();
    const mes = String(hoje.getMonth() + 1).padStart(2, '0');
    const dia = String(hoje.getDate()).padStart(2, '0');
    return `${ano}-${mes}-${dia}`;
}

// Cria cookie para manter o estado do checkbox
function CreateCookie(nome, valor, dias) {
    const data = new Date();
    data.setTime(data.getTime() + (dias * 24 * 60 * 60 * 1000)); // Definindo a data de expiração
    const expires = "expires=" + data.toUTCString();
    document.cookie = nome + "=" + valor + "; " + expires + "; path=/";
}
// Pega o valor do cookie
function getCookie(nome) {
   
    let cookies = document.cookie.split("; ");
    
    
    for (let cookie of cookies) {
        
        let [chave, value] = cookie.split("=");

      
        if (chave === nome) {
            return value; 
        }
    }
    return null; 
}

// Cria o cookie Gravacao se não existir
if (getCookie('Gravacao_'+ dataAtualFormatada()) === null) {
    CreateCookie('Gravacao_'+ dataAtualFormatada(), 0, 365); // Cria o cookie Gravacao com valor inicial 0 e duração de 1 ano
}

// JavaScript para manter estado dos checkboxes -->
function salvarEstadoCheckbox(checkbox) {

   var gravacaoCookie = getCookie('Gravacao_' + dataAtualFormatada());
   const selectPedido = document.getElementById('larguraSelect');

    localStorage.setItem(checkbox.id, checkbox.checked);
    const carrossel = checkbox.closest('.carrossel');
    const carrosselSuperior = checkbox.closest('.carrosselSuperior');
    if (!carrossel && !carrosselSuperior) return;

    if (checkbox.checked) {
        carrossel.style.border = '8px solid blue'; 
        carrosselSuperior.style.borderBottom = '8px solid blue';

        gravacaoCookie++; // Incrementa o valor do cookie Gravacao
        CreateCookie('Gravacao_'+ dataAtualFormatada(), gravacaoCookie, 365); // Atualiza o cookie Gravacao com o novo valor e duração de 1 ano

        if(selectPedido.options[0].value == "PF"){
            enviarParaJson('pedidos.json', checkbox.id, '');
            console.log(checkbox.id)
        }
        else if(selectPedido.options[0].value == "PG"){
            enviarParaJson('pedidosPg.json', checkbox.id, '');
            console.log(checkbox.id)
        }

    } else {
        carrossel.style.border = '';
        carrosselSuperior.style.borderBottom = ''; 
        gravacaoCookie--; // Decrementa o valor do cookie Gravacao
        CreateCookie('Gravacao_' + dataAtualFormatada(), gravacaoCookie, 365); // Atualiza o cookie Gravacao com o novo valor e duração de 1 ano

        if (gravacaoCookie < 0) {
            gravacaoCookie = 0; // Garante que o valor não fique negativo
            CreateCookie('Gravacao_' + dataAtualFormatada(), gravacaoCookie, 365); // Atualiza o cookie Gravacao com o novo valor e duração de 1 ano
        }

        
        if(selectPedido.options[0].value == "PF"){
            enviarParaJson('pedidos.json', checkbox.id, 'sim');
            console.log(checkbox.id)
        }
        else if(selectPedido.options[0].value == "PG"){
            enviarParaJson('pedidosPg.json', checkbox.id, 'sim');
            console.log(checkbox.id)
        }
    }
    console.log('Valor do cookie Gravacao: ' + gravacaoCookie);
}

window.addEventListener("load", function() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(cb => {
        const estado = localStorage.getItem(cb.id);
        if (estado === 'true') {
            cb.checked = true;

            const carrossel = cb.closest('.carrossel');
            if (carrossel) {
                carrossel.style.border = '8px solid blue'; 
            }

            const carrosselSuperior = cb.closest('.carrosselSuperior');
            if (carrosselSuperior) {
                carrosselSuperior.style.borderBottom = '8px solid blue'; 

                
            }
            
        }
    });
});

function usuario(){

    const divUsuario = document.getElementById('conteudo');

    if( divUsuario.style.display !== 'none'){

        divUsuario.style.display = 'flex';
        
      document.getElementById('cabecalho').style.filter = 'brightness(0.75) contrast(0.95) blur(2px)';
      document.getElementById('phpmae').style.filter = 'brightness(0.75) contrast(0.95) blur(2px)';
      document.getElementById('phpmae').style.display = 'none';
      
    }
    if(divUsuario.style.display == 'none'){
        
        document.getElementById('cabecalho').style.filter = '';
        document.getElementById('phpmae').style.filter = '';
        divUsuario.style.display = 'none';
        
    }
}