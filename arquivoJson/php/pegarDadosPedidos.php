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

header('Content-Type: application/json');

// Recebe os dados enviados via POST (JSON)
$input = file_get_contents('php://input');
$data = json_decode($input, true);

$pedidos = $data['pedido'];
// Chama a função para garantir saída JSON
pegarDadosPedidos($pedidos);