<?php
    include_once '../../phpIndex/protege.php';
    proteger();
?>
<?php include_once('./phpScripts/separarPedidos.php');?>
<?php include_once('./phpScripts/dataPesquisa.php');?>
<?php include_once('./phpScripts/pesquisa.php');?>
<?php include_once('./phpScripts/quemRecebe.php');?>
<?php include_once('../../scripts/phpGlobal/frontEnd/estoque/estoqueFront.php');?>
<?php include_once('../../scripts/phpGlobal/frontEnd/cabecalho/menu.php');?>
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
    <script src="./js/pedidos.js" type="module" defer></script>
    <title>Pedidos</title>
</head>
<body>
<header>
    <form id="formulario" method="$_GET" action="pedidos.php">
        <div id="cabecalho">
            <div id="cabecalho_menu">
            <div id="part_cabecalho_inputs">
                <div id="casa">
                    <button type="button" value=""  class="botao" >
                    <a href="../PG2-Escritorio.php"><img class="itens" src="../Escritorio_img/casa.png"></a>
                    </button>
                </div>
                    <div id="pesquisa">
                        <input id="pesquisaInput" value='<?php echo $_GET['pesquisa'] ?? ''; ?>' name="pesquisa" type="text" onchange="this.form.submit()" oninput="this.value = this.value.toUpperCase();" placeholder="Titulo Pedido">
                        <input id="quemRecebeInput" value='<?php echo $_GET['quemRecebe'] ?? ''; ?>' name="quemRecebe" type="text" onchange="this.form.submit()" oninput="this.value = this.value.toUpperCase();" placeholder="Quem Recebe">
                        <input class="data" id="dataInput" value="<?php echo $_GET['dataInput'] ?? date('Y-m-d'); ?>" name="dataInput" type="date" oninput="this.form.submit()">
                    </div>

                    <div id="pedidosDiv">
                        
                        <label class="estoque_esgotado">        
                            <input id="PF" value="sim" name="pfSelect" type="checkbox" <?php echo checkboxp('pfSelect'); ?> onchange="this.form.submit()">
                            <div class="checkmark"></div>
                            <span>PF</span>
                        </label>

                        <label class="estoque_esgotado">        
                            <input id="PG" value="sim" name="pgSelect" type="checkbox" <?php echo checkboxpg('pgSelect'); ?> onchange="this.form.submit()">
                            <div class="checkmark"></div>
                            <span>PG</span>
                        </label>

                        <label class="estoque_esgotado">        
                            <input id="PE" value="sim" name="peSelect" type="checkbox" <?php echo checkboxpe('peSelect'); ?> onchange="this.form.submit()">
                            <div class="checkmark"></div>
                            <span>PE</span>
                        </label>

                        <label class="estoque_esgotado">        
                            <input name="estoque_esgotado" value="checked" type="checkbox" oninput="this.form.submit()" <?php echo $_GET['estoque_esgotado']?? '' ?>>
                            <div class="checkmark"></div>
                            <span>Estoque para fazer</span>
                        </label>

                    <button type='button' id="imprimir" class="botao">
                        <img class="itens" src="./imagemPedido/impressora-50.png">
                    </button>
                </div>
            </div>
            <div id="menu">
                <?php echo menu_('') ?>
            </div>
        </div>
    </div>
    </form>
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

            if($_GET){
                // radios
                $pfSelect = $_GET['pfSelect'] ?? null;
                $pgSelect = $_GET['pgSelect'] ?? null;
                $peSelect = $_GET['peSelect'] ?? null;
                $checkbox_estoque = $_GET['estoque_esgotado']?? null;

                // Inputs
                $dataInput = $_GET['dataInput'] ?? null;
                $pesquisa = $_GET['pesquisa'] ?? '';
                $quemRecebe = $_GET['quemRecebe'] ?? '';
            }
        ?>
        <div id="phpDiv">
        <div id="bancoDeDados">
            <?php include_once('../../conexao.php');?>
        </div>
        <?php

        //Estoques //////////////////////////
        if( $checkbox_estoque == 'checked' ){

            //variaveis
            $pesquisa = '';
            $quemRecebe = '';
            $dataInput = null; 
            $pfSelect == null;
            $pgSelect == null ;
            $peSelect == null;
            
            //variaveis
            $estoque_nome = $_REQUEST['radioName']?? "";
            
            // aqui é o quanto vc precisa voltar para achar a imagem , o caminho da imagem
            $caminhoimagem = '../';
            
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
        }

        //PF ////////////////////////////////
        if(isset($pfSelect) == 'sim' && $checkbox_estoque != 'checked'){
            select($conectar,$dataSplit, 'pedidosp', 'contadorpf' ,$data);
            $dataInput = '';
            
        }

        //PG ////////////////////////////////
        if(isset($pgSelect) == 'sim' && $checkbox_estoque != 'checked'){
            select($conectar,$dataSplit,'pedidospg', 'contadorpg' ,$data);
            $dataInput = '';
        }

        //PE ///////////////////////////////
        if(isset($peSelect) == 'sim' && $checkbox_estoque != 'checked'){
            select($conectar,$dataSplit,'pedidospe', 'contadorpe' ,$data);
            $dataInput = '';
        }

        //pesquisa
        if($pesquisa !== '' && $dataInput == null ){
            pesquisa($pesquisa,$conectar,$dataSplit, 'pedidosp' , 'contadorpf');
            pesquisa($pesquisa,$conectar,$dataSplit, 'pedidospg' , 'contadorpg');
            pesquisa($pesquisa,$conectar,$dataSplit, 'pedidospe' , 'contadorpe');

        }
        //PedidosAntigos e pesquisa ///////////////////////////////
        if(isset($dataInput) && $quemRecebe == ''){
            pedidosData($conectar,$dataInput,$pesquisa);
        }
        //Quem Recebe e Data /////////////////////////////////////
        if($quemRecebe !== ''){
            quemRecebe($conectar,$quemRecebe,$dataInput);
        }
            ?></div><?php
        ?>
        <div id="php2">
        <?php 

        //PF ////////////////////////////////
        if(isset($pfSelect) == 'sim'){
            selectImagem($conectar,$dataSplit, 'pedidosp', 'contadorpf' ,$data);   
        } 

        //PG ////////////////////////////////
        if(isset($pgSelect) == 'sim'){
            selectImagem($conectar,$dataSplit, 'pedidospg', 'contadorpg' ,$data);
        } 

        //PE ///////////////////////////////
        if(isset($peSelect) == 'sim'){
            selectImagem($conectar,$dataSplit, 'pedidospe', 'contadorpe' ,$data);
        }

        //Pesquisa
        if($pesquisa !== '' && $dataInput == null ){
            pesquisaImagem($pesquisa,$conectar,$dataSplit, 'pedidosp' , 'contadorpf');
            pesquisaImagem($pesquisa,$conectar,$dataSplit, 'pedidospg' , 'contadorpg');
            pesquisaImagem($pesquisa,$conectar,$dataSplit, 'pedidospe' , 'contadorpe');
        }
        //PedidosAntigos e pesquisa ///////////////////////////////
        if(isset($dataInput) && $quemRecebe == ''){
            pedidosDataImagem($conectar,$dataInput,$pesquisa);
        }
        //Quem Recebe e Data /////////////////////////////////////
        if($quemRecebe !== ''){
            quemRecebeImagem($conectar,$quemRecebe,$dataInput);
        }

        //Se não Pesquisar nada 
        if($pesquisa == '' && $quemRecebe == '' && empty($dataInput) && isset($pfSelect) == null && isset($pgSelect) == null && isset($peSelect) == null && $checkbox_estoque != 'checked'){
            $semPedido =  include_once('../../semPedidos/semPedidos.php');
            echo "<script> document.getElementById('phpmae').style.backgroundColor = 'transparent'; 
                document.body.style.background = 'transparent';
                </script>";
        }
         
        ?>
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
