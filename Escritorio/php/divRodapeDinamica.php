<?php

include_once('../../conexao.php');
date_default_timezone_set('America/Sao_Paulo');

header('Content-Type: application/json'); // retorna JSON

$response = [
    'success' => false,
    'mensagem' => ''
];

if(isset($_POST['Pfverificador'])) {
    $Pverificador = $_POST['Pfverificador'];

    $PverificadorSplit = str_split($Pverificador,1);
    $PverificadorExplode = explode('-',$Pverificador);
    $PverificadorExplodeL = explode('_+_',$Pverificador);
    $alerta = true;

    // Consultas
    $bancotodosPf = "SELECT COUNT(*) AS quantidade FROM pedidosp WHERE idpedidos LIKE '%$Pverificador%' ";
    $bancotodosPg = "SELECT COUNT(*) AS quantidade FROM pedidospg WHERE idpedidos LIKE '%$Pverificador%' ";
    $bancotodosPe = "SELECT COUNT(*) AS quantidade FROM pedidospe WHERE idpedidos LIKE '%$Pverificador%' ";

    $VerificadorBancotodosPf = mysqli_query($conectar, $bancotodosPf);
    $VerificadorBancotodosPg = mysqli_query($conectar, $bancotodosPg);
    $VerificadorBancotodosPe = mysqli_query($conectar, $bancotodosPe);

    if (!in_array($PverificadorSplit[1], ['F', 'G', 'E'])) {

        $bancotodosP = "SELECT COUNT(*) AS quantidade FROM pedidos WHERE idpedidos LIKE '$PverificadorExplodeL[1]'";
        $VerificadorBancotodosP = mysqli_query($conectar, $bancotodosP);
    }

    // Lógica de verificação
    if($PverificadorExplode[0] === 'Nao_Enviado'){
        $response['success'] = false;
        $response['mensagem'] = "Não Enviado";
    }
    elseif($PverificadorExplodeL[0] == "outros" || $PverificadorExplodeL[0] == "loja") {
        $Verificador = isset($VerificadorBancotodosP) ? $VerificadorBancotodosP : null;
        if($dados = mysqli_fetch_assoc($Verificador)){
            $mms = explode('-', $PverificadorExplodeL[1]);
            if($dados['quantidade'] != 0){
                $response['success'] = false;
                $response['mensagem'] = "Pedido    {$mms[1]}    ";
            } else {
                $response['success'] = true;
                $response['mensagem'] = "Pedido    {$mms[1]}    ";
            }
        }
    }
    else {
        $Verificador = null;

        if($PverificadorSplit[1] == 'F') $Verificador = $VerificadorBancotodosPf;
        if($PverificadorSplit[1] == 'G') $Verificador = $VerificadorBancotodosPg;
        if($PverificadorSplit[1] == 'E') $Verificador = $VerificadorBancotodosPe;

        if($dados = mysqli_fetch_assoc($Verificador)){

            if($dados['quantidade'] != 0){
                $response['success'] = false;
                $response['mensagem'] = "Pedido    {$PverificadorExplode[0]}    ";
            } else {
                $response['success'] = true;
                $response['mensagem'] = "Pedido    {$PverificadorExplode[0]}    ";
            }
        }
    }

} else {
    $response['success'] = false;
    $response['mensagem'] = "Falha ao enviar";
}

mysqli_close($conectar);
echo json_encode($response);
