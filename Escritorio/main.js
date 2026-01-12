// imports
import { voltar, avancar, limpar, limpar_btn, atualizarDiv, atualizarDiv_2, selectN, mudaPDF, capitalizarPalavras, capitalizarPalavras_Cliente, bloquearCaracteres } from "./js/funcao.js";
import { radioCabecalho, check_unidade, aguardar_grav, checkboxRodape } from "./js/radiosChitobox.js";
import img_modelo from "./js/imagemInput.js";
import { verificar, submitForm } from "./js/verificarEnviar.js";
import { CreateCookie, getCookie } from "./js/cookies.js";
import { enviandoJson } from "./js/enviandoJSON.js";
import { salvarFormulario, restaurarFormulario, limparFormularioDoLocalStorage } from "./js/memoriaLocalStorage.js";

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
const estoqueSelect = document.getElementById('estoque');
const dataInput = document.getElementById('entrega');
const gravInternaF = document.getElementById('gravInternaF');
const gravInternaM = document.getElementById('gravInternaM');
const gravInternaChekboxF = document.getElementById('gravInternaChekF');
const gravInternaChekboxM = document.getElementById('gravInternaChekM');
const gravacaoCheckbox = document.getElementById('gravacao_externa');
const label_F = document.getElementById('label_F');
const label_M = document.getElementById('label_M');
const numeracao_m = document.getElementById('numeracao_m');
const numeracao_f = document.getElementById('numeracao_f');
const peso_btn = document.getElementById('peso_btn');
const voltarPeso = document.getElementById('voltarPeso');
const radioMercadolivre = document.getElementById('c1');

// Inputs 
const outros = document.getElementById('outros');
const nome_p = document.getElementById('nome_p');
const nome_m = document.getElementById('nome_m');

// Div Peso
const filtrar_peso = document.getElementById('filtrarInput');
const PF_peso = document.getElementById('PF_peso');
const PG_peso = document.getElementById('PG_peso');
const PE_peso = document.getElementById('PE_peso');
const cliente_peso = document.getElementById('cliente_peso');
const input_peso = document.querySelectorAll('.input_peso');


//Global Variaveis
export let contador = {
  contador_P: 0,
  contador_Pg: 0,
  contador_Pe: 0
}


//acresentando dados do Banco de Dados
contador.contador_P = getCookie('contadorpf');
contador.contador_Pg = getCookie('contadorpg');
contador.contador_Pe = getCookie('contadorpe');


//Funções com Buttons
estoqueSelect.addEventListener('change', function () {
  const selected = this.value;
  window.location.href = `./PG2-Escritorio.php?estoque=${selected}`;
  window.reload();
});

voltarBt.addEventListener('click', function () {
  contador = voltar(contador.contador_P, contador.contador_Pg, contador.contador_Pe)
});

avancarBt.addEventListener('click', function () {
  contador = avancar(contador.contador_P, contador.contador_Pg, contador.contador_Pe)
});

dataInput.addEventListener('change', function () {

  CreateCookie('dataInputEscritorio', dataInput.value, 1);
  location.reload();

});

addEventListener('change', function () {
  radioCabecalho()
  checkboxRodape()
  salvarFormulario('formulario');
});

// Para colocar o numero do lado da gravação ----------------
numeracao_m.addEventListener('input', function () {

  label_M.innerHTML = numeracao_m.value;

});
numeracao_f.addEventListener('input', function () {

  label_F.innerHTML = numeracao_f.value;

});

// ----------------------------------------------------------------------------------

// Para deixar a palavra inicial maiuscula e o resto minusculo *----------------

gravInternaF.addEventListener('input', function () {
  capitalizarPalavras(this, gravInternaChekboxF);
});

gravInternaM.addEventListener('input', function () {
  capitalizarPalavras(this, gravInternaChekboxM);
});

