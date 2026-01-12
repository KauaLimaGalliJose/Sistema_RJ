<?php
namespace pedidosPesquisa;

use pedidosPesquisa\Pedidos_Blocos; 

class Pedidos_Linha extends Pedidos_Blocos { 

    // Escritorio\pedidos\pedidos.php
    ///////////////////////////////-------------------Pedidos----------------------////////////////////////////////////////////////////////////// 
    function select(){
    
            $this->montar_Sql();
    
            while ($dados =  $this->resultadoDados->fetch_assoc() ) {
    
            // Variaveis para verificação ---
            $nomePedido = $dados['nomePedido'];
    
            if(stripos($nomePedido, 'flex') !== false){
    
                $flex = 'flex';
            }
            else{
    
                $flex = 'none';
            }
    
            $pf = explode("-" , $dados['idpedidos']);
            $dataPedido = explode('-' , $dados['data_digitada']);
            
            ?><div class="pedidostexto"><label><?php
            ?><div class="tituloPedido">
                <h2><?php print( $pf[0].' -- '.$dados['nomePedido'].' -- '); ?><span class="font_red"><?php print($dataPedido[2] . '/' . $dataPedido[1] );?></span></h2>
            </div>
            <?php
    
            //Variaveis Null
            $pedido = explode('-',$dados['idpedidos']);
            $estoqueF = '';
            $estoqueM = '';
            $PedraF = '';
            $PedraM = '';
            $gravacaoF = $dados['numF'] ;
    
            if($this->cookies['pedidosMenu'] != 'Mercado_Livre' ){
                
                $pedidosOutros = $pedido[1] .'-' . $pedido[2] . '-' . $pedido[3] . '-' . $pedido[4];  
                $pedido = explode('-',$pedidosOutros);
            
                $pedidoLabel = '<span class = "fontBlu" >' . $dados['nomePedido'] . ' - <span class = "fontRed" > ' . $pedido[3] . '/' . $pedido[2] . '</span></span>';
            }
            else{
            
                $pedidoLabel = '<span class = "fontBlu" >' . $pedido[0] . ' - ' .$dados['nomePedido'] . ' - <span class = "fontRed" > ' . $pedido[3] . '/' . $pedido[2] . '</span></span>';
            }
            //Verificando Numeração Feminina
            if($dados['numF'] == 40){
    
                $numeroFeminino = 'não tem';
                $numeroFemininoLabel = '<br> Unidade :';
            }
            else{
    
                $numeroFeminino = $dados['numF'];
                $numeroFemininoLabel = 'Masculina: ';
            }
    
            // gravação interna 
            if($dados['gravacaoInternaM'] !== '' || $dados['gravacaoInternaF'] !== '' ){
    
                $gravacao = '<span class="font_blu">F: </span>' . $dados['gravacaoInternaF'] ?? '';
                $gravacao .=  '<br>' . '<span class="font_blu">M: </span>' . $dados['gravacaoInternaM'] ?? '';
    
                $gravacaoInternaT = '<div class="informacaoInferior"><span class="font_blu">Gravação --------</span><br>' . $gravacao . '</div>';
    
            }
            else{
                $gravacaoInternaT = '';
            }
    
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
    
                        if($numeroFeminino !== 'não tem'){
    
                            print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino . $estoqueF . $PedraF . "<br>"); ?></span><?php
                        }
                        print($numeroFemininoLabel);?><span class="font_red"><?php print($dados['numeM'] . $estoqueM . $PedraM . "<br>"); ?></span>
                    </div>
                        <?php echo $gravacaoInternaT . "<br>"?>
                </div>
                <?php echo $gravacaoExterna?>
                </label></div><?php          
        }
    }
    
    // Escritorio\pedidos\pedidos.php
    ///////////////////////////////-------------------Imagem----------------------////////////////////////////////////////////////////////////// 
    function selectImagem(){
    
            $this->montar_Sql();
    
            while ($dadosImagem =  $this->resultadoDados->fetch_assoc() ) {
                
            // Variaveis para verificação ---
            $nomePedido = $dadosImagem['nomePedido'];
    
            if(stripos($nomePedido, 'flex') !== false){
    
                $flex = 'flex';
            }
            else{
    
                $flex = 'none';
            }
            
                ?><div class="pedidosImagem"><?php
                ?><img class = "Imagem" src="<?php echo $this->caminhoImgem .$dadosImagem['imagem'];?>" alt="Imagem do Pedido"><?php
                ?></div>
                <div class="btPedidos">
                <button class = 'Pdf' type="button"><a class="PdfAncora" href="<?php echo $this->caminhoImgem . $dadosImagem['pdf']?>">PDF</a></button>
                <button class = 'Pdf' type="button"><a class="PdfAncora" target="_blank" href="<?php echo './phpScripts/editarPedido.php?idpedidos=' . $dadosImagem['idpedidos'] . '&estoque=' . $dadosImagem['estoque']; ?>">Editar</a></button>
                </div>
                <?php
                          
        }
    }
}


