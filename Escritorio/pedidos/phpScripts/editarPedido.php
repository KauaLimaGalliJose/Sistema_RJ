<?php
    include_once '../../../phpIndex/protege.php';
    proteger();
?>
<?php
    //Variaveis Global
    ?><div id="banco"><?php include_once('../../../conexao.php'); ?></div><?php

    date_default_timezone_set('America/Sao_Paulo'); // Fuso horário de Brasília
?>

<?php /////////////////////////////////////////////////////////////////////////////////////
    // Para Enviar Cookies 
    function pedidos($conectar, $p , $nomeTabela){

        global $nomePedido, $numeroF, $numeroM, $pdf, $descricaoPedido, $descricaoAlianca, $imagem, 
        $largura, $data, $gravInterna, $gravExterna, $gravExternaCheck, $styleGraveExterna, $unidade, 
        $styleUnidade, $PedraF, $PedraM, $parEstoqueF, $parEstoqueM, $estoquesPersonalizados,$estoqueNenhum,
        $estoquesPersonalizados_selected, $estoquesPersonalizados_style, $estoqueNenhum_style;

        $dados = "SELECT * FROM $nomeTabela WHERE idpedidos = '$p' ";
        $dadosConectar = mysqli_query($conectar,$dados);

            while($linhaDados = mysqli_fetch_assoc($dadosConectar)){


                $nomePedido = $linhaDados['nomePedido'];
                $numeroF = $linhaDados['numF'];
                $numeroM = $linhaDados['numeM'];
                $pdf = $linhaDados['pdf'];
                $descricaoPedido = $linhaDados['descricaoPedido'];
                $descricaoAlianca = $linhaDados['descricaoAlianca'];
                $imagem = $linhaDados['imagem'];
                $largura = $linhaDados['largura'];
                $data = $linhaDados['data_digitada'];

                // gravações
                if(!empty($linhaDados['gravacaoInterna'])){
                    $gravInterna = $linhaDados['gravacaoInterna'];

                }
                if(!empty($linhaDados['gravacaoExterna'])){
                    $gravExterna = $linhaDados['gravacaoExterna'];
                    $gravExternaCheck = 'checked';
                    $styleGraveExterna = 'style="visibility: visible;"';

                }

                // Verifica se o pedido é unidade
                if($numeroF == 40){
                    $unidade = 'checked';
                    $styleUnidade = 'style="visibility: hidden;"';
                }

                //pedras
                if($linhaDados['PedraF'] == true){
                    $PedraF = 'checked';
                }
                if($linhaDados['PedraM'] == true){

                    $PedraM = 'checked';
                }

                // Estoques
                if($linhaDados['parEstoqueF'] == true){
                    $parEstoqueF = 'checked';
                }
                if($linhaDados['parEstoqueM'] == true){

                    $parEstoqueM = 'checked';
                }
                if($linhaDados['estoque'] == NULL || $linhaDados['estoque'] == 'Nenhum'){
                    
                    $estoqueNenhum_style = 'style="display: flex;"';
                    $estoqueNenhum = 'selected';
                    
                    $estoquesPersonalizados == null;
                    $estoquesPersonalizados_selected = '';
                    $estoquesPersonalizados_style = 'style="display: none;"';
                    
                }
                else{
                    $estoquesPersonalizados = $linhaDados['estoque'];
                    $estoquesPersonalizados_selected = 'selected';
                    $estoquesPersonalizados_style = 'style="display: flex;"';
                    
                    $estoqueNenhum = '';
                    $estoqueNenhum_style = 'style="display: none;"';
                }
            }

    }

    if(!empty($_GET['idpedidos'])){

        $p = $_GET['idpedidos'];
        $pPrint = explode("-", $p);
        $pSplit = str_split($p,1);

        //Variaveis NULL
        $mercadoLivre = null;
        $loja = null;
        $outros = null;
        $styleMercadoLivre = null;
        $unidade = null;
        $styleUnidade = null;
        $gravInterna = null;
        $gravExterna = null;
        $gravExternaCheck = null;
        $styleGraveExterna = null;
        $PedraF = null;
        $PedraM = null;
        $parEstoqueF = null;
        $parEstoqueM = null;
        $estoquesPersonalizados = null;

        //variaveis hidden
        $loja_type = 'none';
        $mercadoLivre_type = 'none';
        $outros_type = 'none';

        if($pSplit[1] === "F" || $pSplit[1] === "G" || $pSplit[1] === "E"){

            //Variaveis do tipo do pedido radio
            $mercadoLivre = 'checked';
            $mercadoLivre_type = 'flex';

        
            if($pSplit[1] === "F"){

                pedidos($conectar, $p , 'pedidosp');
            }
            elseif($pSplit[1] === "G"){

                pedidos($conectar, $p , 'pedidospg');
            }
            elseif($pSplit[1] === "E"){

                pedidos($conectar, $p , 'pedidospe');
                
            }
        }
    }


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="../../../coroa.png" type="image/x-icon">
    <link rel="stylesheet" href="../../PG2-Escritorio.css">
    <script src="../../../scripts/importadosLocais/jquery-3.7.1.min.js"></script>
    <script src="../js/mainEditarPedidos.js" type="module" defer></script>
    <title>Escritório</title>
