<?php 

function menu_conteiner($conectar , $caminho , $aparecer , $dataInput) {

    if (!isset($dataInput) || empty($dataInput) || !DateTime::createFromFormat('Y-m-d', $dataInput)) {
        $dataInput = date('Y-m-d');
    }
    
    // Biblioteca
    include( $caminho . 'Escritorio/Estoque/phpScripts/puxarDados.php');
    include( $caminho . 'scripts/phpGlobal/backEnd/menu/filtrarClientes.php');
        // variavel
        $estilo_pedido_none = '';

        if($aparecer != null ){

            foreach($aparecer as $item){

                if($item == 'estilo_pedidos_none'){

                    $estilo_pedido_none = 'style = "display: none;"';
                }
            }
        }
        
        ?>
        <div id="div_menu_conteiner" >
            <form id="form_menu" >
                <div id="div_menu_conteiner_itens">
                    <label class="font_global_titulo_vinho" >------- Configurações --------</label>
                    
                    <div id="grade">
                        <label class="font_global_Subtitulo_vinho" <?php echo $estilo_pedido_none; ?> >-- Estilo dos Pedidos --</label>
                        <div class="divs_padrao_row" <?php echo $estilo_pedido_none; ?>>

                           <div class="divs_padrao_colun" >
                               <label id="pedidosEmLinha_label"  for="pedidosEmLinha" class="bnt_estiloPedidos btn_Padrao"><img class="img_estiloPedidos" src = '<?php echo $caminho . "scripts\imagem_global\menu_img\pedidosLinhas.png";  ?>' >
                                <input id="pedidosEmLinha" type="radio" name="estilo_pedidos" class="invisivel" onchange = 'enviarLocalStorage("estilo_pedido" , "pedidosLinha"); this.form.submit()' >
                                    Linha
                                </label>

                           </div>
                           <div class="divs_padrao_colun">
                               <label  id="pedidosEmBlocos_label" for="pedidosEmBlocos" class="bnt_estiloPedidos btn_Padrao"><img class="img_estiloPedidos" src = '<?php echo $caminho . "scripts\imagem_global\menu_img\pedidosQuadrados.png";  ?>' >
                                <input id="pedidosEmBlocos" type="radio" name="estilo_pedidos" class="invisivel" onchange = 'enviarLocalStorage("estilo_pedido" , "pedidosBlocos"); this.form.submit()'>
                                Quadrados
                                </label>
                           </div>
                           
                       </div>

                       <label class="font_global_Subtitulo_vinho font_margin_20px" >-- Filtrar --</label>
                       <div class="divs_padrao_row">

                        <!-- Escolher tipo de Pedido -->
                            <label class="font_global_Subtitulo_black font_margin_10px">Pedidos:</label>
                                <select  id="filtro_pedidos" class="font_global_Subtitulo_black font_margin_10px" onchange = 'criarCookie("pedidosMenu", this.value , 1); enviarLocalStorage("filtro_pedido" , this.value); this.form.submit()' >
                                    <option value="Todos" selected >Todos</option>
                                    <option value="Mercado_Livre" selected >Mercado_Livre</option>
                                    <?php
                                        pegar_tipo_pedidos('pedidos' , $conectar , $dataInput);
                                    ?>
                                </select>
                       </div>
                       <!-- Escolher tipo de estoque -->
                       <div class="divs_padrao_row">
                            <label class="font_global_Subtitulo_black font_margin_10px">Estoque :</label>
                                <select  id="filtro_estoque" class="font_global_Subtitulo_black font_margin_10px" onchange = 'criarCookie("estoqueMenu", this.value , 1); enviarLocalStorage("filtro_estoque" , this.value); this.form.submit()' >
                                    <option value="Todos" >Todos</option>
                                    <?php
                                        titulosDoEstoque($conectar);
                                    ?>
                                </select>
                       </div>
                       <!-- Escolher tipo de Numeração -->
                       <div class="divs_padrao_row">
                            <label class="font_global_Subtitulo_black font_margin_10px">Numeração:</label>
                            <input id="filtro_numero" min="0" class="font_global_Subtitulo_black font_margin_10px" type="number" placeholder="Nº" onchange = 'criarCookie("numeracaoMenu", this.value , 1); enviarLocalStorage("filtro_numero" , this.value); this.form.submit()' >
                       </div>
                       <!-- Escolher filtrar pedidos Flex -->
                       <div class="divs_padrao_row">
                           <input id="filtro_flex" value="checkFlex" class="font_global_Subtitulo_black font_margin_10px checkMenuFlex" type="checkbox" onclick = ' enviarLocalStoCheckBox("filtro_flex" , this); this.form.submit()' >
                           <label for="filtro_flex" class="font_global_Subtitulo_black font_margin_10px">Pedidos Flex</label>
                       </div>

                    <label class="font_global_Subtitulo_vinho font_margin_20px" >-- Configuração seleção --</label>
                    <div class="divs_padrao_row">

                           <input id="check_config_estoque" value="check_config_estoque" class="font_global_Subtitulo_black font_margin_10px checkMenuFlex" type="checkbox" onclick = ' enviarLocalStoCheckBox("check_config_estoque" , this); this.form.submit()' >
                           <label for="check_config_estoque" class="font_global_Subtitulo_black font_margin_10px">Não Tirar/Repor estoque</label>
                       </div>
                    </div>
                </div>
            </form>
        </div> 
        <?php


    }
?>