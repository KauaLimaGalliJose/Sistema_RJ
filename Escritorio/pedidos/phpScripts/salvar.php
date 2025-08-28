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
    $estoque = $_POST['estoque']?? 'Nenhum';

    $numeroPedidoSplit = str_split($numeroPedido,1);

    $idPedidos = $numeroPedido ."-". $dataEntrega;

    //Verifica estoque
    if($estoque == 'Nenhum'){
        $estoque = null;
    }

    //imagem 
    if(isset($_FILES['imagem']) && !empty($_FILES['imagem'])){

        move_uploaded_file($_FILES['imagem']['tmp_name'], "../../../imagem/". $idPedidos . '.png');
    }

    // Quardando PDF 
    if(isset($_FILES['pdf']) && !empty($_FILES['pdf'])){
        $pdf = "./pedidos/PDF/" . $idPedidos . '.pdf';
        move_uploaded_file($_FILES['pdf']['tmp_name'], "../PDF/" . $idPedidos . '.pdf' );
    }


    if($cliente == 'Mercado_Livre' && $numeroPedidoSplit[1] == "F"){
        
        $sql_update = "UPDATE pedidosp SET nomePedido = ?, numF = ?, numeM = ?, descricaoPedido = ?, descricaoAlianca = ?,largura = ?, gravacaoInterna = ?, gravacaoExterna = ? ,parEstoqueF = ?,parEstoqueM = ?, PedraF = ?,PedraM = ? , pdf = ? , estoque = ?  WHERE idpedidos = ?";

        $stmt = $conectar->prepare($sql_update);
        $stmt->bind_param("siissssssssssss", $nomePedido, $f, $m, $descricao_Pedido, $descricaoAlianca,$largura, $gravacao_inter, $gravacao_exter , $estoqueFeminina ,$estoqueMasculina, $comPedra ,$semPedra ,$pdf , $estoque , $idPedidos);


        $pedido_Tabela = 'pedidosp';
    }

    if($cliente == 'Mercado_Livre' && $numeroPedidoSplit[1] == 'G'){

        $sql_update = "UPDATE pedidospg SET nomePedido = ?, numF = ?, numeM = ?, descricaoPedido = ?, descricaoAlianca = ?,largura = ?, gravacaoInterna = ?, gravacaoExterna = ? ,parEstoqueF = ?,parEstoqueM = ?, PedraF = ?,PedraM = ? , pdf = ? , estoque = ? WHERE idpedidos = ?";

        $stmt = $conectar->prepare($sql_update);
        $stmt->bind_param("siissssssssssss", $nomePedido, $f, $m, $descricao_Pedido, $descricaoAlianca,$largura, $gravacao_inter, $gravacao_exter , $estoqueFeminina ,$estoqueMasculina, $comPedra ,$semPedra ,$pdf, $estoque , $idPedidos);

        
        $pedido_Tabela = 'pedidospg';
    }

    if($cliente == 'Mercado_Livre' && $numeroPedidoSplit[1] == 'E'){

        $sql_update = "UPDATE pedidospe SET nomePedido = ?, numF = ?, numeM = ?, descricaoPedido = ?, descricaoAlianca = ?,largura = ?, gravacaoInterna = ?, gravacaoExterna = ? ,parEstoqueF = ?,parEstoqueM = ?, PedraF = ?,PedraM = ? , pdf = ? , estoque = ? WHERE idpedidos = ?";

        $stmt = $conectar->prepare($sql_update);
        $stmt->bind_param("siissssssssssss", $nomePedido, $f, $m, $descricao_Pedido, $descricaoAlianca,$largura, $gravacao_inter, $gravacao_exter , $estoqueFeminina ,$estoqueMasculina, $comPedra ,$semPedra ,$pdf, $estoque , $idPedidos);

    
        $pedido_Tabela = 'pedidospe';
    }

    
}

// Calibrar estoque -------------------------------------------------------------------------------------------------------------------------
include_once('../../php/escritorio_estoque.php');
$estoquePersonalizado = $_POST['estoque'];  // nome do estoque
$f = $_POST['f'];  // nome da coluna da aliança feminina
$m = $_POST['m'];  // nome da coluna da aliança masculina

// Verifica se o estoque existe feminina
repor_estoque_antigo($conectar, $pedido_Tabela, $idPedidos,$f,'F', $estoquePersonalizado);

// Verifica se o estoque existe masculina
repor_estoque_antigo($conectar, $pedido_Tabela, $idPedidos,$m,'M', $estoquePersonalizado);

$stmt->execute();
$stmt->close();
mysqli_close($conectar);
?>
