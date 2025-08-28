import {Docxtemplater} from '../Importados/cloud.js'

export function gerarDocumento() {
    const doc = new Docxtemplater();
    
    // Dados para preencher no documento
    const data = {
        nome: 'João da Silva',
        email: 'joao@example.com',
        mensagem: 'Este é o conteúdo do meu documento.',
    };

    doc.setData(data);

    try {
        // Tenta renderizar o documento com os dados
        doc.render();
    } catch (error) {
        console.error('Erro ao gerar o documento:', error);
        return;
    }

    // Gerar o arquivo .docx e salvar
    const out = doc.getZip().generate({ type: 'blob' });

    // Aqui você pode salvar o arquivo gerado, por exemplo com FileSaver.js:
    saveAs(out, "documento-gerado.docx");
}