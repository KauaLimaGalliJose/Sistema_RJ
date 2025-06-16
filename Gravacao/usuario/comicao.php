<?php include_once('../../conexao.php') ?>
<?php include_once('./funcao.php') ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../coroa.png" type="image/x-icon">
    <title>Quantidade Gravação</title>
</head>
<style>
    *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    list-style: none;
    }
    body{
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        flex-direction: column;
    }

    #senhadiv{
        display: flex;
        align-items: center;
        flex-direction: row;
    }
    #senha{
        height: 30px;
        font-size: 150%;
        border: solid black 3px;
        border-radius: 5px;
    }
    #BtEnviar{
        margin-left: 10px;
        margin-right: 10px;
        height: 30px;
    }
    form{
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    .data{
    margin-left:10px;
    margin-right:10px;
    border: solid black 3px;
    border-radius: 5px;
    font-size: 150%;
    font-weight: 600;
    height: 30px;
    }
    #cabecalho{
    display: flex;
    align-items: center;
    justify-content: center; /* Garante que os itens sejam distribuídos */
    flex-direction: column;
    left: 0;
    top:0;
    width:100%;
    height: 85px;
    border: solid black 5px;
    border-bottom: solid rgb(0, 0, 0) 5px ;
    background-color: antiquewhite;
    overflow: auto; /* Garante que o menu não "quebre" */
    padding-left: 10px;
    padding-right: 10px;
    flex-direction: column;
}
#cabecalho_menu{
    display: flex;
    align-items: center;
    width: 100%;
    height: 100%;
}
.botao{
    background-color: antiquewhite;
    border: 0px;
    padding: 2px;
    cursor: pointer;    
    font-size:150% ;
}
.botao:hover{
    transition: 0.5s;
    transform: scale(110%);
    background-color: rgb(247, 94, 94);
    border-radius: 10%;
}
.itens{
    width: 50px;
    height: 50px;
    margin-left: 19px;
    margin-right: 19px;
}
#grav{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-top: 10px;
    width:100%;
}
.titulo{
    display: flex;
    align-items: center;
    font-size: 200%;
    font-weight: 700;
    margin-bottom: 10px;
}
#PedidosGrav{
    display: flex;
    justify-content: center;
    align-items: flex-start;
    width: 100%;
    flex-direction: row;
    flex-wrap: wrap;
}
.pedidos{
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: flex-start;
    width: 48%;
    height: 100%;
    border: solid black 5px;
    border-radius: 10px;
    margin: 1%;
}
.tituloPedido{
    font-weight: 700;
    color: rgb(0, 0, 0);
}
.tituloData{
    font-weight: 700;
    color: rgb(209, 22, 22);
}
.tituloDataBlue{
    font-weight: 700;
    color: rgb(22, 103, 209);
}
.gravacoes{
    font-size: 180%;
    font-weight: 600;
    color: rgb(0, 0, 0);
    margin-left: 10px;
    margin-right: 10px;
}
</style>
<body>
    <div id="cabecalho">
        <div id="cabecalho_menu">
            <div id="casa">
                <button type="button" value=""  class="botao" >
                <a href="../gravacao.php"><img class="itens" src="../../Escritorio/casa.png"></a>
                </button>
            </div>
            
        </div>
    </div>
    <form action="./comicao.php" method="post">
        <div id = 'senhadiv'>
            <h2><label for="senha">Senha-> </label></h2>
            <Input id="senha" name="senha" value="<?php echo $_POST['senha']?? "";?>" type="password">
            <button id="BtEnviar" type="submit">Enviar</button>
            <input class="data" id="dataInput1" value="<?php echo $_POST['dataInput']?? date('Y-m-d');?>" name="dataInput" type="date"><h2>ATÉ</h2>
            <input class="data" id="dataInput2" value="<?php echo $_POST['dataInput2']?? date('Y-m-d');?>" name="dataInput2" type="date">
            <h2>DIAS GRAVAÇÃO</h2>
            <input class="data" id="dataInput3" value="<?php echo $_POST['dataInput3']?? date('Y-m-d');?>" name="dataInput3" type="date">
        </div>
    </form>
        <div id="grav">
            <?php 
                $senha = null;
            if($_POST){
                $senha = $_POST['senha'];
                $data1 = $_POST['dataInput'];
                $data2 = $_POST['dataInput2'];
                $data3 = $_POST['dataInput3'];
            }
            if($senha == '3567'){
                ?><div class="titulo"><?php
                    echo "Acesso Liberado<br>";
                ?></div> 
                <div><?php
                if(isset($_COOKIE['Gravacao_' . $data3])){
                    echo "<h1>Pedidos Gravados Hoje: <span style='color: red;'>" . $_COOKIE['Gravacao_' . $data3] .'</span></h1>';
                }
                else{
                    echo "<h1>Pedidos Gravados Hoje: <span style='color: red;'>Sem dados</span></h1>";
                }
                ?></div>
                <div id="PedidosGrav">
                    <div class="pedidos"><?php
                        banco($conectar,'pedidosp',$data1,$data2);
                    ?></div>
                    <div class="pedidos"><?php
                        banco($conectar,'pedidospg',$data1,$data2);
                    ?></div>
                </div><?php

            }
            else{
                ?><div class="titulo"><?php
                echo "<h1>Acesso Negado</h1>";
                ?></div><?php
            }
            ?>
        </div>
</body>
</html>