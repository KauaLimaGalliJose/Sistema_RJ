<?php
    //Variaveis Global
    ?><div id="banco"><?php include_once('../conexao.php'); ?></div><?php

    date_default_timezone_set('America/Sao_Paulo'); // Fuso horário de Brasília
    $data = date('Y-m-d');
?>
<?php /////////////////////////////////////////////////////////////////////////////////////////
    //Conectar com Banco de Dados para Criar o Pedido PF00 ,PG00 ,PE00
    //PF
    $pf00 = "SELECT idpedidos FROM pedidosp WHERE idpedidos LIKE '%PF00-$data%'";
    $conectarpf00 = mysqli_query($conectar, $pf00);
    //PG
    $pg00 = "SELECT idpedidos FROM pedidospg WHERE idpedidos LIKE '%PG00-$data%'";
    $conectarpg00 = mysqli_query($conectar, $pg00);
    //PE
    $pe00 = "SELECT idpedidos FROM pedidospe WHERE idpedidos LIKE '%PE00-$data%'";
    $conectarpe00 = mysqli_query($conectar, $pe00);

    //Criando o PF0
    if(mysqli_num_rows($conectarpf00) == 0 ){
        mysqli_query($conectar, "INSERT INTO pedidosp 
        (contadorpf, idpedidos, cliente, nomePedido, numF, numeM, descricaoPedido, descricaoAlianca,largura, gravacaoInterna, gravacaoExterna,imagem,parEstoqueF,parEstoqueM,PedraF,PedraM) 
        VALUES (0,'PF00-$data','teste', 'teste', 0, 0, 'teste', 'teste','2mm', '', '','../','','','','')");
    }
     //Criando o PG0
    if(mysqli_num_rows($conectarpg00) == 0 ){
        mysqli_query($conectar, "INSERT INTO pedidospg
        (contadorpg, idpedidos, cliente, nomePedido, numF, numeM, descricaoPedido, descricaoAlianca,largura, gravacaoInterna, gravacaoExterna,imagem,parEstoqueF,parEstoqueM,PedraF,PedraM) 
        VALUES (0,'PG00-$data','teste', 'teste', 0, 0, 'teste', 'teste','2mm', '', '','../','','','','')");
        }
    //Criando o PE0
    if(mysqli_num_rows($conectarpe00) == 0 ){
        mysqli_query($conectar, "INSERT INTO pedidospe
        (contadorpe, idpedidos, cliente, nomePedido, numF, numeM, descricaoPedido, descricaoAlianca,largura, gravacaoInterna, gravacaoExterna,imagem,parEstoqueF,parEstoqueM,PedraF,PedraM) 
        VALUES (0,'PE00-$data','teste', 'teste', 0, 0, 'teste', 'teste','2mm', '', '','../','','','','')");
        }
?>
 <?php /////////////////////////////////////////////////////////////////////////////////////
    // Para Enviar Cookies 
    function CokiesP($nome,$numero){
        setcookie($nome,intval($numero), time() + (365 * 86400 * 1000), "/");
    }

    //Conectar com Banco de Dados para Atualizar pagina com pedido Atual
    //PF
    $dadosVerificadorP = "SELECT * FROM pedidosp WHERE idpedidos LIKE '%$data%' ORDER BY contadorpf DESC LIMIT 1";
    $VerificadorP = mysqli_query($conectar, $dadosVerificadorP);

    while($linhapf = mysqli_fetch_assoc($VerificadorP)){
        $pf = explode("-",$linhapf['idpedidos']);
        $numeroPf = str_replace("PF","",$pf[0]);
        $numeroPfDisplay = $numeroPf + 1;
        $letraPf = preg_replace("/[^a-zA-Z]/", "", $pf[0]);
        CokiesP('contadorPf',$numeroPf);
        $idPf = $numeroPfDisplay;
        CokiesP('idPf',$idPf);
    }
    //PG
    $dadosVerificadorPG = "SELECT * FROM pedidospg WHERE idpedidos LIKE '%$data%' ORDER BY contadorpg DESC LIMIT 1";
    $VerificadorPG= mysqli_query($conectar, $dadosVerificadorPG);

    while($linhapg = mysqli_fetch_assoc($VerificadorPG)){
        $pg = explode("-",$linhapg['idpedidos']);
        $numeroPg = str_replace("PG","",$pg[0]);
        $numeroPgDisplay = $numeroPg + 1;
        $letraPg = preg_replace("/[^a-zA-Z]/", "", $pg[0]);
        CokiesP('contadorPg',$numeroPg);
        $idPg = $numeroPgDisplay;
        CokiesP('idPg',$idPg);
    }
    //PE
    $dadosVerificadorPE = "SELECT * FROM pedidospe WHERE idpedidos LIKE '%$data%' ORDER BY contadorpe DESC LIMIT 1";
    $VerificadorPE= mysqli_query($conectar, $dadosVerificadorPE);

    while($linhape = mysqli_fetch_assoc($VerificadorPE)){
        $pe = explode("-",$linhape['idpedidos']);
        $numeroPe = str_replace("PE","",$pe[0]);
        $numeroPeDisplay = $numeroPe + 1;
        $letraPe = preg_replace("/[^a-zA-Z]/", "", $pe[0]);
        CokiesP('contadorPe',$numeroPe);
        $idPe = $numeroPeDisplay;
        CokiesP('idPe',$idPe);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="shortcut icon" href="../coroa.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="PG2-Escritorio.css">
    <script src="../Importados/sistemaGoogleDocumentos.js" type="module"></script>
    <script src="../Importados/jquery-3.7.1.min.js"></script>
    <script src="main.js" type="module" defer></script>
    <title>Escritório</title>
</head>
<body>
   <main>
    <form id="formulario" enctype="multipart/form-data" action="PG2_Escritorio1.php" method="post">
        <div id="cabecalho">
            <div id="cabecalho_cima">
                <div id="casa">
                    <button type="button" value=""  class="botao" >
                    <a href="../index.html"><img class="itens" src="casa.png"></a>
                    </button>
        
                    <button type="button" id="seta_esquerda" value="" class="botao" >
                        <img class="seta" src="angulo-esquerdo.png">
                    </button>
        
                    <button type="button" id="seta_direita" value="" class="botao" >
                        <img class="seta" src="angulo-direito.png">
                    </button>
                </div>
                <div id="ferramentas">
                    <button type="button" id="editar" value="" class="botao">
                    <a href="pedidos/pedidos.php"><img class="itens" src="editar.png"></a>
                    </button>
        
                    <button type="button" id="pasta_aberta" value="" class="botao">
                    <img class="itens" src="pasta-aberta.png">
                    </button>
                    <img class="itens" src="upload-de-pasta.png">
                    <img class="itens" src="download-de-pasta.png">
        
                    <button type="button" value="" class="botao">
                        <a href="Estoque/Estoque_Pagina_Inicial.html"><img class="itens" src="aliancas-de-casamento.png"></a>
                    </button>
        
                    <button type="button" id="limpar" value="" class="botao">
                        <img class="itens" src="lixeira.png">
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
                        <input type="radio" onchange="" id="c1" value="Mercado_Livre" name = 'cliente' class="radio"><label for="c1">Mercado Livre</label> 
                        <input type="radio" onchange="" id="c2" value="showroom" name = 'cliente' class="radio"><label for="c2">Showroom</label> 
                        <input type="radio" value="Outros"  id="c3" name = 'cliente' class="radio" ><label for="c3">Outros:</label>  
                        <input type="text" id="outros"  name="txtcliente"  placeholder="Cliente...">
                </div>
            </div>
        </div>
        <div id="conteudo">
            <div id="data">
             20/05/24
            </div>
            <div id="pedido_input">
                <div id="direita_input">
                    <div id="numeracao_div">
                        Número do Pedido:
                          <select id="n_p" name="numeroPedido" class="pedido" >
                                <option value='N'  id="Nenhum" >Escolha</option>
                                <option value='<?php echo $letraPf . $numeroPf; ?>' id="P1" >
                                    <?php echo  $letraPf . $numeroPfDisplay;?>
                                </option>
                           
                                <option value="<?php echo $letraPg . $numeroPg; ?>" id="PG1" >
                                    <?php echo  $letraPg . $numeroPgDisplay;?>
                                </option>
                           
                                <option value="<?php echo $letraPe . $numeroPe; ?>" id="PE1" >
                                    <?php echo  $letraPe . $numeroPeDisplay;?> 
                                </option>
                        </select>
                        <input type="text" id="nome_m" name="nome_m" placeholder="Pedido..." >
                        <input type="text" id="nome_p" name="nome_p" placeholder="Pedido..." >
                    </div>
                    <div id="numeracao">
                        Númeração M:<input type="number" id="numeracao_m" value='' name="m" placeholder="M" >
                        F:<input type="number" id="numeracao_f" value='' name="f"  placeholder="F" >
                       </div>
                    <div id="unidade">
                       <label for="checkboxFeminina">Unidade:</label><input type="checkbox" id="checkboxFeminina"  name = 'pé' class="radio" >
                    </div>
                    <div id="descricao_div">
                        <textarea id="descricao_Pedido" name="descricao_Pedido" class="descricao" placeholder="Descrição do Pedido..."  ></textarea>
                        <textarea id="descricao_Alianca" name="descricao_Alianca" class="descricao" placeholder="Descrição da Alianças..."  ></textarea>
                    </div>
                </div>
                    <div id="imagem_p" >
                        <div id="pdfSalvo">
                        </div>
                        <div id="PDF">
                            <label id="PdfBT" for="inputPDF">
                                <img class="botaoPDF" id="imagemPdf" src="./pedidos/imagemPedido/pdf.png">
                            </label>
                            <input id="inputPDF" class="fileBt" name="pdf" accept="application/pdf"  type="file" >
                            
                        </div>
                        <label class="botaoImg">
                        <input type="file" src="#" class="fileBt" name="imagem" id="uploadimg" accept="image/png, image/jpeg, image/jpg">
                            Enviar Imagem
                        </label>
                        <div id="modelo">
                        <img id="modelo_rainha" src="rj.png.webp" alt="rainha">
                        <img id="modelo2" src="#" alt="Pré-visualização da Imagem" style="display: none;">
                        </div>
                    </div>
                        <div id="esquerda_input">
                            <div id="dia_horas">
                                <div id="Div_entrega">
                                    Entrega:<input id="entrega" name="dataEntrega" type="date">
                                </div>Largura
                                <select  name="largura" id="horaPedido">
                                    <option id="2mm">2mm</option>
                                    <option id="3mm" selected >3mm</option>
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
                    echo 'Sem Pedido';
                ?></label>
            </div>
            <input type="checkbox" id="gravacao_externa"  name = 'gravacao_externa' class="radio"><label for="gravacao_externa">Gravação Externa</label>
            <div class="div_footer">
            <input type="checkbox" id="comPedra" name = 'comPedra' class="radio" ><label for="comPedra">Feminina pedra</label>
            <input type="checkbox" id="semPedra" name = 'semPedra' class="radio" ><label for="semPedra">Masculina Pedra</label>
            <div class="div_footer">
            <input type="checkbox" value="" id="estoqueFeminina"  name = 'estoqueFeminina' class="radio"><label for="estoqueFeminina">Feminina Estoque</label>
            <input type="checkbox" value="" id="estoqueMasculina"  name = 'estoqueMasculina' class="radio"><label for="estoqueMasculina">Masculina Estoque</label>
            </div>
        </footer>
    </form>
   </main>
</body>
</html> 