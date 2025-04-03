<?php 
include_once('../../../conexao.php');

//imagem 
if(isset($_FILES['imagem']) && !empty($_FILES['imagem'])){
    $imagem = "../imagem/". $_FILES['imagem']['name'];
    move_uploaded_file($_FILES['imagem']['tmp_name'], "../imagem/".$_FILES['imagem']['name'] );
}

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
    $semPedra = isset($_POST['semPedra']) ? $_POST['semPedra'] : null;
    $comPedra = isset($_POST['comPedra']) ? $_POST['comPedra'] : null;
    $estoqueFeminina = isset($_POST['estoqueFeminina']) ? $_POST['estoqueFeminina'] : null;
    $estoqueMasculina = isset($_POST['estoqueMasculina']) ? $_POST['estoqueMasculina'] : null;

    $numeroPedidoSplit = str_split($numeroPedido,1);

    $idPedidos = $numeroPedido ."-". $dataEntrega;

    // Quardando PDF 
    if(isset($_FILES['pdf']) && !empty($_FILES['pdf'])){
        include('./pedidos/PDF/');
        $pdf = "./pedidos/PDF/" . $idPedidos . '.pdf';
        move_uploaded_file($_FILES['pdf']['tmp_name'], "./pedidos/PDF/" . $idPedidos . '.pdf' );
    }


    if($cliente == 'Mercado_Livre' && $numeroPedidoSplit[1] == "F"){
        
        $sql_update = "UPDATE pedidosp SET nomePedido = ?, numF = ?, numeM = ?, descricaoPedido = ?, descricaoAlianca = ?,largura = ?, gravacaoInterna = ?, gravacaoExterna = ? ,parEstoqueF = ?,parEstoqueM = ?, PedraF = ?,PedraM = ? WHERE idpedidos = ?";

        $stmt = $conectar->prepare($sql_update);
        $stmt->bind_param("siisssssssssss", $nomePedido, $f, $m, $descricao_Pedido, $descricaoAlianca,$largura, $gravacao_inter, $gravacao_exter , $estoqueFeminina ,$estoqueMasculina, $semPedra , $comPedra , $idPedidos);
        $stmt->execute();
        $stmt->close();
    }

    if($cliente == 'Mercado_Livre' && $numeroPedidoSplit[1] == 'G'){

        $sql_update = "UPDATE pedidospg SET nomePedido = ?, numF = ?, numeM = ?, descricaoPedido = ?, descricaoAlianca = ?,largura = ?, gravacaoInterna = ?, gravacaoExterna = ? ,parEstoqueF = ?,parEstoqueM = ?, PedraF = ?,PedraM = ? WHERE idpedidos = ?";

        $stmt = $conectar->prepare($sql_update);
        $stmt->bind_param("siisssssssssss", $nomePedido, $f, $m, $descricao_Pedido, $descricaoAlianca,$largura, $gravacao_inter, $gravacao_exter , $estoqueFeminina ,$estoqueMasculina, $semPedra , $comPedra , $idPedidos);
        $stmt->execute();
        $stmt->close();
        
    }

    if($cliente == 'Mercado_Livre' && $numeroPedidoSplit[1] == 'E'){

        $sql_update = "UPDATE pedidospe SET nomePedido = ?, numF = ?, numeM = ?, descricaoPedido = ?, descricaoAlianca = ?,largura = ?, gravacaoInterna = ?, gravacaoExterna = ? ,parEstoqueF = ?,parEstoqueM = ?, PedraF = ?,PedraM = ? WHERE idpedidos = ?";

        $stmt = $conectar->prepare($sql_update);
        $stmt->bind_param("siisssssssssss", $nomePedido, $f, $m, $descricao_Pedido, $descricaoAlianca,$largura, $gravacao_inter, $gravacao_exter , $estoqueFeminina ,$estoqueMasculina, $semPedra , $comPedra , $idPedidos);
        $stmt->execute();
        $stmt->close();
    
        
    }

}
?>
