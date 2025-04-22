<?php
include('../conexao.php'); // Ajuste conforme seu projeto

if (isset($_FILES['arquivo_csv']) && $_FILES['arquivo_csv']['error'] === UPLOAD_ERR_OK) {
    $arquivoTmp = $_FILES['arquivo_csv']['tmp_name'];

    // Abre o arquivo CSV
    if (($handle = fopen($arquivoTmp, 'r')) !== FALSE) {
        // Lê o cabeçalho
        $cabecalho = fgetcsv($handle, 1000, ",");

        while (($linha = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $dados = array_combine($cabecalho, $linha);

            // Prepara os dados para inserção
            $id = $conectar->real_escape_string($dados['idpedidos']);
            $cliente = $conectar->real_escape_string($dados['cliente']);
            $nomePedido = $conectar->real_escape_string($dados['nomePedido']);
            $largura = $conectar->real_escape_string($dados['largura']);
            $descricao = $conectar->real_escape_string($dados['descricaoPedido']);
            $gravacao = $conectar->real_escape_string($dados['gravacaoInterna']);
            $pdf = $conectar->real_escape_string($dados['pdf']);
            $data = $conectar->real_escape_string($dados['data_digitada']);

            // Monta e executa a query
            $sql = "INSERT INTO pedidosp 
                    (idpedidos, cliente, nomePedido, largura, descricaoPedido, gravacaoInterna, pdf, data_digitada)
                    VALUES ('$id', '$cliente', '$nomePedido', '$largura', '$descricao', '$gravacao', '$pdf', '$data')";

            $conectar->query($sql);
        }

        fclose($handle);
        echo "Importação concluída com sucesso!";
    } else {
        echo "Erro ao abrir o arquivo CSV.";
    }
} else {
    echo "Nenhum arquivo enviado ou ocorreu um erro no upload.";
}
?>