outros.addEventListener('input', function () {
  capitalizarPalavras_Cliente(this);
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
gravacaoCheckbox.addEventListener('change', function () {
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

  limparFormularioDoLocalStorage('formulario');
  limpar_btn()
});

//DIV EXPORTAR Tinha pego do pedidos.php 
buttonPdf.addEventListener('click', function () {
  const pdfDiv = document.getElementById('PdfDivMae');

  if (pdfDiv.style.visibility == 'hidden') {
    pdfDiv.style.visibility = 'visible';

    document.getElementById('formulario').style.filter = 'brightness(0.65) contrast(0.85) blur(2px)';
    document.getElementById('conteudo').style.filter = 'brightness(0.75) contrast(0.95) blur(2px)';
    document.getElementById('formulario').style.pointerEvents = 'none';
    document.getElementById('conteudo').style.pointerEvents = 'none';
    document.querySelector('footer').style.visibility = 'hidden';

  }
  else {
    pdfDiv.style.visibility = 'hidden';

    document.getElementById('conteudo').style.filter = '';
    document.getElementById('formulario').style.filter = '';
    document.getElementById('formulario').style.pointerEvents = 'auto';
    document.getElementById('conteudo').style.pointerEvents = 'auto';
    document.querySelector('footer').style.visibility = 'visible';
  }
})

buttonPdfDiv.addEventListener('click', function () {
  const pdfDiv = document.getElementById('PdfDivMae');

  pdfDiv.style.visibility = 'hidden';

  document.getElementById('conteudo').style.filter = '';
  document.getElementById('formulario').style.filter = '';
  document.getElementById('formulario').style.pointerEvents = 'auto';
  document.getElementById('conteudo').style.pointerEvents = 'auto';
  document.querySelector('footer').style.visibility = 'visible';

})

enviarExportar.addEventListener('submit', function (event) {
  // Variavel
  const pf = document.getElementById('PF');
  const pg = document.getElementById('PG');
  const pe = document.getElementById('PE');

  // DATA INPUT ---------------------------------------------
  if (document.getElementById('dataExportarInput').value.trim() === '') {
    event.preventDefault();
    alert('Coloque a Data!!')
    document.getElementById('dataExportarInput').style.borderColor = 'red';
  }
  else {
    document.getElementById('dataExportarInput').style.borderColor = 'black';
    // checked INPUT ---------------------------------------------
  }
  if (!pf.checked && !pg.checked && !pe.checked) {
    event.preventDefault();
    alert('Marque um Pedido (PF,PG,PE)');
  }

})
// ---------------------------------------------------------------------------

//DIV IMPORTAR 
buttonPdfImportar.addEventListener('click', function () {
  const pdfDiv = document.getElementById('PdfDivMaeImportar');

  if (pdfDiv.style.visibility == 'hidden') {
    pdfDiv.style.visibility = 'visible';

    document.getElementById('formulario').style.filter = 'brightness(0.65) contrast(0.85) blur(2px)';
    document.getElementById('conteudo').style.filter = 'brightness(0.75) contrast(0.95) blur(2px)';
    document.getElementById('formulario').style.pointerEvents = 'none';
    document.getElementById('conteudo').style.pointerEvents = 'none';
    document.querySelector('footer').style.visibility = 'hidden';

  }
  else {
    pdfDiv.style.visibility = 'hidden';

    document.getElementById('conteudo').style.filter = '';
    document.getElementById('formulario').style.filter = '';
    document.getElementById('formulario').style.pointerEvents = 'auto';
    document.getElementById('conteudo').style.pointerEvents = 'auto';
    document.querySelector('footer').style.visibility = 'visible';
  }
})

buttonPdfDivImportar.addEventListener('click', function () {
  const pdfDiv = document.getElementById('PdfDivMaeImportar');

  pdfDiv.style.visibility = 'hidden';

  document.getElementById('conteudo').style.filter = '';
  document.getElementById('formulario').style.filter = '';
  document.getElementById('formulario').style.pointerEvents = 'auto';
  document.getElementById('conteudo').style.pointerEvents = 'auto';
  document.querySelector('footer').style.visibility = 'visible';

})
// ---------------------------------------------------------------------------

// Para DIV Peso
peso_btn.addEventListener('click', function () {
  const pesoDiv = document.getElementById('pesoDivMae');

  if (pesoDiv.style.visibility == 'hidden') {

    pesoDiv.style.visibility = 'visible';
    document.getElementById('formulario').style.filter = 'brightness(0.65) contrast(0.85) blur(2px)';
    document.getElementById('conteudo').style.filter = 'brightness(0.75) contrast(0.95) blur(2px)';
    document.getElementById('formulario').style.pointerEvents = 'none';
    document.getElementById('conteudo').style.pointerEvents = 'none';
    document.querySelector('footer').style.visibility = 'hidden';
  }
  else {
    pesoDiv.style.visibility = 'hidden';

    document.getElementById('conteudo').style.filter = '';
    document.getElementById('formulario').style.filter = '';
    document.getElementById('formulario').style.pointerEvents = 'auto';
    document.getElementById('conteudo').style.pointerEvents = 'auto';
    document.querySelector('footer').style.visibility = 'visible';
  }
});

voltarPeso.addEventListener('click', function () {
  const pesoDiv = document.getElementById('pesoDivMae');

  pesoDiv.style.visibility = 'hidden';

  document.getElementById('conteudo').style.filter = '';
  document.getElementById('formulario').style.filter = '';
  document.getElementById('formulario').style.pointerEvents = 'auto';
  document.getElementById('conteudo').style.pointerEvents = 'auto';
  document.querySelector('footer').style.visibility = 'visible';
  window.location.href = window.location.pathname;

})

// Input de peso ------------------------------------------------
filtrar_peso.addEventListener('change', function () {

  this.form.submit();

});

cliente_peso.addEventListener('change', function () {

  this.form.submit();

});
PF_peso.addEventListener('change', function () {

  this.form.submit();

});
PG_peso.addEventListener('change', function () {

  this.form.submit();

});
PE_peso.addEventListener('change', function () {

  this.form.submit();

});
PE_peso.addEventListener('change', function () {

  this.form.submit();

});
input_peso.forEach(input => {
  input.addEventListener('change', function () {
    submitForm('pesoForm', './Peso/peso_post.php');
  });
});
// ---------------------------------------------------------------------------

enviarBt.addEventListener('click', async function () {
  let dataDigitada = document.getElementById('entrega').value;
  let dataDigitadaSplit = dataDigitada.split('-');

  if (verificar() === true) {


    enviandoJson(dataDigitadaSplit[1], dataDigitadaSplit[2]);

    if (radioMercadolivre.checked) {

      contador = avancar(contador.contador_P, contador.contador_Pg, contador.contador_Pe);
    }

    const resultado = await selectN('./php/divRodapeDinamica.php');

    const form = document.getElementById('formulario');
    const formData = new FormData(form);

    const response = await fetch("./php/PG2_Escritorio1.php", {
      method: "POST",
      body: formData
    })

    // Resposta do servidor
    const data = await response.text();
    console.log("Resposta do servidor: Enviado " + data);

    const verificadorSelectN = resultado;

    if (verificadorSelectN.success) {

      document.getElementById('envioP').innerHTML = '<label class="font_red">' + verificadorSelectN.mensagem + ' Enviado' + '</label>';
      alert('🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩 \n\n == ' + verificadorSelectN.mensagem + ' Enviado' + ' ==\n\n🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩');

      // Limpar formulário
      document.getElementById('numeracao_m').value = '';
      document.getElementById('numeracao_f').value = '';
      document.getElementById('descricao_Pedido').value = '';
      document.getElementById('peso').value = '';
      document.getElementById('descricao_Alianca').value = '';
      document.getElementById('gravInternaM').value = '';
      document.getElementById('gravInternaF').value = '';
      document.getElementById('nome_p').value = '';
    }
    else {

      document.getElementById('envioP').innerHTML = '<label class="font_red">' + verificadorSelectN.mensagem + ' já Existe!</label>';
      alert('🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥 \n\n == ' + verificadorSelectN.mensagem + ' já Existe! ==\n\n🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥');
    }

    atualizarDiv_2("#aviso_badge", './php/divPesoDinamico.php');
  }
  else {

    console.log("Erro: Formulário inválido, não enviado.");
  }

  document.getElementById("imagemPdf").src = './pedidos/imagemPedido/pdf.png';
  console.log(document.cookie);

});





// Adiciona favicon dinamicamente coroa.ico
(function () {
  let link = document.createElement('link');
  link.rel = 'shortcut icon';
  link.type = 'image/x-icon';
  link.href = './Escritorio_img/coroa.ico';
  document.head.appendChild(link);
})();

// Quando atualizar pagina --------------------------------------------------------------
document.addEventListener("DOMContentLoaded", () => {
  restaurarFormulario('formulario');
  aguardar_grav();
  radioCabecalho()
  checkboxRodape()
});


export { CreateCookie }