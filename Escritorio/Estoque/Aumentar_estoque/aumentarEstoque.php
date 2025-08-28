<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="shortcut icon" href="../../Escritorio_img/coroa.ico" type="image/x-icon">
    <link href="aumentarEstoque.css" rel="stylesheet">
    <script src="aumentarEstoque.js" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Estoque</title>
</head>
<body>
    <?php
        include_once '../../../phpIndex/protege.php';
        proteger();
    ?>
    <div id="cabecalho">
            <div id="casa">
                <button type="button" id="seta_esquerda" value="" class="botao" >
                    <a href="../Estoque_Pagina_Inicial.html"><img class="itens" src="Imagens_aumentar_Estoque/angulo-esquerdo.png"></a>
                </button>

                <button type="button" value="" class="botao" >
                    <a href="../../PG2-Escritorio.php"><img class="itens" src="Imagens_aumentar_Estoque/casa.png"></a>
                </button>
            </div>      
    </div>
    <div id = "div_estoques">
        <?php
            include_once('../../../conexao.php');
            include_once('../phpScripts/puxarDados.php');

            verEstoque($conectar);

        ?>
    </div>
</body>
</html>