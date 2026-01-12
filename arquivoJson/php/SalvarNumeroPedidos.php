<?php
header('Content-Type: application/json');

// Recebe os dados enviados via POST (JSON)
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (
    !$data ||
    !isset($data['nome']) ||
    !isset($data['valor']) ||
    !isset($data['arquivo']) ||
    !isset($data['dataAtual']) ||
    !isset($data['horaEntrega']) ||
    !preg_match('/^[a-zA-Z0-9_\-]+\.json$/', $data['arquivo'])
) {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos', 'debug' => $data]);
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
if (isset($data['valor'])) {

    $valorSplit = explode('_', $data['valor']);

    if($valorSplit[1] === 'feito' ){

        if($valorSplit[0] === 'numM' ){
            $pedidos[$data['nome']]['Masculina'] = 'feito';

        }
        elseif($valorSplit[0] === 'numF' ){
            $pedidos[$data['nome']]['Feminina'] = 'feito';

        }
    }
    elseif($valorSplit[1] === 'naoFeito' ){

        if($valorSplit[0] === 'numF' ){
            $pedidos[$data['nome']]['Feminina'] = 'Pendente';

        }
        elseif($valorSplit[0] === 'numM' ){
            $pedidos[$data['nome']]['Masculina'] = 'Pendente';

        }
    }
}
if (isset($data['dataAtual'])) {
    $pedidos[$data['nome']]['data'] = $data['dataAtual'];
}

// Salva de volta no arquivo
file_put_contents($arquivo, json_encode($pedidos, JSON_PRETTY_PRINT));

// Resposta de sucesso
echo json_encode(['success' => true, 'data' => $pedidos]);

?>