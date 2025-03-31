import { diaMesAno } from "../../dataHora.js";
import { CreateCookie } from "../../cookies.js";
//Variaveis do P , PG e PE
const select = document.getElementById('n_p');
let  select_N = select.options[0];
let  select_P = select.options[1];

// Variáveis
const formulario = document.getElementById("formulario");
const cliente1 = document.getElementById('c1');
const cliente2 = document.getElementById('c2');
const cliente3 = document.getElementById('c3');
const estoqueMasculina = document.querySelector('#estoqueMasculina');
const estoqueFeminina = document.querySelector('#estoqueFeminina');
let chave = null;

// Função para mudar a cor da borda
function borderRed(id) {
    document.getElementById(id).style.borderColor = 'red';
}
function borderBlack(id) {
    document.getElementById(id).style.borderColor = 'black';
}

// Função para verificar os inputs
export function verificar() {
    let preview = document.getElementById('modelo2');
    let pedido_mercado = document.getElementById('nome_m').value;
    let pedido_outros = document.getElementById('nome_p').value;
    let respostas = document.getElementById('numeracao_m').value;
    let respostas2 = document.getElementById('numeracao_f').value;
    let descricao = document.getElementById('descricao_Pedido').value;
    let dataInput = document.getElementById('entrega').value;
 
    let respostas3 = [parseFloat(respostas)]; //'Number' transforma em numero e 'parseFloat' em decimais 
    let respostas4 = [parseFloat(respostas2)];
// Funcionamento da data ---------------------------------------------------------------------------------
    const data = diaMesAno();
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
// ▲▲▲▲ Essa pate foi uma conta que eu fiz para validar a data atual e não colocar as datas anteriores no pedido ------
    let valido = true;

    if (cliente1.checked || cliente2.checked || cliente3.checked) {
        document.getElementById("cabecalho").style.borderBottomColor = 'black';
        borderBlack('tipo_pedido');
    } 
    else {
        document.getElementById("cabecalho").style.borderBottomColor = 'red';
        borderRed("tipo_pedido");
        valido = false;
    }
    if(cliente1.checked && select_N.selected){
        borderRed('n_p')
        valido = false;
    }
    else{
        borderBlack('n_p')
    }
    //----------------------------------------------Mercado Livre
    if(cliente1.checked && pedido_mercado.trim() === ''){
        borderRed('nome_m')
        valido = false;
    }
    else{
        borderBlack('nome_m')
    }
    //--------------------------------------------------Centro e Outros
    if(cliente2.checked && pedido_outros.trim() === ''){
        borderRed('nome_p')
        valido = false;
    }
    else if(cliente3.checked && pedido_outros.trim() === '' ){
        borderRed('nome_p')
        valido = false;
    }
    else{
        borderBlack('nome_p')
    }
    //--------------------------------------Validação das numeração Masculina
    if((respostas3 <= 6) || (respostas3 >= 40) || isNaN(respostas3)){ 
        borderRed('numeracao_m')    
        valido = false;
    }
    else{
        borderBlack('numeracao_m') 
    }
// --------------------------------------Validação das numeração Feminina
    if((respostas4 <= 6) || (respostas4 >= 41) || isNaN(respostas4)){
        borderRed('numeracao_f')
        valido = false;
    }
    else{
        borderBlack('numeracao_f')
    }
// --------------------------------------Validação das Descrição do Pedido
    if(descricao.trim() === ''){
        borderRed('descricao_Pedido')
        valido = false;
    }
    else{
        borderBlack('descricao_Pedido')
    }
// ---------------------------------------------------------Validação Imagem
    if(preview.style.display !== 'block'){
        borderRed('modelo')
        borderRed('modelo_rainha')
        valido = false;
    }else{
        borderBlack('modelo')
        borderBlack('modelo_rainha')
    }
    // ------------------------------------------------------Data Personalizada
    if( somaDataInputNumber < somaDataAtualNumber || dataInput.length == 0 || ano_input !== ano ){
        borderRed('entrega')
        valido = false;
    }
    else{
        borderBlack('entrega')
    }
    chave = valido;

    if(chave == true){
        return true
    }
    else{
        return false
    }
}

export function enviar(){
    formulario.addEventListener("submit", function(event) {
        event.preventDefault();
        verificar()
        
        if (chave === true) {  
            document.getElementById('btEnviar').disabled = true;
            const dadosInputs = new FormData(this);

            fetch("../phpScripts/salvar.php", { 
                method: "POST",
                body: dadosInputs
            })
            .then(response => response.text()) 
            .then(data => {
                console.log("Resposta do servidor: Enviado " );
                document.getElementById('btEnviar').disabled = false; // Reativa o botão após a resposta
            })
            .catch(error => console.error("Erro:", error));
            document.getElementById('btEnviar').disabled = false;
        } 
        else {
            console.log("Erro: Formulário inválido, não enviado.");
        }
        document.getElementById('btEnviar').disabled = false; 
    });
}

export function naoenviar(){
    formulario.addEventListener("submit", function(event) {
        event.preventDefault(); // Impede o envio do formulário
    });

}

export {CreateCookie}
