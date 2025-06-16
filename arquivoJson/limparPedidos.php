<?php
// Caminho do arquivo JSON
$arquivo = __DIR__ . '/pedidos.json';

// Define timezone para Brasília
date_default_timezone_set('America/Sao_Paulo');

// Cria objeto com data/hora do evento
$dados = [
    '_limpo_em' => date('Y-m-d H:i:s')
];

// Salva no arquivo JSON
file_put_contents($arquivo, json_encode($dados, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
?>
