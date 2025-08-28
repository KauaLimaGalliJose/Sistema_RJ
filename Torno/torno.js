// Data atual no formato YYYY-MM-DD e horário de Brasília
const dataAtual = new Date().toLocaleDateString('pt-BR', { timeZone: 'America/Sao_Paulo' }).split('/').reverse().join('-');

// Atualiza a página
setInterval(function() {
    window.onload = function() {
      document.getElementById('formulario').submit();
    };
    location.reload();
  }, 120000); //120 segundos

// Nova função para enviar dados ao backend
function enviarParaJson(arquivo, arquivoPhp, nome, valor , dataAtual) {

    // Hora e minuto
    const agora = new Date();
    const hora = agora.getHours();
    const minutos = agora.getMinutes();
    const segundos = agora.getSeconds();

    let horaEntrega = `${hora.toString().padStart(2, '0')}:${minutos.toString().padStart(2, '0')}:${segundos.toString().padStart(2, '0')}`;

    fetch('../arquivoJson/php/' + arquivoPhp, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ arquivo, nome, valor, dataAtual , horaEntrega }) // Inclui o nome do arquivo no corpo
    })
    .then(response => response.json())
    .then(data => {
       // console.log('Salvo no JSON:', data);
    })
    .catch(error => {
        console.error('Erro ao salvar no JSON:', error);
    });
}

async function carregarPedidosJson() {
    try {
        const response = await fetch('../arquivoJson/php/pegarDadosPedidos.php');
        const dados = await response.json();
        return dados;
    } catch (error) {
        console.error('Erro ao carregar JSON:', error);
        return null;
    }
}
  
// Nova função para salvar estado dos radios
function salvarEstadoRadio(radio) {
    const name = radio.name;
    localStorage.setItem(name, radio.value);

    const carrossel = radio.closest('.carrossel');
    const carrosselSuperior = radio.closest('.carrosselSuperior');
    if (!carrossel && !carrosselSuperior) return;

    if (radio.value === "Escritorio") {

        carrossel.style.border = '8px solid blue';
        carrosselSuperior.style.borderBottom = '8px solid blue';
        enviarParaJson('pedidos.json', 'salvarPedidoPolimento.php', radio.classList[1], "escritorio" , dataAtual);
        
    } else if (radio.value === "Polimento") {

        carrossel.style.border = '8px solid rgb(40, 170, 0)';
        carrosselSuperior.style.borderBottom = '8px solid rgb(40, 170, 0)';
        enviarParaJson('pedidos.json', 'salvarPedidoTorno.php', radio.classList[1], "polimento" , dataAtual);
    }
    else if (radio.value === "torno") {
        
        carrossel.style.border = 'solid #800020 9px';
        carrosselSuperior.style.borderBottom = 'solid #800020 9px';
        enviarParaJson('pedidos.json', 'salvarPedidoTorno.php', radio.classList[1], "torno" , dataAtual);
    }
}

// Restaura o estado dos radios ao carregar a página
window.addEventListener("load", async function() {
    
    const dadosJson = await carregarPedidosJson();

    // Supondo que dadosJson é um objeto como { PF2-13/06: {...}, PF3-13/06: {...}, ... }

    Object.entries(dadosJson).forEach(([chave, pedido]) => {

        // Aqui você precisa relacionar 'chave' com algum atributo no HTML para achar o grupo certo de radios
        // Supondo que o 'name' do input radio seja 'marcado_' + chave, igual ao PHP
        const nomeRadio = "marcado_" + chave;

        // Seleciona todos os radios desse grupo
        const radios = document.querySelectorAll(`input[name="${nomeRadio}"]`);
        
        radios.forEach(radio => {
            if (radio.value.toLowerCase() === pedido.estado.toLowerCase()) {
                radio.checked = true; // marca o radio conforme o estado do JSON

                // Aplica os estilos aos elementos relacionados (ajuste se precisar)
                const carrossel = radio.closest('.carrossel');
                const carrosselSuperior = radio.closest('.carrosselSuperior');

                console.log(radio.value.toLowerCase())
                if ( pedido.estado.toLowerCase() === "polimento") {

                    if (carrossel) carrossel.style.border = '8px solid rgb(40, 170, 0)';
                    if (carrosselSuperior) carrosselSuperior.style.borderBottom = '8px solid rgb(40, 170, 0)';

                } else if ( pedido.estado.toLowerCase() === "torno" ) {

                    if (carrossel) carrossel.style.border = 'solid #800020 9px';
                    if (carrosselSuperior) carrosselSuperior.style.borderBottom = 'solid #800020 9px';

                } else if ( pedido.estado.toLowerCase() === "escritorio" ) {

                    if (carrossel) carrossel.style.border = '8px solid blue';
                    if (carrosselSuperior) carrosselSuperior.style.borderBottom = '8px solid blue';
                }
            }
        });
    });
});


// Parte do Scroll---------------------------------------------------------------------------------

window.addEventListener('wheel', function(e) {
    e.preventDefault(); // Impede o scroll padrão do navegador

    const scrollAmount = 124; // define a "passada"
    const direction = e.deltaY > 0 ? 1 : -1;

    window.scrollBy({
      top: scrollAmount * direction,
      behavior: 'auto' 
    });
  }, { passive: false }); // 'passive: false' é necessário para usar e.preventDefault

  // Salva a posição antes do recarregamento
window.addEventListener("beforeunload", () => {
    localStorage.setItem("scrollPos", window.scrollY);
  });

  // Restaura após carregar
window.addEventListener("load", () => {
    const scrollPos = localStorage.getItem("scrollPos");
    if (scrollPos !== null) {
      window.scrollTo(0, parseInt(scrollPos));
    }
  });

// ---------------------------------------------------------------------------------
