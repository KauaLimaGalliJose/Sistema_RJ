<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../coroa.png" type="image/x-icon">
    <link rel="stylesheet" href="larguraTorno.css">
    <script src="./larguraTorno.js" defer></script>
    <title>Torno Largura</title>
</head>
<body>
<form id="formulario" method="POST" action="larguraFundecao.php">
    <div id="cabecalho">
        <div id="cabecalho_menu">
            <div id="casa">
                <button type="button"  value=""  class="botao" >
                <a href="../torno.php"><img class="itens" src="../../Escritorio/casa.png"></a>
                </button>
            </div>
                <input class="data" id="dataInput" name="dataInput" type="date">
                <button type="submit" id="enviar"><h1>Pesquisar</h1></button>

                <button type='button' id="imprimir" class="botao">
                    <img class="itens" src="../imagem/impressora-50.png">
                </button>
        </div>
    </div>
</form>
    <?php include_once('../../conexao.php');?>

    <?php 
    if($_POST){
       $data =  $_POST['dataInput']?? null;
    }
    ?>
    <div id="phpmae">
        <div id="largura">
            <?php
            if(isset($data)){
                $dados = "SELECT * FROM `pedidosp` WHERE `contadorpf` <> 0
                AND data_digitada = '$data'
                ORDER BY `contadorpf` ASC";
               
                $resultadoDados = mysqli_query($conectar,$dados);
                $resultadoDados3mm = mysqli_query($conectar,$dados);
            
            ?>
            <div id="superior">
                <div id="2mm" class="larguras">
                    <div class="tituloLargura">
                        <label >-- 2MM --</label>
                    </div>
                    <?php
                        while($linha = mysqli_fetch_assoc($resultadoDados)){
                        
                            
                            if($linha['largura'] == '2mm'){
                                ?>
                                    
                                <?php
                            }
                        }
                    ?>
                </div>
                <div id="3mm" class="larguras">
                    <div class="tituloLargura">
                        <label>-- 3MM --</label>
                    </div>
                        <div class="numeracoes">
                            <?php
                                while($linha = mysqli_fetch_assoc($resultadoDados3mm)){
                                    $largura = $linha['largura'];
                                    
                                    if($largura == '3mm'){
                                        ?>
                                        <div class="numercao">
                                        <?php 
                                            echo $linha['numF'];
                                        ?>
                                        </div>
                                        <?php
                                    }
                                }
                            ?>
                    </div>
                </div>
                <div id="4mm" class="larguras">
                    <div class="tituloLargura">
                        <label>-- 4MM --</label>
                    </div>
                    <?php

                    ?>
                </div>
                <div id="5mm" class="larguras">
                    <div class="tituloLargura">
                        <label>-- 5MM --</label>
                    </div>
                    <?php

                    ?>
                </div>
                <div id="6mm" class="larguras">
                    <div class="tituloLargura">
                        <label>-- 6MM --</label>
                    </div>
                    <?php

                    ?>
                </div>
            </div>
            <div id="inferior">
                <div id="7mm" class="larguras">
                    <div class="tituloLargura">
                        <label>-- 7MM --</label>
                    </div>
                    <?php

                    ?>
                </div>
                <div id="8mm" class="larguras">
                    <div class="tituloLargura">
                        <label>-- 8MM --</label>
                    </div>
                    <?php

                    ?>
                </div>
                <div id="9mm" class="larguras">
                    <div class="tituloLargura">
                        <label>-- 9MM  --</label>
                    </div>
                    <?php

                    ?>
                </div>
                <div id="10mm" class="larguras">
                    <div class="tituloLargura">
                        <label>-- 10MM --</label>
                    </div>
                    <?php

                    ?>
                </div>
                <div id="Dia" class="larguras">
                    <div class="tituloLargura">
                        <label>Anotações</label>
                    </div>
                    <?php

                    ?>
                </div>
            </div>
            <div class="pesquise">
                <?php
                    }
                   ?>
            </div>
        </div>
    </div>
</body>
</html>