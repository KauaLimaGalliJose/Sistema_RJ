<?php
// Imports
include_once('../../../conexao.php');
include_once('./funcaoExportar.php');

//Variaveis
$PF = isset($_POST['PF']) ? $_POST['PF']: NULL;
$PG = isset($_POST['PG']) ? $_POST['PG']: NULL;
$PE = isset($_POST['PE']) ? $_POST['PE']: NULL;
$data_Digitada = $_POST['data'];

if($data_Digitada !== '' ){
    if($PF == 'PF' || $PG == 'PG' || $PE == 'PE'){

        if($PF == "PF"){
            criarCsv($conectar, $data_Digitada, 'pedidosp' , 'contadorpf');
        }
        if($PG == "PG"){
            criarCsv($conectar, $data_Digitada, 'pedidospg' , 'contadorpg');
        }
        if($PE == "PE"){
            criarCsv($conectar, $data_Digitada, 'pedidospe' , 'contadorpe');
        }
        
        zipar($data_Digitada,$PF,$PG,$PE,$conectar);
        
    }
    else{
        htmlErro();
    }
}
else{
    htmlErro();
}
mysqli_close($conectar);
?>