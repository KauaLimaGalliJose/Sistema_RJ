<?php

// Usado no PG2_Escritorio.php 
function titulosDoEstoque($conectar){
    
    $estoqueTitulo = "SELECT nome FROM estoque";
    $conectarEstoque = mysqli_query($conectar, $estoqueTitulo);
    
    while ($linha = mysqli_fetch_assoc($conectarEstoque)) {

        $nome = $linha['nome'];
        echo "<option id = '$nome' value='$nome'>$nome</option>";
    }
}

// Usado na pagina ver_estoque.php
function verEstoque($conectar){

    $estoque = "SELECT * FROM estoque";
    $conectarEstoque = mysqli_query($conectar, $estoque);

    if(mysqli_num_rows($conectarEstoque) == 0){
        echo "<div id = 'Sem_estoque'>";
        echo '<h1>  ----- Sem estoques ----- </br></br> Crie um para começar  </h1>';
        ?>
            <a  href="../Criar_estoque/CriarEstoque.php" id = 'criarBnt'>Criar agora</a>
        <?php
        echo "</div>";
    }
    while($linha = mysqli_fetch_assoc($conectarEstoque)){

        //Variaveis banco
        $nome =  $linha['nome'];
        $imagem =  $linha['imagem'];
        $peso =  $linha['peso'];
        $descricao =  $linha['descricaoEstoque'];
        
        echo "<form id='formulario' enctype='multipart/form-data' action='./php_Estoque/estoque.php' method='get'>";
        echo "<button class = 'botaoForm' type = 'submit'>";
        echo "<div name = '$nome' class = 'estoques' id ='$nome'>";
        
        echo "<div class = 'Estoque_Divs'><img class = 'imgEstoques' src = '../../../$imagem'></div>";
        echo "<div class = 'Estoque_Divs'><div class = 'informacoesDiv' ><h1>" . $nome . "</h1>";
        echo "<label>Peso: <span class = 'fontRed'>" . $peso . "</span></label>";
        echo "<span class = 'fontbackground'>" . nl2br($descricao) . "</span></div></div>";
        
        // Envia os dados sem exibir nada no formulário
        echo "<input type='hidden' name='nome' value='" . htmlspecialchars($nome, ENT_QUOTES) . "'>";


        echo "</div>";
        echo "</button>";
        echo "</form>";
    }
}
