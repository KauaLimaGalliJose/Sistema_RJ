// imports
import { limpar, capitalizarPalavras, bloquearCaracteres, atualizarDiv } from "../../js/funcao.js";
import { mudaPDF , selectN_mainEdit} from "./funcao.js";
import { radioCabecalho, check_unidade, aguardar_grav, checkboxRodape } from "../../js/radiosChitobox.js";
import img_modelo from "../../js/imagemInput.js";
import { enviandoJson } from "./enviandoJSON_Edit.js";
import { verificar } from "./verificarEnviar.js";
import { getCookie } from "../../js/cookies.js";

//Buttons
const voltarBt = document.getElementById('seta_esquerda');
const avancarBt = document.getElementById('seta_direita');
const limparBt = document.getElementById('limpar');
const imagemBt = document.getElementById('uploadimg');
const pdfBt = document.getElementById('inputPDF');
const enviarBt = document.getElementById('btEnviar');
const unidadeCheck = document.getElementById('checkboxFeminina');
const estoqueSelect = document.getElementById('estoque');
const gravInternaF = document.getElementById('gravInternaF');
const gravInternaM = document.getElementById('gravInternaM');
const gravInternaChekboxF = document.getElementById('gravInternaChekF');
const gravInternaChekboxM = document.getElementById('gravInternaChekM');
const gravacaoCheckbox = document.getElementById('gravacao_externa');
const radioMercadolivre = document.getElementById('c1');

// Inputs 
const outros = document.getElementById('outros');
const nome_p = document.getElementById('nome_p');
const nome_m = document.getElementById('nome_m');
const select = document.getElementById('n_p');
const nome_pInput = document.getElementById('nome_p');
const nome_outros = document.getElementById('outros');
const data_pInput = document.getElementById('entrega');

// radios 
const cliente2 = document.getElementById('c2');
const cliente3 = document.getElementById('c3');


//Global Variaveis
export let contador = {
    contador_P: 0,
    contador_Pg: 0,
    contador_Pe: 0
}

//acresentando dados do Banco de Dados
contador.contador_P = getCookie('contadorPf');
contador.contador_Pg = getCookie('contadorPg');
contador.contador_Pe = getCookie('contadorPe');


//Funções com Buttons
estoqueSelect.addEventListener('change', function () {


    if (radioMercadolivre.checked) {


        let dataDigitada = document.getElementById('entrega').value;
        const idpedidos = document.getElementById('n_p').value + '-' + dataDigitada;
        const selected = this.value;
        window.location.href = `./editarPedido.php?idpedidos=${idpedidos}&estoque=${selected}`;
    }
    else {

        let dataDigitada = document.getElementById('entrega_original').value;
        const idpedidos = document.getElementById('outros_hidden').value + '-' + document.getElementById('nome_p_original').value + '-' + dataDigitada;
        const selected = this.value;
        window.location.href = `./editarPedido.php?idpedidos=${idpedidos}&estoque=${selected}`;
    }
});

addEventListener('change', function () {
    radioCabecalho()
    checkboxRodape()
});

// Para deixar a palavra inicial maiuscula e o resto minusculo *----------------

gravInternaF.addEventListener('input', function () {
    capitalizarPalavras(this, gravInternaChekboxF);
});

gravInternaM.addEventListener('input', function () {
    capitalizarPalavras(this, gravInternaChekboxM);
});

// ---------------------------------------------------------------------------------- 

// Para bloquear - + _ no inptus minusculo *-----------------------------------------

outros.addEventListener('input', function () {
    bloquearCaracteres(this);
});

nome_p.addEventListener('input', function () {
    bloquearCaracteres(this);
});

nome_m.addEventListener('input', function () {
    bloquearCaracteres(this);
});


// ---------------------------------------------------------------------------------- 
gravacaoCheckbox.addEventListener('click', function () {
    aguardar_grav()
});

unidadeCheck.addEventListener('click', function () {
    check_unidade()
});

imagemBt.addEventListener('click', function () {
    img_modelo()
});

pdfBt.addEventListener('change', function () {
    mudaPDF()
});

limparBt.addEventListener('click', function () {
    limpar()
});

enviarBt.addEventListener('click', async function () {

    let dataDigitada = document.getElementById('entrega').value;
    let dataDigitadaSplit = dataDigitada.split('-');

    if (verificar() === true) {

        // espera selectN_mainEdit terminar
        const result = await selectN_mainEdit('../phpScripts/divRodapeDinamicaEdit.php',"Atualizado");
        enviandoJson(dataDigitadaSplit[1], dataDigitadaSplit[2]);

        const form = document.getElementById('formulario');
        const formData = new FormData(form);

        // mantém sua estrutura, só remove o conflito await + then
        const response = await fetch("../phpScripts/salvar.php", {
            method: "POST",
            body: formData
        });

        console.log("Status do fetch:", response.status);

        const data = await response.text();
        console.log("Resposta completa do servidor:", data);


    } 
    else {

        console.log("Erro: Formulário inválido, não enviado.");
        alert(
            '🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨 \n\n' +
            '== Não Enviado, Verifique o Pedido == \n\n' +
            '🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨'
        );
    }

    document.getElementById("imagemPdf").src = '../imagemPedido/pdf.png';
    document.getElementById('pdfSalvo').style.visibility = 'hidden';

});




// Adiciona favicon dinamicamente coroa.ico
(function () {
    let link = document.createElement('link');
    link.rel = 'shortcut icon';
    link.type = 'image/x-icon';
    link.href = '../imagemPedido/coroa.ico';
    document.head.appendChild(link);
})();

