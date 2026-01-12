

async function verificarPedidosJson(pedido, arquivoPhp, $tipo, gravacao, radio) {

    if (pedido === "PF") {
        await enviarParaJson('pedidos.json', arquivoPhp, radio, $tipo);

        if (gravacao != "nao") {

            enviarParaJson_gravacao('pedidos.json', radio, gravacao);
        }
    }
    else if (pedido === "PG") {
        await enviarParaJson('pedidosjsonpg.json', arquivoPhp, radio, $tipo);

        if (gravacao != "nao") {

            enviarParaJson_gravacao('pedidosjsonpg.json', radio, gravacao);
        }
    }
    else if (pedido === "PE") {
        await enviarParaJson('pedidosjsonpe.json', arquivoPhp, radio, $tipo);

        if (gravacao != "nao") {

            enviarParaJson_gravacao('pedidosjsonpe.json', radio, gravacao);
        }
    }

}

// Nova função para enviar dados ao backend
async function enviarParaJson(arquivo, arquivoPhp, nome, valor) {

    // Hora e minuto
    const dataAtual = new Date().toLocaleDateString('pt-BR', { timeZone: 'America/Sao_Paulo' }).split('/').reverse().join('-');
    const agora = new Date();
    const hora = agora.getHours();
    const minutos = agora.getMinutes();
    const segundos = agora.getSeconds();

    let horaEntrega = `${hora.toString().padStart(2, '0')}:${minutos.toString().padStart(2, '0')}:${segundos.toString().padStart(2, '0')}`;

    await fetch('../arquivoJson/php/' + arquivoPhp, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ arquivo, nome, valor, dataAtual, horaEntrega }) // Inclui o nome do arquivo no corpo
    })
        .then(response => response.json())
        .then(data => {
            console.log('Salvo no JSON:', data);
        })
        .catch(error => {
            console.error('Erro ao salvar no JSON:', error);
        });
}

function enviarParaJson_gravacao(arquivo, nome, gravacao) {

    // Hora e minuto
    const agora = new Date();
    const hora = agora.getHours();
    const minutos = agora.getMinutes();
    const segundos = agora.getSeconds();

    let horaEntrega = `${hora.toString().padStart(2, '0')}:${minutos.toString().padStart(2, '0')}:${segundos.toString().padStart(2, '0')}`;

    fetch('../arquivoJson/php/salvarPedidoGravacao.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ arquivo, nome, gravacao, horaEntrega }) // Inclui o nome do arquivo no corpo
    })
        .then(response => response.json())
        .then(data => {
            // console.log('Salvo no JSON:', data);
        })
        .catch(error => {
            console.error('Erro ao salvar no JSON:', error);
        });
}

async function carregarPedidosJson(pedido) {
    try {

        const response = await fetch('../arquivoJson/php/pegarDadosPedidos.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ pedido }) // mantém o nome exato
        });

        if (!response.ok) {
            throw new Error(`Erro HTTP ${response.status}`);
        }

        const dados = await response.json();
        return dados;

    } catch (error) {
        console.error('❌ ');
        return null;
    }
}

// Nova função para salvar estado dos radios
async function salvarEstadoRadio(radio, caminho) {

    // Garante que pega a string do valor
    let valor = typeof radio === "string" ? radio : radio.id;

    let radioSplit = valor.split('-');
    // Pega a primeira parte e remove os dígitos
    let pedidos = radioSplit[1].replace(/\d+/g, "").trim();

    const carrossel = radio.closest('.carrossel');
    const carrosselSuperior = radio.closest('.carrosselSuperior');
    if (!carrossel && !carrosselSuperior) return;

    if (radio.value === "Escritorio") {

        carrossel.style.border = '6px solid blue';
        carrosselSuperior.style.borderBottom = '6px solid blue';

        await verificarPedidosJson(pedidos, 'salvarPedidoPolimento.php', "escritorio", "nao", radio.classList[1]);

    } else if (radio.value === "Polimento") {

        carrossel.style.border = '6px solid rgb(40, 170, 0)';
        carrosselSuperior.style.borderBottom = '6px solid rgb(40, 170, 0)';

        await verificarPedidosJson(pedidos, 'salvarPedidoPolimento.php', "polimento", "nao", radio.classList[1]);

    } else if (radio.value === "torno") {

        carrossel.style.border = 'solid #E6C27A 6px';
        carrosselSuperior.style.borderBottom = 'solid #E6C27A 6px';

        await verificarPedidosJson(pedidos, 'salvarPedidoPolimento.php', "torno", "nao", radio.classList[1]);
    }
}

