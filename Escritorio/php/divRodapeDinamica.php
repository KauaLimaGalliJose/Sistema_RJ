<?php
    include_once '../../phpIndex/protege.php';
    proteger();
?>
<div style="display: none;">
<?php
    //Variaveis Global
    include_once('../../conexao.php');
    date_default_timezone_set('America/Sao_Paulo'); // Fuso horário de Brasília
    $data = date('Y-m-d');
?>
</div>
<?php
    //Variaveis 
     $Pverificador = $_COOKIE['Pfverificador'];       

    $bancotodosPf = "SELECT COUNT(*) AS quantidade FROM pedidosp WHERE idpedidos LIKE '%$Pverificador%' AND contadorpf != 0 ";
    $bancotodosPg = "SELECT COUNT(*) AS quantidade FROM pedidospg WHERE idpedidos LIKE '%$Pverificador%' AND contadorpg != 0 " ;
    $bancotodosPe = "SELECT COUNT(*) AS quantidade FROM pedidospe WHERE idpedidos LIKE '%$Pverificador%' AND contadorpe != 0 ";

    $VerificadorBancotodosPf = mysqli_query($conectar, $bancotodosPf);
    $VerificadorBancotodosPg = mysqli_query($conectar, $bancotodosPg);
    $VerificadorBancotodosPe = mysqli_query($conectar, $bancotodosPe);

    //Pegando o Cookie para verificar se o pedido existe
    $PverificadorSplit =  str_split($Pverificador,1);
    $PverificadorExplode = explode('-',$Pverificador);
    $todosP;
    $alerta = true;

    if($PverificadorExplode[0] === 'Nao_Enviado'){
        $mensagem = "Não Enviado ";
        echo "<script> alert('🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨 \\n \\n == Não Enviado, Verifique o Pedido ==  \\n \\n 🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨🟨 ' )</script>";
    }
    elseif(isset($Pverificador)){

        if($PverificadorSplit[1] === 'F' ){
            if($dados = mysqli_fetch_assoc($VerificadorBancotodosPf)){

                if($dados['quantidade'] != 0){

                    $mensagem = 'Duplicado ' . $PverificadorExplode[0];
                    $alerta = false;
        
                }
                else{
                    $mensagem = 'Enviado ' .  $PverificadorExplode[0];
                    echo "<script> alert('✅ Enviado👉 =$PverificadorExplode[0]= ' )</script>";
                }

            }
        }
        elseif($PverificadorSplit[1] === 'G' ){
            if($dados = mysqli_fetch_assoc($VerificadorBancotodosPg)){

                if($dados['quantidade'] != 0){
                    $mensagem = 'Duplicado ' . $PverificadorExplode[0];
                    $alerta = false;
        
                }
                else{
                    $mensagem = 'Enviado ' .  $PverificadorExplode[0];
                    echo "<script> alert('✅ Enviado👉 =$PverificadorExplode[0]= ' )</script>";
                }

            }
        }
        elseif($PverificadorSplit[1] === 'E' ){
            if($dados = mysqli_fetch_assoc($VerificadorBancotodosPe)){

                if($dados['quantidade'] != 0){
                    $mensagem = 'Duplicado ' . $PverificadorExplode[0];
                    $alerta = false;
        
                }
                else{
                    $mensagem = 'Enviado ' .  $PverificadorExplode[0];
                    echo "<script> alert('✅ Enviado👉 =$PverificadorExplode[0]= ' )</script>";
                }

            }
        }
        if($alerta == false){

            $mensagem = 'Duplicado ' .  $PverificadorExplode[0];
            echo "<script> alert('🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥 \\n \\n   DUPLICADO  == $PverificadorExplode[0] == \\n \\n 🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥🟥' )</script>";
        }
    }
    else{
        $alerta = true;
        $mensagem = 'Enviado ' . $PverificadorExplode[0];
        echo "<script> alert('Enviado👉 $PverificadorExplode[0] ' )</script>";
    }
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="./coroa.ico" type="image/x-icon" >
    <link rel="stylesheet" href="PG2-Escritorio.css">
    <script src="../../scripts/importadosLocais/jquery-3.7.1.min.js" defer></script><!-- Não Tirar Biblioteca --> 
    <script src="main.js" type="module" defer></script>
    <title>Escritório</title>
</head>
<body>
<div id="envioP">
    <label class="font_red"> <?php
     echo $mensagem;
     mysqli_close($conectar);
    ?></label>
</div>
</body>
</html>