<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
?>
<?php
    if($_POST){

        $pedidos_peso = true;
        $PF_peso = $_POST['PF_peso']??'';
        $PG_peso = $_POST['PG_peso']??'';
        $PE_peso = $_POST['PE_peso']??'';
        $cliente = $_POST['cliente_peso']??'';
        $filtrar_peso = $_POST['filtrar_peso']??'';
        
        if($PF_peso == "PF"){

            $pedidos_peso = false;
            $PF_peso_Select = "checked";
        }
        if($PG_peso == "PG"){
            
            $pedidos_peso = false;
            $PG_peso_Select = "checked";
        }
        if($PE_peso == "PE"){

            $pedidos_peso = false;
            $PE_peso_Select = "checked";
        }

        if($cliente != ''){

            $cliente_selected = 'selected';
            $mercado_Livre_selected = '';
        }

        $div_visible = "
        <script defer>
                document.getElementById('pesoDivMae').style.visibility = 'visible'; 
                document.getElementById('formulario').style.filter = 'brightness(0.65) contrast(0.85) blur(2px)';
                document.getElementById('conteudo').style.filter = 'brightness(0.75) contrast(0.95) blur(2px)';
                document.getElementById('formulario').style.pointerEvents = 'none';
                document.getElementById('conteudo').style.pointerEvents = 'none';
                document.querySelector('footer').style.visibility = 'hidden';
        </script>";
    }
    else{
        $filtrar_peso = '';
        $pedidos_peso = true;
        $div_visible = '';
        $cliente = '';

        $cliente_selected = '';
        $mercado_Livre_selected = 'selected';
    }

    //Variaveis Global
    ?><div id="banco"><?php include_once('../conexao.php'); ?></div><?php

    date_default_timezone_set('America/Sao_Paulo'); // Fuso horário de Brasília
    $data = $_COOKIE['dataInputEscritorio'] ?? date('Y-m-d');

    require './Peso/cadastrar_Peso.php';
    include('../scripts/phpGlobal/backEnd/menu/filtrarClientes.php');
    use Peso\cadastrarPeso;

    $peso_pf = new cadastrarPeso('PF', $conectar ,$cliente);
    $peso_pg = new cadastrarPeso('PG', $conectar ,$cliente);
    $peso_pe = new cadastrarPeso('PE', $conectar, $cliente);
    $peso_pedidos = new cadastrarPeso('pedidos', $conectar, $cliente);


?>
<?php /////////////////////////////////////////////////////////////////////////////////////
    // Para Enviar Cookies 
    function CokiesP($nome,$numero){
        setcookie($nome,intval($numero), time() + (365 * 86400 * 1000), "/");
    }

    //Conectar com Banco de Dados para Atualizar pagina com pedido Atual
    function atualizarPedidos_Bd($tipo ,$data ,$posicao , $conectar , $tabelaSql , $contadorSql){


        $dadosVerificadorP = "SELECT * FROM $tabelaSql WHERE idpedidos LIKE '%$data%' ORDER BY $contadorSql DESC LIMIT 1";
        $VerificadorP = mysqli_query($conectar, $dadosVerificadorP);

        if( mysqli_num_rows($VerificadorP) == 0 ){

            $numero = 0;
            $numeroDisplay = 1; 
        }
        else{

            while($linha = mysqli_fetch_assoc($VerificadorP)){

                $p = explode("-",$linha['idpedidos']);

                $numero = str_replace($tipo,"",$p[0]);
                $numeroDisplay = (int)$numero + 1;
                
                $numero = ($numero == 0) ? 1 : $numero;
            }
        }

        CokiesP($contadorSql,$numero);
        $id = $numeroDisplay;
        CokiesP('id' . $tipo ,$id);

        if($posicao == 'display'){

            $resul = $tipo . $numeroDisplay; 
            return $resul;
        }
        elseif($posicao == 'numero'){
            
            $resul = $tipo . $numero; 
            return $resul;
        }
    }

    // PF
    $Pfcontador = atualizarPedidos_Bd("PF", $data ,'numero' , $conectar , 'pedidosp' , 'contadorpf');
    $Pfcontador_Display = atualizarPedidos_Bd("PF", $data ,'display' , $conectar , 'pedidosp' , 'contadorpf');

    // PG 
    $Pgcontador = atualizarPedidos_Bd("PG", $data ,'numero' , $conectar , 'pedidospg' , 'contadorpg');
    $Pgcontador_Display = atualizarPedidos_Bd("PG", $data ,'display' , $conectar , 'pedidospg' , 'contadorpg');
    
    // PE 
    $Pecontador = atualizarPedidos_Bd("PE", $data ,'numero' , $conectar , 'pedidospe' , 'contadorpe');
    $Pecontador_Display = atualizarPedidos_Bd("PE", $data ,'display' , $conectar , 'pedidospe' , 'contadorpe');



