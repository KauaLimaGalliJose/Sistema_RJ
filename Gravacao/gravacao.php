<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../coroa.png" type="image/x-icon">
    <link rel="stylesheet" href="gravacao.css">
    <script src="./gravacao.js"  defer></script>
    <title>Gravação</title>
</head>
<body>
 <!-- Usuario-------------------------------------------------------------------------------------------------------------------------- --> 
    <div id="conteudo">
        <div id="Usuario">
          <!-- div class="usuario">
              <img class="usuarioImg" src="./imagemGravacao/novo-usuario.png">  
                <label class="tituloUsuario">Criar Usuario</label>
          </div--> 
          <div class="usuario">
             <a href=".\usuario\comicao.php"> <img class="usuarioImg" src="./imagemGravacao/homem-usuario.png">  
                <label class="tituloUsuario">Kauã</label></a>
          </div>
        </div>
    </div>
 <!-- Usuario-------------------------------------------------------------------------------------------------------------------------- --> 
  <form id="formulario" method="POST" action="gravacao.php">
    <div id="cabecalho">
        <div id="cabecalho_menu">
            <div id="casa">
                <button type="button" value=""  class="botao" >
                <a href="../menu/index.html"><img class="itens" src="../Escritorio/casa.png"></a>
                </button>
            </div>
                <select name="pedidos" id="larguraSelect">
                        <option class="fontRed" value="<?php echo $_POST['pedidos']?? 'pedidos';?>" selected><?php echo $_POST['pedidos']?? 'pedidos';?></option>
                        <option value="PF">PF</option>
                        <option value="PG">PG</option>
                        <option value="PE">PE</option>
                </select>
                <input class="data" id="dataInput" value="<?php echo $_POST['dataInput']?? date('Y-m-d');?>" name="dataInput" type="date">
                <button type="submit" id="enviar"><h1>Pesquisar</h1></button>

                <button  type="button" value="" id="usuarioButao" onclick ="return usuario()" class="botao">
                    <img class="itens" src="./imagemGravacao/homem-usuario.png">
                </button>
        </div>
    </div>
  </form>
    <?php include_once('../conexao.php');?>
    <?php include_once('./scriptsphp/funcaoGravacao.php')?>

    <?php 
    if($_POST){
       $largura =  $_POST['pedidos'];
       $data =  $_POST['dataInput']?? null;
       $checkbox = $_POST['marcado']?? 'sim';
    }
    ?>
    <div id="phpmae">
        <?php
        if(isset($largura) && isset($data)){
            pedidosPf($conectar,$largura,'pedidosp','contadorpf',$data);
        }
        if(isset($largura) && isset($data)){
            pedidosPf($conectar,$largura,'pedidospg','contadorpg',$data);
        }
        if(isset($largura) && isset($data)){
            pedidosPf($conectar,$largura,'pedidospe','contadorpe',$data);
        }

        //Se não Pesquisar nada 
        if(!isset($largura) && !isset($data) || $data == null){
            $semPedido =  include_once('../semPedidos/semPedidos.php');
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