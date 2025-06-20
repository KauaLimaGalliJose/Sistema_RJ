
<?php ////////////////////////////////////////////////////////////////////-- Pesquisa PEDIDOS DATAS --////////////////////////////////////////////////////////////////////////?>
<?php
   function pesquisaPedidosData($resultado,$conectar,$dataDigitada){

        date_default_timezone_set('America/Sao_Paulo'); // Fuso horário de Brasília

            $pesquisaDados = 
            "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido , descricaoAlianca, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido
            FROM pedidosp 
            WHERE contadorpf <> 0 
            AND nomePedido LIKE '%$resultado%'
            AND data_digitada LIKE '$dataDigitada'
 
            OR idpedidos LIKE '%$resultado%'
            AND data_digitada LIKE '$dataDigitada'

            ORDER BY contadorpf ASC";
            
            $pesquisaVerificador = mysqli_query($conectar,$pesquisaDados);

            $pesquisaDadosPg = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido, descricaoAlianca, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido
            FROM pedidospg 
            WHERE contadorpg <> 0 
            AND nomePedido LIKE '%$resultado%'
            AND data_digitada LIKE '$dataDigitada'
 
            OR idpedidos LIKE '%$resultado%'
            AND data_digitada LIKE '$dataDigitada'

            ORDER BY contadorpg ASC";

            $pesquisaVerificadorPg = mysqli_query($conectar,$pesquisaDadosPg);

            $pesquisaDadosPe = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido, descricaoAlianca, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido
            FROM pedidospe
            WHERE contadorpe <> 0 
            AND nomePedido LIKE '%$resultado%'
            AND data_digitada LIKE '$dataDigitada'
 
            OR idpedidos LIKE '%$resultado%'
            AND data_digitada LIKE '$dataDigitada'

            ORDER BY contadorpe ASC";
            $pesquisaVerificadorPe = mysqli_query($conectar,$pesquisaDadosPe);

            //PF ------------------------------------------------------------------------------------------------------------------------------------------------------
            while (($dados = mysqli_fetch_assoc($pesquisaVerificador))) {
        
                    $pf = explode("-" , $dados['idpedidos']);
    
                    ?><div class="pedidostexto"><label><?php
                    ?><div class="tituloPedido">
                        <h2><?php print( $pf[0].' -- '.$dados['nomePedido'].' -- '); ?><span class="font_red"><?php print($pf[3] . '/' . $pf[2] );?></span></h2>
                    </div>
                    <?php
                    //Variaveis Null
                    $estoqueF = null;
                    $estoqueM = null;
                    $PedraF = null;
                    $PedraM = null;

                    //Verificando Numeração Feminina
                    if($dados['numF'] == 40){

                        $numeroFeminino = ' não tem';
                    }
                    else{
                        
                        $numeroFeminino = $dados['numF'];
                    }
    
                    // gravação interna 
                    if(!empty($dados['gravacaoInterna'])){

                    $gravacao = $dados['gravacaoInterna'];

                    if (strpos($gravacao, ',') !== false) {
                        $gravacaoSplit = explode(',', $gravacao);

                        $gravacaoInterna = '<div class="informacaoInferior"><span class="font_blu">Gravação --------</span><br>';

                        foreach ($gravacaoSplit as $item) {
                            $gravacaoInterna .= trim($item) . '<br>'; // trim remove espaços desnecessários
                        }

                        $gravacaoInterna .= '</div>';
                    } else {
                        $gravacaoInterna = '<div class="informacaoInferior"><span class="font_blu">Gravação --------</span><br>' . $gravacao . '</div>';
                    }
                    }
                    else{
                        $gravacaoInterna = '';
                    }
                    
                    //gravação externa
                    if(!empty($dados['descricaoAlianca'])){
                        $gravacaoExterna = '<span class="font_blue">Descrição:</span>' . $dados['descricaoAlianca'];
                    }
                    else{
                        $gravacaoExterna = '';
                    }

                    //Verificando Estoque 
                    if(!empty($dados['parEstoqueF'])){

                        $estoqueF = '<span class="font_estoque"> Estoque</span>' ;
                    }
                    if(!empty($dados['parEstoqueM'])){

                        $estoqueM = '<span class="font_estoque"> Estoque</span>' ;
                    }

                    //Verificando Pedra 
                    if($dados['PedraF'] == true){

                        $PedraF = '&#128142;' ;
                    }
                    if( $dados['PedraM'] == true){

                        $PedraM = '&#128142;' ;
                    }

                    print($dados['descricaoPedido'] . "<br>");

                    ?><div class="informacaoPedido"><?php
                        ?><div class="informacaoSuperior"><?php
                            print('<br>Largura:' . $dados['largura']);
                            print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino . $estoqueF . $PedraF . "<br>"); ?></span>
                            <?php print('Masculina:');?><span class="font_red"><?php print($dados['numeM'] . $estoqueM . $PedraM . "<br>"); ?></span>
                        </div>
                            <?php echo $gravacaoInterna . "<br>"?>
                    </div>
                    <?php echo $gravacaoExterna?>
                    </label></div><?php
                }
    
            //PG ------------------------------------------------------------------------------------------------------------------------------------------------------
            while (($dadosPg = mysqli_fetch_assoc($pesquisaVerificadorPg))) {
        
                
                    $pg = explode("-" , $dadosPg['idpedidos']);
    
                    ?><div class="pedidostexto"><label><?php
                    ?><div class="tituloPedido">
                        <h2><?php print( $pg[0].' -- '.$dadosPg['nomePedido'].' -- '); ?><span class="font_red"><?php print($pg[3] . '/' . $pg[2]);?></span></h2>
                    </div>
                    <?php
                        //Variaveis Null
                        $estoqueF = null;
                        $estoqueM = null;
                        $PedraF = null;
                        $PedraM = null;

                  //Verificando Numeração Feminina
                if($dadosPg['numF'] == 40){

                    $numeroFeminino = ' não tem';
                }
                else{

                    $numeroFeminino = $dadosPg['numF'];
                }
                // gravação interna 
                if(!empty($dadosPg['gravacaoInterna'])){

                    $gravacao = $dadosPg['gravacaoInterna'];

                    if (strpos($gravacao, ',') !== false) {
                        $gravacaoSplit = explode(',', $gravacao);

                        $gravacaoInterna = '<div class="informacaoInferior"><span class="font_blu">Gravação --------</span><br>';

                        foreach ($gravacaoSplit as $item) {
                            $gravacaoInterna .= trim($item) . '<br>'; // trim remove espaços desnecessários
                        }

                        $gravacaoInterna .= '</div>';
                    } 
                    else {
                            $gravacaoInterna = '<div class="informacaoInferior"><span class="font_blu">Gravação --------</span><br>' . $gravacao . '</div>';
                    }
                }
                else{
                    $gravacaoInterna = '';
                }
                    
                //gravação externa
                if(!empty($dadosPg['descricaoAlianca'])){
                    $gravacaoExterna = '<span class="font_blue">Descrição:</span>' . $dadosPg['descricaoAlianca'];
                }
                else{
                    $gravacaoExterna = '';
                }

                //Verificando Estoque 
                if(!empty($dadosPg['parEstoqueF'])){

                    $estoqueF = '<span class="font_estoque"> Estoque</span>' ;
                }
                if(!empty($dadosPg['parEstoqueM'])){

                    $estoqueM = '<span class="font_estoque"> Estoque</span>' ;
                }

                //Verificando Pedra 
                if($dadosPg['PedraF'] == true){

                    $PedraF = '&#128142;' ;
                }
                if( $dadosPg['PedraM'] == true){

                    $PedraM = '&#128142;' ;
                }

                print($dadosPg['descricaoPedido'] . "<br>");

                ?><div class="informacaoPedido"><?php
                    ?><div class="informacaoSuperior"><?php
                        print('<br>Largura:' . $dadosPg['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino . $estoqueF . $PedraF . "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($dadosPg['numeM'] . $estoqueM . $PedraM . "<br>"); ?></span>
                    </div>
                        <?php echo $gravacaoInterna . "<br>"?>
                </div>
                <?php echo $gravacaoExterna?>
                   </label></div><?php   
            }
            //PE ------------------------------------------------------------------------------------------------------------------------------------------------------
            while (($dadosPe = mysqli_fetch_assoc($pesquisaVerificadorPe))) {
        
                    $pe = explode("-" , $dadosPe['idpedidos']);
    
                    ?><div class="pedidostexto"><label><?php
                    ?><div class="tituloPedido">
                        <h2><?php print( $pe[0].' -- '.$dadosPe['nomePedido'].' -- '); ?><span class="font_red"><?php print($pe[3] . '/' . $pe[2] );?></span></h2>
                    </div>
                    <?php
                        //Variaveis Null
                        $estoqueF = null;
                        $estoqueM = null;
                        $PedraF = null;
                        $PedraM = null;

                       //Verificando Numeração Feminina
                    if($dadosPe['numF'] == 40){

                        $numeroFeminino = ' não tem';
                    }
                    else{

                        $numeroFeminino = $dadosPe['numF'];
                    }
                    // gravação interna 
                    if(!empty($dadosPe['gravacaoInterna'])){

                        $gravacao = $dadosPe['gravacaoInterna'];

                        if (strpos($gravacao, ',') !== false) {
                            $gravacaoSplit = explode(',', $gravacao);

                            $gravacaoInterna = '<div class="informacaoInferior"><span class="font_blu">Gravação --------</span><br>';

                            foreach ($gravacaoSplit as $item) {
                                $gravacaoInterna .= trim($item) . '<br>'; // trim remove espaços desnecessários
                            }

                            $gravacaoInterna .= '</div>';
                        } 
                        else {
                                $gravacaoInterna = '<div class="informacaoInferior"><span class="font_blu">Gravação --------</span><br>' . $gravacao . '</div>';
                        }
                    }
                    else{
                        $gravacaoInterna = '';
                    } 
                    //gravação externa
                    if(!empty($dadosPe['descricaoAlianca'])){
                        $gravacaoExterna = '<span class="font_blue">Descrição:</span>' . $dadosPe['descricaoAlianca'];
                    }
                    else{
                        $gravacaoExterna = '';
                    }

                    //Verificando Estoque 
                    if(!empty($dadosPe['parEstoqueF'])){

                        $estoqueF = '<span class="font_estoque"> Estoque</span>' ;
                    }
                    if(!empty($dadosPe['parEstoqueM'])){

                        $estoqueM = '<span class="font_estoque"> Estoque</span>' ;
                    }

                    //Verificando Pedra 
                    if($dadosPe['PedraF'] == true){

                        $PedraF = '&#128142;' ;
                    }
                    if($dadosPe['PedraM'] == true){
                    
                        $PedraM = '&#128142;' ;
                    }

                print($dadosPe['descricaoPedido'] . "<br>");

                ?><div class="informacaoPedido"><?php
                    ?><div class="informacaoSuperior"><?php
                        print('<br>Largura:' . $dadosPe['largura']);
                        print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino . $estoqueF . $PedraF . "<br>"); ?></span>
                        <?php print('Masculina:');?><span class="font_red"><?php print($dadosPe['numeM'] . $estoqueM . $PedraM . "<br>"); ?></span>
                    </div>
                        <?php echo $gravacaoInterna . "<br>"?>
                </div>
                <?php echo $gravacaoExterna?>
                   </label></div><?php  
            }
        }
