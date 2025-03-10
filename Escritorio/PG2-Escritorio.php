<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="../coroa.png" type="image/x-icon">
    <link rel="stylesheet" href="PG2-Escritorio.css">
    <script src="../Importados/sistemaGoogleDocumentos.js" type="module"></script>
    <script src="../Importados/cloud.js" type="module"></script>
    <script src="main.js" type="module" defer></script>
    <title>Escritório</title>
</head>
<body>
   <main>
    <form id="formulario" enctype="multipart/form-data" action="PG2-Escritorio.php" method="post">
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
        
                    <button type="reset" id="limpar" value="" class="botao">
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
                        <input type="radio" onchange="" id="c1" value="Mercado_Livre" name = 'cliente' class="radio">Mercado Livre
                        <input type="radio" onchange="" id="c2" value="Centro_Alianca" name = 'cliente' class="radio">Centro das Alianças
                        <input type="radio" value="Outros"  id="c3" name = 'cliente' class="radio" >Outros: 
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
                                <option value='N'  id="Nenhum" >N</option>
    
                                <option value='PF'  id="P1" >PF1</option>
                           
                                <option value="PG" id="PG1" >PG1</option>
                           
                                <option value="PE" id="PE1" >PE1</option>
                        </select>
                        <input type="text" id="nome_m" name="nome_m" placeholder="Pedido..." >
                        <input type="text" id="nome_p" name="nome_p" placeholder="Pedido..." >
                    </div>
                    <div id="numeracao">
                        Númeração M:<input type="number" id="numeracao_m" value='' name="m" placeholder="M" >
                        F:<input type="number" id="numeracao_f" value='' name="f"  placeholder="F" >
                       </div>
                    <div id="unidade">
                        Unidade: <input type="checkbox" id="checkboxFeminina"  name = 'pé' class="radio" >
                    </div>
                    <div id="descricao_div">
                        <textarea id="descricao_Pedido" name="descricao_Pedido" class="descricao" placeholder="Descrição do Pedido..."  ></textarea>
                        <textarea id="descricao_Alianca" name="descricao_Alianca" class="descricao" placeholder="Descrição da Alianças..."  ></textarea>
                    </div>
                </div>
                    <div id="imagem_p" >
                        <label class="botaoImg">
                        <input type="file" src="#" class="fileBt" name="imagem" id="uploadimg" accept="imagem/*">
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
                            <textarea name="gravacao_inter" id="grav_m" class="grav_input" placeholder="Gravações do Pedido..."></textarea>   
                        </div>
            </div>
        </div>
        <footer id="rodape">
            <input type="checkbox" id="gravacao_externa"  name = 'gravacao_externa' class="radio" >Gravação Externa
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