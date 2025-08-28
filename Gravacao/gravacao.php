<?php
    include_once '../phpIndex/protege.php';
    proteger();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Escritorio/Escritorio_img/coroa.ico" type="image/x-icon">
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
                <a href="../menu/index.php"><img class="itens" src="../Escritorio/Escritorio_img/casa.png"></a>
                </button>
            </div>
                <select name="pedidos" id="larguraSelect" oninput="this.form.submit()">
                        <option class="fontRed" value="<?php echo $_POST['pedidos']?? 'pedidos';?>" selected><?php echo $_POST['pedidos']?? 'pedidos';?></option>
                        <option value="PF">PF</option>
                        <option value="PG">PG</option>
                        <option value="PE">PE</option>
                </select>
                <input class="data" id="dataInput" value="<?php echo $_POST['dataInput']?? date('Y-m-d');?>" oninput="this.form.submit()" name="dataInput" type="date">

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