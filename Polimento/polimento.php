<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../coroa.png" type="image/x-icon">
    <link rel="stylesheet" href="polimento.css">
    <script src="polimento.js" defer></script>
    <title>Polimento</title>
</head>
<body>
<form id="formulario" method="POST" action="polimento.php">
    <div id="cabecalho">
        <div id="cabecalho_menu">
            <div id="casa">
                <button type="button" value=""  class="botao" >
                <a href="../index.html"><img class="itens" src="../Escritorio/casa.png"></a>
                </button>
            </div>
                <select name="largura" id="larguraSelect">
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
                <input class="data" id="dataInput" value="<?php echo $_POST['dataInput']?? date('Y-m-d');?>" name="dataInput" type="date">
                <button type="submit" id="enviar"><h1>Pesquisar</h1></button>
        </div>
    </div>
</form>
    <?php include_once('../conexao.php');?>
    <?php include_once('./scriptsphp/funcaoTorno.php')?>

    <?php 
    if($_POST){
       $largura =  $_POST['largura'];
       $data =  $_POST['dataInput']?? null;
    }
    if($_POST['largura'] == 'Todos'){
        $largura = '%mm';
    }
    ?>
    <div id="phpmae">
        <?php
        if(isset($largura) && isset($data)){
            pedidosPf($conectar,$largura,'pedidosp','contadorpf',$data);
        }

        //Se não Pesquisar nada 
        if(!isset($largura) && !isset($data) || $largura == '%mm' && $data == null){
            $semPedido =  include_once('../semPedidos/semPedidos.php');
        }
        else{
            $semPedido = '';
        }

        ?>

    </div>
    <div id="pedidonaoEncontrado">
       <?php echo $semPedido; ?>
    </div>
</body>
</html>
