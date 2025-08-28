<?php

include_once '../../phpIndex/protege.php';
proteger(); // Chama a função para verificar o token antes de carregar a página

function polimento_estoque($linha){



    for($n = 9; $n <= 35; $n++){

        if($linha[$n] != 0){

            // Verifica se o estoque já está calibrado
            $numeracoes_Lista = [];
            $numeracoes_Lista =  $n;
        }
    }
    if (!empty($numeracoes_Lista)){
    ?>
    <!-- Parte do Torno ----------------------------------------------------------------------->
    <div class="carrossel">
        <div class="carrosselSuperior">
            <div class="carrossel_div">
                <img class="carrosselImg" src="<?php echo '../../' . $linha['imagem']; ?>" alt="ERRO">
                
                <div id="pedido">
                    <label class="fontPedido"  title="desmarcar" value="torno" class="desmarcar"  type="radio" ><?php echo $linha['nome'] ?></label>
                </div>
            </div>
            <div class="carrossel_div">
                <div class="informacaoInferior">
                    <h3>---------- Descrição ----------</h3> <?php echo " <h4></br>" .  nl2br($linha['descricaoEstoque']) . '</br></br> Peso ==> <span class = "fontRed">' . $linha['peso'] .'</span>' . '</h4>'   ?>
                </div>
            </div>
        </div>
        <div class="carrosselInferior">
            <label id="repor_estoque">Repor Estoque -- Polimento</label>
            <div class = numeracao_estoque>
                <?php
                
                for($n = 9; $n <= 35; $n++){
                    
                    if($linha[$n] != 0){
                        
                        ?>
                                    <div class="numeracao">
                                        <label class="numero">
                                            <?php echo  $n  ?>
                                        </label>
                                        
                                        <!-- Botão para diminuir o número -->
                                <form id="formulario_polimento_<?php echo $n ?>" class="formulario_estoque" method="post" action="./repor2.php" enctype='multipart/form-data'>
                                    <div class='button-container'>
                                        <button type="button" class='button-3d' onclick = 'voltar("id2_<?php echo $n?>", "id2_Input<?php echo $n ?>"); enviar_form("formulario_polimento_<?php echo $n ?>"); atualizarInputs()' >
                                            <div class='button-top'>
                                            <span class='material-icons'>-</span>
                                            </div>
                                            <div class='button-bottom'></div>
                                            <div class='button-base'></div>
                                        </button>

                                        <!-- Input para o número -->
                                        <label  id="id2_<?php echo $n ?>" class="numero_abastecer">
                                            <?php echo  $linha[$n]  ?>
                                        </label>
                                        <input type="hidden" id="id2_Input<?php echo $n ?>" name="numero_value" value="">
                                        <input type="hidden" name="numero_" value="<?php echo $n; ?>">

                                        <button type="button" class='button-3d' onclick = 'avancar("id2_<?php echo $n ?>", "id2_Input<?php echo $n ?>"); enviar_form("formulario_polimento_<?php echo $n ?>"); atualizarInputs()'>
                                            <div class='button-top'>
                                            <span class='material-icons'>+</span>
                                            </div>
                                            <div class='button-bottom'></div>
                                            <div class='button-base'></div>
                                        </button></div>
                                        <input type="hidden" name="estoque_nome" value="<?php echo $linha['nome']; ?>">
                                        <input type="hidden" name="local" value="<?php echo 'polimento'; ?>">
                                </form>
                                    </div>
                                    <?php
                    }
                }
                ?></div><?php // Fim da div numeracao_estoque
                ?></div><?php // Fim da div carrosselInferior
                ?></div><?php // Fim da div carrossel
    }
}

