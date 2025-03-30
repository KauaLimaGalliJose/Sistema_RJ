
<?php ///////////////////////////////-------------------PF----------------------////////////////////////////////////////////////////////////// ?>

<?php
function selectPf($conectar,$dataSplit,$data){

        $dadosVerificador = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido FROM pedidosp WHERE idpedidos != 'PF00-$data' ORDER BY contadorpf ASC";
        $Verificador = mysqli_query($conectar, $dadosVerificador);

        while (($dados = mysqli_fetch_assoc($Verificador))) {
        
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

                //Verificando Estoque 
                if(!empty($dados['parEstoqueF'])){

                    $estoqueF = '<span class="font_estoque"> Estoque</span>' ;
                }
                if(!empty($dados['parEstoqueM'])){

                    $estoqueM = '<span class="font_estoque"> Estoque</span>' ;
                }

                //Verificando Pedra 
                if($dados['PedraF'] == true){

                    $PedraF = '<span class="font_blue"> com Pedra</span>' ;
                }
                if( $dados['PedraM'] == true){

                    $PedraM = '<span class="font_blue"> com Pedra</span>' ;
                }

                    print($dados['descricaoPedido'] . "<br>");
                    print('<br>Largura:' . $dados['largura']);
                    print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino . $estoqueF . $PedraF . "<br>"); ?></span>
                    <?php print('Masculina:');?><span class="font_red"><?php print($dados['numeM'] . $estoqueM . $PedraM . "<br>"); ?></span>
                    <?php echo $gravacaoInterna . "<br>"?>
                    <?php echo $gravacaoExterna?>
                    </label></div><?php
                
                
            }
        }
}
?>

<?php ///////////////////////////////-------------------PG----------------------////////////////////////////////////////////////////////////// ?>

<?php 
function selectPg($conectar,$dataSplit,$data){
    
    $dadosVerificadorPg = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, PedraF, PedraM,parEstoqueF, parEstoqueM, descricaoPedido, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido FROM pedidospg WHERE idpedidos != 'PG00-$data' ORDER BY contadorpg ASC";
    $VerificadorPg = mysqli_query($conectar, $dadosVerificadorPg);

    while (($dadosPg = mysqli_fetch_assoc($VerificadorPg))) {
    
        if ($dadosPg['idpedido'] == $dataSplit[1] . '-' . $dataSplit[2]) {

            $pg = explode("-" , $dadosPg['idpedidos']);

            ?><div class="pedidostexto"><label><?php
            ?><div class="tituloPedido">
                <h2><?php print( $pg[0].' -- '.$dadosPg['nomePedido'].' -- '); ?><span class="font_red"><?php print($dataSplit[2] . '/' . $dataSplit[1] );?></span></h2>
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

            //Verificando Estoque 
            if(!empty($dadosPg['parEstoqueF'])){

                $estoqueF = '<span class="font_estoque"> Estoque</span>' ;
            }
            if(!empty($dadosPg['parEstoqueM'])){

                $estoqueM = '<span class="font_estoque"> Estoque</span>' ;
            }

            //Verificando Pedra 
            if($dadosPg['PedraF'] == true){

                $PedraF = '<span class="font_blue"> com Pedra</span>' ;
            }
            if( $dadosPg['PedraM'] == true){

                $PedraM = '<span class="font_blue"> com Pedra</span>' ;
            }

                    print($dadosPg['descricaoPedido'] . "<br>");
                    print('<br>Largura:' . $dadosPg['largura']);
                    print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino . $estoqueF . $PedraF . "<br>"); ?></span>
                    <?php print('Masculina:');?><span class="font_red"><?php print($dadosPg['numeM'] . $estoqueM . $PedraM . "<br>"); ?></span>
                    <?php echo $gravacaoInterna . "<br>"?>
                    <?php echo $gravacaoExterna?>
                    </label></div><?php
        }  
    }   
}
?>

<?php ///////////////////////////////-------------------PE----------------------////////////////////////////////////////////////////////////// ?>

