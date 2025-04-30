export function imprimirDiv(id) {
    var conteudo = document.getElementById(id).innerHTML;
    var window = window.open('', '', 'width=800,height=600');
    window.document.write('<html><head><title>Pedidos</title></head><body>');
    window.document.write(conteudo);
    window.document.write('</body></html>');
    window.document.close();
    window.print();
}
export function atualizarDiv(div , caminho) {
    $(div).load(caminho); // Carrega o conteúdo de um arquivo PHP
}

export function mudaPDF(){
    const cliente2 = document.getElementById('c2');
    const cliente3 = document.getElementById('c3');
    let pdfInput = document.getElementById("inputPDF");
    let imagemPdf = document.getElementById("imagemPdf");

    if (pdfInput.files.length > 0 || (cliente2.checked || cliente3.checked)) {
        imagemPdf.src = '../imagemPedido/pdfAzul.png';
        document.getElementById('pdfSalvo').style.visibility = 'visible';
        document.getElementById('pdfSalvo').innerHTML= 'PDF Salvo';
    }
    else{
        imagemPdf.src = '../imagemPedido/pdf.png';
        document.getElementById('pdfSalvo').style.visibility = 'visible' ;
        document.getElementById('pdfSalvo').innerHTML= 'Adicione o PDF';
    }

}

