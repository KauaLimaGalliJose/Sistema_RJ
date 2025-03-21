<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../coroa.png" type="image/x-icon">
    <link rel="stylesheet" href="pedidos.css">
    <script src="./js/pedidos.js" type="module"></script>
    <title>Pedidos</title>
</head>
<body>
<form id="formulario" method="GET" action="pedidos.php">
    <div id="cabecalho">
        <div id="cabecalho_menu">
            <div id="casa">
                <button type="button" value=""  class="botao" >
                <a href="../PG2-Escritorio.php"><img class="itens" src="../casa.png"></a>
                </button>
            </div>
                <div id="pesquisa">
                    <input id="pesquisaInput" value='' name="pesquisa" type="text" oninput="this.value = this.value.toUpperCase();" placeholder="Número Pedido">
                </div>
                <div id="pedidosDiv">
                    <input class="selecao" value="sim" name="pedidosAntigosSelect" type="checkbox">Outros Dias
                    <input class="selecao" value="sim" name="pedidosAmanhaSelect" type="checkbox">Para Amanhã
                    <input class="selecao" value="sim" name="pfSelect" type="checkbox">PF
                    <input class="selecao" value="sim" name="pgSelect" type="checkbox">PG
                    <input class="selecao" value="sim" name="peSelect" type="checkbox">PE
                </div>
                <button type="submit" id="enviar">
                    <h1>Pesquisar</h1>
                </button>
                <button type='button' id="imprimir" class="botao">
                    <img class="itens" src="./imagemPedido/impressora-50.png">
                </button>
        </div>
    </div>
</form>
    <?php include_once('./phpScripts/separarPedidos.php');?>
    <?php include_once('./phpScripts/pedidosAntigos.php');?>
    <?php include_once('./phpScripts/pesquisa.php');?>
    <div id="phpmae">
        <?php
            // Função para relogio
            date_default_timezone_set('America/Sao_Paulo'); // Fuso horário de Brasília
            $data = date('Y-m-d');
            $dataSplit = explode("-", $data);
            //////////////////////////////////////////////////////////////////////////

            if($_GET){
                $pedidosAntigosSelect = $_GET['pedidosAntigosSelect'] ?? null;
                $pfSelect = $_GET['pfSelect'] ?? null;
                $pgSelect = $_GET['pgSelect'] ?? null;
                $peSelect = $_GET['peSelect'] ?? null;
                $pesquisa = $_GET['pesquisa'];
            }
        ?>
        <div id="phpDiv">
        <div id="bancoDeDados">
            <?php include_once('../../conexao.php');?>
        </div>
        <?php
        //PF ////////////////////////////////
        if(isset($fpSelect) == 'sim'){
            selectPf($conectar,$dataSplit,$data);
            
        }
        //PG ////////////////////////////////
        if(isset($pgSelect) == 'sim'){
            selectPg($conectar,$dataSplit,$data);
        }
        //PE ///////////////////////////////
        if(isset($peSelect) == 'sim'){
            selectPe($conectar,$dataSplit,$data);
        }
        //PedidosAntigos ///////////////////////////////
        if(isset($pedidosAntigosSelect) == 'sim'){
            pedidosAntigos($conectar,$dataSplit);
        }
        //elseif(isset($pedidosAntigosSelect) == 'sim' && isset($pesquisa)){
            //pesquisaPedidosAntigos($pesquisa,$conectar,$data,$dataSplit);
        //}
        //Pesquisa /////////////////////////
        if(isset($pesquisa) !== ''){
            pesquisa($pesquisa,$conectar,$data,$dataSplit);
        }
            ?></div><?php
        ?>
        <div id="php2">
        <?php 
        //PF ////////////////////////////////
        if(isset($pfSelect) == 'sim'){
            selectImagePF($conectar,$dataSplit,$data);
            
        } 
        //PG ////////////////////////////////
        if(isset($pgSelect) == 'sim'){
            selectImagePG($conectar,$dataSplit,$data);
        } 
        //PE ///////////////////////////////
        if(isset($peSelect) == 'sim'){
            selectImagePE($conectar,$dataSplit,$data);
        }
        //PedidosAntigos ///////////////////////////////
        if(isset($pedidosAntigosSelect) == 'sim'){
            pedidosAntigosImagem($conectar,$dataSplit);
        }
         //Pesquisa /////////////////////////
        if(isset($pesquisa) !== ''){
            pesquisaImagem($pesquisa,$conectar,$data,$dataSplit);
        }
        ?>
        </div>
    </div>
    <div id="pedidonaoEncontrado">

    </div>
</body>
</html>
