
<?php ////////////////////////////////////////////////////////////////////-- Pesquisa Do Dia --////////////////////////////////////////////////////////////////////////?>
<?php 
    function pesquisa($resultado,$conectar,$data,$dataSplit){
        if(isset($resultado) !== ''){

            $pesquisaDados = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, descricaoPedido, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido FROM pedidosp WHERE idpedidos != 'PF00-$data' AND idpedidos LIKE '%$resultado%' ORDER BY contadorpf ASC";
            $pesquisaVerificador = mysqli_query($conectar,$pesquisaDados);

            $pesquisaDadosPg = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, descricaoPedido, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido FROM pedidospg WHERE idpedidos != 'PG00-$data' AND idpedidos LIKE '%$resultado%' ORDER BY contadorpg ASC";
            $pesquisaVerificadorPg = mysqli_query($conectar,$pesquisaDadosPg);

            $pesquisaDadosPe = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, descricaoPedido, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido FROM pedidospe WHERE idpedidos != 'PE00-$data' AND idpedidos LIKE '%$resultado%' ORDER BY contadorpe ASC";
            $pesquisaVerificadorPe = mysqli_query($conectar,$pesquisaDadosPe);

            //PF
            while (($dados = mysqli_fetch_assoc($pesquisaVerificador))) {
        
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
            //PG
            while (($dadosPg = mysqli_fetch_assoc($pesquisaVerificadorPg))) {
        
                if ($dadosPg['idpedido'] == $dataSplit[1] . '-' . $dataSplit[2]) {
                    $pf = explode("-" , $dadosPg['idpedidos']);
    
                    ?><div class="pedidostexto"><label><?php
                    ?><div class="tituloPedido">
                        <h2><?php print( $pf[0].' -- '.$dadosPg['nomePedido'].' -- '); ?><span class="font_red"><?php print($dataSplit[2] . '/' . $dataSplit[1] );?></span></h2>
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
            //PE
            while (($dadosPe = mysqli_fetch_assoc($pesquisaVerificadorPe))) {
        
                if ($dadosPe['idpedido'] == $dataSplit[1] . '-' . $dataSplit[2]) {
                    $pf = explode("-" , $dadosPe['idpedidos']);
    
                    ?><div class="pedidostexto"><label><?php
                    ?><div class="tituloPedido">
                        <h2><?php print( $pf[0].' -- '.$dadosPe['nomePedido'].' -- '); ?><span class="font_red"><?php print($dataSplit[2] . '/' . $dataSplit[1] );?></span></h2>
                    </div>
                    <?php
                    //Verificando Numeração Feminina
                    if($dadosPe['numF'] == 40){
    
                        $numeroFeminino = ' não tem';
                    }
                    else{
                        
                        $numeroFeminino = $dadosPe['numF'];
                    }
    
    
                    //Se gravação externa e interna for NULL
                    if($dadosPe['gravacaoInterna'] == NULL && $dadosPe['gravacaoExterna'] == NULL){
    
                        print($dadosPe['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $dadosPe['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($dadosPe['numeM']. "<br>"); ?></span>
                        </label></div><?php
                    }
                    elseif($dadosPe['gravacaoExterna'] !== NULL && $dadosPe['gravacaoInterna'] !== NULL){
    
                        print($dadosPe['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $dadosPe['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($dadosPe['numeM']. "<br>"); ?></span>
                        <span class="font_blu"> <?php print('Gravação:');?></span><?php echo $dadosPe['gravacaoInterna']. "<br>"?>
                        <span class="font_red"> <?php print('Gravação Externa:');?></span><?php echo $dadosPe['gravacaoExterna'];?>
                        </label></div><?php
                    }
                    elseif($dadosPe['gravacaoInterna'] !== NULL){
    
                        print($dadosPe['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $dadosPe['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($dadosPe['numeM']. "<br>"); ?></span>
                        <span class="font_blu"> <?php print('Gravação:');?></span><?php echo $dadosPe['gravacaoInterna'];?>
                        </label></div><?php
                    }
                    elseif($dadosPe['gravacaoExterna'] !== NULL){
    
                        print($dadosPe['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $dadosPe['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($dadosPe['numeM']. "<br>"); ?></span>
                        <span class="font_red"> <?php print('Gravação Externa:');?></span><?php echo $dadosPe['gravacaoExterna'];?>
                        </label></div><?php
                    }  
                }
            }
        }
    }

?>
<?php ////////////////////////////////////////////////////////////////////-- Pesquisa Imagem Do Dia  --////////////////////////////////////////////////////////////////////////?>
<?php 
    function pesquisaImagem($resultado,$conectar,$data,$dataSplit){

        $imagem = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, descricaoPedido, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido, pdfp FROM pedidosp WHERE idpedidos != 'PF00-$data' AND idpedidos LIKE '%$resultado%' ORDER BY contadorpf ASC";
        $imagemConectar = mysqli_query($conectar, $imagem);

        $imagemPg = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, descricaoPedido, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido , pdfpg FROM pedidospg WHERE idpedidos != 'PG00-$data' AND idpedidos LIKE '%$resultado%' ORDER BY contadorpg ASC";
        $imagemConectarPg = mysqli_query($conectar, $imagemPg);

        $imagemPe = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, descricaoPedido, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido , pdfpe FROM pedidospe WHERE idpedidos != 'PE00-$data' AND idpedidos LIKE '%$resultado%' ORDER BY contadorpe ASC";
        $imagemConectarPe = mysqli_query($conectar, $imagemPe);


        while ($dadosImagem = mysqli_fetch_assoc($imagemConectar)) {
            
            if ($dadosImagem['idpedido'] == $dataSplit[1] . '-' . $dataSplit[2]) {

                ?><div class="pedidosImagem"><?php
                ?><img class = "Imagem" src="<?php echo '../' .$dadosImagem['imagem'];?>" alt="Imagem do Pedido"><?php
                ?></div>
                <div class="btPedidos">
                <button class = 'Pdf' type="button"><a class="PdfAncora" href="../<?php echo $dadosImagem['pdfp']?>">PDF</a></button>
                <button class = 'Pdf' type="button"><a class="PdfAncora" href="<?php echo './phpScripts/editarPedido.php?idpedidos=' . $dadosImagem['idpedidos'] ; ?>">Editar</a></button>
                </div>
                <?php
            }
        }
        while ($dadosImagemPg = mysqli_fetch_assoc($imagemConectarPg)) {
            
            if ($dadosImagemPg['idpedido'] == $dataSplit[1] . '-' . $dataSplit[2]) {

                ?><div class="pedidosImagem"><?php
                ?><img class = "Imagem" src="<?php echo '../' .$dadosImagemPg['imagem'];?>" alt="Imagem do Pedido"><?php
                ?></div>
                <div class="btPedidos">
                <button class = 'Pdf' type="button"><a class="PdfAncora" href="../<?php echo $dadosImagemPg['pdfpg']?>">PDF</a></button>
                <button class = 'Pdf' type="button"><a class="PdfAncora" href="<?php echo './phpScripts/editarPedido.php?idpedidos=' . $dadosImagemPg['idpedidos'] ; ?>">Editar</a></button>
                </div>
                <?php
            }
        }
        while ($dadosImagemPe = mysqli_fetch_assoc($imagemConectarPe)) {
            
            if ($dadosImagemPe['idpedido'] == $dataSplit[1] . '-' . $dataSplit[2]) {

                ?><div class="pedidosImagem"><?php
                ?><img class = "Imagem" src="<?php echo '../' .$dadosImagemPe['imagem'];?>" alt="Imagem do Pedido"><?php
                ?></div>
                <div class="btPedidos">
                <button class = 'Pdf' type="button"><a class="PdfAncora" href="../<?php echo $dadosImagemPe['pdfpe']?>">PDF</a></button>
                <button class = 'Pdf' type="button"><a class="PdfAncora" href="./phpScripts/editarPedido.php">Editar</a></button>
                </div>
                <?php
            }
        }
    }
?>
