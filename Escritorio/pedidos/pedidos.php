
<?php // banco de dados
 include_once('../../conexao.php');?>
<?php // Menu -----
include_once('../../scripts/phpGlobal/frontEnd/cabecalho/menu.php');
include_once('../../scripts/phpGlobal/frontEnd/cabecalho/menu_conteiners/menu_conteiner.php');
include_once('../../scripts/phpGlobal/backEnd/menu/configMenu.php');
?>
<?php // estoques de agora  -----
include_once('../../scripts/phpGlobal/frontEnd/estoque/estoqueFront.php');
?>
<?php // pedidos em linha e Blocos -----

$valorEstiloPedidos = estiloConfig_pedidos_menu();

//include_once('../../scripts/phpGlobal/backEnd/pedidosPesquisa/pedidosEmLinha.php');
include_once('../../scripts/phpGlobal/backEnd/pedidosPesquisa/pedidosEmBlocos.php');
include_once('../../scripts/phpGlobal/backEnd/pedidosPesquisa/pedidosEmLinha.php');

use pedidosPesquisa\Pedidos_Blocos;
use pedidosPesquisa\Pedidos_Linha;
$tipoDePedidos = '';

if($valorEstiloPedidos == 'pedidosBlocos' ){

    $pedidosPF = new Pedidos_Blocos('PF' , '../' , $conectar);
    $pedidosPG = new Pedidos_Blocos('PG' , '../' , $conectar);
    $pedidosPE = new Pedidos_Blocos('PE' , '../' , $conectar);

    $tipoDePedidos = '<link rel="stylesheet" href="../../scripts/cssGlobal/pedidosPesquisa/pedidosEmBlocos.css">';
}
else{

    $pedidosPF = new Pedidos_Linha('PF' , '../' , $conectar);
    $pedidosPG = new Pedidos_Linha('PG' , '../' , $conectar);
    $pedidosPE = new Pedidos_Linha('PE' , '../' , $conectar);

    $tipoDePedidos = '';
}

?>
<?php



