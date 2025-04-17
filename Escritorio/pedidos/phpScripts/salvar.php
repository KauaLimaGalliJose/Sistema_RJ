<?php 
include_once('../../../conexao.php');

// Puxando dados
if($_POST){
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
    $semPedra = isset($_POST['semPedra']) ;
    $comPedra = isset($_POST['comPedra']);
    $estoqueFeminina = isset($_POST['estoqueFeminina']) ;
    $estoqueMasculina = isset($_POST['estoqueMasculina']);

    $numeroPedidoSplit = str_split($numeroPedido,1);

    $idPedidos = $numeroPedido ."-". $dataEntrega;

    //imagem 
    if(isset($_FILES['imagem']) && !empty($_FILES['imagem'])){
        $imagem = "../imagem/". $idPedidos . 'png';
        move_uploaded_file($_FILES['imagem']['tmp_name'], "../../../imagem/". $idPedidos . 'png');
    }

    // Quardando PDF 
    if(isset($_FILES['pdf']) && !empty($_FILES['pdf'])){
        include('./pedidos/PDF/');
        move_uploaded_file($_FILES['pdf']['tmp_name'], "../PDF/" . $idPedidos . '.pdf' );
    }


    if($cliente == 'Mercado_Livre' && $numeroPedidoSplit[1] == "F"){
        
        $sql_update = "UPDATE pedidosp SET nomePedido = ?, numF = ?, numeM = ?, descricaoPedido = ?, descricaoAlianca = ?,largura = ?, gravacaoInterna = ?, gravacaoExterna = ? ,parEstoqueF = ?,parEstoqueM = ?, PedraF = ?,PedraM = ?  WHERE idpedidos = ?";

        $stmt = $conectar->prepare($sql_update);
        $stmt->bind_param("siissssssssss", $nomePedido, $f, $m, $descricao_Pedido, $descricaoAlianca,$largura, $gravacao_inter, $gravacao_exter , $estoqueFeminina ,$estoqueMasculina, $comPedra ,$semPedra  , $idPedidos);
        $stmt->execute();
        $stmt->close();
    }

    if($cliente == 'Mercado_Livre' && $numeroPedidoSplit[1] == 'G'){

        $sql_update = "UPDATE pedidospg SET nomePedido = ?, numF = ?, numeM = ?, descricaoPedido = ?, descricaoAlianca = ?,largura = ?, gravacaoInterna = ?, gravacaoExterna = ? ,parEstoqueF = ?,parEstoqueM = ?, PedraF = ?,PedraM = ?  WHERE idpedidos = ?";

        $stmt = $conectar->prepare($sql_update);
        $stmt->bind_param("siissssssssss", $nomePedido, $f, $m, $descricao_Pedido, $descricaoAlianca,$largura, $gravacao_inter, $gravacao_exter , $estoqueFeminina ,$estoqueMasculina, $comPedra ,$semPedra , $idPedidos);
        $stmt->execute();
        $stmt->close();
        
    }

    if($cliente == 'Mercado_Livre' && $numeroPedidoSplit[1] == 'E'){

        $sql_update = "UPDATE pedidospe SET nomePedido = ?, numF = ?, numeM = ?, descricaoPedido = ?, descricaoAlianca = ?,largura = ?, gravacaoInterna = ?, gravacaoExterna = ? ,parEstoqueF = ?,parEstoqueM = ?, PedraF = ?,PedraM = ? WHERE idpedidos = ?";

        $stmt = $conectar->prepare($sql_update);
        $stmt->bind_param("siissssssssss", $nomePedido, $f, $m, $descricao_Pedido, $descricaoAlianca,$largura, $gravacao_inter, $gravacao_exter , $estoqueFeminina ,$estoqueMasculina, $comPedra ,$semPedra  , $idPedidos);
        $stmt->execute();
        $stmt->close();
    
        
    }

}
?>
