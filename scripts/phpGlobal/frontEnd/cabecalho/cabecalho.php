
<?php
include_once 'inputs_buttons.php';

function print_bnt($dados_parametros , $Printar_tela){

    $Printar_tela = '';

    foreach($dados_parametros as $dados){

        if($dados == null){
           continue;
        }
        else{

            $dadosSplit = explode('-+-' , $dados);
        }

        if($dadosSplit[0] == 'btn'){

            $caminho = $dadosSplit[1];
            $caminho_img = $dadosSplit[2];

            $Printar_tela .= bnt($caminho , $caminho_img);
        }

    }

    return $Printar_tela;
}
function print_inputs($dados_parametros , $Printar_tela){

    $Printar_tela = '';

    foreach($dados_parametros as $dados){

        if($dados == null){
           continue;
        }
        else{

            $dadosSplit = explode('-+-' , $dados);
        }

        if($dadosSplit[0] == 'input'){

            $tipo = $dadosSplit[1];
            $texto_input = $dadosSplit[2] ?? '';
            $nome = $dadosSplit[3] ?? '';
            
            $Printar_tela .= data($tipo, $texto_input, $nome);
        }
    }

    return $Printar_tela;
}


function cabecalho($parametros){
    
    $Printar_tela = '';
    // Mostra o Array print_r($dados_parametros);

    ?>
    <link rel="stylesheet" href="../../scripts/cssGlobal/cabecalho/cabecalho.css">
    <link rel="stylesheet" href="../../scripts/cssGlobal/cabecalho/inputs.css">

    <div id="cabecalho">
        <div id="casa">
            <?php echo print_bnt($parametros , $Printar_tela); ?>
        </div>      
        <div id="inputs">
            <?php echo print_inputs($parametros , $Printar_tela); ?>
        </div>
    </div>
   <?php

}

function cabecalho_btn($parametros){
    
    $Printar_tela = '';
    // Mostra o A rray print_r($dados_parametros);

    ?>
    <link rel="stylesheet" href="../../scripts/cssGlobal/cabecalho/cabecalho.css">
    <link rel="stylesheet" href="../../scripts/cssGlobal/cabecalho/inputs.css">
    <?php echo print_inputs($parametros , $Printar_tela); ?>

   <?php

}
 