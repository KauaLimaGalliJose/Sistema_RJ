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
                    <input id="pesquisaInput" type="text" oninput="this.value = this.value.toUpperCase();" placeholder="Número Pedido">
                </div>
                <div id="pedidosDiv">
                    <input class="selecao" value="sim" name="TodosSelect" type="checkbox">Todos os Pedidos
                    <input class="selecao" value="sim" name="pedidosAntigosSelect" type="checkbox">Pedidos Antigos
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
    <?php include_once('./separarPedidos.php');?>
    <div id="phpmae">
        <?php
            // Função para relogio
            date_default_timezone_set('America/Sao_Paulo'); // Fuso horário de Brasília
            $data = date('Y-m-d');
            $dataSplit = explode("-", $data);
            //////////////////////////////////////////////////////////////////////////

            if($_GET){

                $TodosSelect = $_GET['TodosSelect'] ?? null;
                $pedidosAntigosSelect = $_GET['pedidosAntigosSelect'] ?? null;
                $pfSelect = $_GET['pfSelect'] ?? null;
                $pgSelect = $_GET['pgSelect'] ?? null;
                $peSelect = $_GET['peSelect'] ?? null;
            }
        ?>
        <div id="phpDiv">
        <div id="bancoDeDados">
            <?php include_once('../../conexao.php');?>
        </div>
        <?php
        //PF ////////////////////////////////
        if(isset($pSelect) == 'sim'){
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
            ?></div><?php
        ?>
        <div id="php2">
        <?php 
        //PF ////////////////////////////////
        if(isset($pSelect) == 'sim'){
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
        else{
            $pedidoNaoEncontrado = 'Pedido Não Encontrado';
        } 
        ?>
        </div>
    </div>
    <div id="pedidonaoEncontrado">
        <?php 
            echo $pedidoNaoEncontrado;
        ?>
    </div>
</body>
</html>
