<?php 
    //Função Para buscar no Banco de dados 
    function quemRecebeBd($tabela,$contadorp,$pesquisa,$data_Digitada){

        $data = date('Y-m-d');

        if($data_Digitada == '' || $data_Digitada == NULL){
            $data_Digitada = $data;
        }

       $pesquisaDados = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido, idpedidos, numF, numeM, largura, gravacaoInterna, gravacaoExterna, nomePedido ,pdf
       FROM `$tabela`  WHERE `$contadorp` <> 0 
       AND descricaoPedido LIKE '%$pesquisa%'
       AND data_digitada LIKE '$data_Digitada'
 
       OR idpedidos LIKE '%$pesquisa%'
       AND data_digitada LIKE '$data_Digitada'
       ORDER BY `$contadorp` ASC";

       return $pesquisaDados;
      
    }

    //Função Para pesquisar e criar imagens na pagina  
    function quemRecebePesquisaImagem($PesquisaBd,$pesquisa){
         
        while ($dadosImagemP = mysqli_fetch_assoc($PesquisaBd)) {
                        
            ?><div class="pedidosImagem"><?php
            ?><img class = "Imagem" src="<?php echo '../' .$dadosImagemP['imagem'];?>" alt="Imagem do Pedido"><?php
            ?></div>
            <div class="btPedidos">
            <button class = 'Pdf' type="button"><a class="PdfAncora" href="../<?php echo $dadosImagemP['pdf']?>">PDF</a></button>
            <?php 
                if($pesquisa == date('Y-m-d')){
                    ?><button class = 'Pdf' id="editar" type="button"><a class="PdfAncora" target="_blank" href="<?php echo './phpScripts/editarPedido.php?idpedidos=' . $dadosImagemP['idpedidos'] ; ?>">Editar</a></button><?php
                }
                ?>
                </div>
                <?php   
        }
    }

    //Função Para pesquisar e criar divs na pagina
    function quemRecebePesquisa($PesquisaBd){

        while (($dados = mysqli_fetch_assoc($PesquisaBd))) {
                
            $p = explode("-" , $dados['idpedidos']);

            ?><div class="pedidostexto"><label><?php
            ?><div class="tituloPedido">
                <h2><?php print( $p[0].' -- '.$dados['nomePedido'].' -- '); ?><span class="font_red"><?php print($p[3] . '/' . $p[2] );?></span></h2>
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
                $gravacaoExterna = '<span class="font_blue">Gravação Externa:</span>' . $dados['gravacaoExterna'];
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
                print('<br>Largura:' . $dados['largura']);
                print('<br> Feminina:');?><span class="font_red"><?php print($numeroFeminino .  $estoqueF . $PedraF . "<br>"); ?></span>
                <?php print('Masculina:');?><span class="font_red"><?php print($dados['numeM'] . $estoqueM . $PedraM . "<br>"); ?></span>
                <?php echo $gravacaoInterna . "<br>"?>
                <?php echo $gravacaoExterna?>
                </label></div><?php
            
        }
    }
    //Função para executar as funções anteriores
    function quemRecebe($conectar,$pesquisa,$data_Digitada){

        //PF
        $pfPesquisa =  quemRecebeBd('pedidosp','contadorpf',$pesquisa,$data_Digitada);
        $pfPesquisaBd = mysqli_query($conectar,$pfPesquisa);
        //PG
        $pgPesquisa =  quemRecebeBd('pedidospg','contadorpg',$pesquisa,$data_Digitada);
        $pgPesquisaBd = mysqli_query($conectar,$pgPesquisa);
        //PE
         $pePesquisa =  quemRecebeBd('pedidospe','contadorpe',$pesquisa,$data_Digitada);
         $pePesquisaBd = mysqli_query($conectar,$pePesquisa);
  
        //PF
        quemRecebePesquisa($pfPesquisaBd);

        //PG
        quemRecebePesquisa($pgPesquisaBd);
       
        //PE
        quemRecebePesquisa($pePesquisaBd);
     
    }
    //Função para executar as funções anteriores
    function quemRecebeImagem($conectar,$pesquisa,$data_Digitada){

         //PF
         $pfPesquisa =  quemRecebeBd('pedidosp','contadorpf',$pesquisa,$data_Digitada);
         $pfPesquisaBd = mysqli_query($conectar,$pfPesquisa);
         //PG
         $pgPesquisa =  quemRecebeBd('pedidospg','contadorpg',$pesquisa,$data_Digitada);
         $pgPesquisaBd = mysqli_query($conectar,$pgPesquisa);
         //PE
          $pePesquisa =  quemRecebeBd('pedidospe','contadorpe',$pesquisa,$data_Digitada);
          $pePesquisaBd = mysqli_query($conectar,$pePesquisa);
  
        //PF
        quemRecebePesquisaImagem($pfPesquisaBd,$data_Digitada);

        //PG
        quemRecebePesquisaImagem($pgPesquisaBd,$data_Digitada);
       
        //PE
        quemRecebePesquisaImagem($pePesquisaBd,$data_Digitada);
     
    }
?>