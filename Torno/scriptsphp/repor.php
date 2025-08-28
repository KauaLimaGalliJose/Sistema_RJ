<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../coroa.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/repor.css">
    <script src="../js/repor.js" defer></script>
    <title>Reposição</title>
</head>
<body>
    <div id="cabecalho">
        <div id="cabecalho_menu">
            <div id="casa">
                <button type="button" value=""  class="botao" >
                    <a href="../../menu/"><img class="itens" src="../../Escritorio/Escritorio_img/casa.png"></a>
                </button>
                <button type="button" value=""  class="botao" >
                    <a href="../torno.php"><img class="itens" src="../../Escritorio//Escritorio_img/angulo-esquerdo.png"></a>
                </button>
            </div>
        </div>
    </div>
        <?php
        include_once '../../phpIndex/protege.php';
        proteger(); // Chama a função para verificar o token antes de carregar a página
        include_once('../../conexao.php');
        include_once('repor1.php');


            $estoque_nome = $_POST['radioName']?? "";
            
            echo '<div id = "estoques_Mae">';


                 ?>
                    <div id="Estoques_Torno_Polimento_Sem_estoque">
                        <h1>Escolha um Estoque</h1>
                    </div>
                <?php

                estoques($conectar, $estoque_nome);    
                escolher_estoque($conectar, $estoque_nome);

            echo '</div>';


        ?>
</body>
</html>

