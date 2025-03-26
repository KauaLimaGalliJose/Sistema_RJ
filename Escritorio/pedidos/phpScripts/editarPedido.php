<?php
    //Variaveis Global
    ?><div id="banco"><?php include_once('../../../conexao.php'); ?></div><?php

    date_default_timezone_set('America/Sao_Paulo'); // Fuso horário de Brasília
    $data = date('Y-m-d');
?>

<?php /////////////////////////////////////////////////////////////////////////////////////
    // Para Enviar Cookies 
    function CokiesP($nome,$numero){
        setcookie($nome,intval($numero), time() + (365 * 86400 * 1000), "/");
    }

    if(!empty($_GET['idpedidos'])){

        $p = $_GET['idpedidos'];
        $pPrint = explode("-", $p);
        $pSplit = str_split($p,1);

        //Variaveis NULL
        $mercadoLivre = null;
        $styleMercadoLivre = null;
        $unidade = null;
        $styleUnidade = null;

        if($pSplit[1] === "F"){
            
            $dados = "SELECT * FROM pedidosp WHERE idpedidos = '$p' ";
            $dadosConectar = mysqli_query($conectar,$dados);

            while($linhaDados = mysqli_fetch_assoc($dadosConectar)){


                //Variaveis do VALUES
                $mercadoLivre = 'checked';
                $styleMercadoLivre = 'style="visibility: visible;"';

                $nomePedido = $linhaDados['nomePedido'];
                $numeroF = $linhaDados['numF'];
                $numeroM = $linhaDados['numeM'];
                $descricaoPedido = $linhaDados['descricaoPedido'];
                $descricaoAlianca = $linhaDados['descricaoAlianca'];
                $imagem = $linhaDados['imagem'];
                $largura = $linhaDados['largura'];
               

                if($numeroF == 40){
                    $unidade = 'checked';
                    $styleUnidade = 'style="visibility: hidden;"';
                }
            }

        }
        elseif($pSplit[1] === "G"){

            $dadosPg = "SELECT * FROM pedidospg WHERE idpedidos = '$p' ";
            $dadosConectarPg = mysqli_query($conectar,$dadosPg);

            while($linhaDadosPg = mysqli_fetch_assoc($dadosConectarPg)){

                //Variaveis do VALUES
                $mercadoLivre = 'checked';
                $styleMercadoLivre = 'style="visibility: visible;"';
                
                $mercadoLivre = 'checked';
                $styleMercadoLivre = 'style="visibility: visible;"';
                $nomePedido = $linhaDadosPg['nomePedido'];
                $numeroF = $linhaDadosPg['numF'];
                $numeroM = $linhaDadosPg['numeM'];
                $descricaoPedido = $linhaDadosPg['descricaoPedido'];
                $descricaoAlianca = $linhaDadosPg['descricaoAlianca'];
                $imagem = $linhaDadosPg['imagem'];
                $largura = $linhaDadosPg['largura'];
                

                if($numeroF == 40){
                    $unidade = 'checked';
                    $styleUnidade = 'style="visibility: hidden;"';
                }
            }

        }
        elseif($pSplit[1] === "E"){

            $dadosPe = "SELECT * FROM pedidospe WHERE idpedidos = '$p' ";
            $dadosConectarPe = mysqli_query($conectar,$dadosPe);

            while($linhaDadosPe = mysqli_fetch_assoc( $dadosConectarPe)){

                //Variaveis do VALUES
                $mercadoLivre = 'checked';
                $styleMercadoLivre = 'style="visibility: visible;"';

                $nomePedido = $linhaDadosPe['nomePedido'];
                $numeroF = $linhaDadosPe['numF'];
                $numeroM = $linhaDadosPe['numeM'];
                $descricaoPedido = $linhaDadosPe['descricaoPedido'];
                $descricaoAlianca = $linhaDadosPe['descricaoAlianca'];
                $imagem = $linhaDadosPe['imagem'];
                $largura = $linhaDadosPe['largura'];
                
                


                if($numeroF == 40){
                    $unidade = 'checked';
                    $styleUnidade = 'style="visibility: hidden;"';
                }

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
    <script src="../../../Importados/jquery-3.7.1.min.js"></script>
    <script src="../js/mainEditarPedidos.js" type="module" defer></script>
    <title>Escritório</title>
</head>
<body>
   <main>
    <form id="formulario"  enctype="multipart/form-data" action="PG2-Escritorio.php" method="post">
        <div id="cabecalho">
            <div id="cabecalho_cima">
                <div id="casa">
                    <button type="button" value=""  class="botao" >
                    <a href="../../../index.html"><img class="itens" src="../../casa.png"></a>
                    </button>
        
                    <button type="button" id="seta_esquerda" value="" class="botao" >
                        <img class="seta" src="../../angulo-esquerdo.png">
                    </button>
        
                    <button type="button" id="seta_direita" value="" class="botao" >
                        <img class="seta" src="../../angulo-direito.png">
                    </button>
                </div>
                <div id="ferramentas">
                    <button type="button" id="editar" value="" class="botao">
                    <a href="../pedidos.php"><img class="itens" src="../../editar.png"></a>
                    </button>
        
                    <button type="button" id="pasta_aberta" value="" class="botao">
                    <img class="itens" src="../../pasta-aberta.png">
                    </button>
                    <img class="itens" src="../../upload-de-pasta.png">
                    <img class="itens" src="../../download-de-pasta.png">
        
                    <button type="button" value="" class="botao">
                        <a href="Estoque/Estoque_Pagina_Inicial.html"><img class="itens" src="../../aliancas-de-casamento.png"></a>
                    </button>
        
                    <button type="button" id="limpar" value="" class="botao">
                        <img class="itens" src="../../lixeira.png">
                    </button>
                </div>
                <div id="enviar">
                    <button id="btEnviar" type="submit"  value="enviar" >
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
                        <input type="radio" id="c1" value="Mercado_Livre" name = 'cliente' class="radio" <?php echo $mercadoLivre ?>><label for="c1">Mercado Livre</label> 
                        <input type="radio" id="c2" value="showroom" name = 'cliente' class="radio"><label for="c2">Showroom</label> 
                        <input type="radio" value="Outros"  id="c3" name = 'cliente' class="radio" ><label for="c3">Outros:</label>  
                        <input type="text" id="outros"  name="txtcliente"  placeholder="Cliente...">
                </div>
            </div>
        </div>
        <div id="conteudo">
            <div id="data">
             Pedido <?php echo $pPrint[0]; ?>
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
                           
                                <option value="<?php echo $pPrint[0]; ?>" id="PG1" >
                                    <?php echo  $pPrint[0];?>
                                </option>
                           
                                <option value="<?php echo $pPrint[0]; ?>" id="PE1" >
                                    <?php echo  $pPrint[0];?> 
                                </option>
                        </select>
                        <input type="text" <?php echo $styleMercadoLivre; ?> value="<?php echo $nomePedido; ?>" id="nome_m" name="nome_m" placeholder="Pedido..." >
                        <input type="text" id="nome_p" name="nome_p" placeholder="Pedido..." >
                    </div>
                    <div id="numeracao">
                        Númeração M:<input type="number" id="numeracao_m" value='<?php echo $numeroM;  ?>' name="m" placeholder="M" >
                        F:<input  type="number" id="numeracao_f" value='<?php echo $numeroF; ?>' name="f"  placeholder="F"  <?php echo $styleUnidade?>>
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
                            <input id="inputPDF" class="fileBt" name="pdf" accept="application/pdf"  type="file" >
                            
                        </div>
                        <label class="botaoImg">
                        <input type="file" src="../../<?php echo $imagem ; ?>" class="fileBt" name="imagem" id="uploadimg" accept="image/png, image/jpeg, image/jpg">
                            Enviar Imagem
                        </label>
                        <div id="modelo">
                        <img id="modelo_rainha" src="../../rj.png.webp" alt="rainha" style="display: none;">
                        <img id="modelo2" src="../../<?php echo $imagem ; ?>" alt="Pré-visualização da Imagem" style="display: block;">
                        </div>
                    </div>
                        <div id="esquerda_input">
                            <div id="dia_horas">
                                <div id="Div_entrega">
                                    Entrega:<input id="entrega" name="dataEntrega" type="date">
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
                                <textarea name="gravacao_exter" class="grav_input" id="grav_externaInput" placeholder="Gravações Externa..."></textarea>   
                            </div>
                            <textarea name="gravacao_inter" id="grav_internaInput" class="grav_input" placeholder="Gravações do Pedido..."></textarea>   
                        </div>
                        
            </div>
        </div>
        <footer id="rodape">
            <div id="envioP">
                <label class="font_red"> <?php
                    echo 'Editando';
                ?></label>
            </div>
            <input type="checkbox" id="gravacao_externa"  name = 'gravacao_externa' class="radio">Gravação Externa
            <div class="div_footer">
                <input type="checkbox" id="comPedra" name = 'comPedra' class="radio">Par com pedra
                <input type="checkbox" id="semPedra" name = 'semPedra' class="radio" >Sem Pedra 
            </div>
            <div class="div_footer">
                <input type="checkbox" value="" id="estoqueFeminina"  name = 'estoqueFeminina' class="radio" >Feminina Estoque
                <input type="checkbox" value="" id="estoqueMasculina"  name = 'estoqueMasculina' class="radio" >Masculina Estoque
            </div>
        </footer>
    </form>
   </main>
</body>
</html> 