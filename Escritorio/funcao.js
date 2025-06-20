//import
import { CreateCookie } from './cookies.js';


// funcao.js
export function voltar(contador_P, contador_Pg, contador_Pe) {
    let numeroPedido = document.getElementById('n_p');
    let p = numeroPedido.options[1];
    let pg = numeroPedido.options[2];
    let pe = numeroPedido.options[3];

    if (p.selected) {
        contador_P--;
        let contadordisplayP = contador_P + 1
        document.getElementById('P1').innerHTML ='PF' + contadordisplayP;
        document.getElementById('P1').value ='PF' + contador_P;
    }
    if (pg.selected) {
        contador_Pg--;
        let contadordisplayPg = contador_Pg + 1
        document.getElementById('PG1').innerHTML = "PG" + contadordisplayPg;
        document.getElementById('PG1').value ='PG' + contador_Pg;
    }
    if (pe.selected) {
        contador_Pe--;
        let contadordisplayPe = contador_Pe + 1
        document.getElementById('PE1').innerHTML = "PE" +  contadordisplayPe;
        document.getElementById('PE1').value ='PE' + contador_Pe;
    }
    
    if (contador_P < 0) contador_P = 0;
    if (contador_Pg < 0) contador_Pg = 0;
    if (contador_Pe < 0) contador_Pe = 0;

    return { contador_P, contador_Pg, contador_Pe };
}

export function avancar(contador_P, contador_Pg, contador_Pe) {
    let numeroPedido = document.getElementById('n_p');
    let p = numeroPedido.options[1];
    let pg = numeroPedido.options[2];
    let pe = numeroPedido.options[3];

    if (p.selected) {
        contador_P++;
        let contadordisplayP = contador_P +1
        document.getElementById('P1').innerHTML ='PF' + contadordisplayP;
        document.getElementById('P1').value ='PF' + contador_P;

        //Criando verificação para ver se existe o pedido no Banco
        CreateCookie('Pfverificador','PF' + contador_P + '-' + document.getElementById('entrega').value ,0.000012);
    }
    if (pg.selected) {
        contador_Pg++;
        let contadordisplayPg = contador_Pg +1
        document.getElementById('PG1').innerHTML = "PG" + contadordisplayPg ;
        document.getElementById('PG1').value ='PG' + contador_Pg;
        //PG
        CreateCookie('Pfverificador','PG' + contador_Pg + '-' + document.getElementById('entrega').value ,0.000012);
    }
    if (pe.selected) {
        contador_Pe++;
        let contadordisplayPe = contador_Pe +1
        document.getElementById('PE1').innerHTML = "PE" +  contadordisplayPe;
        document.getElementById('PE1').value ='PE' + contador_Pe;
        //PE
        CreateCookie('Pfverificador','PE' + contador_Pe + '-' + document.getElementById('entrega').value ,0.000012);
    }

    return { contador_P, contador_Pg, contador_Pe };
}

export function limpar(){
    document.getElementById('nome_m').value ='';
    document.getElementById('numeracao_m').value = '';
    document.getElementById('numeracao_f').value = '';
    document.getElementById('descricao_Pedido').value = '';
    document.getElementById('grav_externaInput').value = '';
    document.getElementById('descricao_Alianca').value = '';
    document.getElementById('grav_internaInput').value = '';
    document.getElementById("outros").value = '';
    document.getElementById('nome_p').value = '';  
    document.getElementById('modelo2').style.display = 'none';
    document.getElementById('modelo_rainha').style.display = 'block';
    document.getElementById('modelo2').src = '';
    document.getElementById("inputPDF").src = "1";
}

export function atualizarDiv(div , caminho) {
    $(div).load(caminho); // Carrega o conteúdo de um arquivo PHP
}

export function selectN(){
    //Variaveis
    const cliente2 = document.getElementById('c2');
    const cliente3 = document.getElementById('c3');
    const select = document.getElementById('n_p');
    
    if(cliente3.checked ){
            select.value = 'N';
            CreateCookie('Pfverificador','outros');
    }
    if(cliente2.checked ){
        select.value = 'N';
        CreateCookie('Pfverificador','showroom');
    }
}

export function mudaPDF(){
    const cliente2 = document.getElementById('c2');
    const cliente3 = document.getElementById('c3');
    let pdfInput = document.getElementById("inputPDF");
    let imagemPdf = document.getElementById("imagemPdf");

    if (pdfInput.files.length > 0 || (cliente2.checked || cliente3.checked)) {
        imagemPdf.src = './pedidos/imagemPedido/pdfAzul.png';
        document.getElementById('pdfSalvo').style.visibility = 'visible';
        document.getElementById('pdfSalvo').innerHTML= 'PDF Salvo';
    }
    else{
        imagemPdf.src = './pedidos/imagemPedido/pdf.png';
        document.getElementById('pdfSalvo').style.visibility = 'visible' ;
        document.getElementById('pdfSalvo').innerHTML= 'Adicione o PDF';
    }

}

export function recarregarPagina(){

    alert('pedido Enviado')
    
}


export{CreateCookie}