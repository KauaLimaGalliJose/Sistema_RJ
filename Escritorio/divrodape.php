<?php
    //Variaveis Global
    include_once('../conexao.php');
    date_default_timezone_set('America/Sao_Paulo'); // Fuso horário de Brasília
    $data = date('Y-m-d');
?>
<?php
    $bancotodosPf = "SELECT * FROM pedidosp WHERE idpedidos LIKE '%$data%' ORDER BY contadorpf ASC";
    $bancotodosPg = "SELECT * FROM pedidospg WHERE idpedidos LIKE '%$data%'";
    $bancotodosPe = "SELECT * FROM pedidospe WHERE idpedidos LIKE '%$data%'";

    $VerificadorBancotodosPf = mysqli_query($conectar, $bancotodosPf);
    $VerificadorBancotodosPg = mysqli_query($conectar, $bancotodosPg);
    $VerificadorBancotodosPe = mysqli_query($conectar, $bancotodosPe);
    $Pverificador = $_COOKIE['Pfverificador'];    
    $todosPf;

    if(isset($Pverificador)){
        while($bdPf = mysqli_fetch_assoc($VerificadorBancotodosPf)){
           $todos = explode("-",$bdPf['idpedidos']);
            $todosPf[] = $todos[0];

            if(array_search($Pverificador, $todosPf) !== false){
                $printpf = 'Duplicado ' . $Pverificador;
                ?><script> alert('Pedido Duplicado')</script><?php
            }
            else{
                $printpf = 'Enviado ' . $Pverificador;
            }
        }
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div id="envioP">
    <label class="font_red"> <?php
     echo $printpf;
    ?></label>
</div>
</body>
</html>