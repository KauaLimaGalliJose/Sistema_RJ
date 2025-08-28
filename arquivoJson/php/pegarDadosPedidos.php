<?php
function pegarDadosPedidos($arquivo_destino){
    
header('Content-Type: application/json');
$arquivo = __DIR__ . '/../json/' . $arquivo_destino . '.json';
if (file_exists($arquivo)) {
    echo file_get_contents($arquivo);
} else {
    echo json_encode([]);
}
}

// Chama a função para garantir saída JSON
pegarDadosPedidos('pedidos');