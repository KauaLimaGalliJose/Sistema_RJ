
<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

include_once('../../conexao.php');

// Para Enviar Cookies 
function CokiesP($nome,$numero){
    setcookie($nome,$numero, time() + (365 * 86400 * 1000), "/");
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
$gravacao_exter = $_POST['peso'];
$gravacao_interM = $_POST['gravInternaM'];
$gravacao_interF = $_POST['gravInternaF'];
$largura = $_POST['largura'];
$outrosClientes = $_POST['txtcliente'] ?? 'Loja';
$semPedra = isset($_POST['semPedra']) ? $_POST['semPedra'] : null;
$comPedra = isset($_POST['comPedra']) ? $_POST['comPedra'] : null;
$estoqueFeminina = isset($_POST['estoqueFeminina']) ? $_POST['estoqueFeminina'] : null;
$estoqueMasculina = isset($_POST['estoqueMasculina']) ? $_POST['estoqueMasculina'] : null;
$estoque = $_POST['estoque']?? 'Nenhum';
$estoqueImg = $_POST['estoqueImg'] ?? null;
$checkbox_Corfimar_grav = $_POST['Confirmar_grav'] ?? null;


$numeroPedidoSplit = str_split($numeroPedido,1);

$idCentroAlianca = $outrosClientes . '-' . $nomePedidoC;
$idPedidosOutros = $idCentroAlianca ."-". $dataEntrega;

$idPedidos = $numeroPedido ."-". $dataEntrega;
$pdf = null;


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
if( $estoqueImg != null ){

    $imagem = $estoqueImg;
    $imagemOutros = $estoqueImg;
}
if(isset($_FILES['imagem']) && !empty($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK  ){

    
    if($cliente == 'Loja' ){

        $idCentroAlianca = $cliente . '-' . $nomePedidoC;
        $idPedidos = $idCentroAlianca ."-". $dataEntrega;
        
        if(!file_exists("../../arquivos_Sistema/imagem_pedidos/". $idPedidos . '.png')){
    
            $imagemOutros = "../arquivos_Sistema/imagem_pedidos/". $idPedidos . '.png';
            move_uploaded_file($_FILES['imagem']['tmp_name'], "../../arquivos_Sistema/imagem_pedidos/". $idPedidos . '.png');
        }
        $imagemOutros = "../arquivos_Sistema/imagem_pedidos/". $idPedidos . '.png';

    }elseif($cliente == 'Outros'){

        $idOutros = $outrosClientes . '-' . $nomePedidoC;
        $idPedidos =  $idOutros ."-". $dataEntrega ;
                
        if(!file_exists("../../arquivos_Sistema/imagem_pedidos/". $idPedidos . '.png')){
    
            $imagemOutros = "../arquivos_Sistema/imagem_pedidos/". $idPedidos . '.png';
            move_uploaded_file($_FILES['imagem']['tmp_name'], "../../arquivos_Sistema/imagem_pedidos/". $idPedidos . '.png');
        }
        $imagemOutros = "../arquivos_Sistema/imagem_pedidos/". $idPedidos . '.png';
    }
    elseif($cliente == 'Mercado_Livre'){
        $idPedidos = $numeroPedido ."-". $dataEntrega;

        if(!file_exists("../../arquivos_Sistema/imagem_pedidos/". $idPedidos . '.png')){
    
            $imagem = "../arquivos_Sistema/imagem_pedidos/". $idPedidos . '.png';
            move_uploaded_file($_FILES['imagem']['tmp_name'], "../../arquivos_Sistema/imagem_pedidos/". $idPedidos . '.png');
        }

        $imagem = "../arquivos_Sistema/imagem_pedidos/". $idPedidos . '.png';
    }
}


// Quardando PDF 
if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === 0) {

    if(!file_exists("../../arquivos_Sistema/PDFs/" . $idPedidos . '.pdf')){

        $pdf = "../arquivos_Sistema/PDFs/" . $idPedidos . '.pdf';
        $pdfOutros = "../arquivos_Sistema/PDFs/" . $idPedidosOutros . '.pdf';
        move_uploaded_file($_FILES['pdf']['tmp_name'], $pdf);
    }
    $pdf = "../arquivos_Sistema/PDFs/" . $idPedidos . '.pdf';
    $pdfOutros = "../arquivos_Sistema/PDFs/" . $idPedidosOutros . '.pdf';
} else {
    $pdf = "../arquivos_Sistema/PDFs/semEtiqueta.pdf";
    $pdfOutros = "../arquivos_Sistema/PDFs/semEtiqueta.pdf";
}


$conectar->begin_transaction(); // ✅ INICIA A TRANSAÇÃO

try {
    // Clientes showroom
    if($cliente == 'Loja'){
        $idCentroAlianca = $cliente . '-' . $nomePedidoC;
        $idPedidos = $idCentroAlianca ."-". $dataEntrega;

        $dados = $conectar->prepare("INSERT INTO pedidos 
        (idpedidos, cliente, nomePedido, numF, numeM, descricaoPedido, descricaoAlianca, largura, gravacaoInternaM , gravacaoInternaF, peso, imagem, parEstoqueF, parEstoqueM, PedraF, PedraM, pdf, data_digitada , estoque) 
        VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ? , ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $dados->bind_param("sssiisssssdssssssss", $idPedidos, $cliente, $nomePedidoC, $f, $m, $descricao_Pedido, 
                            $descricaoAlianca,$largura, $gravacao_interM, $gravacao_interF, $gravacao_exter, $imagemOutros , 
                            $estoqueFeminina ,$estoqueMasculina, $comPedra , $semPedra , $pdfOutros , $dataEntrega, $estoque );
        if (!$dados) {
            throw new Exception("Erro ao inserir Loja: " . mysqli_error($conectar));
        }
    }

    // Clientes Outros
    if($cliente == 'Outros'){
        $idOutros = $outrosClientes . '-' . $nomePedidoC;
        $idPedidos =  $idOutros ."-". $dataEntrega ;

        $dados = $conectar->prepare("INSERT INTO pedidos 
        (idpedidos, cliente, nomePedido, numF, numeM, descricaoPedido, descricaoAlianca, largura, gravacaoInternaM , gravacaoInternaF, peso, imagem, parEstoqueF, parEstoqueM, PedraF, PedraM, pdf, data_digitada , estoque) 
        VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ? , ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $dados->bind_param("sssiisssssdssssssss", $idPedidos, $outrosClientes, $nomePedidoC, $f, $m, $descricao_Pedido, 
                            $descricaoAlianca,$largura, $gravacao_interM, $gravacao_interF, $gravacao_exter, $imagemOutros , 
                            $estoqueFeminina ,$estoqueMasculina, $comPedra , $semPedra , $pdf , $dataEntrega, $estoque );
        if (!$dados) {
            throw new Exception("Erro ao inserir : " . $outrosClientes . mysqli_error($conectar));
        }
    }

    // Mercado Livre
    if($cliente == 'Mercado_Livre' && $numeroPedidoSplit[1] == "F"){
        $idPf = str_replace("PF","",$_POST['numeroPedido']);

        $dados = $conectar->prepare("INSERT INTO pedidosp 
        (contadorpf, idpedidos, cliente, nomePedido, numF, numeM, descricaoPedido, descricaoAlianca, largura, gravacaoInternaM , gravacaoInternaF, peso, imagem, parEstoqueF, parEstoqueM, PedraF, PedraM, pdf, data_digitada , estoque) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? , ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $dados->bind_param("isssiisssssdssssssss", $idPf, $idPedidos, $cliente, $nomePedido, $f, $m, $descricao_Pedido, 
                            $descricaoAlianca,$largura, $gravacao_interM, $gravacao_interF, $gravacao_exter, $imagem , 
                            $estoqueFeminina ,$estoqueMasculina, $comPedra , $semPedra , $pdf , $dataEntrega, $estoque );
    }

    if($cliente == 'Mercado_Livre' && $numeroPedidoSplit[1] == 'G'){
        $idPg = str_replace("PG","",$_POST['numeroPedido']);

        $dados = $conectar->prepare("INSERT INTO pedidospg 
        (contadorpg, idpedidos, cliente, nomePedido, numF, numeM, descricaoPedido, descricaoAlianca, largura, gravacaoInternaM , gravacaoInternaF, peso, imagem, parEstoqueF, parEstoqueM, PedraF, PedraM, pdf, data_digitada, estoque) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? , ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $dados->bind_param("isssiisssssdssssssss", $idPg, $idPedidos, $cliente, $nomePedido, $f, $m, $descricao_Pedido, 
                            $descricaoAlianca,$largura, $gravacao_interM, $gravacao_interF , $gravacao_exter, $imagem , 
                            $estoqueFeminina ,$estoqueMasculina, $comPedra , $semPedra , $pdf , $dataEntrega, $estoque );
    }

    if($cliente == 'Mercado_Livre' && $numeroPedidoSplit[1] == 'E'){
        $idPe = str_replace("PE","",$_POST['numeroPedido']);

        $dados = $conectar->prepare("INSERT INTO pedidospe 
        (contadorpe, idpedidos, cliente, nomePedido, numF, numeM, descricaoPedido, descricaoAlianca, largura, gravacaoInternaM , gravacaoInternaF, peso, imagem, parEstoqueF, parEstoqueM, PedraF, PedraM, pdf, data_digitada, estoque) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ? , ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $dados->bind_param("isssiisssssdssssssss", $idPe, $idPedidos, $cliente, $nomePedido, $f, $m, $descricao_Pedido, 
                            $descricaoAlianca,$largura, $gravacao_interM, $gravacao_interF , $gravacao_exter, $imagem , 
                            $estoqueFeminina ,$estoqueMasculina, $comPedra , $semPedra , $pdf , $dataEntrega, $estoque );
    }

    if (isset($dados)) {
        if (!$dados->execute()) {
            throw new Exception("Erro ao inserir pedido ML: " . $dados->error);
        }
        $dados->close();
    }

    //  Calibrar estoque SOMENTE após o sucesso
    include_once('escritorio_estoque.php');
    $estoquePersonalizado = $_POST['estoque'];
    tirar_do_estoque($f, $estoquePersonalizado, $conectar);
    tirar_do_estoque($m, $estoquePersonalizado, $conectar);

    $conectar->commit(); //  FINALIZA A TRANSAÇÃO

} 
catch (Exception $e) {

    $conectar->rollback(); // ❌ CANCELA TUDO SE DER ERRO
    echo "Erro: " . $e->getMessage();
}

mysqli_close($conectar);
?>

