<?php

function banco($conectar,$tabela,$data1,$data2){

  //Contador de pedidos
  $contadordePedidosunidade = 0;
  $contadordePedidosPar = 0;
  $contadordePedidos = 0;

    $buscar = "SELECT gravacaoInterna , idpedidos, numF
                FROM $tabela
                WHERE data_digitada BETWEEN '$data1' AND '$data2'
                AND gravacaoInterna IS NOT NULL
                ORDER BY data_digitada ASC";

    $contectarBusca = mysqli_query($conectar,$buscar);
    
    while($linha = mysqli_fetch_assoc($contectarBusca)){

      //variável para separar o pedido
      $pedidosTipo = $linha['idpedidos'];
      $pedidosTipoSplit = explode('-', $pedidosTipo);
      
      if($linha['gravacaoInterna'] != '' && $linha['gravacaoInterna'] != 'SEM GRAVAÇÃO' && $linha['gravacaoInterna'] != 'CONFIRMAR GRAVAÇÃO' && $linha['gravacaoInterna'] != 'confirmar gravação'
      && $linha['gravacaoInterna'] != 'SEM GRAVAÇÃO INTERNA' && $linha['gravacaoInterna'] != 'AGUARDAR CONFIRMAÇÃO DO CLIENTE'){
        
        if($linha['numF'] == 40){
          echo '<label class = "gravacoes"><span class = "tituloData" ><span class = "tituloPedido">' . $pedidosTipoSplit[0] .'--</span>' . $pedidosTipoSplit[3] . '/' . $pedidosTipoSplit[2] . '</span>' .  " => " . $linha['gravacaoInterna'] . "</label><br>---<br>";
          $contadordePedidosunidade++;
        }
        else{
          echo '<label class = "gravacoes"><span class = "tituloDataBlue" ><span class = "tituloPedido">' . $pedidosTipoSplit[0] .'--</span>' . $pedidosTipoSplit[3] . '/' . $pedidosTipoSplit[2] . '</span>' .  " => " . $linha['gravacaoInterna'] . "</label><br>---<br>";
          $contadordePedidosPar++;
        }
        $contadordePedidos++;
      }
    }
    if($contadordePedidosunidade > 0 || $contadordePedidosPar > 0){
        echo "<h2 class='titulo'>Total de Pedidos: <span style='color: red;'>$contadordePedidos</span></h2>";
        echo "<h2 class='titulo'>Unidades: <span style='color: red;'>$contadordePedidosunidade</span></h2>";
        echo "<h2 class='titulo'>Par: <span style='color: red;'>$contadordePedidosPar</span></h2>";
    }
    else{
        echo "<h2 class='titulo'>Nenhum pedido encontrado entre as datas selecionadas.</h2>";
    }
}

function comicao($contectar,$data1,$data2){

}
?>