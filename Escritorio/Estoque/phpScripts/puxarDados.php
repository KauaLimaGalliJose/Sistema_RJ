<?php

// Usado no PG2_Escritorio.php 
function titulosDoEstoque($conectar){
    
   $estoqueTituloGe = $_GET['estoque'] ?? null;

    if( $estoqueTituloGe != null ){

        $nomeEstoque = $_GET['estoque'];

        echo "<option class='font_blu' id = '$nomeEstoque' value='$nomeEstoque' selected>$nomeEstoque</option>";

        $estoqueTitulo = "SELECT nome FROM estoque WHERE nome <> '$nomeEstoque'";
        $conectarEstoque = mysqli_query($conectar, $estoqueTitulo);
    }
    else{
    
        $estoqueTitulo = "SELECT nome FROM estoque";
        $conectarEstoque = mysqli_query($conectar, $estoqueTitulo);
    }
    
    while ($linha = mysqli_fetch_assoc($conectarEstoque)) {

        $nome = $linha['nome'] ;
        echo "<option  id = '$nome' value='$nome'>$nome</option>";

    }
}

function titulosDoEstoqueImg($conectar, $nome , $caminho) {
    // Prepara a query para evitar SQL Injection
    $stmt = $conectar->prepare("SELECT imagem FROM estoque WHERE nome = ?");
    
    if (!$stmt) {
        // Se falhar em preparar, exibe erro
        echo "Erro ao preparar statement: " . $conectar->error;
        return;
    }

    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ( $linha = $resultado->fetch_assoc() ) {

        echo $caminho . $linha['imagem'];
        
    } else {
        echo "Imagem não encontrada.";
    }

    $stmt->close();
}

function titulosDoEstoqueCaminho($conectar, $nome) {
    // Prepara a query para evitar SQL Injection
    $stmt = $conectar->prepare("SELECT imagem FROM estoque WHERE nome = ?");
    
    if (!$stmt) {
        // Se falhar em preparar, exibe erro
        echo "Erro ao preparar statement: " . $conectar->error;
        return;
    }

    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ( $linha = $resultado->fetch_assoc() ) {

        echo 'value="..' . $linha['imagem'] . '" name = "estoqueImg" ';
        
    } else {
        echo "Imagem não encontrada.";
    }

    $stmt->close();
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
// Pegar peso do estoque
function PesoDoEstoque($conectar, $nome) {

    $stmt = $conectar->prepare("SELECT peso FROM estoque WHERE nome = ?");
    if (!$stmt) {
        return null; // não devolve HTML dentro do input
    }

    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($linha = $resultado->fetch_assoc()) {

        $peso = $linha['peso']*2; // peso do par

        $pesoFormatado = number_format($peso, 2, ',', ''); // Formata com vírgula


        return $pesoFormatado;   // AGORA RETORNA
    }

    return null; // não achou nada
}
?>