//--------------------------------------------------------
// Função para obter o próximo número
//--------------------------------------------------------
function proximoNumero($con, $tabela, $prefixo, $data) {

    // Busca apenas pedidos do dia (muito mais rápido)
    $sql = "SELECT idpedidos
            FROM $tabela
            WHERE data_digitada = '$data'
            ORDER BY contador{$prefixo} DESC
            LIMIT 1";

    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);

    if (!$row) return 1; // caso não ache nada, começa do 1

    // Ex: PF24-2025-12-04 → pega só o número 24
    $partes = explode("-", $row['idpedidos']);
    $numero = intval(str_replace($prefixo, "", $partes[0]));

    return $numero + 1;
}


//--------------------------------------------------------
// Cookies seguros
//--------------------------------------------------------
function salvarCookie($nome, $valor) {
    setcookie($nome, intval($valor), time() + 86400 * 365, "/");
}


//--------------------------------------------------------
// Gerando PF / PG / PE automáticos
//--------------------------------------------------------

// PF
$idPf = proximoNumero($conectar, "pedidosp", "PF", $data);
salvarCookie("idPF", $idPf);

// PG
$idPg = proximoNumero($conectar, "pedidospg", "PG", $data);
salvarCookie("idPG", $idPg);

// PE
$idPe = proximoNumero($conectar, "pedidospe", "PE", $data);
salvarCookie("idPE", $idPe);

?>
<!DOCTYPE html>
<html lang="pt-br">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS prioritários (sempre no topo) -->
    <link rel="stylesheet" href="PG2-Escritorio.css">
    <link rel="stylesheet" href="../scripts/cssGlobal/fonts/fonts.css">

    <!-- Scripts não bloqueantes -->
    <script src="../scripts/importadosLocais/jquery-3.7.1.min.js" defer></script>
    <script src="main.js" type="module" defer></script>

    <title>Escritório</title>
</head>

<body>
   <main>
    <!-- ----------------------------------------------------------------------------------------- -->
    <!-- DIV EXPORTAR Tinha pego do pedidos.php -->
    <form id="exportarFormulario" action="./ExportarImportar/Exportar/exportar.php" method="post">
        <div id="PdfDivMae">
            <div id="PdfDiv">
                <div id="TituloPdf">
                    <label >-- Exportar --</label>
                </div>
                <div id="dataExportar">
                    <label id="escolhaTXT"> Escolha </label> 
                    <input id="dataExportarInput" name="data" type="date">
                </div>
                <div id="checkboxPdf">
                    <label class="checkboxFont"><input class="selecao" id="PF" name="PF" value="PF" type="checkbox">Todos os PF</label>
                    <label class="checkboxFont"><input class="selecao" id="PG" name="PG" value="PG" type="checkbox">Todos os PG</label>
                    <label class="checkboxFont"><input class="selecao" id="PE" name="PE" value="PE" type="checkbox">Todos os PE</label>
                </div>
            </div>
            <div id="PdfDiv2">
                <button type='button'  id="buttonPdf" class="buttonPdf">
                    <label>Voltar</label>
                </button>
                <button type='submit' id="submitExportar" class="buttonPdf">
                    <label>Baixar</label>
                </button>    
            </div>
        </div>
    </form>
