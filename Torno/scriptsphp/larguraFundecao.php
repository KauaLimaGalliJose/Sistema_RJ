<?php 
//Funções 
function largura($larguraAlianca,$conectar,$data){

    $dados = "SELECT * FROM `pedidosp` WHERE `contadorpf` <> 0
    AND data_digitada = '$data'
    ORDER BY `contadorpf` ASC";
   
    $resultadoDados = mysqli_query($conectar,$dados);

    ?>
    <div class="numeracoes">
                <?php
                    while($linha = mysqli_fetch_assoc($resultadoDados)){
                        $largura = $linha['largura'];
                        $numeracaoF = $linha['numF'];
                        $numeracaoM = $linha['numeM'];
                        $estoqueFeminina = $linha['parEstoqueF'];
                        $estoqueMasculina = $linha['parEstoqueM'];

                        
                        if($largura == $larguraAlianca){
                            ?>
                            <div class="numercao">
                                <?php
                                    if($estoqueFeminina != null){
                                        $numeracaoF = '';
                                    }
                                    if($estoqueMasculina != null){
                                        $numeracaoM = '';
                                    }

                                    if($numeracaoF !== '40'){
                                        echo $numeracaoF . ',';
                                    }
                                    echo $numeracaoM;
                                ?>
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
            <?php 
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../coroa.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/larguraTorno.css">
    <script src="/js/larguraTorno.js" defer></script>
    <title>Torno Largura</title>
</head>
<body>
<form id="formulario" method="POST" action="larguraFundecao.php">
    <div id="cabecalho">
        <div id="cabecalho_menu">
            <div id="casa">
                <button type="button"  value=""  class="botao" >
                <a href="../torno.php"><img class="itens" src="../../Escritorio/Escritorio_img/casa.png"></a>
                </button>
            </div>
                <input class="data" value="<?php echo $_POST['dataInput']?? date('Y-m-d'); ?>" id="dataInput" name="dataInput" type="date">
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
            ?>

            <div id="superior">

                <div id="2mm" class="larguras">
                    <div class="tituloLargura">
                        <label >-- 2MM --</label>
                    </div>
                       <?php 
                            largura('2mm',$conectar,$data);
                       ?>
                </div>
                
                <div id="3mm" class="larguras">
                    <div class="tituloLargura">
                        <label>-- 3MM --</label>
                    </div>
                    <?php 
                            largura('3mm',$conectar,$data);
                       ?> 
                </div>

                <div id="4mm" class="larguras">
                    <div class="tituloLargura">
                        <label>-- 4MM --</label>
                    </div>
                    <?php 
                            largura('4mm',$conectar,$data);
                       ?>
                </div>

                <div id="5mm" class="larguras">
                    <div class="tituloLargura">
                        <label>-- 5MM --</label>
                    </div>
                        <?php 
                            largura('5mm',$conectar,$data);
                       ?>
                </div>

                <div id="6mm" class="larguras">
                    <div class="tituloLargura">
                        <label>-- 6MM --</label>
                    </div>
                        <?php 
                            largura('6mm',$conectar,$data);
                       ?>
                </div>

            </div>
            <div id="inferior">

                <div id="7mm" class="larguras">
                    <div class="tituloLargura">
                        <label>-- 7MM --</label>
                    </div>
                        <?php 
                            largura('7mm',$conectar,$data);
                       ?>
                </div>

                <div id="8mm" class="larguras">
                    <div class="tituloLargura">
                        <label>-- 8MM --</label>
                    </div>
                    <?php 
                            largura('8mm',$conectar,$data);
                       ?>
                </div>

                <div id="9mm" class="larguras">
                    <div class="tituloLargura">
                        <label>-- 9MM  --</label>
                    </div>
                       <?php 
                            largura('9mm',$conectar,$data);
                       ?>
                </div>

                <div id="10mm" class="larguras">
                    <div class="tituloLargura">
                        <label>-- 10MM --</label>
                    </div>
                        <?php 
                            largura('10mm',$conectar,$data);
                       ?>
                </div>

                <div id="Dia" class="larguras">
                    <div class="tituloLargura">
                        <label>Anotações</label>
                    </div>
                </div>      
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</body>
</html>