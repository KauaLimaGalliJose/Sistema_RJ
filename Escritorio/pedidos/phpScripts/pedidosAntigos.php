
<?php ////////////////////////////////////////////////////////////////////-- Pesquisa PEDIDOS ANTIGOS --////////////////////////////////////////////////////////////////////////?>
<?php
   function pesquisaPedidosAntigos($resultado,$conectar){

        date_default_timezone_set('America/Sao_Paulo'); // Fuso horário de Brasília
        $data = date('Y-m-d');
        $dataSplit = explode("-", $data);
        $dataOntem = (int)$dataSplit[2] - 1;


        if(isset($resultado) !== ''){

            $pesquisaDados = "SELECT RIGHT(idpedidos,2) AS idpedido, imagem, descricaoPedido, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido FROM pedidosp WHERE contadorpf != 0 AND idpedidos LIKE '%$resultado%' ORDER BY contadorpf ASC";
            $pesquisaVerificador = mysqli_query($conectar,$pesquisaDados);

            $pesquisaDadosPg = "SELECT RIGHT(idpedidos,2) AS idpedido, imagem, descricaoPedido, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido FROM pedidospg WHERE contadorpg != 0  AND idpedidos LIKE '%$resultado%' ORDER BY contadorpg ASC";
            $pesquisaVerificadorPg = mysqli_query($conectar,$pesquisaDadosPg);

            $pesquisaDadosPe = "SELECT RIGHT(idpedidos,2) AS idpedido, imagem, descricaoPedido, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido FROM pedidospe WHERE contadorpe != 0  AND idpedidos LIKE '%$resultado%' ORDER BY contadorpe ASC";
            $pesquisaVerificadorPe = mysqli_query($conectar,$pesquisaDadosPe);

            //PF ------------------------------------------------------------------------------------------------------------------------------------------------------
            while (($dados = mysqli_fetch_assoc($pesquisaVerificador))) {
        
                if ($dados['idpedido'] <= $dataOntem) {
                    $pf = explode("-" , $dados['idpedidos']);
    
                    ?><div class="pedidostexto"><label><?php
                    ?><div class="tituloPedido">
                        <h2><?php print( $pf[0].' -- '.$dados['nomePedido'].' -- '); ?><span class="font_red"><?php print($pf[3] . '/' . $pf[2] );?></span></h2>
                    </div>
                    <?php
                    //Verificando Numeração Feminina
                    if($dados['numF'] == 40){

                        $numeroFeminino = ' não tem';
                    }
                    else{
                        
                        $numeroFeminino = $dados['numF'];
                    }
    
                    // gravação interna 
                    if(!empty($dados['gravacaoInterna'])){
                        $gravacaoInterna = '<span class="font_blu">Gravação:</span>' . $dados['gravacaoInterna'];
                    }
                    else{
                        $gravacaoInterna = '';
                    }
                    
                    //gravação externa
                    if(!empty($dados['gravacaoExterna'])){
                        $gravacaoExterna = '<span class="font_blue">Gravação:</span>' . $dados['gravacaoExterna'];
                    }
                    else{
                        $gravacaoExterna = '';
                    }
    
                        print($dados['descricaoPedido'] . "<br>");
                        print('<br>Largura:' . $dados['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($dados['numeM']. "<br>"); ?></span>
                        <?php echo $gravacaoInterna . "<br>"?>
                        <?php echo $gravacaoExterna?>
                        </label></div><?php
                }
            }
            //PG ------------------------------------------------------------------------------------------------------------------------------------------------------
            while (($dadosPg = mysqli_fetch_assoc($pesquisaVerificadorPg))) {
        
                if ($dadosPg['idpedido'] <= $dataOntem) {
                    $pg = explode("-" , $dadosPg['idpedidos']);
    
                    ?><div class="pedidostexto"><label><?php
                    ?><div class="tituloPedido">
                        <h2><?php print( $pg[0].' -- '.$dadosPg['nomePedido'].' -- '); ?><span class="font_red"><?php print($pg[3] . '/' . $pg[2]);?></span></h2>
                    </div>
                    <?php
                   //Verificando Numeração Feminina
                   if($dadosPg['numF'] == 40){

                    $numeroFeminino = ' não tem';
                    }
                    else{

                    $numeroFeminino = $dadosPg['numF'];
                    }
                    // gravação interna 
                    if(!empty($dadosPg['gravacaoInterna'])){
                        $gravacaoInterna = '<span class="font_blu">Gravação:</span>' . $dadosPg['gravacaoInterna'];
                    }
                    else{
                        $gravacaoInterna = '';
                    }
                        
                    //gravação externa
                    if(!empty($dadosPg['gravacaoExterna'])){
                        $gravacaoExterna = '<span class="font_blue">Gravação:</span>' . $dadosPg['gravacaoExterna'];
                    }
                    else{
                        $gravacaoExterna = '';
                    }

                    print($dadosPg['descricaoPedido'] . "<br>");
                    print('<br>Largura:' . $dadosPg['largura']);
                    print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                    <?php print('Masculina:');?><span class="font_red"><?php print($dadosPg['numeM']. "<br>"); ?></span>
                    <?php echo $gravacaoInterna . "<br>"?>
                    <?php echo $gravacaoExterna?>
                    </label></div><?php
                }
            }
            //PE ------------------------------------------------------------------------------------------------------------------------------------------------------
            while (($dadosPe = mysqli_fetch_assoc($pesquisaVerificadorPe))) {
        
                if ($dadosPe['idpedido'] <= $dataOntem) {
                    $pe = explode("-" , $dadosPe['idpedidos']);
    
                    ?><div class="pedidostexto"><label><?php
                    ?><div class="tituloPedido">
                        <h2><?php print( $pe[0].' -- '.$dadosPe['nomePedido'].' -- '); ?><span class="font_red"><?php print($pe[3] . '/' . $pe[2] );?></span></h2>
                    </div>
                    <?php
                    //Verificando Numeração Feminina
                    if($dadosPe['numF'] == 40){

                        $numeroFeminino = ' não tem';
                    }
                    else{

                        $numeroFeminino = $dadosPe['numF'];
                    }
                    // gravação interna 
                    if(!empty($dadosPe['gravacaoInterna'])){
                        $gravacaoInterna = '<span class="font_blu">Gravação:</span>' . $dadosPe['gravacaoInterna'];
                    }
                    else{
                        $gravacaoInterna = '';
                    }
                        
                    //gravação externa
                    if(!empty($dadosPe['gravacaoExterna'])){
                        $gravacaoExterna = '<span class="font_blue">Gravação:</span>' . $dadosPe['gravacaoExterna'];
                    }
                    else{
                        $gravacaoExterna = '';
                    }

                    print($dadosPe['descricaoPedido'] . "<br>");
                    print('<br>Largura:' . $dadosPe['largura']);
                    print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino. "<br>"); ?></span>
                    <?php print('Masculina:');?><span class="font_red"><?php print($dadosPe['numeM']. "<br>"); ?></span>
                    <?php echo $gravacaoInterna . "<br>"?>
                    <?php echo $gravacaoExterna?>
                    </label></div><?php 
                }
            }
        }
    }
?>
<?php ////////////////////////////////////////////////////////////////////-- Pesquisa PEDIDOS ANTIGOS IMAGEM --////////////////////////////////////////////////////////////////////////?>
<?php 
    function pesquisaPedidosAntigosImagem($resultado,$conectar) {

        date_default_timezone_set('America/Sao_Paulo'); // Fuso horário de Brasília
        $data = date('Y-m-d');
        $dataSplit = explode("-", $data);
        $dataOntem = (int)$dataSplit[2] - 1;


        $imagem = "SELECT RIGHT(idpedidos,2) AS idpedido, imagem, pdfp FROM pedidosp WHERE contadorpf != 0 AND idpedidos LIKE '%$resultado%' ORDER BY contadorpf ASC";
        $imagemConectar = mysqli_query($conectar, $imagem);

        $imagemPg = "SELECT RIGHT(idpedidos,2) AS idpedido, imagem, pdfpg FROM pedidospg WHERE  contadorpg != 0 AND  idpedidos LIKE '%$resultado%' ORDER BY contadorpg ASC";
        $imagemConectarPg = mysqli_query($conectar, $imagemPg);

        $imagemPe = "SELECT RIGHT(idpedidos,2) AS idpedido, imagem, pdfpe FROM pedidospe WHERE contadorpe != 0 AND idpedidos LIKE '%$resultado%' ORDER BY contadorpe ASC";
        $imagemConectarPe = mysqli_query($conectar, $imagemPe);

        if(isset($resultado) !== ''){
        

        while ($dadosImagem = mysqli_fetch_assoc($imagemConectar)) {
            
            if ((int)$dadosImagem['idpedido'] <= $dataOntem) {

                ?><div class="pedidosImagem"><?php
                ?><img class = "Imagem" src="<?php echo '../' .$dadosImagem['imagem'];?>" alt="Imagem do Pedido"><?php
                ?></div>
                <div class="btPedidos">
                <button class = 'Pdf' type="button"><a class="PdfAncora" href="../<?php echo $dadosImagem['pdfp']?>">PDF</a></button>
                </div>
                <?php
            }
        }
        while ($dadosImagemPg = mysqli_fetch_assoc($imagemConectarPg)) {
            
            if ((int)$dadosImagemPg['idpedido'] <= $dataOntem) {

                ?><div class="pedidosImagem"><?php
                ?><img class = "Imagem" src="<?php echo '../' .$dadosImagemPg['imagem'];?>" alt="Imagem do Pedido"><?php
                ?></div>
                <div class="btPedidos">
                <button class = 'Pdf' type="button"><a class="PdfAncora" href="../<?php echo $dadosImagemPg['pdfpg']?>">PDF</a></button>
                </div>
                <?php
            }
        }
        while ($dadosImagemPe = mysqli_fetch_assoc($imagemConectarPe)) {
            
            if ((int)$dadosImagemPe['idpedido'] <= $dataOntem) {

                ?><div class="pedidosImagem"><?php
                ?><img class = "Imagem" src="<?php echo '../' .$dadosImagemPe['imagem'];?>" alt="Imagem do Pedido"><?php
                ?></div>
                <div class="btPedidos">
                <button class = 'Pdf' type="button"><a class="PdfAncora" href="../<?php echo $dadosImagemPe['pdfpe']?>">PDF</a></button>
                </div>
                <?php
            }
        }
    }
}
?>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>

<?php ///////////////////////////////-------------------PEDIDOS ANTIGOS----------------------////////////////////////////////////////////////////////////// ?>
<?php
    function pedidosAntigos($conectar,$dataSplit,$resultado){
        
        if($resultado !== ''){
            pesquisaPedidosAntigos($resultado,$conectar);
        }
        else{
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
                            <h2><?php print( $pf[0].' -- '.$linhapedidosAntigos['nomePedido'].' -- '); ?><span class="font_red"><?php print($pf[3] . '/' . $pf[2] );?></span></h2>
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
                $pg = explode("-" , $linhapedidosAntigosPg['idpedidos']);

                if ($linhapedidosAntigosPg['idpedido'] !== $dataSplit[1] . '-' . $dataSplit[2]) {

                    ?><div class="pedidostexto"><label>
                        <div class="tituloPedido">
                            <h2><?php print( $pg[0].' -- '.$linhapedidosAntigosPg['nomePedido'].' -- '); ?><span class="font_red"><?php print($pg[3] . '/' . $pg[2] );?></span></h2>
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
                $pe = explode("-" , $linhapedidosAntigosPg['idpedidos']);

                if ($linhapedidosAntigosPg['idpedido'] !== $dataSplit[1] . '-' . $dataSplit[2]) {

                    ?><div class="pedidostexto"><label>
                        <div class="tituloPedido">
                            <h2><?php print( $pe[0].' -- '.$linhapedidosAntigosPg['nomePedido'].' -- '); ?><span class="font_red"><?php print($pe[3] . '/' . $pe[2] );?></span></h2>
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
    }
?>
<?php ///////////////////////////////-------------------PEDIDOS ANTIGOS IMAGEM----------------------////////////////////////////////////////////////////////////// ?>
<?php 
   function pedidosAntigosImagem($conectar,$dataSplit,$resultado){


    if($resultado !== ''){        
        pesquisaPedidosAntigosImagem($resultado,$conectar);

    }
    else{
        //Variaveis para sincronizar com Banco de Dados
        $imagemPf = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, pdfp FROM pedidosp WHERE contadorpf != 0 ORDER BY contadorpf ASC";
        $imagemConectarPf = mysqli_query($conectar, $imagemPf);

        $imagemPg = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, pdfpg FROM pedidospg WHERE contadorpg != 0 ORDER BY contadorpg ASC";
        $imagemConectarPg = mysqli_query($conectar, $imagemPg);

        $imagemPe = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, pdfpe FROM pedidospe WHERE contadorpe != 0 ORDER BY contadorpe ASC";
        $imagemConectarPe = mysqli_query($conectar, $imagemPe);

        //PF-----------------------------------------------------------
        while ($dadosImagemPf = mysqli_fetch_assoc($imagemConectarPf)) {
                        
            if ($dadosImagemPf['idpedido'] !== $dataSplit[1] . '-' . $dataSplit[2]) {

                ?><div class="pedidosImagem"><?php
                ?><img class = "Imagem" src="<?php echo '../' .$dadosImagemPf['imagem'];?>" alt="Imagem do Pedido"><?php
                ?></div>
                <div class="btPedidos">
                <button class = 'Pdf' type="button"><a class="PdfAncora" href="../<?php echo $dadosImagemPf['pdfp']?>">PDF</a></button>
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
                <button class = 'Pdf' type="button"><a class="PdfAncora" href="../<?php echo $dadosImagemPg['pdfpg']?>">PDF</a></button>
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
                <button class = 'Pdf' type="button"><a class="PdfAncora" href="../<?php echo $dadosImagemPe['pdfpe']?>">PDF</a></button> 
                </div>
                <?php
            }
        }  
   }
}
 ?>