async function salvarCheckbox(checkbox, caminho) {

    caminhoGlobal = caminho;
    let valor = checkbox.id;

    let checkboxSplit = valor.split('-');
    // Pega a primeira parte e remove os dígitos
    let pedidos = checkboxSplit[1].replace(/\d+/g, "").trim();

    if (checkbox.checked) {

        localStorage.setItem(checkbox.id, 'true');

        //console.log('true')
    }
    else if (!checkbox.checked) {

        localStorage.setItem(checkbox.id, 'false');

        //console.log('false')
    }
}

function sincronizarPedidosJson(dadosJson) {

    Object.entries(dadosJson).forEach(([chave, pedido]) => {

        // Aqui você precisa relacionar 'chave' com algum atributo no HTML para achar o grupo certo de radios
        // Supondo que o 'name' do input radio seja 'marcado_' + chave, igual ao PHP
        const nomeRadio = "marcado_" + chave;

        // Seleciona todos os radios desse grupo
        const radios = document.querySelectorAll(`input[name="${nomeRadio}"]`);

        radios.forEach(radio => {
            if (pedido.estado && typeof pedido.estado === 'string' && radio.value.toLowerCase() === pedido.estado.toLowerCase()) {

                // Aplica os estilos aos elementos relacionados (ajuste se precisar)
                const carrossel = radio.closest('.carrossel');
                const carrosselSuperior = radio.closest('.carrosselSuperior');


                if (pedido.estado === "polimento") {

                    if (carrossel) carrossel.style.border = '6px solid rgb(40, 170, 0)';
                    if (carrosselSuperior) carrosselSuperior.style.borderBottom = '6px solid rgb(40, 170, 0)';

                    const radioCheck = document.getElementById(`check_ID_torno_-${chave}`);
                    if (radioCheck) radioCheck.checked = true; // marca o radio conforme o estado do JSON

                } else if (pedido.estado === "escritorio") {

                    if (carrossel) carrossel.style.border = '8px solid blue';
                    if (carrosselSuperior) carrosselSuperior.style.borderBottom = '8px solid blue';

                    const radioCheck = document.getElementById(`check_ID_polimento_-${chave}`);
                    if (radioCheck) radioCheck.checked = true; // marca o radio conforme o estado do JSON

                } else if (pedido.estado === "torno") {

                    if (carrossel) carrossel.style.border = 'solid #E6C27A 6px';
                    if (carrosselSuperior) carrosselSuperior.style.borderBottom = 'solid #E6C27A 6px';

                    const radioCheck = document.getElementById(`check_ID_desmarcado_-${chave}`);
                    if (radioCheck) radioCheck.checked = true; // marca o radio conforme o estado do JSON
                }
            }
        });

        // Restaura o estado dos checkboxes
        const checkboxs = document.querySelectorAll('.input_num');
        checkboxs.forEach(checkbox => {
            if (checkbox.classList[1].toLowerCase() === chave.toLowerCase()) {

                if (pedido.Masculina === 'feito' && checkbox.classList[2] == 'M') {

                    checkbox.checked = true;
                    //console.log('entrou aqui')
                }
                if (pedido.Feminina === 'feito' && checkbox.classList[2] == 'F') {

                    checkbox.checked = true;
                }
                else if (pedido.Feminina === 'Pendente' && checkbox.classList[2] == 'F') {

                    checkbox.checked = false;
                }
                else if (pedido.Masculina === 'Pendente' && checkbox.classList[2] == 'M') {

                    checkbox.checked = false;
                }
            }
        });
    });
}