<!-- -------------------------------------------------------------------------------------------------------------------------- -->
     <!-- DIV Importar Tinha pego do pedidos.php -->
     <form id="importarFormulario" action="./ExportarImportar/Importar/importar.php" enctype="multipart/form-data" method="post">
     <div id="PdfDivMaeImportar">
            <div id="PdfDivImportar">
                <div id="TituloPdfImportar">
                    <label >-- Importar --</label>
                </div>
                <div id="fileImportar">
                    <button type="button" class="importBtt" id="importBtt">
                        <label id="dadosImportLabel" for="dadosImport">Escolha o Arquivo</label>
                    </button>

                    <input type="file" id="dadosImport" name="dadosImport">
                </div>
            </div>
            <div id="PdfDiv2">
                <button type='button'  id="buttonPdfImportar" class="buttonPdf">
                    <label>Voltar</label>
                </button>
                <button type='submit' id="submitImportar" class="buttonPdf">
                    <label>Enviar</label>
                </button>    
            </div>
        </div>
     </form>
<!-- -------------------------------------------------------------------------------------------------------------------------- -->
    <form id="formulario" enctype="multipart/form-data" method="post">
        <div id="cabecalho">
            <div id="cabecalho_cima">
                <div id="casa">
                    <button title="Voltar Menu" type="button" value=""  class="botao" >
                    <a href="../menu/index.php"><img class="itens" src="./Escritorio_img/casa.png"></a>
                    </button>
        
                    <button title="Voltar Pedido" type="button" id="seta_esquerda" value="" class="botao" >
                        <img class="seta" src="./Escritorio_img/angulo-esquerdo.png">
                    </button>
        
                    <button type="button" title="Avançar Pedido" id="seta_direita" value="" class="botao" >
                        <img class="seta" src="./Escritorio_img/angulo-direito.png">
                    </button>
                </div>
                <div id="ferramentas">
                    <button type="button" title="Ver Pedidos" id="editar" value="" class="botao">
                    <a href="pedidos/pedidos.php"><img class="itens" src="./Escritorio_img/editar.png"></a>
                    <h1 class="tituloCabecalho">Ver Pedidos</h1>
                </button>
                
                <button type="button" title="Abrir Pasta" id="pasta_aberta" value="" class="botao">
                    <a href="./statusPedidos\statusPedidos.php"><img class="itens" src="./Escritorio_img/pasta-aberta.png"></a>
                    <h1 class="tituloCabecalho">Status</h1>
                </button>
                
                <button type="button" id="exportar" value="" class="botao">
                    <img class="itens" title="Exportar Pedidos" src="./Escritorio_img/upload-de-pasta.png">
                </button>
                
                <button type="button" id="importar" value="" class="botao">
                    <img class="itens" title="Importar Pedidos"  src="./Escritorio_img/download-de-pasta.png">
                </button>
                        
                <button type="button" value="" title="Estoque" class="botao">
                            <a href="Estoque/Estoque_Pagina_Inicial.php"><img class="itens" src="./Escritorio_img/aliancas-de-casamento.png"></a>
                            <h1 class="tituloCabecalho">Estoque</h1>
                </button>

                <button type="button" id = "peso_btn" value="" title="Peso pedidos" class="botao">
                    <div class="badge-container" id="aviso_badge_div">
                            <img class="itens" src="./Escritorio_img/balanca.png">
                            <span id="aviso_badge" class="badge">
                                <?= 
                                    //vendo quais estão com peso zerado 
                                    $peso_pf->peso_indefinido(''); 
                                    $peso_pg->peso_indefinido(''); 
                                    $peso_pe->peso_indefinido('');  
                                    $peso_pe_Number = $peso_pedidos->peso_indefinido('echo');

                                    if($peso_pe_Number == 0){

                                        echo "<script>
                                                document.getElementById('aviso_badge').style.backgroundColor = 'transparent';
                                            </script>";
                                    }
                                    else{

                                        echo $peso_pe_Number ;
                                    }

                                ?>
                            </span>
                            <h1 class="tituloCabecalho">Peso</h1>
                    </div>
                </button>
        
                    <button type="button"  title="Limpar Pedido" id="limpar" value="" class="botao">
                        <img class="itens" src="./Escritorio_img/lixeira.png">
                    </button>
                </div>
                <div id="enviar">
                    <button id="btEnviar" type="button"  value="enviar" >
                            <div class="svg-wrapper-1">
                              <div class="svg-wrapper">
                                <svg
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
                <div id="tipo_pedido" >
                        <input type="radio" onchange="" id="c1" value="Mercado_Livre" name = 'cliente' class="radio2" checked><label class="radio_label" for="c1">Mercado Livre</label> 
                        <input type="radio" onchange="" id="c2" value="Loja" name = 'cliente' class="radio2"><label class="radio_label" for="c2">Loja</label> 
                        <input type="radio" value="Outros"  id="c3" name = 'cliente' class="radio2" ><label class="radio_label" for="c3">Outros:</label>  
                        <input type="text" id="outros"  pattern="[^-_+]*" name="txtcliente"  placeholder="Cliente...">
                </div>
            </div>
        </div>
        <div id="conteudo">

            <div id="data">
             Estoque 
                 <select id="estoque" name = 'estoque' > 
                    <option value="Nenhum" id="NenhumEstoque" class="estoqueSelect">Nenhum</option>
                    <?php
                        include_once('./Estoque/phpScripts/puxarDados.php');
                        titulosDoEstoque($conectar);
                    ?>
                 </select>
            </div>
            <div id="pedido_input">
                <div id="direita_input">
                    <div id="numeracao_div" >
                        Pedido:
                          <select id="n_p" name="numeroPedido" class="pedido" title="Selecione um Pedido" >
                                <option value='N'  id="Nenhum" >Escolha</option>
                                <option value='<?php echo $Pfcontador; ?>' title="Pedido para Fabricação" id="P1" >
                                    <?php echo  $Pfcontador_Display;?>
                                </option>

                                <option value="<?php echo $Pgcontador ?>" title="Pedido para Gravação" id="PG1" >
                                    <?php echo $Pgcontador_Display?>
                                </option>

                                <option value="<?php echo $Pecontador; ?>" title="Pedido do Estoque" id="PE1" >
                                    <?php echo  $Pecontador_Display;?>
                                </option>
                        </select>
                        <input type="text" pattern="[^-_+]*" id="nome_m" title="Exemplo 'CONTA 001'" name="nome_m" placeholder="Pedido..." >
                        <input type="text" pattern="[^-_+]*" id="nome_p" name="nome_p" title="Nome do Pedido" placeholder="Pedido..." >
                    </div>
                    <div id="numeracao">
                        Númeração M:<input type="number" min="0" title="Numeração Masculina" id="numeracao_m" value='' name="m" placeholder="M" >
                        F:<input type="number" min="0" title="Numeração Feminina" id="numeracao_f" value='' name="f"  placeholder="F" >
                       </div>
                    <div id="unidade">
                       <label for="checkboxFeminina" title="Para deixar apenas 1pé" >Unidade:</label><input type="checkbox" title="Para deixar apenas 1pé" id="checkboxFeminina"  name = 'pé' class="radio" >
                    </div>
                    <div id="descricao_div">
                        <textarea id="descricao_Pedido" name="descricao_Pedido" class="descricao" placeholder="Descrição do Pedido..."  ></textarea>
                        <textarea id="descricao_Alianca" name="descricao_Alianca" class="descricao" placeholder="Descrição da Alianças..."  ></textarea>
                    </div>
                </div>
                    <div id="imagem_p" >
                        <div id="PDF">
                            <label id="PdfBT" for="inputPDF">
                                <img class="botaoPDF" id="imagemPdf" src="./pedidos/imagemPedido/pdf.png">
                            </label>
                            <input id="inputPDF" class="fileBt" src="#" name="pdf" accept="application/pdf"  type="file" >
                            
                        </div>
                        <div id="modelo">
                            <?php
                            $estoquepedido = $_GET['estoque'] ?? null;
                            
                            if( $estoquepedido != null && $estoquepedido != 'Nenhum'){

                                    $nomeEstoqueSelect = $_GET['estoque'];
                                    ?>
                                        <img id="modelo_rainha" src="./Escritorio_img/rj.png.webp" alt="rainha" style="display: none;">
                                        <img id="modelo2" src="<?php titulosDoEstoqueImg($conectar , $nomeEstoqueSelect , '../' )  ?>" alt="Pré-visualização da Imagem" style="display: block;">
                                        <input type="hidden" <?php titulosDoEstoqueCaminho($conectar , $nomeEstoqueSelect )  ?> >
                                    <?php
                                }
                                else{
                                    ?>
                                        <img id="modelo_rainha" src="./Escritorio_img/rj.png.webp" alt="rainha">
                                        <img id="modelo2" src="#" alt="Pré-visualização da Imagem" style="display: none;">
                                    <?php
                                }
                            ?>
                        </div>
                        <label class="botaoImg" >
                            <input type="file" src="#" class="fileBt" name="imagem" id="uploadimg" accept="image/png, image/jpeg, image/jpg">
                            <img  id="botaoImg_img" src="./Escritorio_img/Logo_Rj.png" >
                            <span id="botaoImg_img">Mudar Imagem</span>
                        </label>
                    </div>
                        <div id="esquerda_input">
                            <div id="dia_horas" >
                                <div id="Div_entrega" class="margins_Menu">
                                    Entrega <input id="entrega" value="<?php echo $_COOKIE['dataInputEscritorio']?? date('Y-m-d') ?>"  title="Dia de entrega do pedido" name="dataEntrega" type="date">
                                </div>
                                
                                <div id="largura" class="margins_Menu"> Largura
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

                            </div>
                            <div id="Peso_par" class="margins_Menu">
                                <?php 
                                $estoquepedido = $_GET['estoque'] ?? null;
                                if( $estoquepedido != null &&  $estoquepedido != 'Nenhum' ){
                                ?>
                                    Peso o par <input type="number" placeholder="<?=  PesoDoEstoque($conectar, $estoquepedido) ?? "Gr"?>" name="peso_dis" id="peso" type="number" value="<?= str_replace('.', ',', PesoDoEstoque($conectar, $estoquepedido)) ?>"  disabled step="0.1" min="0" >
                                    <input type="hidden" placeholder="<?=  PesoDoEstoque($conectar, $estoquepedido) ?? "Gr"?>" name="peso" id="peso2" type="number" value="<?= str_replace('.', ',', PesoDoEstoque($conectar, $estoquepedido)) ?>"  >
                                <?php
                                }
                                else{
                                ?>
                                    Peso o par <input type="number" placeholder="Gr" name="peso" id="peso" type="number" step="0.1" min="0" >
                                <?php
                                }
                                ?>
                            </div>
                            <div class="gravs_interna">
    
                               <label id="label_M" style="color:brown; margin-right: 10px;"></label>M =><input name="gravInternaM" id="gravInternaM" class="inputgravint" type="text" placeholder="Gravação Masculina" >
                                <input class="checkboxInternaGrav" id="gravInternaChekM" type="checkbox" ><label for="gravInternaChekM">Maiúsculo</label>
                            </div>
                            <div class="gravs_interna">
    
                               <label id="label_F" style="color:brown; margin-right: 10px;"></label>F =><input name="gravInternaF" id="gravInternaF" class="inputgravint" type="text" placeholder="Gravação Feminina" >
                                <input class="checkboxInternaGrav" id="gravInternaChekF"  type="checkbox"><label for="gravInternaChekF">Maiúsculo</label>
                            </div>

                        </div>
                        
            </div>
        </div>
        <footer id="rodape">
            <div id="envioP">
                <label class="font_red"> <?php
                    echo 'Sem Pedido';
                ?></label>
            </div>

            <div class="div_footer">
                <input type="checkbox" id="gravacao_externa" value="on"  name = 'Confirmar_grav' class="radio"><label for="gravacao_externa">Aguardar Gravação</label>
             </div>

            <div class="div_footer">
                <input type="checkbox" id="comPedra" name = 'comPedra' class="radio" ><label for="comPedra">Feminina pedra</label>
                <input type="checkbox" id="semPedra" name = 'semPedra' class="radio" ><label for="semPedra">Masculina Pedra</label>
            </div>

            <div class="div_footer">
                <input type="checkbox" value="" id="estoqueFeminina"  name = 'estoqueFeminina' class="radio"><label for="estoqueFeminina">Feminina Estoque</label>
                <input type="checkbox" value="" id="estoqueMasculina"  name = 'estoqueMasculina' class="radio"><label for="estoqueMasculina">Masculina Estoque</label>
            </div>

        </footer>
    </form>
        <!-- DIV Pedidos Sem peso -->
    <form id="pesoForm" action="./PG2-Escritorio.php" method="post">
        <div id="pesoDivMae">
            <div id="pesoDiv">
                <div id="TituloPeso">
                    <label>Pedidos sem Peso</label>
                </div>
                <div id="pesoFiltro">

                        <label id="pesoFiltroTXT">Pesquise</label>
                        <input type="text" name="filtrar_peso" value="<?= $filtrar_peso ?? '' ?>" id="filtrarInput" placeholder="Digite o pedido">

                         <select name="cliente_peso" id="cliente_peso" >
                             <option value = 'Mercado_Livre' <?= $mercado_Livre_selected ?> >Mercado Livre</option>
                             <option id = "selected_peso" value = '<?= $cliente  ?>' <?= $cliente_selected ?> ><?= $cliente  ?></option>
                             <?php
                                pegar_tipo_pedidos_Escritorio('pedidos' , $conectar);
                            ?>
                         </select>
                    
                </div>
                <div id="checkboxPeso">
                    <label class="checkboxFont_peso">
                        <input class="selecao_peso" type="checkbox" name="PF_peso" id="PF_peso"  value="PF" <?= $PF_peso_Select ?? ''   ?>> PF
                    </label>
                    <label class="checkboxFont_peso">
                        <input class="selecao_peso" type="checkbox" name="PG_peso" id="PG_peso" value="PG" <?= $PG_peso_Select ?? ''   ?>> PG
                    </label>
                    <label class="checkboxFont_peso">
                        <input class="selecao_peso" type="checkbox" name="PE_peso" id="PE_peso" value="PE" <?= $PE_peso_Select ?? ''   ?>> PE
                    </label>
                </div>
                <!-- Div Para os Pedidos -->
                 <div id="pedidos_peso_div">
                 
                    <?php 
                        if($filtrar_peso != ''){
                             // Remove qualquer caractere perigoso (SQL Injection Protection)
                             $filtrar_peso = preg_replace('/[^A-Za-z0-9]/', '', $filtrar_peso);

                             $sql_externo = " AND (nomePedido LIKE '%$filtrar_peso%' 
                                                 OR idpedidos LIKE '%$filtrar_peso%')";
                             
                             $peso_pf->set_sql_externo($sql_externo);
                             $peso_pg->set_sql_externo($sql_externo);
                             $peso_pe->set_sql_externo($sql_externo);
                             $peso_pedidos->set_sql_externo($sql_externo);
                         }


                        if($pedidos_peso == false ){

                            if($PF_peso == "PF"){
                                $peso_pf->peso_indefinido('pedido');
                            }
                            if($PG_peso == "PG"){
                                $peso_pg->peso_indefinido('pedido');
                            }
                            if($PE_peso == "PE"){
                                $peso_pe->peso_indefinido('pedido');
                            }

                            //echo $filtrar_peso;
                        }
                        else{
                            //echo $cliente . "Cliente";
                            if($cliente != ""){
                                
                                $peso_pedidos->peso_indefinido('pedido_outros');
                                
                            }
                            else{

                                $peso_pf->peso_indefinido('pedido');
                                $peso_pg->peso_indefinido('pedido');
                                $peso_pe->peso_indefinido('pedido');
                                $peso_pedidos->peso_indefinido('pedido_outros');
                            }
                            
                        }
                    ?>

                 </div>
                <div id="pesoDiv2">
                    <button type="button" id="voltarPeso" class="buttonPeso">Voltar</button>
                </div>
            </div>
        </div>
    </form>
   </main>
</body>

<?= $div_visible ?> <!-- parte do Peso_div  script js -->

</html> 
<?php

    mysqli_close($conectar);
?>