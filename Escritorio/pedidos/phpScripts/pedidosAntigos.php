
<?php ///////////////////////////////-------------------PEDIDOS ANTIGOS----------------------////////////////////////////////////////////////////////////// ?>
<?php
    function pedidosAntigos($conectar,$dataSplit){
        
        // VAriaveis para se concetar com Banco de Dados

        //PF
        $pedidosAntigosPf = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, descricaoPedido, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido FROM pedidosp WHERE contadorpf != 0 ORDER BY contadorpf ASC";
        $pedidosAntigosDadosPf = mysqli_query($conectar, $pedidosAntigosPf);

         //PG
        $pedidosAntigosPg = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, descricaoPedido, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido FROM pedidospg WHERE contadorpg != 0 ORDER BY contadorpg ASC";
        $pedidosAntigosDadosPg = mysqli_query($conectar, $pedidosAntigosPg);

          //PE
          $pedidosAntigosPe = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, descricaoPedido, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido FROM pedidospe WHERE contadorpe != 0 ORDER BY contadorpe ASC";
          $pedidosAntigosDadosPe = mysqli_query($conectar, $pedidosAntigosPe);

        //PF -------------------------------------------------------------------
        while($linhapedidosAntigos = mysqli_fetch_assoc($pedidosAntigosDadosPf)){

            //Variaveis do Banco
            $pf = explode("-" , $linhapedidosAntigos['idpedidos']);

            if ($linhapedidosAntigos['idpedido'] !== $dataSplit[1] . '-' . $dataSplit[2]) {

                ?><div class="pedidostexto"><label>
                    <div class="tituloPedido">
                        <h2><?php print( $pf[0].' -- '.$linhapedidosAntigos['nomePedido'].' -- '); ?><span class="font_red"><?php print($pf[2] . '/' . $pf[3] );?></span></h2>
                    </div>
                <?php

                    //Verificando Numeração Feminina
                    if($linhapedidosAntigos['numF'] == 40){

                        $numeroFeminino = ' não tem';
                    }
                    else{
                        
                        $numeroFeminino = $linhapedidosAntigos['numF'];
                    }


                    //Se gravação externa e interna for NULL
                    if($linhapedidosAntigos['gravacaoInterna'] == NULL && $linhapedidosAntigos['gravacaoExterna'] == NULL){

                        print($linhapedidosAntigos['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $linhapedidosAntigos['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($linhapedidosAntigos['numeM']. "<br>"); ?></span>
                        </label></div><?php
                    }
                    elseif($linhapedidosAntigos['gravacaoExterna'] !== NULL && $linhapedidosAntigos['gravacaoInterna'] !== NULL){

                        print($linhapedidosAntigos['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $linhapedidosAntigos['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($linhapedidosAntigos['numeM']. "<br>"); ?></span>
                        <span class="font_blu"> <?php print('Gravação:');?></span><?php echo $linhapedidosAntigos['gravacaoInterna']. "<br>"?>
                        <span class="font_red"> <?php print('Gravação Externa:');?></span><?php echo $linhapedidosAntigos['gravacaoExterna'];?>
                        </label></div><?php
                    }
                    elseif($linhapedidosAntigos['gravacaoInterna'] !== NULL){

                        print($linhapedidosAntigos['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $linhapedidosAntigos['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($linhapedidosAntigos['numeM']. "<br>"); ?></span>
                        <span class="font_blu"> <?php print('Gravação:');?></span><?php echo $linhapedidosAntigos['gravacaoInterna'];?>
                        </label></div><?php
                    }
                    elseif($linhapedidosAntigos['gravacaoExterna'] !== NULL){

                        print($linhapedidosAntigos['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $linhapedidosAntigos['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($linhapedidosAntigos['numeM']. "<br>"); ?></span>
                        <span class="font_red"> <?php print('Gravação Externa:');?></span><?php echo $linhapedidosAntigos['gravacaoExterna'];?>
                        </label></div><?php
                }
            }
        }

        //PG -------------------------------------------------------------------
        while($linhapedidosAntigosPg = mysqli_fetch_assoc($pedidosAntigosDadosPg)){

            //Variaveis do Banco
            $pf = explode("-" , $linhapedidosAntigosPg['idpedidos']);

            if ($linhapedidosAntigosPg['idpedido'] !== $dataSplit[1] . '-' . $dataSplit[2]) {

                ?><div class="pedidostexto"><label>
                    <div class="tituloPedido">
                        <h2><?php print( $pf[0].' -- '.$linhapedidosAntigosPg['nomePedido'].' -- '); ?><span class="font_red"><?php print($pf[2] . '/' . $pf[3] );?></span></h2>
                    </div>
                <?php

                    //Verificando Numeração Feminina
                    if($linhapedidosAntigosPg['numF'] == 40){

                        $numeroFeminino = ' não tem';
                    }
                    else{
                        
                        $numeroFeminino = $linhapedidosAntigosPg['numF'];
                    }


                    //Se gravação externa e interna for NULL
                    if($linhapedidosAntigosPg['gravacaoInterna'] == NULL && $linhapedidosAntigosPg['gravacaoExterna'] == NULL){

                        print($linhapedidosAntigosPg['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $linhapedidosAntigosPg['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($linhapedidosAntigosPg['numeM']. "<br>"); ?></span>
                        </label></div><?php
                    }
                    elseif($linhapedidosAntigosPg['gravacaoExterna'] !== NULL && $linhapedidosAntigosPg['gravacaoInterna'] !== NULL){

                        print($linhapedidosAntigosPg['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $linhapedidosAntigosPg['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($linhapedidosAntigosPg['numeM']. "<br>"); ?></span>
                        <span class="font_blu"> <?php print('Gravação:');?></span><?php echo $linhapedidosAntigosPg['gravacaoInterna']. "<br>"?>
                        <span class="font_red"> <?php print('Gravação Externa:');?></span><?php echo $linhapedidosAntigosPg['gravacaoExterna'];?>
                        </label></div><?php
                    }
                    elseif($linhapedidosAntigosPg['gravacaoInterna'] !== NULL){

                        print($linhapedidosAntigosPg['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $linhapedidosAntigosPg['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($linhapedidosAntigosPg['numeM']. "<br>"); ?></span>
                        <span class="font_blu"> <?php print('Gravação:');?></span><?php echo $linhapedidosAntigosPg['gravacaoInterna'];?>
                        </label></div><?php
                    }
                    elseif($linhapedidosAntigosPg['gravacaoExterna'] !== NULL){

                        print($linhapedidosAntigosPg['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $linhapedidosAntigosPg['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($linhapedidosAntigosPg['numeM']. "<br>"); ?></span>
                        <span class="font_red"> <?php print('Gravação Externa:');?></span><?php echo $linhapedidosAntigosPg['gravacaoExterna'];?>
                        </label></div><?php
                }
            }
        }
        //PE -------------------------------------------------------------------
        while($linhapedidosAntigosPg = mysqli_fetch_assoc($pedidosAntigosDadosPe)){

            //Variaveis do Banco
            $pf = explode("-" , $linhapedidosAntigosPg['idpedidos']);

            if ($linhapedidosAntigosPg['idpedido'] !== $dataSplit[1] . '-' . $dataSplit[2]) {

                ?><div class="pedidostexto"><label>
                    <div class="tituloPedido">
                        <h2><?php print( $pf[0].' -- '.$linhapedidosAntigosPg['nomePedido'].' -- '); ?><span class="font_red"><?php print($pf[2] . '/' . $pf[3] );?></span></h2>
                    </div>
                <?php

                    //Verificando Numeração Feminina
                    if($linhapedidosAntigosPg['numF'] == 40){

                        $numeroFeminino = ' não tem';
                    }
                    else{
                        
                        $numeroFeminino = $linhapedidosAntigosPg['numF'];
                    }


                    //Se gravação externa e interna for NULL
                    if($linhapedidosAntigosPg['gravacaoInterna'] == NULL && $linhapedidosAntigosPg['gravacaoExterna'] == NULL){

                        print($linhapedidosAntigosPg['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $linhapedidosAntigosPg['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($linhapedidosAntigosPg['numeM']. "<br>"); ?></span>
                        </label></div><?php
                    }
                    elseif($linhapedidosAntigosPg['gravacaoExterna'] !== NULL && $linhapedidosAntigosPg['gravacaoInterna'] !== NULL){

                        print($linhapedidosAntigosPg['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $linhapedidosAntigosPg['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($linhapedidosAntigosPg['numeM']. "<br>"); ?></span>
                        <span class="font_blu"> <?php print('Gravação:');?></span><?php echo $linhapedidosAntigosPg['gravacaoInterna']. "<br>"?>
                        <span class="font_red"> <?php print('Gravação Externa:');?></span><?php echo $linhapedidosAntigosPg['gravacaoExterna'];?>
                        </label></div><?php
                    }
                    elseif($linhapedidosAntigosPg['gravacaoInterna'] !== NULL){

                        print($linhapedidosAntigosPg['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $linhapedidosAntigosPg['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($linhapedidosAntigosPg['numeM']. "<br>"); ?></span>
                        <span class="font_blu"> <?php print('Gravação:');?></span><?php echo $linhapedidosAntigosPg['gravacaoInterna'];?>
                        </label></div><?php
                    }
                    elseif($linhapedidosAntigosPg['gravacaoExterna'] !== NULL){

                        print($linhapedidosAntigosPg['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $linhapedidosAntigosPg['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($linhapedidosAntigosPg['numeM']. "<br>"); ?></span>
                        <span class="font_red"> <?php print('Gravação Externa:');?></span><?php echo $linhapedidosAntigosPg['gravacaoExterna'];?>
                        </label></div><?php
                }
            }
        }
    }
?>
<?php ///////////////////////////////-------------------PEDIDOS ANTIGOS IMAGEM----------------------////////////////////////////////////////////////////////////// ?>
<?php 
   function pedidosAntigosImagem($conectar,$dataSplit){
    

        //Variaveis para sincronizar com Banco de Dados
        $imagemPf = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem FROM pedidosp WHERE contadorpf != 0 ORDER BY contadorpf ASC";
        $imagemConectarPf = mysqli_query($conectar, $imagemPf);

        $imagemPg = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem FROM pedidospg WHERE contadorpg != 0 ORDER BY contadorpg ASC";
        $imagemConectarPg = mysqli_query($conectar, $imagemPg);

        $imagemPe = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem FROM pedidospe WHERE contadorpe != 0 ORDER BY contadorpe ASC";
        $imagemConectarPe = mysqli_query($conectar, $imagemPe);

        //PF-----------------------------------------------------------
        while ($dadosImagemPf = mysqli_fetch_assoc($imagemConectarPf)) {
                        
            if ($dadosImagemPf['idpedido'] !== $dataSplit[1] . '-' . $dataSplit[2]) {

                ?><div class="pedidosImagem"><?php
                ?><img class = "Imagem" src="<?php echo '../' .$dadosImagemPf['imagem'];?>" alt="Imagem do Pedido"><?php
                ?></div>
                <div class="btPedidos">
                <button class = 'Pdf' type="button">PDF</button>
                </div>
                <?php
            }
        } 
        //PG-----------------------------------------------------------
        while ($dadosImagemPg = mysqli_fetch_assoc($imagemConectarPg)) {
                        
            if ($dadosImagemPg['idpedido'] !== $dataSplit[1] . '-' . $dataSplit[2]) {

                ?><div class="pedidosImagem"><?php
                ?><img class = "Imagem" src="<?php echo '../' .$dadosImagemPg['imagem'];?>" alt="Imagem do Pedido"><?php
                ?></div>
                <div class="btPedidos">
                <button class = 'Pdf' type="button">PDF</button>
                </div>
                <?php
            }
        }
        while ($dadosImagemPe = mysqli_fetch_assoc($imagemConectarPe)) {
                        
            if ($dadosImagemPe['idpedido'] !== $dataSplit[1] . '-' . $dataSplit[2]) {

                ?><div class="pedidosImagem"><?php
                ?><img class = "Imagem" src="<?php echo '../' .$dadosImagemPe['imagem'];?>" alt="Imagem do Pedido"><?php
                ?></div>
                <div class="btPedidos">
                <button class = 'Pdf' type="button">PDF</button> 
                </div>
                <?php
            }
        }  
   } 