<?php
include_once('../conexao.php');

//imagem 
if(isset($_FILES['imagem']) && !empty($_FILES['imagem'])){
    $imagem = "../imagem/".$_FILES['imagem']['name'];
    move_uploaded_file($_FILES['imagem']['tmp_name'], "../imagem/".$_FILES['imagem']['name'] );
}

// Puxando dados
$numeroPedido = $_POST['numeroPedido'];
$dataEntrega = $_POST['dataEntrega'];
$cliente = $_POST['cliente'];
$nomePedido = $_POST['nome_m'];
$nomePedidoC = $_POST['nome_p'];
$f = $_POST['f'];
$m = $_POST['m'];
$descricao_Pedido = $_POST['descricao_Pedido'];
$descricaoAlianca = $_POST['descricao_Alianca'];
$gravacao_exter = $_POST['gravacao_exter'];
$gravacao_inter = $_POST['gravacao_inter'];
$largura = $_POST['largura'];
$outrosClientes = $_POST['txtcliente'];
$semPedra = isset($_POST['semPedra']) ? $_POST['semPedra'] : null;
$comPedra = isset($_POST['comPedra']) ? $_POST['comPedra'] : null;
$estoqueFeminina = isset($_POST['estoqueFeminina']) ? $_POST['estoqueFeminina'] : null;
$estoqueMasculina = isset($_POST['estoqueMasculina']) ? $_POST['estoqueMasculina'] : null;

$numeroPedidoSplit = str_split($numeroPedido,1);

$idPedidos = $numeroPedido ."-". $dataEntrega;

// Outros Clientes 
if($cliente == 'Centro_Alianca'){
    $idCentroAlianca = $cliente . '-' . $nomePedidoC;
    $idPedidos = $idCentroAlianca;

    // passando pro banco de dados
    $dadosp = mysqli_query($conectar, "INSERT INTO pedidosp 
    (contadorpf,idpedidos, cliente, nomePedido, numF, numeM, descricaoPedido, descricaoAlianca,largura, gravacaoInterna, gravacaoExterna,outrosClientes,imagem,parEstoqueF,parEstoqueM,parPedra,parSemPedra) 
    VALUES (0,'$idPedidos', '$cliente', '$nomePedido', '$f', '$m', '$descricao_Pedido', '$descricaoAlianca','$largura', '$gravacao_inter', '$gravacao_exter', '$outrosClientes','$imagem' , '$estoqueFeminina' ,'$estoqueMasculina', '$semPedra' , '$comPedra' )");

}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($cliente == 'Outros'){
    $idOutros = $outrosClientes . '-' . $nomePedidoC;
    $idPedidos =  $idOutros;

    // passando pro banco de dados
    $dadosp = mysqli_query($conectar, "INSERT INTO pedidosp 
    (contadorpf,idpedidos, cliente, nomePedido, numF, numeM, descricaoPedido, descricaoAlianca,largura, gravacaoInterna, gravacaoExterna,outrosClientes,imagem,parEstoqueF,parEstoqueM,parPedra,parSemPedra) 
    VALUES (01,'$idPedidos','$cliente', '$nomePedido', '$f', '$m', '$descricao_Pedido', '$descricaoAlianca','$largura', '$gravacao_inter', '$gravacao_exter', '$outrosClientes','$imagem' , '$estoqueFeminina' ,'$estoqueMasculina', '$semPedra' , '$comPedra' )");
    
}
if($cliente == 'Mercado_Livre' && $numeroPedidoSplit[1] == "F"){

    $idPf = str_replace("PF","",$_POST['numeroPedido']); //Contador para o banco
    setcookie('Pfverificador', 'PF'.$idPf + 1, time() + (365 * 86400 * 1000), "/");

    // passando pro banco de dados
    $dadosp = mysqli_query($conectar, "INSERT INTO pedidosp 
    (contadorpf,idpedidos, cliente, nomePedido, numF, numeM, descricaoPedido, descricaoAlianca,largura, gravacaoInterna, gravacaoExterna,outrosClientes,imagem,parEstoqueF,parEstoqueM,parPedra,parSemPedra) 
    VALUES ($idPf,'$idPedidos','$cliente', '$nomePedido', '$f', '$m', '$descricao_Pedido', '$descricaoAlianca','$largura', '$gravacao_inter', '$gravacao_exter', '$outrosClientes','$imagem' , '$estoqueFeminina' ,'$estoqueMasculina', '$semPedra' , '$comPedra' )");
    
}
if($cliente == 'Mercado_Livre' && $numeroPedidoSplit[1] == 'G'){

    $idPg = str_replace("PG","",$_POST['numeroPedido']); 
    // passando pro banco de dados
    $dadosg = mysqli_query($conectar, "INSERT INTO pedidospg
    (contadorpg,idpedidos, cliente, nomePedido, numF, numeM, descricaoPedido, descricaoAlianca,largura, gravacaoInterna, gravacaoExterna,outrosClientes,imagem,parEstoqueF,parEstoqueM,parPedra,parSemPedra) 
    VALUES ('$idPg','$idPedidos','$cliente', '$nomePedido', '$f', '$m', '$descricao_Pedido', '$descricaoAlianca','$largura', '$gravacao_inter', '$gravacao_exter', '$outrosClientes','$imagem' , '$estoqueFeminina' ,'$estoqueMasculina', '$semPedra' , '$comPedra' )");
    
   
}
if($cliente == 'Mercado_Livre' && $numeroPedidoSplit[1] == 'E'){

    $idPe = str_replace("PE","",$_POST['numeroPedido']);
    // passando pro banco de dados
    $dadose = mysqli_query($conectar, "INSERT INTO pedidospe
    (contadorpe,idpedidos, cliente, nomePedido, numF, numeM, descricaoPedido, descricaoAlianca,largura, gravacaoInterna, gravacaoExterna,outrosClientes,imagem,parEstoqueF,parEstoqueM,parPedra,parSemPedra) 
    VALUES ('$idPe','$idPedidos','$cliente', '$nomePedido', '$f', '$m', '$descricao_Pedido', '$descricaoAlianca','$largura', '$gravacao_inter', '$gravacao_exter', '$outrosClientes','$imagem' , '$estoqueFeminina' ,'$estoqueMasculina', '$semPedra' , '$comPedra' )");
    

}

?>
