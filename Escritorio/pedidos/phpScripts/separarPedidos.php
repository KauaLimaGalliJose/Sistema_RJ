<?php ///////////////////////////////-------------------PF----------------------////////////////////////////////////////////////////////////// ?>

<?php
function select($conectar,$dataSplit, $tabela_nome , $contador , $data){

        $dadosVerificador = 
        "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido , descricaoAlianca, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido 
         FROM $tabela_nome WHERE $contador != 0
         ORDER BY $contador ASC";
        
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
}
?>
<?php 
///////////////////////////////-------------------Imagem----------------------////////////////////////////////////////////////////////////// 
    function selectImagem($conectar,$dataSplit, $tabela_nome , $contador ,$data){

        $imagem = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, pdf, idpedidos FROM $tabela_nome WHERE $contador != 0 ORDER BY  $contador ASC";
        $imagemConectar = mysqli_query($conectar, $imagem);

        while ($dadosImagem = mysqli_fetch_assoc($imagemConectar)) {
            
            if ($dadosImagem['idpedido'] == $dataSplit[1] . '-' . $dataSplit[2]) {

                ?><div class="pedidosImagem"><?php
                ?><img class = "Imagem" src="<?php echo '../' .$dadosImagem['imagem'];?>" alt="Imagem do Pedido"><?php
                ?></div>
                <div class="btPedidos">
                <button class = 'Pdf' type="button"><a class="PdfAncora" href="../<?php echo $dadosImagem['pdf']?>">PDF</a></button>
                <button class = 'Pdf' type="button"><a class="PdfAncora" target="_blank" href="<?php echo './phpScripts/editarPedido.php?idpedidos=' . $dadosImagem['idpedidos'] ; ?>">Editar</a></button>
                </div>
                <?php
            }
        }
    }
?>
