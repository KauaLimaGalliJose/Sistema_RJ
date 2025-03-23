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

function imprimirPDF() {
    var win = window.open('documento.pdf', '_blank');
    win.onload = function() {
        win.print();
    };
}