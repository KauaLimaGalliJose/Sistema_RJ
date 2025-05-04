<?php
function moverArquivos($origem, $destino) {
    // Remove barra final, se houver
    $origem = rtrim($origem, '/');
    $destino = rtrim($destino, '/');

    // Cria pasta destino se não existir
    if (!is_dir($destino)) {
        mkdir($destino, 0755, true);
    }

    // Lista os arquivos da pasta de origem
    $arquivos = glob($origem . '/*');

    foreach ($arquivos as $arquivo) {
        // Ignora se for uma pasta
        if (is_dir($arquivo)) continue;

        $nomeArquivo = basename($arquivo);
        $caminhoDestino = $destino . '/' . $nomeArquivo;

        // Move apenas se o arquivo ainda não existir no destino
        if (!file_exists($caminhoDestino)) {
            rename($arquivo, $caminhoDestino);
        }
    }
}

function apagarDiretorio($caminho) {
    if (!file_exists($caminho)) return;

    if (is_file($caminho) || is_link($caminho)) {
        unlink($caminho); // Se for arquivo ou link simbólico
        return;
    }

    // É diretório: percorre todos os itens
    $itens = scandir($caminho);
    foreach ($itens as $item) {
        if ($item === '.' || $item === '..') continue;

        apagarDiretorio($caminho . '/' . $item); // Recursivo
    }

    rmdir($caminho); // Remove a pasta agora vazia
}
?>