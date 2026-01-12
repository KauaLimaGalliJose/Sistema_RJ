<?php 
include_once('../../../conexao.php');

if($_POST){
    $numeroPedido = $_POST['numeroPedido'];
    $dataEntrega = $_POST['dataEntrega'];
    $dataEntrega_original = $_POST['dataEntrega_original'];

    $cliente = $_POST['cliente'];
    $clienteOutros = $_POST['txtcliente'] ?? 'Loja';
    $clienteOutros_original = $_POST['txtcliente_original'] ?? 'Loja';
    $nomePedido = $_POST['nome_m'];
    $nomePedidoC = $_POST['nome_p'];
    $nomePedidoC_original = $_POST['nome_p_original'] ?? '';
    $f = $_POST['f'];
    $m = $_POST['m'];
    $descricao_Pedido = $_POST['descricao_Pedido'];
    $descricaoAlianca = $_POST['descricao_Alianca'];
    $gravacao_exter = $_POST['peso'];
    $gravacao_interM = $_POST['gravInternaM'];
    $gravacao_interF = $_POST['gravInternaF'];
    $largura = $_POST['largura'];
    $outrosClientes = $_POST['txtcliente'];
    $semPedra = isset($_POST['semPedra']) ;
    $comPedra = isset($_POST['comPedra']);
    $estoqueFeminina = isset($_POST['estoqueFeminina']) ;
    $estoqueMasculina = isset($_POST['estoqueMasculina']);

    $estoque = $_POST['estoque']?? null;
    $estoqueImg = $_POST['estoqueImg'] ?? null;
    $checkbox_Corfimar_grav = $_POST['Confirmar_grav'] ?? null;

    $numeroPedidoSplit = str_split($numeroPedido,1);

    // Nomes Caso tenha mudança será o atual Id Antigo e O atual para substituir 
    if($cliente == 'Loja'){

        $idPedidosOutros = 'Loja' ."-". $nomePedidoC ."-". $dataEntrega;
        $idPedidosOutros_antigo = 'Loja' ."-". $nomePedidoC_original ."-". $dataEntrega_original;
    }
    elseif($cliente == 'Outros'){

        $idPedidosOutros = $clienteOutros ."-". $nomePedidoC ."-". $dataEntrega;
        $idPedidosOutros_antigo = $clienteOutros_original ."-". $nomePedidoC_original ."-". $dataEntrega_original;
    }
    else{

        $idPedidos = $numeroPedido ."-". $dataEntrega;
        $idPedidos_antigo = $numeroPedido ."-". $dataEntrega_original;
    }

    // Coloca o endereço para achar a imagem novamente
    $imagem = "../arquivos_Sistema/imagem_pedidos/". $idPedidos . '.png'; // Mercado Livre Pf Pg e Pe
    $imagemOutros = "../arquivos_Sistema/imagem_pedidos/". $idPedidosOutros . '.png'; // esse é da Loja e dos Outros 


    // Verifica se é para confirmar gravação
    if($checkbox_Corfimar_grav == 'on'){
        $gravacao_interM = 'Confirmar_Gravação';
        $gravacao_interF = 'Confirmar_Gravação';
    }
    //Verifica estoque
    if($estoque == 'Nenhum'){
        $estoque = null;
    }

    //imagem 
    if( $estoque != null && $estoqueImg != null  ){

        $imagem = $estoqueImg;
        $imagemOutros = $estoqueImg;

        if(file_exists("../../../arquivos_Sistema/imagem_pedidos/". $idPedidos . '.png')){

            unlink("../../../arquivos_Sistema/imagem_pedidos/". $idPedidos . '.png');
        }
        elseif(file_exists("../../../arquivos_Sistema/imagem_pedidos/". $idPedidosOutros . '.png')){
            
            unlink("../../../arquivos_Sistema/imagem_pedidos/". $idPedidosOutros . '.png');
        }

    }


    if(isset($_FILES['imagem']) && !empty($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK ){

        if( $cliente == 'Outros' || $cliente == 'Loja'){
            
            $imagemOutros = "../arquivos_Sistema/imagem_pedidos/". $idPedidosOutros . '.png';
            move_uploaded_file($_FILES['imagem']['tmp_name'], "../../../arquivos_Sistema/imagem_pedidos/". $idPedidosOutros . '.png');
        }
        else {

            $imagem = "../arquivos_Sistema/imagem_pedidos/". $idPedidos . '.png';
            move_uploaded_file($_FILES['imagem']['tmp_name'], "../../../arquivos_Sistema/imagem_pedidos/". $idPedidos . '.png');
        }
    }
    
    
    // parte caso mude o nome principal no caso a Primary Key dele moda o nome da imagem tbm  -- OUTROS e LOJA --
    if($idPedidosOutros_antigo != $idPedidosOutros && $estoque == null && $estoqueImg == null && $cliente != 'Mercado_Livre' ){


        $caminhoAntigo = "../../../arquivos_Sistema/imagem_pedidos/". $idPedidosOutros_antigo . '.png';
        $novo_caminho =  "../../../arquivos_Sistema/imagem_pedidos/". $idPedidosOutros . '.png';
        
        rename($caminhoAntigo, $novo_caminho);
        $imagemOutros = "../arquivos_Sistema/imagem_pedidos/". $idPedidosOutros . '.png';
        
    }
    // parte caso mude o nome principal no caso a Primary Key dele moda o nome da imagem tbm  -- Mercado Livre --
    elseif($idPedidos != $idPedidos_antigo && $estoque == null && $estoqueImg == null && $cliente == 'Mercado_Livre' ){

        
        $caminhoAntigo = "../../../arquivos_Sistema/imagem_pedidos/". $idPedidos_antigo . '.png';
        $novo_caminho =  "../../../arquivos_Sistema/imagem_pedidos/". $idPedidos . '.png';
   
        rename($caminhoAntigo, $novo_caminho);
        $imagem = "../arquivos_Sistema/imagem_pedidos/". $idPedidos . '.png';
    }



    // Quardando PDF 
    if($cliente == 'Mercado_Livre'){

        if(isset($_FILES['pdf']) && !empty($_FILES['pdf'])){
            
            $pdf = "../arquivos_Sistema/PDFs/" . $idPedidos . '.pdf';
            move_uploaded_file($_FILES['pdf']['tmp_name'], "../PDF/" . $idPedidos . '.pdf' );
        }
    }
    else{

        if(isset($_FILES['pdf']) && !empty($_FILES['pdf'])){
            
            $pdf = "../arquivos_Sistema/PDFs/" . $idPedidosOutros . '.pdf';
            move_uploaded_file($_FILES['pdf']['tmp_name'], "../PDF/" . $idPedidosOutros . '.pdf' );
        }        
    }

    if($cliente == 'Mercado_Livre' && $numeroPedidoSplit[1] == "F"){
        
        $sql_update = "UPDATE pedidosp SET idpedidos = ? , nomePedido = ?, imagem = ?, numF = ?, numeM = ?, descricaoPedido = ?, descricaoAlianca = ?,largura = ?, gravacaoInternaM = ? ,gravacaoInternaF = ?, peso = ? ,parEstoqueF = ?,parEstoqueM = ?, PedraF = ?,PedraM = ? , pdf = ? , estoque = ?, data_digitada = ?  WHERE idpedidos = ?";

        $stmt = $conectar->prepare($sql_update);
        $stmt->bind_param("sssiisssssdssssssss", $idPedidos , $nomePedido, $imagem , $f, $m, $descricao_Pedido, $descricaoAlianca,$largura, $gravacao_interM, $gravacao_interF , $gravacao_exter , $estoqueFeminina ,$estoqueMasculina, $comPedra ,$semPedra ,$pdf , $estoque , $dataEntrega , $idPedidos_antigo);


        $pedido_Tabela = 'pedidosp';
    }

    if($cliente == 'Mercado_Livre' && $numeroPedidoSplit[1] == 'G'){

        $sql_update = "UPDATE pedidospg SET idpedidos = ? , nomePedido = ?, imagem = ?, numF = ?, numeM = ?, descricaoPedido = ?, descricaoAlianca = ?,largura = ?, gravacaoInternaM = ? ,gravacaoInternaF = ?, peso = ? ,parEstoqueF = ?,parEstoqueM = ?, PedraF = ?,PedraM = ? , pdf = ? , estoque = ?, data_digitada = ? WHERE idpedidos = ?";

        $stmt = $conectar->prepare($sql_update);
        $stmt->bind_param("sssiisssssdssssssss", $idPedidos, $nomePedido, $imagem , $f, $m, $descricao_Pedido, $descricaoAlianca,$largura, $gravacao_interM, $gravacao_interF, $gravacao_exter , $estoqueFeminina ,$estoqueMasculina, $comPedra ,$semPedra ,$pdf, $estoque ,$dataEntrega , $idPedidos_antigo);

        
        $pedido_Tabela = 'pedidospg';
    }

    if($cliente == 'Mercado_Livre' && $numeroPedidoSplit[1] == 'E'){

        $sql_update = "UPDATE pedidospe SET idpedidos = ? , nomePedido = ?, imagem = ? , numF = ?, numeM = ?, descricaoPedido = ?, descricaoAlianca = ?,largura = ?, gravacaoInternaM = ? ,gravacaoInternaF = ?, peso = ? ,parEstoqueF = ?,parEstoqueM = ?, PedraF = ?,PedraM = ? , pdf = ? , estoque = ?, data_digitada = ? WHERE idpedidos = ?";

        $stmt = $conectar->prepare($sql_update);
        $stmt->bind_param("sssiisssssdssssssss", $idPedidos, $nomePedido,$imagem , $f, $m, $descricao_Pedido, $descricaoAlianca,$largura, $gravacao_interM, $gravacao_interF , $gravacao_exter , $estoqueFeminina ,$estoqueMasculina, $comPedra ,$semPedra ,$pdf, $estoque , $dataEntrega , $idPedidos_antigo);

    
        $pedido_Tabela = 'pedidospe';
    }

    if($cliente != 'Mercado_Livre' ){

        if($cliente == 'Loja'){

            $clienteLoja = 'Loja';

            $sql_update = "UPDATE pedidos SET idpedidos = ? , nomePedido = ?, cliente = ? , numF = ?, numeM = ?, descricaoPedido = ?, descricaoAlianca = ?,largura = ?, gravacaoInternaM = ? ,gravacaoInternaF = ?, peso = ? ,parEstoqueF = ?,parEstoqueM = ?, PedraF = ?,PedraM = ? , pdf = ? , estoque = ? , imagem = ? , data_digitada = ? WHERE idpedidos = ?";
    
            $stmt = $conectar->prepare($sql_update);
            $stmt->bind_param("sssiisssssdsssssssss", $idPedidosOutros , $nomePedidoC , $clienteLoja , $f, $m, $descricao_Pedido, $descricaoAlianca,$largura, $gravacao_interM, $gravacao_interF , $gravacao_exter , $estoqueFeminina ,$estoqueMasculina, $comPedra ,$semPedra ,$pdf, $estoque , $imagemOutros , $dataEntrega , $idPedidosOutros_antigo);
    
            $pedido_Tabela = 'pedidos';
            $idPedidos_antigo = $idPedidosOutros;

        }
        elseif($cliente == 'Outros'){
            
            $sql_update = "UPDATE pedidos SET idpedidos = ? , nomePedido = ?, cliente = ? , numF = ?, numeM = ?, descricaoPedido = ?, descricaoAlianca = ?,largura = ?, gravacaoInternaM = ? ,gravacaoInternaF = ?, peso = ? ,parEstoqueF = ?,parEstoqueM = ?, PedraF = ?,PedraM = ? , pdf = ? , estoque = ? , imagem = ? , data_digitada = ? WHERE idpedidos = ?";
    
            $stmt = $conectar->prepare($sql_update);
            $stmt->bind_param("sssiisssssdsssssssss", $idPedidosOutros , $nomePedidoC , $clienteOutros , $f, $m, $descricao_Pedido, $descricaoAlianca,$largura, $gravacao_interM, $gravacao_interF , $gravacao_exter , $estoqueFeminina ,$estoqueMasculina, $comPedra ,$semPedra ,$pdf, $estoque , $imagemOutros , $dataEntrega , $idPedidosOutros_antigo);
    
        
            $pedido_Tabela = 'pedidos';
            $idPedidos_antigo = $idPedidosOutros;
        }
    }




}

// Calibrar estoque -------------------------------------------------------------------------------------------------------------------------
include_once('../../php/escritorio_estoque.php');
$estoquePersonalizado = $_POST['estoque']?? '';  // nome do estoque
$f = $_POST['f'];  // nome da coluna da aliança feminina
$m = $_POST['m'];  // nome da coluna da aliança masculina

if($estoquePersonalizado == '' ){

    $stmt->execute();
    $stmt->close();
    mysqli_close($conectar);

    return;
}
else{

    // Verifica se o estoque existe feminina
    repor_estoque_antigo($conectar, $pedido_Tabela, $idPedidos_antigo,$f,'F', $estoquePersonalizado);
    
    // Verifica se o estoque existe masculina
    repor_estoque_antigo($conectar, $pedido_Tabela, $idPedidos_antigo,$m,'M', $estoquePersonalizado);
}

$stmt->execute();
$stmt->close();
mysqli_close($conectar);

?>
