
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="shortcut icon" href="../Escritorio_img/coroa.ico" type="image/x-icon">
    <link href="Estoque_Pagina_Inicial.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque</title>
</head>
<body>
    <header>
      <?php
        include_once('../../scripts/phpGlobal/frontEnd/cabecalho/cabecalho.php');

        $parametros = [];
        $parametros['caminho_Casa'] = 'btn' . '-+-' . '../PG2-Escritorio.php' . '-+-' . '../../scripts/imagem_global/cabecalho_img/casa.png';
        
        cabecalho($parametros);
      ?>
    </header>
    <main>
        <div id="opcoes">
            <div class="opcao_estilo">
                <a style="text-decoration: none;" href="Criar_estoque/CriarEstoque.php" >
                <div class="opcao_titulo">Criar um Estoque</div>
                <img class="opcao_imagem" src="imagens_Estoque/criar_estoque.png" alt="" > 
                </a>
            </div>

            <div class="opcao_estilo">
                <a style="text-decoration: none;" href="Aumentar_estoque/aumentarEstoque.php" >
                <div class="opcao_titulo">Aumentar Estoque</div>
                <img class="opcao_imagem" src="imagens_Estoque/aumentar.png" alt="">
            </div>

            <div class="opcao_estilo">
                <a style="text-decoration: none;" href="Ver_estoque/ver_estoque.php" >
                <div class="opcao_titulo">Ver Estoques</div>
                <img class="opcao_imagem" src="imagens_Estoque/estoque.png" alt="">
                </a>
            </div>
        </div>
    </main>

</body>
</html>