<?php 
    function selectPe($conectar,$dataSplit,$data){

        $dadosVerificadorPe = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, PedraF, PedraM,parEstoqueF, parEstoqueM, descricaoPedido, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido FROM pedidospe WHERE idpedidos != 'PE00-$data' ORDER BY contadorpe ASC";
        $VerificadorPe = mysqli_query($conectar, $dadosVerificadorPe);

        while (($dadosPe = mysqli_fetch_assoc($VerificadorPe))) {
        
            if ($dadosPe['idpedido'] == $dataSplit[1] . '-' . $dataSplit[2]) {

                $pg = explode("-" , $dadosPe['idpedidos']);

                ?><div class="pedidostexto"><label><?php
                ?><div class="tituloPedido">
                    <h2><?php print( $pg[0].' -- '.$dadosPe['nomePedido'].' -- '); ?><span class="font_red"><?php print($dataSplit[2] . '/' . $dataSplit[1] );?></span></h2>
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

            //Verificando Estoque 
            if(!empty($dadosPe['parEstoqueF'])){

                $estoqueF = '<span class="font_estoque"> Estoque</span>' ;
            }
            if(!empty($dadosPe['parEstoqueM'])){

                $estoqueM = '<span class="font_estoque"> Estoque</span>' ;
            }

            //Verificando Pedra 
            if($dadosPe['PedraF'] == true){

                $PedraF = '<span class="font_blue"> com Pedra</span>' ;
            }
            if( $dadosPe['PedraM'] == true){

                $PedraM = '<span class="font_blue"> com Pedra</span>' ;
            }

                    print($dadosPe['descricaoPedido'] . "<br>");
                    print('<br>Largura:' . $dadosPe['largura']);
                    print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino . $estoqueF . $PedraF ."<br>"); ?></span>
                    <?php print('Masculina:');?><span class="font_red"><?php print($dadosPe['numeM'] . $estoqueM .$PedraM . "<br>"); ?></span>
                    <?php echo $gravacaoInterna . "<br>"?>
                    <?php echo $gravacaoExterna?>
                    </label></div><?php
            }  
        }      
}
?>
<?php 
///////////////////////////////-------------------PF__Imagem----------------------////////////////////////////////////////////////////////////// 
    function selectImagePF($conectar,$dataSplit,$data){

        $imagem = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, pdfp, idpedidos FROM pedidosp WHERE idpedidos != 'PF00-$data' ORDER BY contadorpf ASC";
        $imagemConectar = mysqli_query($conectar, $imagem);

        while ($dadosImagem = mysqli_fetch_assoc($imagemConectar)) {
            
            if ($dadosImagem['idpedido'] == $dataSplit[1] . '-' . $dataSplit[2]) {

                ?><div class="pedidosImagem"><?php
                ?><img class = "Imagem" src="<?php echo '../' .$dadosImagem['imagem'];?>" alt="Imagem do Pedido"><?php
                ?></div>
                <div class="btPedidos">
                <button class = 'Pdf' type="button"><a class="PdfAncora" href="../<?php echo $dadosImagem['pdfp']?>">PDF</a></button>
                <button class = 'Pdf' id="editar" type="button"><a class="PdfAncora" href="<?php echo './phpScripts/editarPedido.php?idpedidos=' . $dadosImagem['idpedidos'] ; ?>">Editar</a></button>
                </div>
                <?php
            }
        }
    }
///////////////////////////////-------------------PG__Imagem----------------------////////////////////////////////////////////////////////////// 
    function selectImagePG($conectar,$dataSplit,$data){

        $imagemPg = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, pdfpg, idpedidos FROM pedidospg WHERE idpedidos != 'PG00-$data' ORDER BY contadorpg ASC";
        $imagemConectarPg = mysqli_query($conectar, $imagemPg);

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
    }
///////////////////////////////-------------------PE__Imagem----------------------////////////////////////////////////////////////////////////// 
    function selectImagePE($conectar,$dataSplit,$data){
        
        $imagemPe = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, pdfpe, idpedidos FROM pedidospe WHERE idpedidos != 'PE00-$data' ORDER BY contadorpe ASC";
            $imagemConectarPe = mysqli_query($conectar, $imagemPe);
    
            while ($dadosImagemPe = mysqli_fetch_assoc($imagemConectarPe)) {
                     
                if ($dadosImagemPe['idpedido'] == $dataSplit[1] . '-' . $dataSplit[2]) {

                    ?><div class="pedidosImagem"><?php
                    ?><img class = "Imagem" src="<?php echo '../' .$dadosImagemPe['imagem'];?>" alt="Imagem do Pedido"><?php
                    ?></div>
                    <div class="btPedidos">
                    <button class = 'Pdf' type="button"><a class="PdfAncora" href="../<?php echo $dadosImagemPe['pdfpe']?>">PDF</a></button>
                    <button class = 'Pdf' type="button"><a class="PdfAncora" href="<?php echo './phpScripts/editarPedido.php?idpedidos=' . $dadosImagemPe['idpedidos'] ; ?>">Editar</a></button>
                    </div>
                    <?php
                }
            } 
    }

?>
