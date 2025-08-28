// imports
import { voltar, avancar, limpar , atualizarDiv, selectN , mudaPDF } from "./js/funcao.js";
import { radioCabecalho, check_unidade, gravacaoExterna, checkboxRodape } from "./js/radiosChitobox.js";
import img_modelo  from "./js/imagemInput.js";
import { dataEntrega} from "./js/dataHora.js";
import { verificar } from "./js/verificarEnviar.js";
import { CreateCookie,getCookie } from "./js/cookies.js";
import { enviandoJson } from "./js/enviandoJSON.js";

//Buttons
const voltarBt = document.getElementById('seta_esquerda');
const avancarBt = document.getElementById('seta_direita');
const limparBt = document.getElementById('limpar');
const imagemBt = document.getElementById('uploadimg');
const pdfBt = document.getElementById('inputPDF');
const enviarBt = document.getElementById('btEnviar');
const unidadeCheck = document.getElementById('checkboxFeminina');
const buttonPdf = document.getElementById('exportar');
const buttonPdfDiv = document.getElementById('buttonPdf');
const enviarExportar = document.getElementById('exportarFormulario');
const buttonPdfImportar = document.getElementById('importar');
const buttonPdfDivImportar = document.getElementById('buttonPdfImportar');

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

voltarBt.addEventListener('click', function(){
   contador =  voltar(contador.contador_P,contador.contador_Pg,contador.contador_Pe)
});

avancarBt.addEventListener('click', function(){
   contador =  avancar(contador.contador_P,contador.contador_Pg,contador.contador_Pe)
});

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

//DIV EXPORTAR Tinha pego do pedidos.php 
buttonPdf.addEventListener('click',function(){
    const pdfDiv =  document.getElementById('PdfDivMae');
  
    if(pdfDiv.style.visibility == 'hidden'){
      pdfDiv.style.visibility = 'visible';
  
      document.getElementById('formulario').style.filter = 'brightness(0.65) contrast(0.85) blur(2px)';
      document.getElementById('conteudo').style.filter = 'brightness(0.75) contrast(0.95) blur(2px)';
      document.getElementById('formulario').style.pointerEvents = 'none';
      document.getElementById('conteudo').style.pointerEvents = 'none';
      document.querySelector('footer').style.visibility = 'hidden';
      
    }
    else{
      pdfDiv.style.visibility = 'hidden';
  
      document.getElementById('conteudo').style.filter = '';
      document.getElementById('formulario').style.filter = '';
      document.getElementById('formulario').style.pointerEvents = 'auto';
      document.getElementById('conteudo').style.pointerEvents = 'auto';
      document.querySelector('footer').style.visibility = 'visible';
    }
  })
  
buttonPdfDiv.addEventListener('click', function(){
    const pdfDiv =  document.getElementById('PdfDivMae');
  
    pdfDiv.style.visibility = 'hidden';
  
    document.getElementById('conteudo').style.filter = '';
    document.getElementById('formulario').style.filter = '';
    document.getElementById('formulario').style.pointerEvents = 'auto';
    document.getElementById('conteudo').style.pointerEvents = 'auto';
    document.querySelector('footer').style.visibility = 'visible';
    
  })

enviarExportar.addEventListener('submit',function(event){
  // Variavel
   const pf = document.getElementById('PF');
   const pg = document.getElementById('PG');
   const pe = document.getElementById('PE');

  // DATA INPUT ---------------------------------------------
  if(document.getElementById('dataExportarInput').value.trim() === ''){
    event.preventDefault();
    alert('Coloque a Data!!')
    document.getElementById('dataExportarInput').style.borderColor = 'red';
  }
  else{
    document.getElementById('dataExportarInput').style.borderColor = 'black';
  // checked INPUT ---------------------------------------------
  }
  if(!pf.checked && !pg.checked && !pe.checked){
    event.preventDefault();
    alert('Marque um Pedido (PF,PG,PE)');
  }

})
// ---------------------------------------------------------------------------

//DIV IMPORTAR 
buttonPdfImportar.addEventListener('click',function(){
    const pdfDiv =  document.getElementById('PdfDivMaeImportar');
  
    if(pdfDiv.style.visibility == 'hidden'){
      pdfDiv.style.visibility = 'visible';
  
      document.getElementById('formulario').style.filter = 'brightness(0.65) contrast(0.85) blur(2px)';
      document.getElementById('conteudo').style.filter = 'brightness(0.75) contrast(0.95) blur(2px)';
      document.getElementById('formulario').style.pointerEvents = 'none';
      document.getElementById('conteudo').style.pointerEvents = 'none';
      document.querySelector('footer').style.visibility = 'hidden';
      
    }
    else{
      pdfDiv.style.visibility = 'hidden';
  
      document.getElementById('conteudo').style.filter = '';
      document.getElementById('formulario').style.filter = '';
      document.getElementById('formulario').style.pointerEvents = 'auto';
      document.getElementById('conteudo').style.pointerEvents = 'auto';
      document.querySelector('footer').style.visibility = 'visible';
    }
  })
  
buttonPdfDivImportar.addEventListener('click', function(){
    const pdfDiv =  document.getElementById('PdfDivMaeImportar');
  
    pdfDiv.style.visibility = 'hidden';
  
    document.getElementById('conteudo').style.filter = '';
    document.getElementById('formulario').style.filter = '';
    document.getElementById('formulario').style.pointerEvents = 'auto';
    document.getElementById('conteudo').style.pointerEvents = 'auto';
    document.querySelector('footer').style.visibility = 'visible';
    
  })
// ---------------------------------------------------------------------------

enviarBt.addEventListener('click', async function(){
    let dataDigitada = document.getElementById('entrega').value;
    let dataDigitadaSplit = dataDigitada.split('-');

    if(verificar() === true){

        selectN();
        enviandoJson(dataDigitadaSplit[1],dataDigitadaSplit[2]);
       contador =  avancar(contador.contador_P,contador.contador_Pg,contador.contador_Pe);
        
        const form = document.getElementById('formulario');
        const formData = new FormData(form);

        fetch("./php/PG2_Escritorio1.php", { 
                method: "POST",
                body: formData
        })
        .then(response => response.text()) 
        .then(data => {
            console.log("Resposta do servidor: Enviado " + data);

        })
        .catch(error => console.error("Erro:", error));
 
    }
    else{
        console.log("Erro: Formulário inválido, não enviado.");
        CreateCookie('Pfverificador','Nao_Enviado' ,0.00012);
    }
    document.getElementById("imagemPdf").src = './pedidos/imagemPedido/pdf.png';
    document.getElementById('pdfSalvo').style.visibility = 'hidden' ;
    atualizarDiv("#envioP", './php/divRodapeDinamica.php');
    //console.log(document.cookie);
});


//Funções para ser iniciadas
dataEntrega();


// Adiciona favicon dinamicamente coroa.ico
(function() {
    let link = document.createElement('link');
    link.rel = 'shortcut icon';
    link.type = 'image/x-icon';
    link.href = './Escritorio_img/coroa.ico'; 
    document.head.appendChild(link);
})();


export {CreateCookie}