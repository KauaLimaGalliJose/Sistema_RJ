<?php

include_once('../../conexao.php');
include_once('./phpScripts/statusFuncao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../coroa.ico" type="image/x-icon">
    <script src="./statusFuncao.js" defer></script>
    <link rel="stylesheet" href="statusPedidos.css">
    <script src="./statusFuncao.js" defer></script>
    <title>Andamento dos Pedidos</title>
</head>
<body>
    <!-- Cabeçalho -->
    <form id="formulario" method="POST" action="statusPedidos.php">
        <div id="cabecalho">
            <div id="cabecalho_menu">
                <div id="casa">
                    <button type="button" value=""  class="botao" >
                    <a href="../PG2-Escritorio.php"><img class="itens" src="../Escritorio_img/casa.png"></a>
                    </button>
                </div>
                <div class="body">
                    <div class="tabs">
                        <input
                        <?php echo (isset($_POST['pedidos']) && $_POST['pedidos'] == 'PF') ? 'checked' : ''; ?>
                        value="PF"
                        name="pedidos"
                        id="pf"
                        type="radio"
                        class="input"
                        />
                        <label for="pf" class="label">PF</label>
                        <input
                        <?php echo (isset($_POST['pedidos']) && $_POST['pedidos'] == 'PG') ? 'checked' : ''; ?>
                        value="PG"
                        name="pedidos"
                        id="pg"
                        type="radio"
                        class="input"
                        />
                        <label for="pg" class="label">PG</label>
                        <input
                        <?php echo (isset($_POST['pedidos']) && $_POST['pedidos'] == 'PE') ? 'checked' : ''; ?>
                        value="PE"
                        name="pedidos"
                        id="pe"
                        type="radio"
                        class="input"
                        />
                        <label for="pe" class="label">PE</label>
                        <input
                        <?php echo (isset($_POST['pedidos']) && $_POST['pedidos'] == 'todos') ? 'checked' : ''; ?>
                        value="todos"
                        name="pedidos"
                        id="todos"
                        type="radio"
                        class="input"
                        />
                        <label for="todos" class="label">Todos</label>
                    </div>
                </div>
                <input class="data" id="dataInput" value="<?php echo $_POST['dataInput']?? date('Y-m-d');?>" name="dataInput" type="date">
            </div>
        </div>
    </form>
    <!-- Cabeçalho -->
    <!-- Corpo -->
    <div id="corpo">
        <?php 
            //variaveis
            $tipoPedido = $_POST['pedidos']?? "PF"; // Define o tipo de pedido, padrão é PF
            $dataInput = $_POST['dataInput']?? date('Y-m-d'); // Define o tipo de pedido, padrão é PF

                if($tipoPedido == 'PF'){

                    statusPedidos($conectar, 'pedidosp', 'contadorpf',$dataInput);
                }
                elseif($tipoPedido == 'PG'){

                    statusPedidos($conectar,'pedidospg', 'contadorpg',$dataInput);
                }
                elseif($tipoPedido == 'PE'){

                    statusPedidos($conectar, 'pedidospe', 'contadorpe',$dataInput);
                }
                elseif($tipoPedido == 'todos'){

                    statusPedidosTodos($conectar,$dataInput);
                }
                mysqli_close($conectar);
        ?>
    </div>
</body>
</html>