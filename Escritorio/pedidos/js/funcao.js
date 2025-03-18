export function imprimirDiv(id) {
    var conteudo = document.getElementById(id).innerHTML;
    var janela = window.open('', '', 'width=800,height=600');
    janela.document.write('<html><head><title>Pedidos</title></head><body>');
    janela.document.write(conteudo);
    janela.document.write('</body></html>');
    janela.document.close();
    janela.print();
}