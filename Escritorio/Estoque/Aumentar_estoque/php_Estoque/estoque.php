<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="shortcut icon" href="../../../Escritorio_img/coroa.ico" type="image/x-icon">
    <link href="../css/estoque.css" rel="stylesheet">
    <script src="../js/estoque.js" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Aumentar</title>
</head>
<body>
    <?php
        include_once('../../../../conexao.php');

        //variaveis
        $nome = $_GET["nome"];   

        $estoqueEditar = "SELECT * FROM estoque WHERE nome LIKE '$nome'";
        $conectarEstoqueEditar = mysqli_query($conectar, $estoqueEditar);
    ?>

   
    <div id="cabecalho">
            <div id="casa">
                <button type="button" id="seta_esquerda" value="" class="botao" >
                    <a href="../aumentarEstoque.php"><img class="itens" src="../Imagens_aumentar_Estoque/angulo-esquerdo.png"></a>
                </button>

                <button type="button" value="" class="botao" >
                    <a href="../../../PG2-Escritorio.php"><img class="itens" src="../Imagens_aumentar_Estoque/casa.png"></a>
                </button>
            </div>      
    </div>
    <div id = "div_estoques">
        <?php
            include_once('../../../../conexao.php');

            $estoque = "SELECT * FROM estoque WHERE nome LIKE '$nome'";
            $conectarEstoque = mysqli_query($conectar, $estoque);

    echo "<div class = 'estoque'>";
    echo "<form id = 'formEstoque'><div class = 'numeracao_Div'>";
            while($linha = mysqli_fetch_assoc($conectarEstoque)){

                
                //Variaveis banco
                $nomeBd =  $linha['nome'];
                $imagem =  $linha['imagem'];
                $peso =  $linha['peso'];
                $descricao =  $linha['descricaoEstoque'];
                
                if($nomeBd == $nome){

                    for($i = 9; $i <= 35; $i++ ){

                        echo "<div class='numero-div'>";
                        echo "<label class = 'labelFontN' > N°$i</label>";

                        // botão --------------------------------------------------
                        ?><div class='button-container'>
                        <button type="button" class='button-3d' onclick = 'voltar("id_<?php echo $i ?>"); atualizarInputs();' >
                            <div class='button-top'>
                            <span class='material-icons'>-</span>
                            </div>
                            <div class='button-bottom'></div>
                            <div class='button-base'></div>
                        </button><?php
                        
                        echo "<div id = 'id_$i'  class = 'numeracao'>" . 0 . "</div>";
                        
                        ?><button type="button" class='button-3d' onclick = 'avancar("id_<?php echo $i ?>"); atualizarInputs();'>
                            <div class='button-top'>
                            <span class='material-icons'>+</span>
                            </div>
                            <div class='button-bottom'></div>
                            <div class='button-base'></div>
                        </button></div><?php
                        // fim do botão --------------------------------------------

                        echo "</div>";
                        echo "<input type='hidden' name='valores[$i]' id='input_$i' value='" . $linha[$i] . "'>";
                    }
                    
                }
    echo "<input type='hidden' name='local' id='local' >";
    echo "<input type='hidden' name='nome' value='" . $nome . "'>";
    echo "</form></div>";
    
        ?>
        <Div class = 'informacoesDiv'>
            <img class = 'imagemdiv' src = '../../../../<?php echo $imagem; ?>'>
                <h1><?php echo "--- " . $nomeBd . " ---"; ?></h1>
                <h2>Peso: <?php echo $peso; ?></h2>
                <div class = 'divDescricao'>
                    <h2><?php echo nl2br($descricao); ?></h2>
                </div>
                <div id = 'perfilButtons'>
                    <button class="button2" type="button" onclick="enviar_local('polimento'); submitForm('formEstoque' , 'estoque_1.php')">Enviar para Polimento</button>
                    <button class="button2" type="button" onclick="enviar_local('torno'); submitForm('formEstoque' , 'estoque_1.php')">Enviar para Torno</button>
                </div>
        </Div>
        <?php
            }
echo "</div>";
mysqli_close($conectar);
        ?>
    </div>
</body>
</html>
