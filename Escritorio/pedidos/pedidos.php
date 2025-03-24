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
                    <input class="selecao" id="Outros Dias" value="sim" name="pedidosAntigosSelect" type="checkbox"><label for="Outros Dias">Outros Dias</label>
                    <input class="selecao" id="PF" value="sim" name="pfSelect" type="checkbox"><label for="PF">PF</label>
                    <input class="selecao" id="PG" value="sim" name="pgSelect" type="checkbox"><label for="PG">PG</label>
                    <input class="selecao" id="PE" value="sim" name="peSelect" type="checkbox"><label for="PE">PE</label>
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
<main>
    <div id="phpmae">
        <?php include_once('./phpScripts/separarPedidos.php');?>
        <?php include_once('./phpScripts/pedidosAntigos.php');?>
        <?php include_once('./phpScripts/pesquisa.php');?>
        <?php
            // Função para relogio
            date_default_timezone_set('America/Sao_Paulo'); // Fuso horário de Brasília
            $data = date('Y-m-d');
            $dataSplit = explode("-", $data);
            //////////////////////////////////////////////////////////////////////////
            //Variaveis
            $pesquisa = ''; // Valor padrão

            if($_GET){
                $pedidosAntigosSelect = $_GET['pedidosAntigosSelect'] ?? null;
                $pfSelect = $_GET['pfSelect'] ?? null;
                $pgSelect = $_GET['pgSelect'] ?? null;
                $peSelect = $_GET['peSelect'] ?? null;
                $pesquisa = $_GET['pesquisa'] ?? '';
            }
        ?>
        <div id="phpDiv">
        <div id="bancoDeDados">
            <?php include_once('../../conexao.php');?>
        </div>
        <?php

        //PF ////////////////////////////////
        if(isset($pfSelect) == 'sim'){
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

        //pesquisa
        if($pesquisa !== '' && $pedidosAntigosSelect !== 'sim'){
            pesquisa($pesquisa,$conectar,$data,$dataSplit);
        }
        //PedidosAntigos e pesquisa ///////////////////////////////
        if(isset($pedidosAntigosSelect) == 'sim'){
                pedidosAntigos($conectar,$dataSplit,$pesquisa);
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

        //Pesquisa
        if($pesquisa !== '' && $pedidosAntigosSelect !== 'sim'){
            pesquisaImagem($pesquisa,$conectar,$data,$dataSplit);
        }
        //PedidosAntigos e pesquisa ///////////////////////////////
        if(isset($pedidosAntigosSelect) == 'sim'){
                pedidosAntigosImagem($conectar,$dataSplit,$pesquisa);
        }
         
        ?>
        </div>
    </div>
    <div id="pedidonaoEncontrado">

    </div>
</main>
</body>
</html>