</head>
<body>
   <main>
    <form id="formulario"  enctype="multipart/form-data" >
        <div id="cabecalho">
            <div id="cabecalho_cima">
                <div id="casa">
                    <button type="button" value=""  class="botao" >
                    <a href="../../../Escritorio/pedidos/pedidos.php"><img class="itens" src="../../Escritorio_img/casa.png"></a>
                    </button>
        
                </div>
                <div id="ferramentas">
                    <button type="button" id="editar" value="" class="botao">
                    <a href="../pedidos.php"><img class="itens" src="../../Escritorio_img/editar.png"></a>
                    </button>
        
                    <button type="button" id="limpar" value="" class="botao">
                        <img class="itens" src="../../Escritorio_img/lixeira.png">
                    </button>
                </div>
                <div id="enviar">
                    <button id="btEnviar" type="button"  value="enviar" >
                            <div class="svg-wrapper-1">
                              <div class="svg-wrapper">
                                <svg
                                  xmlns="http://www.w3.org/2000/svg"
                                  viewBox="0 0 24 24"
                                  width="24"
                                  height="24"
                                >
                                  <path fill="none" d="M0 0h24v24H0z"></path>
                                  <path
                                    fill="currentColor"
                                    d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"
                                  ></path>
                                </svg>
                              </div>
                            </div>
                            <span>Enviar</span>
                    </button>
                </div>
            </div>
            <div id="cabecalho_baixo">
                <div id="tipo_pedido">
                        <input type="radio" style="display:<?php echo $mercadoLivre_type; ?>" id="c1" value="Mercado_Livre" name = 'cliente' class="radio" <?php echo $mercadoLivre ?>><label for="c1" style="display:<?php echo $mercadoLivre_type; ?> ;">Mercado Livre</label> 
                        <input type="radio" style="display:<?php echo $loja_type; ?>" id="c2" value="showroom" name = 'cliente' class="radio" <?php echo $loja ?>><label for="c2" style="display:<?php echo $loja_type; ?> ;" >Loja</label> 
                        <input type="radio" style="display:<?php echo $outros_type; ?>" value="Outros"  id="c3" name = 'cliente' class="radio" <?php echo $outros ?>><label for="c3" style="display:<?php echo $outros_type; ?> ;">Outros:</label>  
                        <input type="text" id="outros"  name="txtcliente"  placeholder="Cliente...">
                </div>
            </div>
        </div>
        <div id="conteudo">
            <div id="data">
             Estoque 
             <select id="estoque" name = 'estoque' > 
                <option value="Nenhum" id="NenhumEstoque" <?php echo $estoqueNenhum; echo $estoqueNenhum_style; ?>>Nenhum</option>
                <span class="font_red"><option value="<?php echo $estoquesPersonalizados ?>" <?php echo $estoquesPersonalizados_style; echo $estoquesPersonalizados_selected; ?>><?php echo $estoquesPersonalizados ?></option></span>
                <?php
                    include_once('../../Estoque/phpScripts/puxarDados.php');
                    titulosDoEstoque($conectar);
                ?>
             </select>
            </div>
            <div id="pedido_input">
                <div id="direita_input">
                    <div id="numeracao_div">
                        Número do Pedido:
                          <select id="n_p" <?php echo $styleMercadoLivre; ?> name="numeroPedido" class="pedido" >
                                <option value='N'  id="Nenhum" >N</option>
                                <option value='<?php echo $pPrint[0]  ?>' id="P1" selected >
                                    <?php echo  $pPrint[0] ?>
                                </option>
                    
                        </select>
                        <input type="text" <?php echo $styleMercadoLivre; ?> value="<?php echo $nomePedido; ?>" id="nome_m" name="nome_m" placeholder="Pedido..." >
                        <input type="text" id="nome_p" name="nome_p" placeholder="Pedido..." >
                    </div>
                    <div id="numeracao">
                        Númeração M:<input min="0" type="number" id="numeracao_m" value='<?php echo $numeroM;  ?>' name="m" placeholder="M" >
                        F:<input min="0" type="number" id="numeracao_f" value='<?php echo $numeroF; ?>' name="f"  placeholder="F"  <?php echo $styleUnidade?>>
                       </div>
                    <div id="unidade">
                       <label for="checkboxFeminina">Unidade:</label><input type="checkbox" id="checkboxFeminina"  name = 'pé' class="radio" <?php echo $unidade ?> >
                    </div>
                    <div id="descricao_div">
                        <textarea id="descricao_Pedido" value = '<?php echo $descricaoPedido; ?>' name="descricao_Pedido" class="descricao" placeholder="Descrição do Pedido..."  ><?php echo $descricaoPedido; ?></textarea>
                        <textarea id="descricao_Alianca" value = '<?php echo $descricaoAlianca; ?>' name="descricao_Alianca" class="descricao" placeholder="Descrição da Alianças..."  ><?php echo $descricaoAlianca; ?></textarea>
                    </div>
                </div>
                    <div id="imagem_p" >
                        <div id="pdfSalvo">
                        </div>
                        <div id="PDF">
                            <label id="PdfBT" for="inputPDF">
                                <img class="botaoPDF" id="imagemPdf" src="../imagemPedido/pdf.png">
                            </label>
                            <input id="inputPDF" class="fileBt" name="pdf" accept="application/pdf"  src="#" type="file" >
                            
                        </div>
                        <label class="botaoImg">
                        <input type="file" src="../../<?php echo $imagem ; ?>" class="fileBt" name="imagem" id="uploadimg" accept="image/png, image/jpeg, image/jpg">
                            Enviar Imagem
                        </label>
                        <div id="modelo">
                        <img id="modelo_rainha" src="../../Escritorio_img/rj.png.webp" alt="rainha" style="display: none;">
                        <img id="modelo2" src="../../<?php echo $imagem ; ?>" alt="Falha ao carregar imagem" style="display: block;">
                        </div>
                    </div>
                        <div id="esquerda_input">
                            <div id="dia_horas">
                                <div id="Div_entrega">
                                    Entrega:<input id="entrega" value="<?php echo $data; ?>" name="dataEntrega" type="date">
                                </div>Largura
                                <select name="largura" id="horaPedido">
                                    <option id="<?php echo $largura; ?>" class="spanRed" selected ><?php echo $largura ;?></option>
                                    <option id="2mm">2mm</option>
                                    <option id="3mm" >3mm</option>
                                    <option id="4mm" >4mm</option>
                                    <option id="5mm" >5mm</option>
                                    <option id="6mm" >6mm</option>
                                    <option id="7mm" >7mm</option>
                                    <option id="8mm" >8mm</option>
                                    <option id="9mm" >9mm</option>
                                    <option id="10mm" >10mm</option>
                                    
                                </select>
                            </div>
                            <div id="grav_externa">
                                <textarea name="gravacao_exter" class="grav_input" id="grav_externaInput" placeholder="Gravações Externa..." <?php echo $styleGraveExterna; ?>><?php echo $gravExterna; ?></textarea>   
                            </div>
                            <textarea name="gravacao_inter" id="grav_internaInput" class="grav_input" placeholder="Gravações do Pedido..."><?php echo $gravInterna; ?></textarea>   
                        </div>
                        
            </div>
        </div>
        <footer id="rodape">
            <div id="envioP">
                <label class="font_red"> <?php
                    echo 'Editando';
                ?></label>
            </div>
            <input type="checkbox" id="gravacao_externa"  name = 'gravacao_externa' class="radio" <?php echo $gravExternaCheck ?>><label for="gravacao_externa">Gravação Externa</label>
            <div class="div_footer">
                <input type="checkbox" id="comPedra" name = 'comPedra' <?php echo $PedraF; ?> class="radio" ><label for="comPedra">Feminina pedra</label>
                <input type="checkbox" id="semPedra" name = 'semPedra' <?php echo $PedraM; ?> class="radio"  ><label for="semPedra">Mascolina Pedra</label>
            </div>
            <div class="div_footer">
                <input type="checkbox" value="" id="estoqueFeminina"  name = 'estoqueFeminina' class="radio"  <?php echo $parEstoqueF  ?>><label for="estoqueFeminina">Feminina Estoque</label>
                <input type="checkbox" value="" id="estoqueMasculina"  name = 'estoqueMasculina' class="radio" <?php echo $parEstoqueM ?>><label for="estoqueMasculina">Masculina Estoque</label>
            </div>
        </footer>
    </form>
   </main>
</body>
</html>