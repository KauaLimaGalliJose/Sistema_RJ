import { diaMesAno } from "./dataHora.js";

//Variaveis do P , PG e PE
const select = document.getElementById('n_p');
let select_N = select.options[0];
let select_P = select.options[1];

// Variáveis
const formulario = document.getElementById("formulario");
const cliente1 = document.getElementById('c1');
const cliente2 = document.getElementById('c2');
const cliente3 = document.getElementById('c3');
const estoqueMasculina = document.querySelector('#estoqueMasculina');
const estoqueFeminina = document.querySelector('#estoqueFeminina');
let estoquePersonalizado = document.getElementById('estoque');

// Função para mudar a cor 
function borderRed(id) {
    const el = document.getElementById(id);
    el.style.backgroundColor = 'rgba(255, 182, 182, 1)'; // vermelho claro translúcido
}

function borderBlack(id) {
    const el = document.getElementById(id);
    el.style.backgroundColor = '#ffffff'; // branco
}

function borderPersonazado(id, color) {
    const el = document.getElementById(id);
    el.style.backgroundColor = color;
}

// Função para verificar os inputs
export function verificar() {
    let pdfInput = document.getElementById("inputPDF");
    let imagemPdf = document.getElementById("imagemPdf");
    let preview = document.getElementById('modelo2');
    let pedido_mercado = document.getElementById('nome_m').value;
    let pedido_outros = document.getElementById('nome_p').value;
    let pedido_outros_input = document.getElementById('outros').value;
    let respostas = document.getElementById('numeracao_m').value;
    let respostas2 = document.getElementById('numeracao_f').value;
    let descricao = document.getElementById('descricao_Pedido').value;
    let dataInput = document.getElementById('entrega').value;
    let chave = null;

    let respostas3 = [parseFloat(respostas)]; //'Number' transforma em numero e 'parseFloat' em decimais 
    let respostas4 = [parseFloat(respostas2)];
    // Funcionamento da data ---------------------------------------------------------------------------------
    const data = diaMesAno();
    let [ano_input, mes_input, dia_input] = dataInput.split('-');
    let [dia, mes, ano] = data.split('/');

    // data Atual    
    let agora = new Date();
    let dataAtual = new Date(
        agora.toLocaleString('en-US', { timeZone: 'America/Sao_Paulo' })
    );
    dataAtual.setHours(0, 0, 0, 0);

    let valido = true;

    if (cliente1.checked || cliente2.checked || cliente3.checked) {
        document.getElementById("cabecalho").style.borderBottomColor = 'black';
        borderPersonazado('tipo_pedido', 'antiquewhite');
    }
    else {
        document.getElementById("cabecalho").style.borderBottomColor = 'red';
        borderRed("tipo_pedido");
        valido = false;
    }
    if (cliente1.checked && select_N.selected) {
        borderRed('n_p')
        valido = false;
    }
    else {
        borderBlack('n_p')
    }
    //----------------------------------------------Mercado Livre
    if (cliente1.checked && pedido_mercado.trim() === '') {
        borderRed('nome_m')
        valido = false;
    }
    else {
        borderBlack('nome_m')
    }
    //--------------------------------------------------Centro e Outros
    if (cliente2.checked && pedido_outros.trim() === '') {
        borderRed('nome_p')
        valido = false;
    }
    else if (cliente3.checked && pedido_outros.trim() === '') {
        borderRed('nome_p')
        valido = false;
    }
    else if (cliente3.checked && pedido_outros_input.trim() === '') {
        borderRed('outros')
        valido = false;
    }
    else {
        borderBlack('nome_p')
    }
    //--------------------------------------Validação das numeração Masculina
    if ((respostas3 <= 6) || (respostas3 >= 40) || isNaN(respostas3)) {
        borderRed('numeracao_m')
        valido = false;
    }
    else {
        borderBlack('numeracao_m')
    }
    // --------------------------------------Validação das numeração Feminina
    if ((respostas4 <= 6) || (respostas4 >= 41) || isNaN(respostas4)) {
        borderRed('numeracao_f')
        valido = false;
    }
    else {
        borderBlack('numeracao_f')
    }
    // --------------------------------------Validação das Descrição do Pedido
    if (descricao.trim() === '') {
        borderRed('descricao_Pedido')
        valido = false;
    }
    else {
        borderBlack('descricao_Pedido')
    }
    // ---------------------------------------------------------Validação Imagem
    if (preview.style.display !== 'block') {
        borderPersonazado('botaoImg_img', 'red')
        borderPersonazado('botaoImg_img', 'red')
        alert('Por favor, insira uma imagem do modelo da aliança.')
        valido = false;
    } else {
        borderBlack('botaoImg_img')
        borderBlack('botaoImg_img')

        
    }
    // ------------------------------------------------------Data Personalizada
    if (dataInput.length === 0) {

        borderRed('entrega');
        valido = false;
    } 
    else {

        // Data atual em Brasília
        let agora = new Date();
        let dataAtual = new Date(
            agora.toLocaleString('en-US', { timeZone: 'America/Sao_Paulo' })
        );
        dataAtual.setHours(0, 0, 0, 0);

        // Data do input (criada manualmente, SEM UTC)
        let [ano, mes, dia] = dataInput.split('-');
        let dataEntrega = new Date(ano, mes - 1, dia);
        dataEntrega.setHours(0, 0, 0, 0);

        if (dataEntrega < dataAtual) {

            borderRed('entrega');
            valido = false;
            
        } 
        else {
            
            borderBlack('entrega');
        }
    }
    // --------------------------------------------------------Verificação Rodapé
    if (estoqueFeminina.checked && estoqueMasculina.checked && select_P.selected) {
        valido = false;
        borderRed('rodape')
    }
    else {
        borderPersonazado('rodape', 'antiquewhite')
    }
    // --------------------------------------------------------Validação do PDF não verifica se realmente tem PDF só para o estilo
    if (pdfInput.files.length > 0 || (cliente2.checked || cliente3.checked)) {
        imagemPdf.src = './pedidos/imagemPedido/pdfAzul.png';
    }
    else {

        imagemPdf.src = './pedidos/imagemPedido/pdf.png';
        //valido = false; Ative caso precise validar 
    }
    // arumando envio da gravação para evitar espaço em branco
    if (document.getElementById('gravInternaM').value.trim() === '') {

        document.getElementById('gravInternaM').value = ''
    }
    if (document.getElementById('gravInternaF').value.trim() === '') {

        document.getElementById('gravInternaF').value = ''
    }

    // --------------------------------------------------------Chave final
    chave = valido;

    if (chave == true) {
        return true
    }
    else {
        return false
    }
}

//enviar formulario
export function submitForm(formulario, aquivo) {

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