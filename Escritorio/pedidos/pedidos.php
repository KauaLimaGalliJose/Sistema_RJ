<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../coroa.png" type="image/x-icon">
    <link rel="stylesheet" href="pedidos.css">
    <script src="./pedidos.js"></script>
    <title>Pedidos</title>
</head>
<body>
<form id="formulario" method="POST" action="pedidos.php">
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
                <button type="submit" id="enviar"><h1>Pesquisar</h1></button>
        </div>
    </div>
</form>
    <?php include_once('../../conexao.php');?>
    <div id="phpmae">
        <?php
            if($_POST){

                $TodosSelect = $_POST['TodosSelect'] ?? null;
                $pedidosAntigosSelect = $_POST['pedidosAntigosSelect'] ?? null;
                $pfSelect = $_POST['pfSelect'] ?? 'nao';
                $pgSelect = $_POST['pgSelect'] ?? 'nao';
                $peSelect = $_POST['peSelect'] ?? 'nao';
            }
        ?>
        <div id="phpDiv">
        <?php
            date_default_timezone_set('America/Sao_Paulo'); // Fuso horário de Brasília
            $data = date('Y-m-d');
            $dataSplit = explode("-", $data);

            // Recupera todos os pedidos com idpedidos e imagem *Select PF*
        if($pfSelect == 'sim'){

            $dadosVerificador = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, descricaoPedido, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido FROM pedidosp WHERE idpedidos != 'PF00-$data' ORDER BY contadorpf ASC";
            $Verificador = mysqli_query($conectar, $dadosVerificador);

            while (($dados = mysqli_fetch_assoc($Verificador))) {
            
                if ($dados['idpedido'] == $dataSplit[1] . '-' . $dataSplit[2]) {
                    $pf = explode("-" , $dados['idpedidos']);

                    ?><div class="pedidostexto"><label><?php
                    ?><div class="tituloPedido">
                        <h2><?php print( $pf[0].' -- '.$dados['nomePedido'].' -- '); ?><span class="font_red"><?php print($dataSplit[2] . '/' . $dataSplit[1] );?></span></h2>
                    </div>
                    <?php
                    //Verificando Numeração Feminina
                    if($dados['numF'] == 40){

                        $numeroFeminino = ' não tem';
                    }
                    else{

                        $numeroFeminino = $dados['numF'];
                    }


                    //Se gravação externa e interna for NULL
                    if($dados['gravacaoInterna'] == NULL && $dados['gravacaoExterna'] == NULL){

                        print($dados['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $dados['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($dados['numeM']. "<br>"); ?></span>
                        </label></div><?php
                    }
                    elseif($dados['gravacaoExterna'] !== NULL && $dados['gravacaoInterna'] !== NULL){

                        print($dados['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $dados['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($dados['numeM']. "<br>"); ?></span>
                        <span class="font_blu"> <?php print('Gravação:');?></span><?php echo $dados['gravacaoInterna']. "<br>"?>
                        <span class="font_red"> <?php print('Gravação Externa:');?></span><?php echo $dados['gravacaoExterna'];?>
                        </label></div><?php
                    }
                    elseif($dados['gravacaoInterna'] !== NULL){

                        print($dados['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $dados['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($dados['numeM']. "<br>"); ?></span>
                        <span class="font_blu"> <?php print('Gravação:');?></span><?php echo $dados['gravacaoInterna'];?>
                        </label></div><?php
                    }
                    elseif($dados['gravacaoExterna'] !== NULL){

                        print($dados['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $dados['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($dados['numeM']. "<br>"); ?></span>
                        <span class="font_red"> <?php print('Gravação Externa:');?></span><?php echo $dados['gravacaoExterna'];?>
                        </label></div><?php
                    }
                }
            }
            ?>    
        </div>
        <div id="php2">
            <?php

            $imagem = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem FROM pedidosp WHERE idpedidos != 'PF00-$data' ORDER BY contadorpf ASC";
            $imagemConectar = mysqli_query($conectar, $imagem);

            while ($dadosImagem = mysqli_fetch_assoc($imagemConectar)) {
                 
                if ($dadosImagem['idpedido'] == $dataSplit[1] . '-' . $dataSplit[2]) {

                    ?><div class="pedidosImagem"><?php
                    ?><img class = "Imagem" src="<?php echo '../' .$dadosImagem['imagem'];?>" alt="Imagem do Pedido"><?php
                    ?></div><?php
                    ?><button class = 'Pdf' type="button">PDF</button><?php
                }
            }
        }
        //PG
        elseif($pgSelect == 'sim'){

            $dadosVerificadorPg = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, descricaoPedido, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido FROM pedidospg WHERE idpedidos != 'PG00-$data' ORDER BY contadorpg ASC";
            $VerificadorPg = mysqli_query($conectar, $dadosVerificadorPg);

            while (($dadosPg = mysqli_fetch_assoc($VerificadorPg))) {
            
                if ($dadosPg['idpedido'] == $dataSplit[1] . '-' . $dataSplit[2]) {

                    $pg = explode("-" , $dadosPg['idpedidos']);

                    ?><div class="pedidostexto"><label><?php
                    ?><div class="tituloPedido">
                        <h2><?php print( $pg[0].' -- '.$dadosPg['nomePedido'].' -- '); ?><span class="font_red"><?php print($dataSplit[2] . '/' . $dataSplit[1] );?></span></h2>
                    </div>
                    <?php
                    //Verificando Numeração Feminina
                    if($dadosPg['numF'] == 40){

                        $numeroFeminino = ' não tem';
                    }
                    else{

                        $numeroFeminino = $dadosPg['numF'];
                    }

                    //Se gravação externa e interna for NULL
                    if($dadosPg['gravacaoInterna'] == NULL && $dadosPg['gravacaoExterna'] == NULL){

                        print($dadosPg['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $dadosPg['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($dadosPg['numeM']. "<br>"); ?></span>
                        </label></div><?php
                    }
                    elseif($dadosPg['gravacaoExterna'] !== NULL && $dadosPg['gravacaoInterna'] !== NULL){

                        print($dadosPg['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $dadosPg['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($dadosPg['numeM']. "<br>"); ?></span>
                        <span class="font_blu"> <?php print('Gravação:');?></span><?php echo $dadosPg['gravacaoInterna']. "<br>"?>
                        <span class="font_red"> <?php print('Gravação Externa:');?></span><?php echo $dadosPg['gravacaoExterna'];?>
                        </label></div><?php
                    }
                    elseif($dadosPg['gravacaoInterna'] !== NULL){

                        print($dadosPg['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $dadosPg['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($dadosPg['numeM']. "<br>"); ?></span>
                        <span class="font_blu"> <?php print('Gravação:');?></span><?php echo $dadosPg['gravacaoInterna'];?>
                        </label></div><?php
                    }
                    elseif($dadosPg['gravacaoExterna'] !== NULL){

                        print($dadosPg['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $dadosPg['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($dadosPg['numeM']. "<br>"); ?></span>
                        <span class="font_red"> <?php print('Gravação Externa:');?></span><?php echo $dadosPg['gravacaoExterna'];?>
                        </label></div><?php
                    }
                }  
            }
            ?>    
            </div>
            <div id="php2">
                <?php

                $imagemPg = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem FROM pedidospg WHERE idpedidos != 'PG00-$data' ORDER BY contadorpg ASC";
                $imagemConectarPg = mysqli_query($conectar, $imagemPg);
        
                while ($dadosImagemPg = mysqli_fetch_assoc($imagemConectarPg)) {
                         
                    if ($dadosImagemPg['idpedido'] == $dataSplit[1] . '-' . $dataSplit[2]) {

                        ?><div class="pedidosImagem"><?php
                        ?><img class = "Imagem" src="<?php echo '../' .$dadosImagemPg['imagem'];?>" alt="Imagem do Pedido"><?php
                        ?></div><?php
                        ?><button class = 'Pdf' type="button">PDF</button><?php
                    }
                } 
            }
        
        else{
            ?><h1><span class="font_red"><?php print('Nenhum Pedido Encontrado');?></span></h1><?php
        }
            ?></div><?php
        ?>
        </div>
    </div>
</body>
</html>
