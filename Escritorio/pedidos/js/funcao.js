export function imprimirDiv(id) {
  var conteudo = document.getElementById(id).innerHTML;
  var window = window.open('', '', 'width=800,height=600');
  window.document.write('<html><head><title>Pedidos</title></head><body>');
  window.document.write(conteudo);
  window.document.write('</body></html>');
  window.document.close();
  window.print();
}
export function atualizarDiv(div, caminho) {
  $(div).load(caminho); // Carrega o conteúdo de um arquivo PHP
}

export function mudaPDF() {
  const cliente2 = document.getElementById('c2');
  const cliente3 = document.getElementById('c3');
  let pdfInput = document.getElementById("inputPDF");
  let imagemPdf = document.getElementById("imagemPdf");

  if (pdfInput.files.length > 0 || (cliente2.checked || cliente3.checked)) {
    imagemPdf.src = '../imagemPedido/pdfAzul.png';
    document.getElementById('pdfSalvo').style.visibility = 'visible';
    document.getElementById('pdfSalvo').innerHTML = 'PDF Salvo';
  }
  else {
    imagemPdf.src = '../imagemPedido/pdf.png';
    document.getElementById('pdfSalvo').style.visibility = 'visible';
    document.getElementById('pdfSalvo').innerHTML = 'Adicione o PDF';
  }

}

export function capitalizarPalavras(campo, checkbox) {

  const excecoes = ['e', 'de', 'do', 'da', 'dos', 'das', 'em', 'no', 'na', 'nos', 'nas'];

  if (checkbox.checked) {
    campo.value = campo.value.toUpperCase();
  } else {
    campo.value = campo.value
      .toLowerCase()
      .split(' ')
      .map((palavra, index) => {
        if (excecoes.includes(palavra) && index !== 0) {
          return palavra; // mantém minúsculo
        } else {
          return palavra.charAt(0).toUpperCase() + palavra.slice(1);
        }
      })
      .join(' ');
  }
}


export function bloquearCaracteres(input) {
  // Remove apenas - _ +
  input.value = input.value.replace(/[-_+]/g, '');
}

export async function selectN_mainEdit(caminhoquery, mesagemSucesso) {

  // inputs
  const select = document.getElementById('n_p');
  const nome_pInput = document.getElementById('nome_p');
  const nome_outros = document.getElementById('outros');
  const data_pInput = document.getElementById('entrega');

  // radios
  const cliente1 = document.getElementById('c1');
  const cliente2 = document.getElementById('c2');
  const cliente3 = document.getElementById('c3');

  let Pfverificador;

  if (cliente1.checked) {

    Pfverificador = select.value + '-' + data_pInput.value;
  }
  else if (cliente2.checked) {

    Pfverificador = "loja_+_Loja-" + nome_pInput.value + '-' + data_pInput.value;
  }
  else if (cliente3.checked) {

    Pfverificador = "outros_+_" + nome_outros.value + '-' + nome_pInput.value + '-' + data_pInput.value;
  }

  const formData = new FormData();
  console.log(Pfverificador);
  formData.append('Pfverificador', Pfverificador);

  try {
    const response = await fetch(caminhoquery, {
      method: 'POST',
      body: formData
    })

    const data = await response.json();

    if (data.success) {

      document.getElementById('envioP').innerHTML = '<label class="font_red">' + data.mensagem + mesagemSucesso + '</label>';
      alert('🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩 \n\n == ' + data.mensagem + mesagemSucesso + ' ==\n\n🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩');

      window.close();
    }
    else {


      if (data.pedido == Pfverificador && !cliente1.checked) {

        alert('🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥 \n \n == ' + data.mensagem + ' já Existe! == \n \n 🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥');
        document.getElementById('envioP').innerHTML = '<label class="font_red">' + data.mensagem + ' não enviado!</label>';

      }
      else {

        alert('🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩 \n \n == ' + data.mensagem + ' ' + mesagemSucesso + ' ==\n \n  🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩');
        window.close();
      }

    }
    return data;

  } catch (err) {

    console.error("Erro ao enviar:", err);
    throw err; // permite tratar erro fora
  }
}