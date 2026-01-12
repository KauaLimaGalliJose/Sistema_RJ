<?php


include_once('../../../conexao.php');
date_default_timezone_set('America/Sao_Paulo');

$response = [
    'success' => false,
    'mensagem' => '',
    'pedido'   => null
];

if (isset($_POST['Pfverificador'])) {

    $Pverificador = $_POST['Pfverificador'];

    $PverificadorSplit   = str_split($Pverificador, 1);
    $PverificadorExplode = explode('-', $Pverificador);
    $PverificadorExplodeL = explode('_+_', $Pverificador);

    //  Consultas (PEGANDO idpedidos)
    $sqlPf = "SELECT idpedidos FROM pedidosp 
              WHERE idpedidos LIKE '%$Pverificador%' 
              AND contadorpf != 0 LIMIT 1";

    $sqlPg = "SELECT idpedidos FROM pedidospg 
              WHERE idpedidos LIKE '%$Pverificador%' 
              AND contadorpg != 0 LIMIT 1";

    $sqlPe = "SELECT idpedidos FROM pedidospe 
              WHERE idpedidos LIKE '%$Pverificador%' 
              AND contadorpe != 0 LIMIT 1";

    $resPf = mysqli_query($conectar, $sqlPf);
    $resPg = mysqli_query($conectar, $sqlPg);
    $resPe = mysqli_query($conectar, $sqlPe);

    //  Caso NÃO seja F / G / E
    if ($PverificadorExplodeL[0] === "outros" || $PverificadorExplodeL[0] === "loja") {

        $sqlP = "SELECT idpedidos FROM pedidos 
                 WHERE idpedidos LIKE '{$PverificadorExplodeL[1]}' 
                 LIMIT 1";

        $resP = mysqli_query($conectar, $sqlP);
    }

    //  LÓGICA
    if ($PverificadorExplode[0] === 'Nao_Enviado') {

        $response['success']  = false;
        $response['mensagem'] = "Não Enviado";

    }
    elseif ($PverificadorExplodeL[0] === "outros" || $PverificadorExplodeL[0] === "loja") {

        if (isset($resP) && $dados = mysqli_fetch_assoc($resP)) {

            $mms = explode('-', $dados['idpedidos']);

            $response['success']  = false;
            $response['pedido']   = $dados['idpedidos'];
            $response['mensagem'] = "Pedido {$mms[1]}";

        } else {
            $mms = explode('-', $PverificadorExplodeL[1]);

            $response['success']  = true;
            $response['mensagem'] = "Pedido    {$mms[0]}    ";
        }

    }
    else {

        $res = null;

        if ($PverificadorSplit[1] === 'F') $res = $resPf;
        if ($PverificadorSplit[1] === 'G') $res = $resPg;
        if ($PverificadorSplit[1] === 'E') $res = $resPe;

        if ($res && $dados = mysqli_fetch_assoc($res)) {

            $response['success']  = false;
            $response['pedido']   = $dados['idpedidos'];
            $response['mensagem'] = "Pedido {$PverificadorExplode[0]}";

        } else {

            $response['success']  = true;
            $response['mensagem'] = "Pedido    {$PverificadorExplode[0]}    ";
        }
    }

} else {

    $response['success']  = false;
    $response['mensagem'] = "Falha ao enviar";
}

mysqli_close($conectar);
echo json_encode($response);
