<?php
// Imports
include_once('../../conexao.php');
include_once('./funcaoExportar.php');

//Variaveis
$PF = isset($_POST['PF']) ? $_POST['PF']: NULL;
$PG = isset($_POST['PG']) ? $_POST['PG']: NULL;
$PE = isset($_POST['PE']) ? $_POST['PE']: NULL;
$data_Digitada = $_POST['data'];

if($data_Digitada !== '' ){
    if($PF == 'PF' || $PG == 'PG' || $PE == 'PE'){

    // Define cabeçalhos para forçar o download
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="Pedidos-" '. $data_Digitada . '".csv"');
    $enviarDados = fopen('php://output', 'w');

    if($PF == "PF"){

        $result = $conectar->query(
            "SELECT *
             FROM pedidosp WHERE contadorpf <> 0 
             AND data_digitada LIKE '$data_Digitada'
             ORDER BY contadorpf ASC"
               );
        
        if ($result) {
            $colunas = array_keys($result->fetch_assoc());
            fputcsv($enviarDados, $colunas);
        }
        
        // Busca e escreve os dados
        $result = $conectar->query("SELECT * FROM pedidosp  WHERE contadorpf <> 0 ");
        while ($row = $result->fetch_assoc()) {
            fputcsv($enviarDados, $row);
        }
    }

    fclose($enviarDados);
    $conectar->close();
    exit;
    }
    
    else{
        htmlErro();
    }
}
else{
    htmlErro();
}
?>