function Torno_estoque($linha){


    for($n = 9; $n <= 35; $n++){

        if($linha[$n] != 0){

            // Verifica se o estoque já está calibrado
            $numeracoes_Lista = [];
            $numeracoes_Lista =  $n;
        }
    }
    if (!empty($numeracoes_Lista)){
    ?>
    <!-- Parte do Torno ----------------------------------------------------------------------->
    <div class="carrossel">
        <div class="carrosselSuperior">
            <div class="carrossel_div">
                <img class="carrosselImg" src="<?php echo '../../' . $linha['imagem']; ?>" alt="ERRO">
                <div id="pedido">
                    <label class="fontPedido"  title="desmarcar" value="torno" class="desmarcar"  type="radio" ><?php echo $linha['nome'] ?></label>
                </div>
            </div>
            <div class="carrossel_div">
                <div class="informacaoInferior">
                    <h3>---------- Descrição ----------</h3> <?php echo " <h4></br>" .  nl2br($linha['descricaoEstoque']) . '</br></br> Peso ==> <span class = "fontRed">' . $linha['peso'] .'</span>' . '</h4>'   ?>
                </div>
            </div>
        </div>
        <div class="carrosselInferior">
            <label id="repor_estoque">Repor Estoque -- Torno</label>
            <div class = numeracao_estoque>
                <?php

                for($n = 9; $n <= 35; $n++){
                    
                    if($linha[$n] != 0){
                        
                        ?>
                                <div class="numeracao">
                                    <label class="numero">
                                        <?php echo  $n  ?>
                                    </label>
                                        
                                        <!-- Botão para diminuir o número -->
                                <form id="formulario_torno_<?php echo $n ?>" class="formulario_estoque" >
                                    <div class='button-container'>
                                        <button type="button" class='button-3d' onclick = 'voltar("id_<?php echo $n?>","id_Input<?php echo $n ?>"); enviar_form("formulario_torno_<?php echo $n ?>"); atualizarInputs()' >
                                            <div class='button-top'>
                                            <span class='material-icons'>-</span>
                                            </div>
                                            <div class='button-bottom'></div>
                                            <div class='button-base'></div>
                                        </button>

                                        <!-- Input para o número -->
                                        <label id="id_<?php echo $n ?>"  class="numero_abastecer">
                                            <?php echo  $linha[$n]  ?>
                                        </label>
                                        <input type="hidden" id="id_Input<?php echo $n ?>" name="numero_value" value="">
                                        <input type="hidden" name="numero_" value="<?php echo $n; ?>">

                                        <button type="button" class='button-3d' onclick = 'avancar("id_<?php echo $n ?>", "id_Input<?php echo $n ?>"); enviar_form("formulario_torno_<?php echo $n ?>"); atualizarInputs()'>
                                            <div class='button-top'>
                                            <span class='material-icons'>+</span>
                                            </div>
                                            <div class='button-bottom'></div>
                                            <div class='button-base'></div>
                                        </button></div>
                                        <input type="hidden" name="estoque_nome" value="<?php echo $linha['nome']; ?>">
                                        <input type="hidden" name="local" value="<?php echo 'torno'; ?>">
                                    </form>
                                    </div>       
                        <?php
                    }

                }
                ?></div><?php // Fim da div numeracao_estoque
                ?></div><?php // Fim da div carrosselInferior
                ?></div><?php // Fim da div carrossel
    }
}

// mostra os estoques
function estoques($conectar,$nome ){
    ?>
    <?php

        // Consulta para obter os dados do Torno
        $sql = "SELECT *, 
                GREATEST(`9`, `10`, `11`, `12`, `13`, `14`, `15`, `16`, `17`, `18`, `19`, `20`, 
                `21`, `22`, `23`, `24`, `25`, `26`, `27`, `28`, `29`, `30`, `31`, `32`, `33`, `34`, `35`) AS maior_valor
                FROM reabastecer_estoque WHERE nome LIKE '$nome' ORDER BY maior_valor DESC"; // Consulta para obter os dados do estoque
        
        $consulta = $conectar->query($sql);

        // Consulta para obter os dados do Polimento
        $sql_polimento = "SELECT *, 
                GREATEST(`9`, `10`, `11`, `12`, `13`, `14`, `15`, `16`, `17`, `18`, `19`, `20`, 
                `21`, `22`, `23`, `24`, `25`, `26`, `27`, `28`, `29`, `30`, `31`, `32`, `33`, `34`, `35`) AS maior_valor
                FROM reabastecer_estoque_polimento WHERE nome LIKE '$nome' ORDER BY maior_valor DESC"; // Consulta para obter os dados do estoque

        $consulta_polimento = $conectar->query($sql_polimento);

        if($consulta->num_rows > 0){
            
            
            echo  '<div class ="Estoques_Torno_Polimento">';

                if($linha = $consulta->fetch_assoc()){

                    Torno_estoque($linha);
                }
                if($linha2 = $consulta_polimento->fetch_assoc()){

                    polimento_estoque($linha2);
                }

            echo '</div>';// Fim da div Estoques_Torno_Polimento'
            
        }
        else{
             echo "<div class='semEstoque'><h1>Sem Estoque, Crie um</h1></div>";   
        } 
}


// escolher estoques
function escolher_estoque($conectar, $estoque_nome){

    //variaveis
    $estoque_nome_semEspaco = str_replace(' ', '_', $estoque_nome);

    $sql = "SELECT nome FROM reabastecer_estoque "; 
    $consulta = $conectar->query($sql);

    

    ?>
    <div id = "opcoes_div">
        <form id="opcoes_estoques" method="post" action="./repor.php" enctype='multipart/form-data'>
            
            <?php
                while($consut = $consulta->fetch_assoc()){
                    
                    $nome_sem_espaco = str_replace(' ', '_', $consut['nome']);

                    ?><div class = "opcoes">

                        <input name = 'radioName' value="<?php echo $consut['nome']; ?>" type="radio" id="<?php echo  $nome_sem_espaco; ?>" class="estoque_Bnt_radio" onclick="this.form.submit(); " >
                        
                        <label class="estoque_Bnt" id="<?php echo 'lab_' . $nome_sem_espaco; ?>" for="<?php echo $nome_sem_espaco; ?>" >
                            <?php echo $consut['nome']; ?>
                        </label >
                    </div><?php
                    }
                    ?>    

        <input name = 'radioName' type="radio" value="<?php echo $estoque_nome_semEspaco; ?>" id="<?php echo "id2_" . $estoque_nome_semEspaco; ?>" class=" estoque_Bnt_radio iniciar-selecionado" onchange="input_Radio(<?php echo 'id2_' . $estoque_nome_semEspaco ?>) " >
        </form>
    </div>

    <?php
    mysqli_close($conectar);
}