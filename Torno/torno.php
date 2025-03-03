<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../coroa.png" type="image/x-icon">
    <link rel="stylesheet" href="torno.css">
    <script src="torno.js" defer></script>
    <title>Torno</title>
</head>
<body>
<form id="formulario" method="POST" action="torno.php">
    <div id="cabecalho">
        <div id="cabecalho_menu">
            <div id="casa">
                <button type="button" value=""  class="botao" >
                <a href="../index.html"><img class="itens" src="../Escritorio/casa.png"></a>
                </button>
            </div>
                <select name="largura" id="larguraSelect">
                        <option value="todos">Todos</option>
                        <option value="2mm">2mm</option>
                        <option value="3mm">3mm</option>
                        <option value="4mm">4mm</option>
                        <option value="5mm">5mm</option>
                        <option value="6mm">6mm</option>
                        <option value="7mm">7mm</option>
                        <option value="8mm">8mm</option>
                        <option value="9mm">9mm</option>
                        <option value="10mm">10mm</option>
                </select>

                <div id="pesquisa">
                    <input id="pesquisaInput" type="text" oninput="this.value = this.value.toUpperCase();" placeholder="Número Pedido">
                </div>
                <button type="submit" id="enviar"><h1>Enviar</h1></button>
        </div>
    </div>
</form>
    <?php include_once('../conexao.php');?>
    <div id="phpmae">
        <div id="phpDiv">
        <?php
            //Variaveis
            if($_POST){
            $largura = $_POST['largura'];
            ?><span class="titulo_black"><?php echo 'Largura:'; ?></span><span class="titulo_red"><?php echo $largura; ?></span><?php
            }
            
            $data = date('Y-m-d');
            $dataSplit = explode("-", $data);

            // Recupera todos os pedidos com idpedidos e imagem
            $dadosVerificador = "SELECT RIGHT(idpedidos,5) AS idpedido, imagem, descricaoPedido,idpedidos FROM pedidosp";
            $Verificador = mysqli_query($conectar, $dadosVerificador);
    
            while (($dados = mysqli_fetch_assoc($Verificador))) {
            
                if ($dados['idpedido'] == $dataSplit[1] . '-' . $dataSplit[2]) {
                    
                    if ($dados['imagem']) {
                    
                        

                        ?><div class="pedidosImagem"><?php
                        print('Pedido do Dia: ' . $dataSplit[1] . '/' . $dataSplit[2] . '</br>');
                        print($dados['descricaoPedido'] . "<br>");
                        print($dados['idpedidos'] . "<br>");
                        ?><img class = "Imagem" src="<?php echo $dados['imagem'];?>" alt="Imagem do Pedido"><?php
                    }
                
                    ?></div><?php
                }
            }
            
            ?>
            
        </div>
        <div id="php2">
            <?php
            $imagem = "SELECT DISTINCT imagem FROM pedidos";
            $imagemConectar = mysqli_query($conectar, $imagem);

            while ($dadosImagem = mysqli_fetch_assoc($imagemConectar)) {
            
                    
                    ECHO "VAIIIII";            
                        ?><img class = "Imagem" src="<?php echo $dadosImagem['imagem'];?>" alt="Imagem do Pedido"><?php
                    
                
                    ?></div><?php
                
            }
            ?>
        </div>
    </div>
</body>
</html>
