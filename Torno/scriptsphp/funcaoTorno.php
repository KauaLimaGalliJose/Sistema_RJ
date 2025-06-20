<?php

function pedidosPf($conectar,$largura,$tabela,$contador,$data){

    //Variavel -----------------------------------------------


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
        $checkboxClass = $pedido[0] . '-' . $pedido[3] . '/' . $pedido[2];
        $checkboxId = 'check_ID_polimento_' . $pedido[0] . '-' . $pedido[3] . '/' . $pedido[2];
        $checkboxId2 = 'check_ID_torno_' . $pedido[0] . '-' . $pedido[3] . '/' . $pedido[2];
        $checkboxId3 = 'check_ID_desmarcado_' . $pedido[0] . '-' . $pedido[3] . '/' . $pedido[2];
        
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

        //Gravação 
        if($linha['gravacaoInterna'] !== ''){
            
            $gravInterna = '<span class = "fontRed" >Sim</span>';
        }
        else{
            $gravInterna = '<span class = "fontBlu" >Não</span>';

        }

        ?>
        <div class="carrossel">
            <div class="carrosselSuperior">
                <img class="carrosselImg" src="<?php echo $linha['imagem']; ?>" alt="ERRO">
                <div id="pedido">
                <label class="fontPedido" for="<?php echo $checkboxId3; ?>"><?php echo $pedido[0] . ' ' . $pedido[3] . '/' . $pedido[2] ?> <input name="marcado_<?php echo $checkboxClass; ?>" title="desmarcar" value="torno" id="<?php echo $checkboxId3; ?>" class="desmarcar <?php echo $checkboxClass; ?>" onchange="salvarEstadoRadio(this)" type="radio" ></label>
                </div>
                <div class="caixaSelecao">
                    <label class="fontCheckboxPolimento">Polimento </label>
                    <input name="marcado_<?php echo $checkboxClass; ?>" title="Polimento" value="Escritorio" id="<?php echo $checkboxId; ?>"  class="polimentoRadio <?php echo $checkboxClass; ?>" onchange="salvarEstadoRadio(this)" type="radio" >
                    <label class="fontCheckboxTorno">Torno </label>
                    <input name="marcado_<?php echo $checkboxClass; ?>" title="Torno" value="Polimento" id="<?php echo $checkboxId2; ?>" class="tornoRadio <?php echo $checkboxClass; ?>" onchange="salvarEstadoRadio(this)" type="radio" >
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
                <div class="informacaoInferior">
                    <h3>--- Descrição ---</h3> <?php echo " <h4> Largura: " .  $linha['largura'] . ' --  Gravação:' . $gravInterna  . '</h4>' . $linha['descricaoAlianca'] ?>
                </div>
            </div>
        </div>
        <?php
    }

}
?>