<?php

function pedidosPf($conectar,$largura,$tabela,$contador,$data){

    $dados = "SELECT * FROM `$tabela` WHERE `$contador` <> 0
    AND data_digitada = '$data'
    AND largura LIKE '$largura'
    ORDER BY `$contador` ASC";

    $resultadoDados = mysqli_query($conectar,$dados);

    while($linha = mysqli_fetch_assoc($resultadoDados)){

        //Variaveis
        $pedido = explode('-',$linha['idpedidos']);
        $estoqueF = '';
        $estoqueM = '';
        $PedraF = '';
        $PedraM = '';

        //Verificações 
        if($linha['numF'] == 40){
            $numeroFeminino = ' não tem';
        }
        else{
            $numeroFeminino = $linha['numF'];
        }
        //Verificando Estoque 
        if(!empty($linha['parEstoqueF'])){
            $estoqueF = ' Estoque' ;
        }
        if(!empty($linha['parEstoqueM'])){
            $estoqueM = ' Estoque' ;
        }

        //Verificando Pedra 
        if($linha['PedraF'] == true){
            $PedraF = '&#128142;' ;
        }
        if( $linha['PedraM'] == true){
            $PedraM = '&#128142;' ;
        }


        ?>
        <div class="carrossel">
            <div class="carrosselSuperior">
                <img class="carrosselImg" src="<?php echo $linha['imagem']; ?>" alt="ERRO">
                <div id="pedido">
                <label class="fontPedido"><?php echo $pedido[0] . ' ' . $pedido[3] . '/' . $pedido[2] ?></label>
                </div>
            </div>
            <div class="carrosselInferior">
                <div id="numeracao">
                    <div class="divsNumeracaoF">
                        <label class="tituloPreto">Feminina:</label>
                        <label class="numeracaoFont"><?php echo $numeroFeminino . $estoqueF; ?></label><label class="diamante"><?php echo ' ' .  $PedraF ?></label>
                    </div>
                    <div class="divsNumeracaoM">
                        <label class="tituloPreto">Masculina:</label>
                        <label class="numeracaoFont"><?php echo $linha['numeM']. " " . $estoqueM; ?></label><label class="diamante"><?php echo  ' ' . $PedraM ?></label>
                    </div>
                </div>
                <div id="descricao">
                <label class="descricaoFont">Descrição: <?php echo $linha['descricaoAlianca'] ?></label>
                </div>
                <div>

                </div>
            </div>
            </div>
        <?php
    }

}
?>