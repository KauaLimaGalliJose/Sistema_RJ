// imports
import { limpar , selectN } from "../../js/funcao.js";
import { mudaPDF } from "./funcao.js";
import { radioCabecalho, check_unidade, gravacaoExterna, checkboxRodape } from "../../js/radiosChitobox.js";
import img_modelo  from "../../js/imagemInput.js";
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

//Global Variaveis
export let contador = { 
contador_P:0,
contador_Pg:0, 
contador_Pe:0
}

//acresentando dados do Banco de Dados
contador.contador_P = getCookie('contadorPf');
contador.contador_Pg = getCookie('contadorPg');
contador.contador_Pe = getCookie('contadorPe');


//Funções com Buttons


addEventListener('change', function(){
    radioCabecalho()
    checkboxRodape()
    gravacaoExterna()
}); 

unidadeCheck.addEventListener('click',function(){
    check_unidade()
});

imagemBt.addEventListener('click', function(){
    img_modelo()
});

pdfBt.addEventListener('change', function(){
    mudaPDF()
});

limparBt.addEventListener('click',function(){
    limpar()
});

enviarBt.addEventListener('click',function(){
    let dataDigitada = document.getElementById('entrega').value;
    let dataDigitadaSplit = dataDigitada.split('-');

    if(verificar() === true){
    
            selectN();
            enviandoJson(dataDigitadaSplit[1],dataDigitadaSplit[2]);
            
            const form = document.getElementById('formulario');
            const formData = new FormData(form);
    
            fetch("../phpScripts/salvar.php", { 
                    method: "POST",
                    body: formData
            })
            .then(response => response.text()) 
            .then(data => {
                console.log("Resposta do servidor: Enviado " + data);
    
            })
            .catch(error => console.error("Erro:", error));
            
            alert('Editado Com Sucesso !!');
            window.close();
        }
    else{
        console.log("Erro: Formulário inválido, não enviado.");
        alert('🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨 \n \n == Não Enviado, Verifique o Pedido == \n \n 🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨 ' );
    }
    document.getElementById("imagemPdf").src = '../imagemPedido/pdf.png';
    document.getElementById('pdfSalvo').style.visibility = 'hidden' ;
});



// Adiciona favicon dinamicamente coroa.ico
(function() {
    let link = document.createElement('link');
    link.rel = 'shortcut icon';
    link.type = 'image/x-icon';
    link.href = '../imagemPedido/coroa.ico'; 
    document.head.appendChild(link);
})();
