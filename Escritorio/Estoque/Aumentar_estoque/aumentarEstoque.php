
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
        include_once('../../../scripts/phpGlobal/frontEnd/cabecalho/cabecalho.php');

        $parametros = [];
        $parametros['caminho_Casa'] = 'btn' . '-+-' . '../../PG2-Escritorio.php' . '-+-' . '../../../scripts/imagem_global/cabecalho_img/casa.png';
        $parametros['caminho_Seta'] = 'btn' . '-+-' . '../Estoque_Pagina_Inicial.php' . '-+-' . '../../../scripts/imagem_global/cabecalho_img/angulo-esquerdo.png';
        
        cabecalho($parametros);
      ?>
    <div id = "div_estoques">
        <?php
            include_once('../../../conexao.php');
            include_once('../phpScripts/puxarDados.php');

            verEstoque($conectar);

        ?>
    </div>
</body>
</html>