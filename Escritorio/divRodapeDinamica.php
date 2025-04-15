<div style="display: none;">
<?php
    //Variaveis Global
    include_once('../conexao.php');
    date_default_timezone_set('America/Sao_Paulo'); // Fuso horário de Brasília
    $data = date('Y-m-d');
?>
</div>
<?php
    $bancotodosPf = "SELECT * FROM pedidosp WHERE idpedidos LIKE '%$data%' ORDER BY contadorpf ASC";
    $bancotodosPg = "SELECT * FROM pedidospg WHERE idpedidos LIKE '%$data%' ORDER BY contadorpg ASC";
    $bancotodosPe = "SELECT * FROM pedidospe WHERE idpedidos LIKE '%$data%' ORDER BY contadorpe ASC";

    $VerificadorBancotodosPf = mysqli_query($conectar, $bancotodosPf);
    $VerificadorBancotodosPg = mysqli_query($conectar, $bancotodosPg);
    $VerificadorBancotodosPe = mysqli_query($conectar, $bancotodosPe);
    //Pegando o Cookie para verificar se o pedido existe
    $Pverificador = $_COOKIE['Pfverificador'];       
    $PverificadorSplit =  str_split($Pverificador,1);
    $todosP;
    $alerta = true;

    if(isset($Pverificador)){

        if($PverificadorSplit[1] === 'F' )
            while($bdPf = mysqli_fetch_assoc($VerificadorBancotodosPf)){

                $todos = explode("-",$bdPf['idpedidos']);
                $todosP[] = $todos[0];

                if(array_search($Pverificador, $todosP) !== false){
                    $printp = 'Duplicado ' . $Pverificador;
                    $alerta = false;
     
                }
                else{
                    $printp = 'Enviado ' . $Pverificador;
                }
            }

        elseif($PverificadorSplit[1] === 'G'){
            while($bdPg = mysqli_fetch_assoc($VerificadorBancotodosPg)){

                $todos = explode("-",$bdPg['idpedidos']);
                $todosP[] = $todos[0];

                if(array_search($Pverificador, $todosP) !== false){
                    $printp = 'Duplicado ' . $Pverificador;
                    $alerta = false;
                   
                }
                else{
                    $printp = 'Enviado ' . $Pverificador;
                }
            }
        }
        elseif($PverificadorSplit[1] === 'E'){
            while($bdPe = mysqli_fetch_assoc($VerificadorBancotodosPe)){

                $todos = explode("-",$bdPe['idpedidos']);
                $todosP[] = $todos[0];

                if(array_search($Pverificador, $todosP) !== false){
                    $printp = 'Duplicado ' . $Pverificador;
                    $alerta = false;
                    
                }
                else{
                    $printp = 'Enviado ' . $Pverificador;
                }
            }
        }
        else{
            $alerta = true;
            $printp = 'Enviado ' . $Pverificador;
        }
        
        if($Pverificador)
            if($alerta == false){
                ?><script>alert('Pedido Duplicado')</script><?php
        }
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../coroa.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="PG2-Escritorio.css">
    <script src="../Importados/sistemaGoogleDocumentos.js" type="module"></script>
    <script src="../Importados/jquery-3.7.1.min.js"></script>
    <script src="main.js" type="module" defer></script>
    <title>Escritório</title>
</head>
<body>
<div id="envioP">
    <label class="font_red"> <?php
     echo $printp;
    ?></label>
</div>
</body>
</html>