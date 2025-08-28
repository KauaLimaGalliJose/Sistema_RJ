<?php
    include_once '../phpIndex/protege.php';
    proteger(); // Chama a função para verificar o token antes de carregar a página

    // Para funcionamento dos pedidos
    include_once('../conexao.php');
    include_once('./scriptsphp/funcaoTorno.php');
    include_once('../scripts/phpGlobal/frontEnd/estoque/estoqueFront.php');
    require_once('../scripts/phpGlobal/frontEnd/cabecalho/menu.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="../Escritorio/Escritorio_img/coroa.ico" type="image/x-icon">
    <link rel="stylesheet" href="torno.css">
    <script src="torno.js" defer></script>
    <title>Torno</title>
</head>
<body>
<form id="formulario" method="post" action="torno.php">
    <div id="cabecalho">
        <div id="cabecalho_menu">
            <div id="casa">
                <button type="button" value=""  class="botao" >
                <a href="../menu/index.php"><img class="itens" src="../Escritorio/Escritorio_img/casa.png"></a>
                </button>
            </div>
                <select name="largura" id="larguraSelect" oninput="this.form.submit()">
                        <option class="fontRed" value="<?php echo $_POST['largura']?? 'Largura';?>" selected><?php echo $_POST['largura']?? 'Largura';?></option>
                        <option value="Todos">Todos</option>
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
                <input class="data" id="dataInput" value="<?php echo $_POST['dataInput']?? date('Y-m-d');?>"  oninput="this.form.submit()" name="dataInput" type="date">
                
                <label class="estoque_esgotado">
                     <input name="estoque_esgotado" value="checked" type="checkbox" oninput="this.form.submit()" <?php echo $_POST['estoque_esgotado']?? '' ?>>
                <div class="checkmark"></div>
                <span>Estoque para fazer</span>
                </label>

                <button  type="button" value="" id="macarico"  class="botao">
                    <a href="./scriptsphp/larguraFundecao.php"><img class="itens" src="./imagem/macarico.png"></a>
                </button>
                <button  type="button" value="" id="reposicao"  class="botao">
                    <a href="./scriptsphp/repor.php"><img class="itens" src="./imagem/estoque.png"></a>
                </button>
            </div>
            <div id="menu">
                <?php echo menu_('') ?>
            </div>
    </div>
</form>

    <?php 
       $largura =  $_POST['largura']?? '';
       $data =  $_POST['dataInput']?? null;
       $checkbox_estoque = $_POST['estoque_esgotado']?? '';
       $selectCheckboox = '';

       // aqui é o quanto vc precisa voltar para achar a imagem , o caminho da imagem
       $caminhoimagem = '';
    
    if($largura == 'Todos'){
        $largura = '%mm';
    }
    ?>
    <div id="phpmae">
        <?php
        
        if(isset($largura) && isset($data) && $checkbox_estoque == ''){
            pedidosPf($conectar,$largura,'pedidosp','contadorpf',$data);
        }
        elseif($checkbox_estoque == 'checked'){

            //variaveis
            $selectCheckboox = 'checked';
            $estoque_nome = $_POST['radioName']?? "";
            
            echo '<div id = "estoques_Mae">';


                 ?>
                 <link rel="stylesheet" href="../scripts/cssGlobal/estoque_esgotadoSemBotao.css">
                 <script src="../scripts/jsGlobal/estoque/estoqueFront.js" defer></script>
                    <div id="Estoques_Torno_Polimento_Sem_estoque">
                        <h1>Escolha um Estoque</h1>
                    </div>
                <?php

                estoques_semBotao($conectar, $estoque_nome,'', $caminhoimagem);    
                escolher_estoque_post($conectar, $estoque_nome, './torno.php');

            echo '</div>';

        }
        else{
            $selectCheckboox = '';
        }


        //Se não Pesquisar nada 
        if($largura == '' &&  $largura != '%mm' && $data == null && $checkbox_estoque == ''){
            $semPedido =  require('../semPedidos/semPedidos.php');
            echo "<script> document.getElementById('phpmae').style.backgroundColor = 'azure'; 
                document.getElementById('phpmae').style.background = 'linear-gradient(azure)';
                document.body.style.background = 'linear-gradient(azure)';
                document.body.style.background = 'azure';
                </script>";
            
        }
        else{
            $semPedido = '';
        }

        ?>

    </div>
    <div id="pedidonaoEncontrado">
        <?php echo $semPedido; 
        mysqli_close($conectar);?>
    </div>
</body>
</html>
