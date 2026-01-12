<?php
header('Content-Type: application/json');

// Recebe os dados enviados via POST (JSON)
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Validação mínima (nome + arquivo são obrigatórios)
if (!$data || !isset($data['nome']) || !isset($data['arquivo'])) {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos']);
    exit;
}

// Garante extensão .json no final
$arquivoNome = $data['arquivo'];
if (!str_ends_with($arquivoNome, '.json')) {
    $arquivoNome .= '.json';
}

// Normaliza pra minúsculo (evita erro de maiúscula/minúscula no Linux)
//$arquivoNome = strtolower($arquivoNome);

// Caminho do arquivo JSON
$arquivo = __DIR__ . '/../json/' . $arquivoNome;

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

if (isset($data['valor'])) {
    $pedidos[$data['nome']]['estado'] = $data['valor'];
}
if (isset($data['dataAtual'])) {
    $pedidos[$data['nome']]['data'] = $data['dataAtual'];
}
if (isset($data['horaEntrega'])) {
    $pedidos[$data['nome']]['horaEntrega_Polimento'] = $data['horaEntrega'];
}
$pedidos[$data['nome']]['horaEntrega_Torno'] = $data['horaEntrega_Torno'] ?? '';

// Salva de volta no arquivo
if (file_put_contents($arquivo, json_encode($pedidos, JSON_PRETTY_PRINT)) === false) {
    echo json_encode(['success' => false, 'message' => 'Erro ao salvar arquivo']);
    exit;
}

// Resposta de sucesso
echo json_encode(['success' => true, 'data' => $pedidos]);
