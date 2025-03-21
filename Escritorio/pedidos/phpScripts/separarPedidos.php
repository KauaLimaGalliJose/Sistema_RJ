
<?php ///////////////////////////////-------------------PF----------------------////////////////////////////////////////////////////////////// ?>

<?php
function selectPf($conectar,$dataSplit,$data){

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
}
?>

<?php ///////////////////////////////-------------------PG----------------------////////////////////////////////////////////////////////////// ?>

<?php 
function selectPg($conectar,$dataSplit,$data){
    
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
}
?>

<?php ///////////////////////////////-------------------PE----------------------////////////////////////////////////////////////////////////// ?>

<?php 
    function selectPe($conectar,$dataSplit,$data){

        $dadosVerificadorPe = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, descricaoPedido, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido FROM pedidospe WHERE idpedidos != 'PE00-$data' ORDER BY contadorpe ASC";
        $VerificadorPe = mysqli_query($conectar, $dadosVerificadorPe);

        while (($dadosPe = mysqli_fetch_assoc($VerificadorPe))) {
        
            if ($dadosPe['idpedido'] == $dataSplit[1] . '-' . $dataSplit[2]) {

                $pg = explode("-" , $dadosPe['idpedidos']);

                ?><div class="pedidostexto"><label><?php
                ?><div class="tituloPedido">
                    <h2><?php print( $pg[0].' -- '.$dadosPe['nomePedido'].' -- '); ?><span class="font_red"><?php print($dataSplit[2] . '/' . $dataSplit[1] );?></span></h2>
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
?>
<?php 
///////////////////////////////-------------------PF__Imagem----------------------////////////////////////////////////////////////////////////// 
    function selectImagePF($conectar,$dataSplit,$data){

        $imagem = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem FROM pedidosp WHERE idpedidos != 'PF00-$data' ORDER BY contadorpf ASC";
        $imagemConectar = mysqli_query($conectar, $imagem);

        while ($dadosImagem = mysqli_fetch_assoc($imagemConectar)) {
            
            if ($dadosImagem['idpedido'] == $dataSplit[1] . '-' . $dataSplit[2]) {

                ?><div class="pedidosImagem"><?php
                ?><img class = "Imagem" src="<?php echo '../' .$dadosImagem['imagem'];?>" alt="Imagem do Pedido"><?php
                ?></div>
                <div class="btPedidos">
                <button class = 'Pdf' type="button">PDF</button>
                <button class = 'Pdf' type="button">Editar</button>
                </div>
                <?php
            }
        }
    }
///////////////////////////////-------------------PG__Imagem----------------------////////////////////////////////////////////////////////////// 
    function selectImagePG($conectar,$dataSplit,$data){

        $imagemPg = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem FROM pedidospg WHERE idpedidos != 'PG00-$data' ORDER BY contadorpg ASC";
        $imagemConectarPg = mysqli_query($conectar, $imagemPg);

        while ($dadosImagemPg = mysqli_fetch_assoc($imagemConectarPg)) {
                 
            if ($dadosImagemPg['idpedido'] == $dataSplit[1] . '-' . $dataSplit[2]) {

                ?><div class="pedidosImagem"><?php
                ?><img class = "Imagem" src="<?php echo '../' .$dadosImagemPg['imagem'];?>" alt="Imagem do Pedido"><?php
                ?></div>
                <div class="btPedidos">
                <button class = 'Pdf' type="button">PDF</button>
                <button class = 'Pdf' type="button">Editar</button>
                </div>
                <?php
            }
        } 
    }
///////////////////////////////-------------------PE__Imagem----------------------////////////////////////////////////////////////////////////// 
    function selectImagePE($conectar,$dataSplit,$data){
        
        $imagemPe = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem FROM pedidospe WHERE idpedidos != 'PE00-$data' ORDER BY contadorpe ASC";
            $imagemConectarPe = mysqli_query($conectar, $imagemPe);
    
            while ($dadosImagemPe = mysqli_fetch_assoc($imagemConectarPe)) {
                     
                if ($dadosImagemPe['idpedido'] == $dataSplit[1] . '-' . $dataSplit[2]) {

                    ?><div class="pedidosImagem"><?php
                    ?><img class = "Imagem" src="<?php echo '../' .$dadosImagemPe['imagem'];?>" alt="Imagem do Pedido"><?php
                    ?></div>
                    <div class="btPedidos">
                    <button class = 'Pdf' type="button">PDF</button>
                    <button class = 'Pdf' type="button">Editar</button>
                    </div>
                    <?php
                }
            } 
    }

?>
