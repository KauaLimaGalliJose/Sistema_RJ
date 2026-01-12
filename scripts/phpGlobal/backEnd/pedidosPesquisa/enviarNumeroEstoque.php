<?php
//Bibliotecas
include_once('../../../../conexao.php');

// adiconando funçoes para tirar e adicionar o numero do estoque
include_once('../estoque/estoqueFunction.php');

if($_POST){

    // variaveis ----------------------------------------
    $nao_repor_estoque = $_COOKIE['check_config_estoque'] ?? 'check_config_estoque';
    $Chekbox = $_POST['checkNumero'] ?? null;
    $numero = $_POST['numero'] ?? null;
    $estoquePedido = $_POST['estoquePedido'] ?? null;
    $verificador = verifica_estoque_esgotado($numero,$estoquePedido,'estoque_esgotado',$conectar);

    if($nao_repor_estoque == 'check_config_estoque'){

        echo ' -- Bloqueado ';
        return;

    }

    if($Chekbox == 'checkM' || $Chekbox == 'checkF'){
         

        if($verificador == true){
            
            return;
        }
        else{
            echo ' --Tirando do estoque_Diario =>' . $numero . "-- ";
            tira_estoque($numero,$estoquePedido,'estoque_esgotado',$conectar);
        }


    }
    else{

       echo ' --Repondo do estoque_Diario =>' . $numero . "-- ";
       
       repor_estoque($numero,$estoquePedido,'estoque_esgotado',$conectar);

    }

}

mysqli_close($conectar);
?>