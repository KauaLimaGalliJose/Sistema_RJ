//import
import { CreateCookie, getCookie, cookieExiste } from './cookies.js';


// funcao.js
export function voltar(contador_P, contador_Pg, contador_Pe) {
    let numeroPedido = document.getElementById('n_p');
    let p = numeroPedido.options[1];
    let pg = numeroPedido.options[2];
    let pe = numeroPedido.options[3];

    if (p.selected) {
        contador_P--;
        if (contador_P < 0) contador_P = 0;

        let contadordisplayP = contador_P + 1
        document.getElementById('P1').innerHTML = 'PF' + contadordisplayP;
        document.getElementById('P1').value = 'PF' + contador_P;
    }
    if (pg.selected) {
        contador_Pg--;
        if (contador_Pg < 0) contador_Pg = 0;

        let contadordisplayPg = contador_Pg + 1
        document.getElementById('PG1').innerHTML = "PG" + contadordisplayPg;
        document.getElementById('PG1').value = 'PG' + contador_Pg;
    }
    if (pe.selected) {
        contador_Pe--;
        if (contador_Pe < 0) contador_Pe = 0;

        let contadordisplayPe = contador_Pe + 1
        document.getElementById('PE1').innerHTML = "PE" + contadordisplayPe;
        document.getElementById('PE1').value = 'PE' + contador_Pe;
    }


    return { contador_P, contador_Pg, contador_Pe };
}

export function avancar(contador_P, contador_Pg, contador_Pe) {
    let numeroPedido = document.getElementById('n_p');
    let p = numeroPedido.options[1];
    let pg = numeroPedido.options[2];
    let pe = numeroPedido.options[3];

    if (p.selected) {
        contador_P++;
        let contadordisplayP = contador_P + 1
        document.getElementById('P1').innerHTML = 'PF' + contadordisplayP;
        document.getElementById('P1').value = 'PF' + contador_P;


    }
    if (pg.selected) {
        contador_Pg++;
        let contadordisplayPg = contador_Pg + 1
        document.getElementById('PG1').innerHTML = "PG" + contadordisplayPg;
        document.getElementById('PG1').value = 'PG' + contador_Pg;


    }
    if (pe.selected) {
        contador_Pe++;
        let contadordisplayPe = contador_Pe + 1
        document.getElementById('PE1').innerHTML = "PE" + contadordisplayPe;
        document.getElementById('PE1').value = 'PE' + contador_Pe;


    }



    return { contador_P, contador_Pg, contador_Pe };
}

export function limpar_btn() {
    document.getElementById('nome_m').value = '';
    document.getElementById('numeracao_m').value = '';
    document.getElementById('numeracao_f').value = '';
    document.getElementById('descricao_Pedido').value = '';
    document.getElementById('gravInternaM').value = '';
    document.getElementById('gravInternaF').value = '';
    document.getElementById("outros").value = '';
    document.getElementById('nome_p').value = '';
    document.getElementById('modelo2').style.display = 'none';
    document.getElementById('modelo_rainha').style.display = 'block';
    document.getElementById('modelo2').src = '';
    document.getElementById("inputPDF").src = "1";
    document.getElementById("estoque").options[0].selected = true;

    // Rodapé
    document.getElementById("semPedra").checked = false;
    document.getElementById("comPedra").checked = false;
    document.getElementById("estoqueFeminina").checked = false;
    document.getElementById("estoqueMasculina").checked = false;

    window.location.href = `./PG2-Escritorio.php?`;
}
export function limpar() {
    document.getElementById('numeracao_m').value = '';
    document.getElementById('numeracao_f').value = '';
    document.getElementById('descricao_Pedido').value = '';
    document.getElementById('peso').value = '';
    document.getElementById('descricao_Alianca').value = '';
    document.getElementById('gravInternaM').value = '';
    document.getElementById('gravInternaF').value = '';
    document.getElementById("outros").value = '';
    document.getElementById('nome_p').value = '';
    document.getElementById("inputPDF").src = "1";

    document.getElementById("semPedra").checked = false;
    document.getElementById("comPedra").checked = false;
    document.getElementById("estoqueFeminina").checked = false;
    document.getElementById("estoqueMasculina").checked = false;

}

export function atualizarDiv(div, caminho) {
    $(div).load(caminho); // Carrega o conteúdo de um arquivo PHP
}

export function atualizarDiv_2(div, caminho) {
    $(div).load(caminho, function (response, status) {
        // response = conteúdo retornado pelo PHP

        if (status === "success") {

            if (response.trim() == "0") {
                document.getElementById('aviso_badge').style.backgroundColor = 'transparent';
                document.getElementById('aviso_badge').textContent = "";
            } else {
                document.getElementById('aviso_badge').style.backgroundColor = '';
                document.getElementById('aviso_badge').textContent = response.trim();
            }

        }
    });
}

export async function selectN(caminhoquery) {

    const select = document.getElementById('n_p');
    const nome_pInput = document.getElementById('nome_p');
    const nome_outros = document.getElementById('outros');
    const data_pInput = document.getElementById('entrega');
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
    formData.append('Pfverificador', Pfverificador);

    try {
        
        const response = await fetch(caminhoquery, {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        return data;

    } catch (err) {

        console.error("Erro ao enviar:", err);
        throw err; // permite tratar erro fora
    }
}



export function mudaPDF() {
    const cliente2 = document.getElementById('c2');
    const cliente3 = document.getElementById('c3');
    let pdfInput = document.getElementById("inputPDF");
    let imagemPdf = document.getElementById("imagemPdf");

    if (pdfInput.files.length > 0 || (cliente2.checked || cliente3.checked)) {
        imagemPdf.src = './pedidos/imagemPedido/pdfAzul.png';
        document.getElementById('pdfSalvo').style.visibility = 'visible';
        document.getElementById('pdfSalvo').innerHTML = 'PDF Salvo';
    }
    else {
        imagemPdf.src = './pedidos/imagemPedido/pdf.png';
        document.getElementById('pdfSalvo').style.visibility = 'visible';
        document.getElementById('pdfSalvo').innerHTML = 'Adicione o PDF';
    }

}

export function recarregarPagina() {

    alert('pedido Enviado')

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

export function capitalizarPalavras_Cliente(campo) {

    const excecoes = ['e', 'de', 'do', 'da', 'dos', 'das', 'em', 'no', 'na', 'nos', 'nas'];

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

export function bloquearCaracteres(input) {
    // Remove apenas - _ +
    input.value = input.value.replace(/[-_+]/g, '');
}


export { CreateCookie, getCookie, cookieExiste }