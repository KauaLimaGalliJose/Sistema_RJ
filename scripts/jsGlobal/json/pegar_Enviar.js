
// Função para enviar dados para o arquivo JSON via PHP
export function enviarParaJson(arquivo, arquivoPhp, nome, valor , dataAtual) {

    // Hora e minuto
    const agora = new Date();
    const hora = agora.getHours();
    const minutos = agora.getMinutes();
    const segundos = agora.getSeconds();

    let horaEntrega = `${hora.toString().padStart(2, '0')}:${minutos.toString().padStart(2, '0')}:${segundos.toString().padStart(2, '0')}`;

    fetch('../../arquivoJson/php/' + arquivoPhp, {
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

// Função para carregar dados do arquivo JSON via PHP
export async function carregarPedidosJson() {
    try {
        const resposta = await fetch('../../arquivoJson/php/pegarDadosPedidos.php');
        const dados = await resposta.json();
        return dados;
    } catch (error) {
        console.error('Erro ao carregar JSON:', error);
        return null;
    }
}