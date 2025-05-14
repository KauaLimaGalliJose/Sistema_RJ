//Variaveis Clientes
const cliente1 = document.getElementById('c1');
const cliente2 = document.getElementById('c2');
const cliente3 = document.getElementById('c3');
//Variaveis do P , PG e PE
const  select = document.getElementById('n_p');
let  select_N = select.options[0];
let  select_0 = select.options[1];
let  select_1 = select.options[2];
let  select_2 = select.options[3];
//Outras variaveis
var sei;
let dataFinal; //data que aparecerá no documento 
var feminlina;
var mascuina;
var descricao_cliente;


function outros_p(){
    document.getElementById('outros').style.visibility = 'visible';
    document.getElementById('nome_p').style.visibility = 'visible';
    document.getElementById('n_p').style.visibility = 'hidden';
    document.getElementById('nome_m').style.visibility = 'hidden';

}
function m_l(){
    document.getElementById('nome_p').style.visibility = 'hidden';
    document.getElementById('outros').style.visibility = 'hidden';
    document.getElementById('n_p').style.visibility = 'visible';
    document.getElementById('nome_m').style.visibility = 'visible';
    document.getElementById('outros').value = null;

}
function m_c(){
    document.getElementById('outros').style.visibility = 'hidden';
    document.getElementById('nome_p').style.visibility = 'visible';
    document.getElementById('n_p').style.visibility = 'hidden';
    document.getElementById('nome_m').style.visibility = 'hidden';
    document.getElementById('outros').value = null;
}
function formatDate_Ano(date) {
    const year = String(date.getFullYear()) // Pega os últimos 2 dígitos do ano

    return `${year}`;
}
function formatDate_dia_mes(date) {
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0'); // Janeiro é 0

    return `${day}-${month}`;
} 

function formatDate(date) {
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0'); // Janeiro é 0
    const year = String(date.getFullYear()).slice(-2); // Pega os últimos 2 dígitos do ano

    return `${day}/${month}/${year}`;
}

const today = new Date();
document.getElementById('data').textContent = formatDate(today);
const dia_e_mes = formatDate_dia_mes(today);
const anoAtual = formatDate_Ano(today);

function img_modelo(){
    const fileInput = document.getElementById('uploadimg');
    const mRainha = document.getElementById('modelo_rainha');
 
    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        
        if (file) {
            const reader = new FileReader();
            let preview =  document.getElementById('modelo2');

            reader.onload = function(event) {
                preview.src = event.target.result;
                preview.style.display = 'block'; // Mostra a imagem de pré-visualização
                mRainha.style.display = 'none'
            }

            reader.readAsDataURL(file); // Lê o arquivo como uma URL de dados
        }
    });
}   
function check_unidade() {
    var check = document.getElementById('umpe');

    // Verifica se o checkbox está marcado
    if (check.checked) {
        document.getElementById('numeracao_f').style.visibility = 'hidden';
        document.getElementById('numeracao_f').value = 'nao_tem';
    } else {
        document.getElementById('numeracao_f').style.visibility = 'visible';
    }
}
    

