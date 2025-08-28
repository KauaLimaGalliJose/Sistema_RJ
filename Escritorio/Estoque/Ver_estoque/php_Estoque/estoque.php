<!DOCTYPE html>
<html lang="pt-br">
<head>
        <link rel="shortcut icon" href="../../../Escritorio_img/coroa.ico" type="image/x-icon">
    <link href="../css/estoque.css" rel="stylesheet">
    <script src="../js/estoque.js" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Ajustar</title>
</head>
<body>
    <?php
        include_once('../../../../conexao.php');
        include_once '../../../../phpIndex/protege.php';
        proteger();

        //variaveis
        $nome = $_GET["nome"];   

        $estoqueEditar = "SELECT * FROM estoque WHERE nome LIKE '$nome'";
        $conectarEstoqueEditar = mysqli_query($conectar, $estoqueEditar);
    ?>

    <!----------------------------------------- DIV Editar Tinha pego do pedidos.php -->
    <form id="editar" action="./estoque_editar.php" method="post">
        <div id="PdfDivMae">
            <div id="PdfDiv">
                <?php if( $dados = mysqli_fetch_assoc($conectarEstoqueEditar)){ ?>
                <div id="TituloPdf">
                    <label >-- Editar --</label>
                </div>

                <div id = 'nomeinput' class="input">
                    Nome do estoque <input name="nome_Esoque" class="input_editar_estoque" type="text" value="<?php echo $dados['nome'] ?>">
                </div>

                <div id = 'Pesoinput' class="input">
                    Peso <input name="Peso_Esoque" class="input_editar_estoque_number" type="number" value="<?php echo $dados['peso'] ?>" >

                    <input name="Imagem_Esoque" class="input_editar_estoque_file" id="input_editar_estoque_file" value="<?php echo $dados['imagem'] ?>" accept="image/png, image/jpeg, image/jpg" type="file" >
                    <label for="input_editar_estoque_file" class="trocarImagemEstoque">Trocar imagem</label>
                </div>

                <div id = 'descricaoinput' class="input">
                    Descrição <textarea name="descricao_Esoque" class="input_editar_estoque_descricao" value=""><?php echo htmlspecialchars($dados['descricaoEstoque']) ?></textarea>
                </div>
                
            </div>
            <div id="PdfDiv2">
                <button type='button'  id="buttonPdf" onclick="voltarEditar()" class="buttonPdf">
                    <label class="labelBtn">Voltar</label>
                </button>
                <button type='button' onclick="submitForm('editar' , 'estoque_editar.php'); voltarpagina('../ver_estoque.php')" class="buttonPdf">
                    <label class="labelBtn" >Salvar</label>
                </button>    
            </div>
        </div>
        <?php
                }
            echo "<input type='hidden' name='nome' value='" . $nome . "'>";
        ?>
    </form>  
    <!-- ----------------------------------------------------------------------------------------------------------------------------------- -->      
    <div id="cabecalho">
            <div id="casa">
                <button type="button" id="seta_esquerda" value="" class="botao" >
                    <a href="../ver_estoque.php"><img class="itens" src="../Imagens_ver_Estoque/angulo-esquerdo.png"></a>
                </button>

                <button type="button" value="" class="botao" >
                    <a href="../../../PG2-Escritorio.php"><img class="itens" src="../Imagens_ver_Estoque/casa.png"></a>
                </button>
            </div>      
    </div>
    <div id = "div_estoques">
        <?php
            include_once('../../../../conexao.php');

            $estoque = "SELECT * FROM estoque WHERE nome LIKE '$nome'";
            $conectarEstoque = mysqli_query($conectar, $estoque);

echo "<div class = 'estoque'>";
echo "<form id = 'formEstoque' action='estoque_1.php' method='post'><div class = 'numeracao_Div'>";
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
                        <button type="button" class='button-3d' onclick = 'voltar("id_<?php echo $i ?>"); atualizarInputs(); submitForm("formEstoque", "estoque_1.php")' >
                            <div class='button-top'>
                            <span class='material-icons'>-</span>
                            </div>
                            <div class='button-bottom'></div>
                            <div class='button-base'></div>
                        </button><?php
                        
                        echo "<div id = 'id_$i'  class = 'numeracao'>" . $linha[$i] . "</div>";
                        
                        ?><button type="button" class='button-3d' onclick = 'avancar("id_<?php echo $i ?>"); atualizarInputs(); submitForm("formEstoque", "estoque_1.php")'>
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
    echo "<input type='hidden' name='nome' value='" . $nome . "'>";
    echo "</form></div>";
    
// Excluir Estoque --------------------------------------------
    echo "<form id = 'excluir' action='estoque_excluir.php' method='post'>";
        echo "<input type='hidden' name='nome' value='" . $nome . "'>";
    echo "</form>";
        ?>
        <Div class = 'informacoesDiv'>
            <img class = 'imagemdiv' src = '../../../../<?php echo $imagem; ?>'>
                <h1><?php echo "--- " . $nomeBd . " ---"; ?></h1>
                <h2>Peso: <?php echo $peso; ?></h2>
                <div class = 'divDescricao'>
                    <h2><?php echo nl2br($descricao); ?></h2>
                </div>
                <div id = 'perfilButtons'>
                    <button class="button2" type="button" onclick="editar()">Editar</button>
                    <button class="button2" type="button" onclick="submitForm('excluir' , 'estoque_excluir.php'); voltarpagina('../ver_estoque.php')">Excluir</button>
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