?>
<?php
    function checkboxp($name){

        $pSelect = $_GET[$name] ?? '';
        if($pSelect !== ''){
            return 'checked';
        }
        else{
            return '';
        }
    }
    function checkboxpg($name){

        $pSelect = $_GET[$name] ?? '';
        if($pSelect !== ''){
            return 'checked';
        }
        else{
            return '';
        }
    }
    function checkboxpe($name){

        $pSelect = $_GET[$name] ?? '';
        if($pSelect !== ''){
            return 'checked';
        }
        else{
            return '';
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="../../coroa.png" type="image/x-icon">
    <link rel="stylesheet" href="pedidos.css">
    <link rel="stylesheet" href="../../scripts/cssGlobal/cabecalho/menu/menu_conteiner.css">
    <?=  $tipoDePedidos ?>
    <script src="./js/pedidos.js" type="module" defer></script>
    <script src="./js/pedidosEnviar.js" defer></script>
    
    <!-- Para Usar a pagina js dos pedidos !-->
    <script src= '../../scripts/jsGlobal/menu/estilosPedidos.js' defer></script>
    <title>Pedidos</title>
</head>
<body>
<header>
    <form id="formulario" method="get" action="pedidos.php">
        <div id="cabecalho">
            <div id="cabecalho_menu">
            <div id="part_cabecalho_inputs">
                <div id="casa">
                    <button type="button" value=""  class="botao" >
                    <a href="../PG2-Escritorio.php"><img class="itens" src="../Escritorio_img/casa.png"></a>
                    </button>
                </div>
                    <div id="pesquisa">
                        <input id="pesquisaInput" value='' name="pesquisa" type="text" oninput =" enviarForm_recuperarEstiloRadio();"  placeholder="Titulo Pedido">
                        <input id="quemRecebeInput" value='' name="quemRecebe" type="text" oninput=" enviarForm_recuperarEstiloRadio();"  placeholder="Quem Recebe">
                        <input class="data" id="dataInput" value="<?php echo $_GET['dataInput'] ?? ''; ?>" name="dataInput" type="date" onchange="enviarForm(); this.form.submit()">
                    </div>

                    <div id="pedidosDiv">
                        
                        <label class="estoque_esgotado">        
                            <input id="PF" value="sim" name="pfSelect" type="checkbox" <?php echo checkboxp('pfSelect'); ?> onchange="this.form.submit(); enviarForm();">
                            <div class="checkmark"></div>
                            <span>PF</span>
                        </label>

                        <label class="estoque_esgotado">        
                            <input id="PG" value="sim" name="pgSelect" type="checkbox" <?php echo checkboxpg('pgSelect'); ?> onchange="enviarForm(); this.form.submit()">
                            <div class="checkmark"></div>
                            <span>PG</span>
                        </label>

                        <label class="estoque_esgotado">        
                            <input id="PE" value="sim" name="peSelect" type="checkbox" <?php echo checkboxpe('peSelect'); ?> onchange="enviarForm(); this.form.submit()">
                            <div class="checkmark"></div>
                            <span>PE</span>
                        </label>

                        <label class="estoque_esgotado">        
                            <input name="estoque_esgotado" value="checked" type="checkbox" oninput="enviarForm(); this.form.submit()" <?php echo $_GET['estoque_esgotado']?? '' ?>>
                            <div class="checkmark"></div>
                            <span>Estoque para fazer</span>
                        </label>

                    <button type='button' id="imprimir" class="botao">
                        <img class="itens" src="./imagemPedido/impressora-50.png">
                    </button>
                </div>
            </div>
            <div id="menu">
                <?php echo menu_('../../') ?>
            </div>
        </div>
    </div>
    </form>
    <?php 
        $dataInput = $_GET['dataInput']  ?? date('Y-m-d');

        // Menu de conteiners
        echo menu_conteiner($conectar , '../../' , null , $dataInput );
    ?>
</header>

<main id="main">
    <div id="phpmae">
        <?php
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

            // radios
            $pfSelect = $_GET['pfSelect'] ?? null;
            $pgSelect = $_GET['pgSelect'] ?? null;
            $peSelect = $_GET['peSelect'] ?? null;
            $checkbox_estoque = $_GET['estoque_esgotado']?? null;
            // Inputs
            $dataInput = $_GET['dataInput'] ?? '';
            $pesquisa = $_GET['pesquisa'] ?? '';
            $quemRecebe = $_GET['quemRecebe'] ?? '';
            //checkbox
            $menu = $_GET['menu_cabecalho'] ?? null;

            
            //Se não Pesquisar nada 
            if($pesquisa == '' && $quemRecebe == '' && empty($dataInput) && $dataInput == '' && isset($pfSelect) == null && isset($pgSelect) == null && isset($peSelect) == null && $checkbox_estoque != 'checked'){
                $semPedido =  include_once('../../semPedidos/semPedidos.php');
            }

            ?>
        <div id="phpDiv">
        <?php    

            //Estoques //////////////////////////
            if( $checkbox_estoque == 'checked' ){
                //variaveis
                $pesquisa = '';
                $quemRecebe = '';
                $dataInput = null; 
                $pfSelect = null;
                $pgSelect = null ;
                $peSelect = null;
                
                //variaveis
                $estoque_nome = $_GET['radioName'] ?? '' ;
                
                // aqui é o quanto vc precisa voltar para achar a imagem , o caminho da imagem
                $caminhoimagem = '../../';
                
                echo '<div id = "estoques_Mae">';
                    ?>
                    <link rel="stylesheet" href="../../scripts/cssGlobal/estoque_esgotado.css">
                    <script src="../../scripts/jsGlobal/estoque/estoqueFront.js" defer></script>
                        <div id="Estoques_Torno_Polimento_Sem_estoque">
                            <h1>Escolha um Estoque</h1>
                        </div>
                    <?php
                    estoques($conectar, $estoque_nome,'./phpScripts/estoque_esgotado.php',$caminhoimagem);    
                    escolher_estoque($conectar, $estoque_nome, './pedidos.php');
                echo '</div>';
            } ?>
        </div>
    </div>
    <div id="pedidonaoEncontrado">
       <?php echo $semPedido; 
       mysqli_close($conectar);
       ?>
    </div>
</main>
</body>
</html>
