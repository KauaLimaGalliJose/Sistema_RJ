<?php
include_once('../conexao.php');

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
$pdf = null;

//imagem 

if(isset($_FILES['imagem']) && !empty($_FILES['imagem'])){

    if(!file_exists("../imagem/". $idPedidos . '.png')){

        $imagem = "../imagem/". $idPedidos . '.png';
        move_uploaded_file($_FILES['imagem']['tmp_name'], "../imagem/". $idPedidos . '.png');
    }
    $imagem = "../imagem/". $idPedidos . '.png';
}


// Quardando PDF 
if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === 0) {

    if(!file_exists("./pedidos/PDF/" . $idPedidos . '.pdf')){

        $pdf = "./pedidos/PDF/" . $idPedidos . '.pdf';
        move_uploaded_file($_FILES['pdf']['tmp_name'], $pdf);
    }
    $pdf = "./pedidos/PDF/" . $idPedidos . '.pdf';
} else {
    $pdf = "./pedidos/PDF/semEtiqueta.pdf";
}

// Outros Clientes 
if($cliente == 'showroom'){

    $idCentroAlianca = $cliente . '-' . $nomePedidoC;
    $idPedidos = $idCentroAlianca ."-". $dataEntrega;

    // passando pro banco de dados
    $dadosp = mysqli_query($conectar, "INSERT INTO pedidos 
    (idpedidos, cliente, nomePedido, numF, numeM, descricaoPedido, descricaoAlianca,largura, gravacaoInterna, gravacaoExterna,outrosClientes,imagem,parEstoqueF,parEstoqueM,PedraF,PedraM,pdf,data_digitada) 
    VALUES ('$idPedidos', '$cliente', '$nomePedido', '$f', '$m', '$descricao_Pedido', '$descricaoAlianca','$largura', '$gravacao_inter', '$gravacao_exter', '$outrosClientes','$imagem' , '$estoqueFeminina' ,'$estoqueMasculina', '$comPedra' , '$semPedra' , 'naoTemPdf' , '$dataEntrega' )");

}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($cliente == 'Outros'){
    
    $idOutros = $outrosClientes . '-' . $nomePedidoC;
    $idPedidos =  $idOutros ."-". $dataEntrega;

    // passando pro banco de dados
    $dadosp = mysqli_query($conectar, "INSERT INTO pedidos 
    (idpedidos, cliente, nomePedido, numF, numeM, descricaoPedido, descricaoAlianca,largura, gravacaoInterna, gravacaoExterna,outrosClientes,imagem,parEstoqueF,parEstoqueM,PedraF,PedraM,pdf,data_digitada) 
    VALUES ('$idPedidos','$cliente', '$nomePedido', '$f', '$m', '$descricao_Pedido', '$descricaoAlianca','$largura', '$gravacao_inter', '$gravacao_exter', '$outrosClientes','$imagem' , '$estoqueFeminina' ,'$estoqueMasculina', '$comPedra' , '$semPedra' , 'naoTemPdf' , '$dataEntrega')");
    
}

if($cliente == 'Mercado_Livre' && $numeroPedidoSplit[1] == "F"){
    
    $idPf = str_replace("PF","",$_POST['numeroPedido']); //Contador para o banco
    
    // passando pro banco de dados
    $dados = $conectar->prepare("INSERT INTO pedidosp 
    (contadorpf, idpedidos, cliente, nomePedido, numF, numeM, descricaoPedido, descricaoAlianca, largura, gravacaoInterna, gravacaoExterna, imagem, parEstoqueF, parEstoqueM, PedraF, PedraM, pdf, data_digitada) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $dados->bind_param("isssiissssssssssss", $idPf, $idPedidos, $cliente, $nomePedido, $f, $m, $descricao_Pedido, 
                            $descricaoAlianca,$largura, $gravacao_inter, $gravacao_exter, $imagem , 
                            $estoqueFeminina ,$estoqueMasculina, $comPedra , $semPedra , $pdf , $dataEntrega );
}

if($cliente == 'Mercado_Livre' && $numeroPedidoSplit[1] == 'G'){

    $idPg = str_replace("PG","",$_POST['numeroPedido']);

    // passando pro banco de dados
     $dados = $conectar->prepare("INSERT INTO pedidospg 
    (contadorpg, idpedidos, cliente, nomePedido, numF, numeM, descricaoPedido, descricaoAlianca, largura, gravacaoInterna, gravacaoExterna, imagem, parEstoqueF, parEstoqueM, PedraF, PedraM, pdf, data_digitada) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $dados->bind_param("isssiissssssssssss", $idPg, $idPedidos, $cliente, $nomePedido, $f, $m, $descricao_Pedido, 
                            $descricaoAlianca,$largura, $gravacao_inter, $gravacao_exter, $imagem , 
                            $estoqueFeminina ,$estoqueMasculina, $comPedra , $semPedra , $pdf , $dataEntrega );
     
}

if($cliente == 'Mercado_Livre' && $numeroPedidoSplit[1] == 'E'){

    $idPe = str_replace("PE","",$_POST['numeroPedido']);

    // passando pro banco de dados
    $dados = $conectar->prepare("INSERT INTO pedidospe 
    (contadorpe, idpedidos, cliente, nomePedido, numF, numeM, descricaoPedido, descricaoAlianca, largura, gravacaoInterna, gravacaoExterna, imagem, parEstoqueF, parEstoqueM, PedraF, PedraM, pdf, data_digitada) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $dados->bind_param("isssiissssssssssss", $idPe, $idPedidos, $cliente, $nomePedido, $f, $m, $descricao_Pedido, 
                            $descricaoAlianca,$largura, $gravacao_inter, $gravacao_exter, $imagem , 
                            $estoqueFeminina ,$estoqueMasculina, $comPedra , $semPedra , $pdf , $dataEntrega );
}

$dados->execute();
$dados->close();
?>