function  verificar(){
    let preview = document.getElementById('modelo2');
    let pedido_mercado = document.getElementById('nome_m').value;
    let respostas = document.getElementById('numeracao_m').value;
    let respostas2 = document.getElementById('numeracao_f').value;
    let descricao = document.getElementById('descricao_P').value;
    let dataInput = document.getElementById('entrega').value;
 
    let respostas3 = [parseFloat(respostas)]; //'Number' transforma em numero e 'parseFloat' em decimais 
    let respostas4 = [parseFloat(respostas2)];
// Funcionamento da data ---------------------------------------------------------------------------------
    const data = formatDate(today);
    let [ano_input, mes_input, dia_input] = dataInput.split('-');
    let [dia,mes,ano] = data.split('/');

    // data Atual
    let varcharDia = String(dia);
    let varcharMes = String(mes);
    let somaDataAtual  = varcharMes + varcharDia;
    let somaDataAtualNumber =  Number(somaDataAtual);
    
    // data Escrita mo input
    let varcharDiaInput = String(dia_input);
    let varcharMesInput = String(mes_input);
    let somaDataAtual_Input = varcharMesInput + varcharDiaInput;
    let somaDataInputNumber = Number(somaDataAtual_Input);
// ▲▲▲▲ Essa pate foi uma conta que eu fiz para falidar a data atual e não colocar as datas anteriores no pedido ------

    let valido = true;

    // Verifica se cada checkbox está marcado
    let c1 = cliente1.checked;
    let c2 = cliente2.checked;
    let c3 = cliente3.checked;
    let a = [c1, c2, c3];
    

    // Verifica se todas as opções estão desmarcadas
    if (!a.includes(true)) {
        alert('Selecione a opção Mercado Livre - Centro das Alianças ou Outros');
        document.getElementById('tipo_pedido').style.borderColor = 'red';
        document.getElementById('cabecalho').style.borderBottomColor = 'red';
        valido = false;
    }
    else{
        document.getElementById('tipo_pedido').style.borderColor = 'black';
        document.getElementById('cabecalho').style.borderBottomColor = 'black';
    }
   // Verifica se um P ,PG ou PE está selecionado
    if(c1 && select_N.selected){
        alert('Selecione os P');
        valido = false;
    }
    if(c1 && pedido_mercado.trim() === ''){
        document.getElementById('nome_m').style.borderColor = 'red';
        alert('Nome do Pedido');
        valido = false;
    }
    else{
        document.getElementById('nome_m').style.borderColor = 'black';
         sei = pedido_mercado
    }
//--------------------------------------Validação das numeração Masculina
    if((respostas3 <= 6) || (respostas3 >= 40) || isNaN(respostas3)){ // 'length' e para contar 
        alert('Numeração Masculina incorreta');
        
        document.getElementById('numeracao_m').style.borderColor = 'red';    
        valido = false;
    }
    else{
        document.getElementById('numeracao_m').style.borderColor = 'black';
        masculina = respostas3;
    }
// --------------------------------------Validação das numeração Feminina
    if((respostas4 <= 6) || (respostas4 >= 40) || isNaN(respostas4)){ // 'length' e para contar 
        alert('Numeração Feminina incorreta');
        
        document.getElementById('numeracao_f').style.borderColor = 'red';
        valido = false;
    }
    else{
        document.getElementById('numeracao_f').style.borderColor = 'black';
        feminina = respostas4;
    }
// --------------------------------------Validação das Descrição do Pedido
    if(descricao.trim() === ''){
        document.getElementById('descricao_P').style.borderColor = 'red';
        alert('Descrição incompleta(Pedido)');
        valido = false;
    }
    else{
        document.getElementById('descricao_P').style.borderColor = 'black';
        descricao_cliente = descricao;
    }
// ---------------------------------------------------------Validação Imagem
    if(preview.style.display !== 'block'){
        alert('Sem Imagem')
        document.getElementById('modelo').style.borderColor = 'red';
        document.getElementById('modelo_rainha').style.borderColor = 'red';
        valido = false;
    }else{
        document.getElementById('modelo').style.borderColor = 'black';
        document.getElementById('modelo_rainha').style.borderColor = 'black';
    }
    // ------------------------------------------------------Data Personalizada
    if( somaDataInputNumber < somaDataAtualNumber ){
        alert('O Dia ou Mes de Entrega está errado')
        document.getElementById('entrega').style.borderColor = 'red'; 
        valido = false;
    }
    else{
        ano_input = anoAtual;
        dataFinal = `${dia_input}/${mes_input}/${ano_input}`; // Inverter a data
        document.getElementById('entrega').style.borderColor = 'black';
    }
    if(dataInput.length == 0){
        dataFinal = formatDate(today);
    }

    console.log("Soma Data Atual: " + somaDataAtualNumber)
    console.log("Soma Data Input: " + somaDataInputNumber)
    
    if(valido === true){
        generate()
        limpar()
        return true;
    }else{
        return false;
    }
}

function limpar(){
    document.getElementById('nome_m').value ='';
    document.getElementById('numeracao_m').value = '';
    document.getElementById('numeracao_f').value = '';
    document.getElementById('descricao_P').value = '';
    document.getElementById('entrega').value = '';
    document.getElementById('grav_externaInput').value = '';
    document.getElementById('descricao_A').value = '';
    document.getElementById('grav_m').value = '';
    document.getElementById("outros").value = '';
    document.getElementById('nome_p').value = '';
}

function grav_e(){
    let grav = document.getElementById('gravacao_externa');

    if(grav.checked){
        document.getElementById('grav_externa').style.visibility = 'visible';
    }
    else{
        document.getElementById('grav_externa').style.visibility = 'hidden';
    }
}

