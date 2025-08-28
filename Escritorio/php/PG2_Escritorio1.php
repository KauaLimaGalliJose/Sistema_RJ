<?php
    include_once '../../phpIndex/protege.php';
    proteger();
?>
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
$gravacao_exter = $_POST['gravacao_exter'];
$gravacao_inter = $_POST['gravacao_inter'];
$largura = $_POST['largura'];
$outrosClientes = $_POST['txtcliente'];
$semPedra = isset($_POST['semPedra']) ? $_POST['semPedra'] : null;
$comPedra = isset($_POST['comPedra']) ? $_POST['comPedra'] : null;
$estoqueFeminina = isset($_POST['estoqueFeminina']) ? $_POST['estoqueFeminina'] : null;
$estoqueMasculina = isset($_POST['estoqueMasculina']) ? $_POST['estoqueMasculina'] : null;
$estoque = $_POST['estoque']?? 'Nenhum';


$numeroPedidoSplit = str_split($numeroPedido,1);

$idPedidos = $numeroPedido ."-". $dataEntrega;
$pdf = null;

//Verifica estoque
if($estoque == 'Nenhum'){
    $estoque = null;
}

//imagem 

if(isset($_FILES['imagem']) && !empty($_FILES['imagem'])){

    if(!file_exists("../../imagem/". $idPedidos . '.png')){

        $imagem = "../imagem/". $idPedidos . '.png';
        move_uploaded_file($_FILES['imagem']['tmp_name'], "../../imagem/". $idPedidos . '.png');
    }
    $imagem = "../imagem/". $idPedidos . '.png';
}


// Quardando PDF 
if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === 0) {

    if(!file_exists("../pedidos/PDF/" . $idPedidos . '.pdf')){

        $pdf = "../pedidos/PDF/" . $idPedidos . '.pdf';
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
    (contadorpf, idpedidos, cliente, nomePedido, numF, numeM, descricaoPedido, descricaoAlianca, largura, gravacaoInterna, gravacaoExterna, imagem, parEstoqueF, parEstoqueM, PedraF, PedraM, pdf, data_digitada , estoque) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $dados->bind_param("isssiisssssssssssss", $idPf, $idPedidos, $cliente, $nomePedido, $f, $m, $descricao_Pedido, 
                            $descricaoAlianca,$largura, $gravacao_inter, $gravacao_exter, $imagem , 
                            $estoqueFeminina ,$estoqueMasculina, $comPedra , $semPedra , $pdf , $dataEntrega, $estoque );
}

if($cliente == 'Mercado_Livre' && $numeroPedidoSplit[1] == 'G'){

    $idPg = str_replace("PG","",$_POST['numeroPedido']);

    // passando pro banco de dados
     $dados = $conectar->prepare("INSERT INTO pedidospg 
    (contadorpg, idpedidos, cliente, nomePedido, numF, numeM, descricaoPedido, descricaoAlianca, largura, gravacaoInterna, gravacaoExterna, imagem, parEstoqueF, parEstoqueM, PedraF, PedraM, pdf, data_digitada, estoque) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $dados->bind_param("isssiisssssssssssss", $idPg, $idPedidos, $cliente, $nomePedido, $f, $m, $descricao_Pedido, 
                            $descricaoAlianca,$largura, $gravacao_inter, $gravacao_exter, $imagem , 
                            $estoqueFeminina ,$estoqueMasculina, $comPedra , $semPedra , $pdf , $dataEntrega, $estoque );
     
}

if($cliente == 'Mercado_Livre' && $numeroPedidoSplit[1] == 'E'){

    $idPe = str_replace("PE","",$_POST['numeroPedido']);

    // passando pro banco de dados
    $dados = $conectar->prepare("INSERT INTO pedidospe 
    (contadorpe, idpedidos, cliente, nomePedido, numF, numeM, descricaoPedido, descricaoAlianca, largura, gravacaoInterna, gravacaoExterna, imagem, parEstoqueF, parEstoqueM, PedraF, PedraM, pdf, data_digitada, estoque) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $dados->bind_param("isssiisssssssssssss", $idPe, $idPedidos, $cliente, $nomePedido, $f, $m, $descricao_Pedido, 
                            $descricaoAlianca,$largura, $gravacao_inter, $gravacao_exter, $imagem , 
                            $estoqueFeminina ,$estoqueMasculina, $comPedra , $semPedra , $pdf , $dataEntrega, $estoque );
}



// Calibrar estoque -------------------------------------------------------------------------------------------------------------------------
include_once('escritorio_estoque.php');
$estoquePersonalizado = $_POST['estoque'];  // nome do estoque
$f = $_POST['f'];  // nome da coluna da aliança feminina
$m = $_POST['m'];  // nome da coluna da aliança masculina

// Verifica se o estoque existe feminina
tirar_do_estoque($f,$estoquePersonalizado,$conectar);

// Verifica se o estoque existe masculina
tirar_do_estoque($m,$estoquePersonalizado,$conectar);


$dados->execute();
$dados->close();
mysqli_close($conectar);
?>
