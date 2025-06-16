<?php 
include_once('funcao.php');
function statusPedidos($conectar, $tabela, $contador,$dataInput){ 

    //Variavel -----------------------------------------------
    date_default_timezone_set('America/Sao_Paulo'); // Fuso horário de Brasília
    $data = date('Y-m-d');

    //Consulta ao banco de dados -----------------------------------------------

    $dados = "SELECT COUNT(*) FROM `$tabela` WHERE `$contador` <> 0
    AND data_digitada = '$data'
    ORDER BY `$contador` ASC";

    $resultado = mysqli_query($conectar, $dados);
    $linha = mysqli_fetch_row($resultado);
    $quantidade = $linha[0];

    if($quantidade == 0){
        $quantidade = '0';
    }
    // Exibe a quantidade de pedidos
?>
  <div class="container">
    <div id = 'quantidades'>
      <label class="titulo" for="quantidade">Quantidade de Pedidos:<span class="tituloRed"> <?php echo $quantidade ?> </span></label>
    </div>   
<?php
    if($tabela == 'pedidosp'){
        pedidosPf($dataInput);
    }
    elseif($tabela == 'pedidospg'){
        pedidosPg($dataInput);
    }
    elseif($tabela == 'pedidospe'){
        pedidosPe($dataInput);
    }
}

function statusPedidosTodos($conectar,$dataInput){ 

    //Variavel -----------------------------------------------
    date_default_timezone_set('America/Sao_Paulo'); // Fuso horário de Brasília
    $data = date('Y-m-d');
    $nenhumPedido = '';

    $dados = "SELECT COUNT(*) FROM `pedidosp` WHERE `contadorpf` <> 0
    AND data_digitada = '$data'
    ORDER BY `contadorpf` ASC";

    $dados2 = "SELECT COUNT(*) FROM `pedidospg` WHERE `contadorpg` <> 0
    AND data_digitada = '$data'
    ORDER BY `contadorpg` ASC";

    $dados3 = "SELECT COUNT(*) FROM `pedidospe` WHERE `contadorpe` <> 0
    AND data_digitada = '$data'
    ORDER BY `contadorpe` ASC";

    $resultado = mysqli_query($conectar, $dados);
    $resultado2 = mysqli_query($conectar, $dados2);
    $resultado3 = mysqli_query($conectar, $dados3);

    (int)$linha = mysqli_fetch_row($resultado);
    (int)$linha2 = mysqli_fetch_row($resultado2);
    (int)$linha3 = mysqli_fetch_row($resultado3);

    $quantidade = $linha[0] + $linha2[0] + $linha3[0];

    if($quantidade == 0){
        $quantidade = 'Nenhum pedido';
        $nenhumPedido = 'Nenhum pedido encontrado para o dia de hoje.';
    }

?> 
  <div class="container">
    <div id = 'quantidades'>
      <label class="titulo" for="quantidade">Quantidade de Pedidos:<span class="tituloRed"> <?php echo $quantidade ?> </span></label>
    </div>   
<?php
    todos($dataInput);
}