let p_contador = 0; // Variável global para manter o contador
let pg_contador = 0;
let pe_contador = 0;

//Serve para acrecentar P PG PE
function contador_pedidos() {

    while(select_0.selected){
            p_contador++;
            p_contador - 1;
        document.getElementById('P1').innerHTML = "P" + p_contador ;
        
        break
    }
   //----------------------------------------------------------------
   while(select_1.selected){
        pg_contador++;
        pg_contador - 1
        document.getElementById('PG1').innerHTML = "PG" + pg_contador;

        break
    }
   //--------------------------------------------------------------------
   while(select_2.selected){
        pe_contador++;
        pe_contador - 1
        document.getElementById('PE1').innerHTML = "PE" + pe_contador ;

        break
    }
}
// --------------------------------------Seta do Menu serve para voltar o contador P,PG,PE
function voltar(){
    if (select_0.selected) {
        p_contador--;
        document.getElementById('P1').innerHTML = "P" + p_contador;
    } else if (select_1.selected) {
        pg_contador--;
        document.getElementById('PG1').innerHTML = "PG" + pg_contador;
    } else if (select_2.selected) {
        pe_contador--;
        document.getElementById('PE1').innerHTML = "PE" + pe_contador;
    }
}
// --------------------------------------Seta do Menu serve para avançar o contador P,PG,PE
function avancar(){
    if (select_0.selected) {
        p_contador++;
        document.getElementById('P1').innerHTML = "P" + p_contador;
    } else if (select_1.selected) {
        pg_contador++;
        document.getElementById('PG1').innerHTML = "PG" + pg_contador;
    } else if (select_2.selected) {
        pe_contador++;
        document.getElementById('PE1').innerHTML = "PE" + pe_contador;
    }
}



const imagem = document.getElementById('modelo2');
// Converter a imagem do preview(imagem que coloca no meio da pedido) (dataURL) para binário
const base64String = imagem.src.split(',')[1];
const binaryString = window.atob(base64String);
const len = binaryString.length;
const bytes = new Uint8Array(len);
for (let i = 0; i < len; i++) {
    bytes[i] = binaryString.charCodeAt(i);
}

