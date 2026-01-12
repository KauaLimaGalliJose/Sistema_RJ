<?php

include "../../scripts/phpGlobal/frontEnd/cabecalho/cabecalho.php";


?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>Teste Criar</title>
    <link rel="stylesheet" href="./css/alianca3D.css">
    <link rel="stylesheet" href="../../scripts/cssGlobal/fonts/fonts.css">
    <script type="importmap">
        {
          "imports": {
            "three": "../../scripts/importadosLocais/threeJs/build/three.module.js",
            "three/import/": "../../scripts/importadosLocais/threeJs/examples/jsm/"
          }
        }
  </script>
    <script type="module" src="./js/mainCriarAlianca.js" defer></script>
  </head>
  <body>
      <?php
        $parametros = [];
        $parametros['caminho_seta_esquerda'] = 'btn' . '-+-' . '../../menu/index.php' . '-+-' . '../../scripts/imagem_global/cabecalho_img/angulo-esquerdo.png';
        $parametros['caminho_Casa'] = 'btn' . '-+-' . '../../menu/index.php' . '-+-' . '../../scripts/imagem_global/cabecalho_img/casa.png';
        
        cabecalho($parametros);
      ?>

    <div id="conteudo">
        <div id="conteiner_Itens">

            <div class="itensa">
                <a href="" ><label>Criar Projeto</label></a>
            </div>
        </div>
    </div>
  </body>
</html>