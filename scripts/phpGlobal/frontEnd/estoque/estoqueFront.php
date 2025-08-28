<?php
//Mostra qualquer estoque com botão 
function mosrtrar_estoque($linha,$nomeTabela, $arquivoBD , $caminhoimagem){


    for($n = 9; $n <= 35; $n++){

        if($linha[$n] != 0){

            // Verifica se o estoque já está calibrado
            $numeracoes_Lista = [];
            $numeracoes_Lista =  $n;
        }
    }
    if (!empty($numeracoes_Lista)){
    ?>
    <!-- Parte do estoque ----------------------------------------------------------------------->
    <div class="carrossel">
        <div class="carrosselSuperior">
            <div class="carrossel_div">
                <img class="carrosselImg" src="<?php echo $caminhoimagem . $linha['imagem']; ?>" alt="ERRO">
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
            <label id="repor_estoque">Fazer Agora -- <?php echo $nomeTabela ?></label>
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
                                        <button type="button" class='button-3d' onclick = 'voltar("id_<?php echo $n?>", "id_Input<?php echo $n ?>"); enviar_form("formulario_torno_<?php echo $n ?>" , "<?php echo  $arquivoBD ?>"); atualizarInputs()' >
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

                                        <button type="button" class='button-3d' onclick = 'avancar("id_<?php echo $n ?>", "id_Input<?php echo $n ?>"); enviar_form("formulario_torno_<?php echo $n ?>", "<?php echo  $arquivoBD ?>"); atualizarInputs()'>
                                            <div class='button-top'>
                                            <span class='material-icons'>+</span>
                                            </div>
                                            <div class='button-bottom'></div>
                                            <div class='button-base'></div>
                                        </button></div>
                                        <input type="hidden" name="estoque_nome" value="<?php echo $linha['nome']; ?>">
                                        <input type="hidden" name="local" value="<?php echo $linha["nome"]; ?>">
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
//Mostra qualquer estoque sem botão 
function mosrtrar_estoque_semBotao($linha,$nomeTabela, $arquivoBD , $caminhoimagem){


    for($n = 9; $n <= 35; $n++){

        if($linha[$n] != 0){

            // Verifica se o estoque já está calibrado
            $numeracoes_Lista = [];
            $numeracoes_Lista =  $n;
        }
    }
    if (!empty($numeracoes_Lista)){
    ?>
    <!-- Parte do estoque ----------------------------------------------------------------------->
    <div class="carrossel">
        <div class="carrosselSuperior">
            <div class="carrossel_div">
                <img class="carrosselImg" src="<?php echo $caminhoimagem . $linha['imagem']; ?>" alt="ERRO">
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
            <label id="repor_estoque">Fazer Agora -- <?php echo $nomeTabela ?></label>
            <div class = numeracao_estoque>
                <?php
                
                for($n = 9; $n <= 35; $n++){
                    
                    if($linha[$n] != 0){
                        
                        ?>
                                <div class="numeracao">
                                    <label class="numero">
                                        <?php echo  $n  ?>
                                    </label>                                      
                                    <!-- Input para o número -->
                                    <label id="id_<?php echo $n ?>"  class="numero_abastecer">
                                        <?php echo  $linha[$n]  ?>
                                    </label>
                                </div>       
                        <?php
                    }
                }
                ?></div><?php // Fim da div numeracao_estoque
                ?></div><?php // Fim da div carrosselInferior
                ?></div><?php // Fim da div carrossel
    }
}

// escolher estoques
function escolher_estoque($conectar, $estoque_nome , $caminhoArquivo){

    //variaveis
    $estoque_nome_semEspaco = str_replace(' ', '_', $estoque_nome);
    $estoque_esgotado_checkbox = $_GET['estoque_esgotado'];

    $sql = "SELECT nome FROM estoque_esgotado "; 
    $consulta = $conectar->query($sql);

    

    ?>
    <div id = "opcoes_div">
        <form id="opcoes_estoques" method="get" action="<?php echo $caminhoArquivo ?>" enctype='multipart/form-data'>
            <input type="hidden" name="estoque_esgotado" value="<?php echo $estoque_esgotado_checkbox ?? ''; ?>">
            
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

        <input name = 'radioName' type="radio" value="<?php echo $estoque_nome_semEspaco; ?>" id="<?php echo "id_" . $estoque_nome_semEspaco; ?>" class=" estoque_Bnt_radio iniciar-selecionado" >
        </form>
    </div>

    <?php
}
// escolher estoques Post
function escolher_estoque_post($conectar, $estoque_nome , $caminhoArquivo){

    //variaveis
    $estoque_nome_semEspaco = str_replace(' ', '_', $estoque_nome);
    $estoque_esgotado_checkbox = $_POST['estoque_esgotado'];

    $sql = "SELECT nome FROM estoque_esgotado "; 
    $consulta = $conectar->query($sql);

    

    ?>
    <div id = "opcoes_div">
        <form id="opcoes_estoques" method="post" action="<?php echo $caminhoArquivo ?>" enctype='multipart/form-data'>
            <input type="hidden" name="estoque_esgotado" value="<?php echo $estoque_esgotado_checkbox ?? ''; ?>">
            
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

        <input name = 'radioName' type="radio" value="<?php echo $estoque_nome_semEspaco; ?>" id="<?php echo "id_" . $estoque_nome_semEspaco; ?>" class=" estoque_Bnt_radio iniciar-selecionado" >
        </form>
    </div>

    <?php
}

// mostra os estoques
function estoques($conectar,$nome ,$arquivoBD, $caminhoimagem ){

        // Consulta para obter os dados do Torno
        $sql = "SELECT *, 
                GREATEST(`9`, `10`, `11`, `12`, `13`, `14`, `15`, `16`, `17`, `18`, `19`, `20`, 
                `21`, `22`, `23`, `24`, `25`, `26`, `27`, `28`, `29`, `30`, `31`, `32`, `33`, `34`, `35`) AS maior_valor
                FROM estoque_esgotado WHERE nome LIKE '$nome' ORDER BY maior_valor DESC"; // Consulta para obter os dados do estoque
        
        $consulta = $conectar->query($sql);

        if($consulta->num_rows > 0){
            
            
            echo  '<div class ="Estoques_Torno_Polimento">';

                if($linha = $consulta->fetch_assoc()){

                    mosrtrar_estoque($linha,$linha['nome'], $arquivoBD, $caminhoimagem);
                }

            echo '</div>';// Fim da div Estoques_Torno_Polimento'
            
        }
        else{
             echo "<div class='semEstoque'><h1>Sem Estoque, Crie um</h1></div>";   
        } 
}

// mostra os estoques sem botao
function estoques_semBotao($conectar,$nome ,$arquivoBD, $caminhoimagem ){

        // Consulta para obter os dados do Torno
        $sql = "SELECT *, 
                GREATEST(`9`, `10`, `11`, `12`, `13`, `14`, `15`, `16`, `17`, `18`, `19`, `20`, 
                `21`, `22`, `23`, `24`, `25`, `26`, `27`, `28`, `29`, `30`, `31`, `32`, `33`, `34`, `35`) AS maior_valor
                FROM estoque_esgotado WHERE nome LIKE '$nome' ORDER BY maior_valor DESC"; // Consulta para obter os dados do estoque
        
        $consulta = $conectar->query($sql);

        if($consulta->num_rows > 0){
            
            
            echo  '<div class ="Estoques_Torno_Polimento">';

                if($linha = $consulta->fetch_assoc()){

                    mosrtrar_estoque_semBotao($linha,$linha['nome'], $arquivoBD, $caminhoimagem);
                }

            echo '</div>';// Fim da div Estoques_Torno_Polimento'
            
        }
        else{
             echo "<div class='semEstoque'><h1>Sem Estoque, Crie um</h1></div>";   
        } 
}