/* ------------ Domwalond docx ou Docmento word ------------ */
function generate() {
    let outros = document.getElementById("outros").value;
    let gravInterna = document.getElementById('grav_m').value;
    
    // Converter a imagem do preview (dataURL) para binário
    const imagem = document.getElementById('modelo2');
    const base64String = imagem.src.split(',')[1];
    const binaryString = window.atob(base64String);
    const len = binaryString.length;
    const bytes = new Uint8Array(len);
    for (let i = 0; i < len; i++) {
        bytes[i] = binaryString.charCodeAt(i);
    }

    // Função para criar o documento
    function criarDocumento(tipo_pedido,contador, sei) {
         // Dividir o texto da gravação em linhas
         const gravacaoLinhas = gravInterna.split('\n').map(linha => new docx.TextRun({
            text: linha,
            bold: true,
            size: 20,
            color: "000000",
            break: 1  // Quebra de linha após cada linha de gravação
        }));

        return new docx.Document({
            sections: [{
                properties: {},
                children: [
                    new docx.Paragraph({
                        children: [
                            new docx.TextRun({
                                text: `${tipo_pedido}${contador} - ${sei}`,
                                bold: true,
                                size: 60,
                                color: "FF0000",
                            }),
                            new docx.TextRun({
                                text: ' -- ' + dataFinal,
                                bold: true,
                                size: 60,
                                color: "000000",
                            }),
                            new docx.TextRun("\n                                                                                                   "),
                            new docx.TextRun("\n"),
                            new docx.TextRun({
                                text: descricao_cliente,
                                bold: true,
                                size: 25,
                                color: "000000",
                            }),
                            new docx.TextRun("\n                                                                                                                   "),
                            new docx.ImageRun({
                                data: bytes,
                                transformation: { width: 200, height: 150 },
                            }),
                            new docx.TextRun("\n                                                                                                  "),
                            new docx.TextRun("\n"),
                            new docx.TextRun({
                                text: 'Feminina: ' + feminina,
                                bold: true,
                                size: 40,
                                color: "000000",
                            }),
                            new docx.TextRun("\n     "),
                            new docx.TextRun({
                                text: 'Masculina: ' + masculina,
                                bold: true,
                                size: 40,
                                color: "000000",
                            }),
                            new docx.TextRun("\n"),
                            // Adicionando cada linha de gravação ao documento
                            ...gravacaoLinhas
                        ],
                    }),
                ],
            }]
        });
    }
// função Sem ser a do mercado Livre
    function criarDocumento_outros(tipo_pedido) {
         // Dividir o texto da gravação em linhas
         const gravacaoLinhas = gravInterna.split('\n').map(linha => new docx.TextRun({
            text: linha,
            bold: true,
            size: 20,
            color: "000000",
            break: 1  // Quebra de linha após cada linha de gravação
        }));
        

        return new docx.Document({
            sections: [{
                properties: {},
                children: [
                    new docx.Paragraph({
                        children: [
                            new docx.TextRun({
                                text: `${tipo_pedido}`,
                                bold: true,
                                size: 60,
                                color: "FF0000",
                            }),
                            new docx.TextRun({
                                text: ' -- ' + dataFinal,
                                bold: true,
                                size: 60,
                                color: "000000",
                            }),
                            new docx.TextRun("\n                                                                                                           "),
                            new docx.TextRun({
                                text: descricao_cliente,
                                bold: true,
                                size: 25,
                                color: "000000",
                            }),
                            new docx.TextRun("\n                                                                                                                  "),
                            new docx.ImageRun({
                                data: bytes,
                                transformation: { width: 200, height: 150 },
                            }),
                            new docx.TextRun("\n                                                                                                  "),
                            new docx.TextRun("\n"),
                            new docx.TextRun({
                                text: 'Feminina: ' + feminina,
                                bold: true,
                                size: 40,
                                color: "000000",
                            }),
                            new docx.TextRun("\n                             "),
                            new docx.TextRun({
                                text: 'Masculina: ' + masculina,
                                bold: true,
                                size: 40,
                                color: "000000",
                            }),
                            new docx.TextRun("\n"),
                            // Adicionando cada linha de gravação ao documento
                            ...gravacaoLinhas
                        ],
                    }),
                ],
            }]
        });
    }
    // Função para salvar o documento sem ser Mercado Livre
    function salvaDocumento_outros(documento, tipo_pedido) {
        docx.Packer.toBlob(documento).then(blob => {
            saveAs(blob, `${outros}-${tipo_pedido}__${dia_e_mes}`);
            document.getElementById(tipo_pedido + '1').innerHTML = `${tipo_pedido}`;
        });
    }
    function salvaDocumento_outrosc3(documento, tipo_pedido, cliente) {
        docx.Packer.toBlob(documento).then(blob => {
            saveAs(blob, `${cliente}-${tipo_pedido}__${dia_e_mes}`);
            document.getElementById(tipo_pedido + '1').innerHTML = `${tipo_pedido}`;
        });
    }

    // Função para salvar o documento
    function salvaDocumento(documento, tipo_pedido, contador, sei) {
        docx.Packer.toBlob(documento).then(blob => {
            saveAs(blob, `${tipo_pedido}${contador}__${sei}-${dia_e_mes}`);
            document.getElementById(tipo_pedido + '1').innerHTML = `${tipo_pedido}${contador + 1}`;
        });
    }

    // Gerar documentos de acordo com a seleção
    if(cliente1.checked){
    //Pedido P
    if (select_0.selected) {

        const documento = criarDocumento('P', p_contador, sei);
        salvaDocumento(documento, 'P', p_contador, sei);

    }
    //Pedido PG
    else if (select_1.selected) {

        const documento = criarDocumento('PG', pg_contador, sei);
        salvaDocumento(documento, 'PG', pg_contador, sei);

    }
    //Pedido PE
    else if (select_2.selected) {

        const documento = criarDocumento('PE', pe_contador, sei);
        salvaDocumento(documento, 'PE', pe_contador, sei);

    }
   }
   // Sem ser Mercado Livre
   if(cliente2.checked){
   let centroAliancaOutros = document.getElementById('nome_p').value;
    outros.value = ' ';

    const documento = criarDocumento_outros(centroAliancaOutros);
    salvaDocumento_outros(documento,centroAliancaOutros,outros);
   }
   if(cliente3.checked){
    let centroAliancaOutros = document.getElementById('nome_p').value;
    
     const documento = criarDocumento_outros(centroAliancaOutros);
     salvaDocumento_outrosc3(documento,centroAliancaOutros,outros);
    }

}


//Finalizado Finalmente :)