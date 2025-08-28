<?php
header('Content-Type: application/json');

// Recebe os dados enviados via POST (JSON)
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (
    !$data ||
    !isset($data['nome']) ||
    !isset($data['arquivo']) ||
    !isset($data['gravacao']) ||
    !isset($data['horaEntrega']) ||
    !preg_match('/^[a-zA-Z0-9_\-]+\.json$/', $data['arquivo']) // Validação simples do nome do arquivo
) {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos']);
    exit;
}

// Caminho do arquivo JSON (garante que só salve na pasta atual)
$arquivo = __DIR__ . '/../json/' . $data['arquivo'];

// Lê os dados existentes
$pedidos = [];
if (file_exists($arquivo)) {
    $json = file_get_contents($arquivo);
    $pedidos = json_decode($json, true);
    if (!is_array($pedidos)) $pedidos = [];
}

// Atualiza ou adiciona o pedido
if (!isset($pedidos[$data['nome']])) {
    $pedidos[$data['nome']] = [];
}
if (isset($data['gravacao'])) {
    $pedidos[$data['nome']]['gravacao'] = $data['gravacao'];
}

$pedidos[$data['nome']]['horaEntrega_Gravacao'] = $data['horaEntrega']?? '';


// Salva de volta no arquivo
file_put_contents($arquivo, json_encode($pedidos, JSON_PRETTY_PRINT));

// Resposta de sucesso
echo json_encode(['success' => true, 'data' => $pedidos]);