?>
<?php ////////////////////////////////////////////////////////////////////-- Pesquisa PEDIDOS DATA IMAGEM --////////////////////////////////////////////////////////////////////////?>
<?php 
    function pesquisaPedidosDataImagem($resultado,$conectar,$dataDigitada) {

        date_default_timezone_set('America/Sao_Paulo'); // Fuso horário de Brasília
        $data = date('Y-m-d');
 
        $imagem = "SELECT RIGHT(idpedidos,2) AS idpedido,idpedidos, imagem, pdf 
        FROM pedidosp
        WHERE contadorpf <> 0 
        AND nomePedido LIKE '%$resultado%'
        AND data_digitada LIKE '$dataDigitada'
 
        OR idpedidos LIKE '%$resultado%'
        AND data_digitada LIKE '$dataDigitada'

        ORDER BY contadorpf ASC";
        $imagemConectar = mysqli_query($conectar, $imagem);

        $imagemPg = "SELECT RIGHT(idpedidos,2) AS idpedido,idpedidos, imagem, pdf 

        FROM pedidospg 
        WHERE contadorpg <> 0 
        AND nomePedido LIKE '%$resultado%'
        AND data_digitada LIKE '$dataDigitada'
 
        OR idpedidos LIKE '%$resultado%'
        AND data_digitada LIKE '$dataDigitada'

        ORDER BY contadorpg ASC";
        $imagemConectarPg = mysqli_query($conectar, $imagemPg);

        $imagemPe = "SELECT RIGHT(idpedidos,2) AS idpedido,idpedidos, imagem, pdf 

        FROM pedidospe 
        WHERE contadorpe <> 0 
        AND nomePedido LIKE '%$resultado%'
        AND data_digitada LIKE '$dataDigitada'
 
        OR idpedidos LIKE '%$resultado%'
        AND data_digitada LIKE '$dataDigitada'

        ORDER BY contadorpe ASC";
        $imagemConectarPe = mysqli_query($conectar, $imagemPe);

        
        while ($dadosImagem = mysqli_fetch_assoc($imagemConectar)) {
            

                ?><div class="pedidosImagem"><?php
                ?><img class = "Imagem" src="<?php echo '../' .$dadosImagem['imagem'];?>" alt="Imagem do Pedido"><?php
                ?></div>
                <div class="btPedidos">
                    <button class = 'Pdf' type="button"><a class="PdfAncora" href="../<?php echo $dadosImagem['pdf']?>">PDF</a></button>
                    <button class = 'Pdf' id="editar" type="button"><a class="PdfAncora" target="_blank" href="<?php echo './phpScripts/editarPedido.php?idpedidos=' . $dadosImagem['idpedidos'] ; ?>">Editar</a></button>
                </div>
                <?php
            
        }
        while ($dadosImagemPg = mysqli_fetch_assoc($imagemConectarPg)) {
            

                ?><div class="pedidosImagem"><?php
                ?><img class = "Imagem" src="<?php echo '../' .$dadosImagemPg['imagem'];?>" alt="Imagem do Pedido"><?php
                ?></div>
                <div class="btPedidos">
                    <button class = 'Pdf' type="button"><a class="PdfAncora" href="../<?php echo $dadosImagemPg['pdf']?>">PDF</a></button>
                    <button class = 'Pdf' id="editar" type="button"><a class="PdfAncora" target="_blank" href="<?php echo './phpScripts/editarPedido.php?idpedidos=' . $dadosImagemPg['idpedidos'] ; ?>">Editar</a></button>
                </div>
                <?php
            
        }
        while ($dadosImagemPe = mysqli_fetch_assoc($imagemConectarPe)) {
           

                ?><div class="pedidosImagem"><?php
                ?><img class = "Imagem" src="<?php echo '../' .$dadosImagemPe['imagem'];?>" alt="Imagem do Pedido"><?php
                ?></div>
                <div class="btPedidos">
                    <button class = 'Pdf' type="button"><a class="PdfAncora" href="../<?php echo $dadosImagemPe['pdf']?>">PDF</a></button>
                    <button class = 'Pdf' id="editar" type="button"><a class="PdfAncora" target="_blank" href="<?php echo './phpScripts/editarPedido.php?idpedidos=' . $dadosImagemPe['idpedidos'] ; ?>">Editar</a></button>
                </div>
                <?php
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

<?php ///////////////////////////////-------------------PEDIDOS DATAS----------------------////////////////////////////////////////////////////////////// ?>
<?php
    function pedidosData($conectar,$resultado,$pesquisa){

            if($pesquisa !== ''){
                pesquisaPedidosData($pesquisa,$conectar,$resultado);
            }
            else{
                // VAriaveis para se concetar com Banco de Dados
                //PF
                $pedidosAntigosPf = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido , descricaoAlianca, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido FROM pedidosp WHERE contadorpf <> 0 AND data_digitada = '$resultado' ORDER BY contadorpf ASC";
                $pedidosAntigosDadosPf = mysqli_query($conectar, $pedidosAntigosPf);

                //PG
                $pedidosAntigosPg = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido , descricaoAlianca, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido FROM pedidospg WHERE contadorpg <> 0 AND data_digitada = '$resultado' ORDER BY contadorpg ASC";
                $pedidosAntigosDadosPg = mysqli_query($conectar, $pedidosAntigosPg);

                //PE
                $pedidosAntigosPe = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido , descricaoAlianca, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido FROM pedidospe WHERE contadorpe <> 0 AND data_digitada = '$resultado' ORDER BY contadorpe ASC";
                $pedidosAntigosDadosPe = mysqli_query($conectar, $pedidosAntigosPe);

                //PF -------------------------------------------------------------------
                while($linhapedidosAntigos = mysqli_fetch_assoc($pedidosAntigosDadosPf)){

                    //Variaveis do Banco
                    $pf = explode("-" , $linhapedidosAntigos['idpedidos']);


                        ?><div class="pedidostexto"><label>
                            <div class="tituloPedido">
                                <h2><?php print( $pf[0].' -- '.$linhapedidosAntigos['nomePedido'].' -- '); ?><span class="font_red"><?php print($pf[3] . '/' . $pf[2] );?></span></h2>
                            </div>
                        <?php

                        //Variaveis Null
                        $estoqueF = null;
                        $estoqueM = null;
                        $PedraF = null;
                        $PedraM = null;

                        //Verificando Numeração Feminina
                            if($linhapedidosAntigos['numF'] == 40){

                                $numeroFeminino = ' não tem';
                            }
                            else{

                                $numeroFeminino = $linhapedidosAntigos['numF'];
                            }
                            // gravação interna 
                            if(!empty($linhapedidosAntigos['gravacaoInterna'])){

                                $gravacao = $linhapedidosAntigos['gravacaoInterna'];

                                if (strpos($gravacao, ',') !== false) {
                                    $gravacaoSplit = explode(',', $gravacao);

                                    $gravacaoInterna = '<div class="informacaoInferior"><span class="font_blu">Gravação --------</span><br>';

                                    foreach ($gravacaoSplit as $item) {
                                        $gravacaoInterna .= trim($item) . '<br>'; // trim remove espaços desnecessários
                                    }

                                    $gravacaoInterna .= '</div>';
                                } 
                                else {
                                        $gravacaoInterna = '<div class="informacaoInferior"><span class="font_blu">Gravação --------</span><br>' . $gravacao . '</div>';
                                }
                            }
                            else{
                                $gravacaoInterna = '';
                            } 
                                
                            //gravação externa
                            if(!empty($linhapedidosAntigos['descricaoAlianca'])){
                                $gravacaoExterna = '<span class="font_blue">Descrição:</span>' . $linhapedidosAntigos['descricaoAlianca'];
                            }
                            else{
                                $gravacaoExterna = '';
                            }

                            //Verificando Estoque 
                            if(!empty($linhapedidosAntigos['parEstoqueF'])){

                                $estoqueF = '<span class="font_estoque"> Estoque</span>' ;
                            }
                            if(!empty($linhapedidosAntigos['parEstoqueM'])){

                                $estoqueM = '<span class="font_estoque"> Estoque</span>' ;
                            }

                            //Verificando Pedra 
                            if($linhapedidosAntigos['PedraF'] == true){

                                $PedraF = '&#128142;' ;
                            }
                            if($linhapedidosAntigos['PedraM'] == true){

                                $PedraM = '&#128142;' ;
                            }

                        print($linhapedidosAntigos['descricaoPedido'] . "<br>");

                        ?><div class="informacaoPedido"><?php
                            ?><div class="informacaoSuperior"><?php
                                print('<br>Largura:' . $linhapedidosAntigos['largura']);
                                print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino . $estoqueF . $PedraF . "<br>"); ?></span>
                                <?php print('Masculina:');?><span class="font_red"><?php print($linhapedidosAntigos['numeM'] . $estoqueM . $PedraM . "<br>"); ?></span>
                            </div>
                                <?php echo $gravacaoInterna . "<br>"?>
                        </div>
                        <?php echo $gravacaoExterna?>
                        </label></div><?php
                }
                //PG -------------------------------------------------------------------
                while($linhapedidosAntigosPg = mysqli_fetch_assoc($pedidosAntigosDadosPg)){

                    //Variaveis do Banco
                    $pg = explode("-" , $linhapedidosAntigosPg['idpedidos']);


                        ?><div class="pedidostexto"><label>
                            <div class="tituloPedido">
                                <h2><?php print( $pg[0].' -- '.$linhapedidosAntigosPg['nomePedido'].' -- '); ?><span class="font_red"><?php print($pg[3] . '/' . $pg[2] );?></span></h2>
                            </div>
                        <?php
                             //Variaveis Null
                                $estoqueF = null;
                                $estoqueM = null;
                                $PedraF = null;
                                $PedraM = null;

                        //Verificando Numeração Feminina
                            if($linhapedidosAntigosPg['numF'] == 40){

                                $numeroFeminino = ' não tem';
                            }
                            else{

                                $numeroFeminino = $linhapedidosAntigosPg['numF'];
                            }
                            // gravação interna 
                            if(!empty($linhapedidosAntigosPg['gravacaoInterna'])){

                                $gravacao = $linhapedidosAntigosPg['gravacaoInterna'];

                                if (strpos($gravacao, ',') !== false) {
                                    $gravacaoSplit = explode(',', $gravacao);

                                    $gravacaoInterna = '<div class="informacaoInferior"><span class="font_blu">Gravação --------</span><br>';

                                    foreach ($gravacaoSplit as $item) {
                                        $gravacaoInterna .= trim($item) . '<br>'; // trim remove espaços desnecessários
                                    }

                                    $gravacaoInterna .= '</div>';
                                } 
                                else {
                                        $gravacaoInterna = '<div class="informacaoInferior"><span class="font_blu">Gravação --------</span><br>' . $gravacao . '</div>';
                                }
                            }
                            else{
                                $gravacaoInterna = '';
                            } 
                                
                            //gravação externa
                            if(!empty($linhapedidosAntigosPg['descricaoAlianca'])){
                                $gravacaoExterna = '<span class="font_blue">Descrição:</span>' . $linhapedidosAntigosPg['descricaoAlianca'];
                            }
                            else{
                                $gravacaoExterna = '';
                            }

                            //Verificando Estoque 
                            if(!empty($linhapedidosAntigosPg['parEstoqueF'])){

                                $estoqueF = '<span class="font_estoque"> Estoque</span>' ;
                            }
                            if(!empty($linhapedidosAntigosPg['parEstoqueM'])){

                                $estoqueM = '<span class="font_estoque"> Estoque</span>' ;
                            }

                            //Verificando Pedra 
                            if($linhapedidosAntigosPg['PedraF'] == true){

                                $PedraF = '&#128142;' ;
                            }
                            if($linhapedidosAntigosPg['PedraM'] == true){

                                $PedraM = '&#128142;' ;
                            }

                        print($linhapedidosAntigosPg['descricaoPedido'] . "<br>");

                        ?><div class="informacaoPedido"><?php
                            ?><div class="informacaoSuperior"><?php
                                print('<br>Largura:' . $linhapedidosAntigosPg['largura']);
                                print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino . $estoqueF . $PedraF . "<br>"); ?></span>
                                <?php print('Masculina:');?><span class="font_red"><?php print($linhapedidosAntigosPg['numeM'] . $estoqueM . $PedraM . "<br>"); ?></span>
                            </div>
                                <?php echo $gravacaoInterna . "<br>"?>
                        </div>
                        <?php echo $gravacaoExterna?>
                        </label></div><?php
                }
                //PE -------------------------------------------------------------------
                while($linhapedidosAntigosPg = mysqli_fetch_assoc($pedidosAntigosDadosPe)){

                    //Variaveis do Banco
                    $pe = explode("-" , $linhapedidosAntigosPg['idpedidos']);


                        ?><div class="pedidostexto"><label>
                            <div class="tituloPedido">
                                <h2><?php print( $pe[0].' -- '.$linhapedidosAntigosPg['nomePedido'].' -- '); ?><span class="font_red"><?php print($pe[3] . '/' . $pe[2] );?></span></h2>
                            </div>
                        <?php

                                //Variaveis Null
                                $estoqueF = null;
                                $estoqueM = null;
                                $PedraF = null;
                                $PedraM = null;

                        //Verificando Numeração Feminina
                            if($linhapedidosAntigosPg['numF'] == 40){

                                $numeroFeminino = ' não tem';
                            }
                            else{

                                $numeroFeminino = $linhapedidosAntigosPg['numF'];
                            }
                            // gravação interna 
                            if(!empty($linhapedidosAntigosPg['gravacaoInterna'])){

                                $gravacao = $linhapedidosAntigosPg['gravacaoInterna'];

                                if (strpos($gravacao, ',') !== false) {
                                    $gravacaoSplit = explode(',', $gravacao);

                                    $gravacaoInterna = '<div class="informacaoInferior"><span class="font_blu">Gravação --------</span><br>';

                                    foreach ($gravacaoSplit as $item) {
                                        $gravacaoInterna .= trim($item) . '<br>'; // trim remove espaços desnecessários
                                    }

                                    $gravacaoInterna .= '</div>';
                                } 
                                else {
                                        $gravacaoInterna = '<div class="informacaoInferior"><span class="font_blu">Gravação --------</span><br>' . $gravacao . '</div>';
                                }
                            }
                            else{
                                $gravacaoInterna = '';
                            } 
                                
                            //gravação externa
                            if(!empty($linhapedidosAntigosPg['descricaoAlianca'])){
                                $gravacaoExterna = '<span class="font_blue">Descrição:</span>' . $linhapedidosAntigosPg['descricaoAlianca'];
                            }
                            else{
                                $gravacaoExterna = '';
                            }

                            //Verificando Estoque 
                            if(!empty($linhapedidosAntigosPg['parEstoqueF'])){

                                $estoqueF = '<span class="font_estoque"> Estoque</span>' ;
                            }
                            if(!empty($linhapedidosAntigosPg['parEstoqueM'])){

                                $estoqueM = '<span class="font_estoque"> Estoque</span>' ;
                            }

                            //Verificando Pedra 
                            if($linhapedidosAntigosPg['PedraF'] == true){

                                $PedraF = '&#128142;' ;
                            }
                            if( $linhapedidosAntigosPg['PedraM'] == true){

                                $PedraM = '&#128142;' ;
                            }


                        print($linhapedidosAntigosPg['descricaoPedido'] . "<br>");

                        ?><div class="informacaoPedido"><?php
                            ?><div class="informacaoSuperior"><?php
                                print('<br>Largura:' . $linhapedidosAntigosPg['largura']);
                                print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino . $estoqueF . $PedraF . "<br>"); ?></span>
                                <?php print('Masculina:');?><span class="font_red"><?php print($linhapedidosAntigosPg['numeM'] . $estoqueM . $PedraM . "<br>"); ?></span>
                            </div>
                                <?php echo $gravacaoInterna . "<br>"?>
                        </div>
                        <?php echo $gravacaoExterna?>
                        </label></div><?php
                }
            }
        }
