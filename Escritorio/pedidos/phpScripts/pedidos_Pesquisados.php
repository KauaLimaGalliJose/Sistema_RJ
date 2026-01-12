
<?php // banco de dados
 include_once('../../../conexao.php');?>
<?php // Menu -----
include_once('../../../scripts/phpGlobal/frontEnd/cabecalho/menu.php');
include_once('../../../scripts/phpGlobal/frontEnd/cabecalho/menu_conteiners/menu_conteiner.php');
include_once('../../../scripts/phpGlobal/backEnd/menu/configMenu.php');
?>
<?php // estoques de agora  -----
include_once('../../../scripts/phpGlobal/frontEnd/estoque/estoqueFront.php');
?>
<?php // pedidos em linha e Blocos -----

$valorEstiloPedidos = estiloConfig_pedidos_menu();

//include_once('../../scripts/phpGlobal/backEnd/pedidosPesquisa/pedidosEmLinha.php');
include_once('../../../scripts/phpGlobal/backEnd/pedidosPesquisa/pedidosEmBlocos.php');
include_once('../../../scripts/phpGlobal/backEnd/pedidosPesquisa/pedidosEmLinha.php');


use pedidosPesquisa\Pedidos_Blocos;
use pedidosPesquisa\Pedidos_Linha;


if($valorEstiloPedidos == 'pedidosBlocos' ){

    $pedidosPF = new Pedidos_Blocos('PF' , '../' , $conectar);
    $pedidosPG = new Pedidos_Blocos('PG' , '../' , $conectar);
    $pedidosPE = new Pedidos_Blocos('PE' , '../' , $conectar);
}
else{

    $pedidosPF = new Pedidos_Linha('PF' , '../' , $conectar);
    $pedidosPG = new Pedidos_Linha('PG' , '../' , $conectar);
    $pedidosPE = new Pedidos_Linha('PE' , '../' , $conectar);
}

// Função para relogio
date_default_timezone_set('America/Sao_Paulo'); // Fuso horário de Brasília
$data = date('Y-m-d');
$dataSplit = explode("-", $data);
//////////////////////////////////////////////////////////////////////////
//Variaveis
$pesquisa = ''; // Valor padrão
$quemRecebe = '';
$semPedido = null;
$checkbox_estoque = '';
$menu = null;
$dataInput = null; 
$pfSelect = null;
$pgSelect = null ;
$peSelect = null;

// radios
$pfSelect = $_POST['pfSelect'] ?? null;
$pgSelect = $_POST['pgSelect'] ?? null;
$peSelect = $_POST['peSelect'] ?? null;
$checkbox_estoque = $_POST['estoque_esgotado']?? null;
// Inputs
$dataInput = $_POST['dataInput'] ?? '';
$pesquisa = $_POST['pesquisa'] ?? '';
$quemRecebe = $_POST['quemRecebe'] ?? '';
//checkbox
$menu = $_POST['menu_cabecalho'] ?? null;
// Enviado os Gets

$pedidosPF->getdata($dataInput);
$pedidosPG->getdata($dataInput);
$pedidosPE->getdata($dataInput);

$pedidosPF->getpesquisa($pesquisa);
$pedidosPG->getpesquisa($pesquisa);
$pedidosPE->getpesquisa($pesquisa);

$pedidosPF->getquemRecebe($quemRecebe);
$pedidosPG->getquemRecebe($quemRecebe);
$pedidosPE->getquemRecebe($quemRecebe);

echo "<div id='phpDiv'>";
//PF ////////////////////////////////
if(isset($pfSelect) == 'sim' && $checkbox_estoque != 'checked'){
    
    $pedidosPF->select();
}

//PG ////////////////////////////////
if(isset($pgSelect) == 'sim' && $checkbox_estoque != 'checked'){
    $pedidosPG->select();
}

//PE ///////////////////////////////
if(isset($peSelect) == 'sim' && $checkbox_estoque != 'checked'){
    
    $pedidosPE->select();
}

if( isset($pfSelect) != 'sim' && $checkbox_estoque != 'checked' ){
    
    $pedidosPF->select();
}
echo "</div>";
?>
<div id="php2"> 
    <?php // Aqui vai a imagem Caso for pedidos Linha
//PF ////////////////////////////////
if(isset($pfSelect) == 'sim' && $valorEstiloPedidos == 'pedidosLinha' && $checkbox_estoque != 'checked'){  
    
    $pedidosPF->selectImagem();
} 
//PG ////////////////////////////////
if(isset($pgSelect) == 'sim' && $valorEstiloPedidos == 'pedidosLinha' && $checkbox_estoque != 'checked'){

    $pedidosPG->selectImagem();
} 
//PE ///////////////////////////////
if(isset($peSelect) == 'sim' && $valorEstiloPedidos == 'pedidosLinha' && $checkbox_estoque != 'checked'){

    $pedidosPE->selectImagem();
}

if( isset($pfSelect) != 'sim' && $checkbox_estoque != 'checked'  && $valorEstiloPedidos == 'pedidosLinha' ){
    
    $pedidosPF->selectImagem();
}
?>
</div>
