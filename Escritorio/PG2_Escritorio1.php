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

$idPedidos = $numeroPedido ."-". $dataEntrega;

if($cliente == 'Centro_Alianca'){
    $idCentroAlianca = $cliente . '-' . $nomePedidoC;
    $idPedidos = $idCentroAlianca;
}
if($cliente == 'Outros'){
    $idOutros = $outrosClientes . '-' . $nomePedidoC;
    $idPedidos =  $idOutros;
}

// passando pro banco de dados

$dados = mysqli_query($conectar, "INSERT INTO pedidosp 
    (idpedidos, cliente, nomePedido, numF, numeM, descricaoPedido, descricaoAlianca,largura, gravacaoInterna, gravacaoExterna,outrosClientes,imagem,parEstoqueF,parEstoqueM,parPedra,parSemPedra) 
    VALUES ('$idPedidos', '$cliente', '$nomePedido', '$f', '$m', '$descricao_Pedido', '$descricaoAlianca','$largura', '$gravacao_inter', '$gravacao_exter', '$outrosClientes','$imagem' , '$estoqueFeminina' ,'$estoqueMasculina', '$semPedra' , '$comPedra' )");
?>