?>
<?php ///////////////////////////////-------------------PEDIDOS DATA IMAGEM----------------------////////////////////////////////////////////////////////////// ?>
<?php 
   function pedidosDataImagem($conectar,$resultado,$pesquisa){

    if($pesquisa !== ''){
        pesquisaPedidosDataImagem($pesquisa,$conectar,$resultado);
    }
    else{

        //Variaveis para sincronizar com Banco de Dados
        $imagemPf = "SELECT RIGHT(idpedidos,5) AS idpedido,idpedidos, imagem, pdf FROM pedidosp WHERE contadorpf != 0 AND data_digitada = '$resultado' ORDER BY contadorpf ASC";
        $imagemConectarPf = mysqli_query($conectar, $imagemPf);

        $imagemPg = "SELECT RIGHT(idpedidos,5) AS idpedido,idpedidos, imagem, pdf FROM pedidospg WHERE contadorpg != 0 AND data_digitada = '$resultado' ORDER BY contadorpg ASC";
        $imagemConectarPg = mysqli_query($conectar, $imagemPg);

        $imagemPe = "SELECT RIGHT(idpedidos,5) AS idpedido,idpedidos, imagem, pdf FROM pedidospe WHERE contadorpe != 0 AND data_digitada = '$resultado' ORDER BY contadorpe ASC";
        $imagemConectarPe = mysqli_query($conectar, $imagemPe);

        //PF-----------------------------------------------------------
        while ($dadosImagemPf = mysqli_fetch_assoc($imagemConectarPf)) {
                        
            

                ?><div class="pedidosImagem"><?php
                ?><img class = "Imagem" src="<?php echo '../' .$dadosImagemPf['imagem'];?>" alt="Imagem do Pedido"><?php
                ?></div>
                <div class="btPedidos">
                    <button class = 'Pdf' type="button"><a class="PdfAncora" href="../<?php echo $dadosImagemPf['pdf']?>">PDF</a></button>
                    <button class = 'Pdf' id="editar" type="button"><a class="PdfAncora" target="_blank" href="<?php echo './phpScripts/editarPedido.php?idpedidos=' . $dadosImagemPf['idpedidos'] ; ?>">Editar</a></button>
                </div>
                <?php
            
        } 
        //PG-----------------------------------------------------------
        while ($dadosImagemPg = mysqli_fetch_assoc($imagemConectarPg)) {
                        
            

                ?><div class="pedidosImagem"><?php
                ?><img class = "Imagem" src="<?php echo '../' .$dadosImagemPg['imagem'];?>" alt="Imagem do Pedido"><?php
                ?></div>
                <div class="btPedidos">
                    <button class = 'Pdf' type="button"><a class="PdfAncora" href="../<?php echo $dadosImagemPg['pdf']?>">PDF</a></button>
                    <button class = 'Pdf' id="editar" type="button"><a class="PdfAncora" target="_blank" href="<?php echo './phpScripts/editarPedido.php?idpedidos=' . $dadosImagemPg['idpedidos'] ; ?>">Editar</a></button>
                </div>
                <?php
            
        }
         //PE-----------------------------------------------------------
        while ($dadosImagemPe = mysqli_fetch_assoc($imagemConectarPe)) {
                        
           
                ?><div class="pedidosImagem"><?php
                ?><img class = "Imagem" src="<?php echo '../' .$dadosImagemPe['imagem'];?>" alt="Imagem do Pedido"><?php
                ?></div>
                <div class="btPedidos">
                    <button class = 'Pdf' type="button"><a class="PdfAncora" href="../<?php echo $dadosImagemPe['pdf']?>">PDF</a></button> 
                    <button class = 'Pdf' id="editar" type="button"><a class="PdfAncora" target="_blank" href="<?php echo './phpScripts/editarPedido.php?idpedidos=' . $dadosImagemPe['idpedidos'] ; ?>">Editar</a></button>
                </div>
                <?php
            
        }  
    }
}
 ?>
