
<?php ////////////////////////////////////////////////////////////////////-- Pesquisa Do Dia --////////////////////////////////////////////////////////////////////////?>
<?php 
    function pesquisa($resultado,$conectar,$data,$dataSplit){
        if(isset($resultado) !== ''){

            $pesquisaDados = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido , descricaoAlianca, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido FROM pedidosp WHERE idpedidos != 'PF00-$data' AND idpedidos LIKE '%$resultado%' OR nomePedido LIKE '%$resultado%' ORDER BY contadorpf ASC";
            $pesquisaVerificador = mysqli_query($conectar,$pesquisaDados);

            $pesquisaDadosPg = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido , descricaoAlianca, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido FROM pedidospg WHERE idpedidos != 'PG00-$data' AND idpedidos LIKE '%$resultado%' OR nomePedido LIKE '%$resultado%' ORDER BY contadorpg ASC";
            $pesquisaVerificadorPg = mysqli_query($conectar,$pesquisaDadosPg);

            $pesquisaDadosPe = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido , descricaoAlianca, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido FROM pedidospe WHERE idpedidos != 'PE00-$data' AND idpedidos LIKE '%$resultado%' OR nomePedido LIKE '%$resultado%' ORDER BY contadorpe ASC";
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
                        } else {
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
                        } else {
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
            
        }
    }

?>
<?php ////////////////////////////////////////////////////////////////////-- Pesquisa Imagem Do Dia  --////////////////////////////////////////////////////////////////////////?>
<?php 
    function pesquisaImagem($resultado,$conectar,$data,$dataSplit){

        $imagem = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, descricaoPedido, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido, pdf FROM pedidosp WHERE idpedidos != 'PF00-$data' AND idpedidos LIKE '%$resultado%' OR nomePedido LIKE '%$resultado%' ORDER BY contadorpf ASC";
        $imagemConectar = mysqli_query($conectar, $imagem);

        $imagemPg = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, descricaoPedido, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido , pdf FROM pedidospg WHERE idpedidos != 'PG00-$data' AND idpedidos LIKE '%$resultado%' OR nomePedido LIKE '%$resultado%' ORDER BY contadorpg ASC";
        $imagemConectarPg = mysqli_query($conectar, $imagemPg);

        $imagemPe = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, descricaoPedido, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido , pdf FROM pedidospe WHERE idpedidos != 'PE00-$data' AND idpedidos LIKE '%$resultado%' OR nomePedido LIKE '%$resultado%' ORDER BY contadorpe ASC";
        $imagemConectarPe = mysqli_query($conectar, $imagemPe);


        while ($dadosImagem = mysqli_fetch_assoc($imagemConectar)) {
            
            if ($dadosImagem['idpedido'] == $dataSplit[1] . '-' . $dataSplit[2]) {

                ?><div class="pedidosImagem"><?php
                ?><img class = "Imagem" src="<?php echo '../' .$dadosImagem['imagem'];?>" alt="Imagem do Pedido"><?php
                ?></div>
                <div class="btPedidos">
                <button class = 'Pdf' type="button"><a class="PdfAncora"  href="../<?php echo $dadosImagem['pdf']?>">PDF</a></button>
                <button class = 'Pdf' type="button"><a class="PdfAncora" target="_blank" href="<?php echo './phpScripts/editarPedido.php?idpedidos=' . $dadosImagem['idpedidos'] ; ?>">Editar</a></button>
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
                <button class = 'Pdf' type="button"><a class="PdfAncora" href="../<?php echo $dadosImagemPg['pdf']?>">PDF</a></button>
                <button class = 'Pdf' type="button"><a class="PdfAncora" target="_blank"  href="<?php echo './phpScripts/editarPedido.php?idpedidos=' . $dadosImagemPg['idpedidos'] ; ?>">Editar</a></button>
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
                <button class = 'Pdf' type="button"><a class="PdfAncora"  href="../<?php echo $dadosImagemPe['pdf']?>">PDF</a></button>
                <button class = 'Pdf' type="button"><a class="PdfAncora" target="_blank" href="<?php echo './phpScripts/editarPedido.php?idpedidos=' . $dadosImagemPe['idpedidos'] ; ?>">Editar</a></button>
                </div>
                <?php
            }
        }
    }
?>
