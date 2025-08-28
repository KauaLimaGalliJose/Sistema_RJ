<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="shortcut icon" href="../../Escritorio_img/coroa.ico" type="image/x-icon">
    <link href="CriarEstoque.css" rel="stylesheet">
    <script src="CriarEstoque.js" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Criar</title>
</head>
<body>
    <div id="cabecalho">
            <div id="casa">
                <button type="button" id="seta_esquerda" value="" class="botao" >
                    <a href="../Estoque_Pagina_Inicial.html"><img class="itens" src="Imagens_criar_Estoque/angulo-esquerdo.png"></a>
                </button>

                <button type="button" value="" class="botao" >
                    <a href="../../PG2-Escritorio.php"><img class="itens" src="Imagens_criar_Estoque/casa.png"></a>
                </button>
            </div>      
    </div>
        <form id = "formulario" action="CriarEstoque.php" method="post" enctype="multipart/form-data">
            <div id="divFormulario">
                <div id="pedido">
                    <div id="inputs">
                        <div class="DivInputs">
                            <label class="titulosInput">Nome do Estoque</label>
                            <input id = 'nome_Estoque' name="nome_Estoque" type="text" class="NomePedido">
                            <label class="titulosInput">Peso da Unidade</label>
                            <input id = 'peso' name="peso" type="number" step="0.01" class="NomePedido" placeholder="Gramas">
                        </div>
                        <div class="DivInputs">
                            <label class="titulosInput"></label>
                            <textarea id = 'descricao_Estoque' placeholder='Descrição do pedido' name="descricao_Estoque" class="descricao"></textarea>  
                        </div>
                    </div>
                    <div id="imagem">
                        <label class="custum-file-upload" id = "labelImagem" for="InputImagem">
                        <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24"><g stroke-width="0" id="SVGRepo_bgCarrier"></g><g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g><g id="SVGRepo_iconCarrier"> <path fill="" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" clip-rule="evenodd" fill-rule="evenodd"></path> </g></svg>
                        </div>
                        <div class="text">
                        <span>Escolher imagem</span>
                        </div>
                        <input  type="file"  id="InputImagem" src="#" name ="imagem"   accept="image/png, image/jpeg, image/jpg">
                        </label>
                        <img id="preview" src="#" alt="Pré-visualização da Imagem">
                        <div id="trocarImgDiv" for = "trocarImg">
                            <label id="trocarImg" for="InputImagem">Mudar Imagem </label>
                        </div>
                    </div>
                </div>
                <div id = "Enviar" >
                    <button id="submitBtt" class="button" type="submit">Salvar</button>
                </div>
            </div>
        </form>

</body>
</html>

<?php
    include_once '../../../phpIndex/protege.php';
    proteger();
?>

<?php
//Bibliotecas
include_once('../../../conexao.php');

// function 
function salvarBanco($conectar , $nome_Tabela , $nome, $descricao, $peso, $imagem, 
$n9, $n10, $n11, $n12, $n13, $n14, $n15, $n16, $n17, $n18, $n19, $n20, $n21, $n22,
$n23, $n24, $n25, $n26, $n27, $n28, $n29, $n30, $n31, $n32, $n33, $n34, $n35) {
    // Implementar a lógica de inserção no banco de dados

     // passando pro banco de dados
        $dados = $conectar->prepare("INSERT INTO $nome_Tabela 
        (nome, descricaoEstoque, imagem, peso, `9`, `10`, `11`, `12`, `13`, `14`, `15`, `16`, `17`, `18`, `19`, `20`, `21`, `22`, `23`, `24`, `25`, `26`, `27`, `28`, `29`, `30`, `31`, `32`, `33`, `34`, `35`)
        VALUES (?, ?, ?, ?, ? , ? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,?)");

        $dados->bind_param("sssdiiiiiiiiiiiiiiiiiiiiiiiiiii",$nome, $descricao, $imagem, $peso,
        $n9, $n10, $n11, $n12, $n13, $n14, $n15, $n16, $n17, $n18, $n19, $n20, $n21, $n22, $n23, $n24, $n25, $n26, $n27, $n28, $n29, $n30, $n31, $n32, $n33, $n34, $n35);

        $dados->execute();
        $dados->close();
}

if($_POST){

    $nome = $_POST['nome_Estoque']?? '';
    $descricao = $_POST['descricao_Estoque']?? '';
    $peso = $_POST['peso']?? '';
    
    //Buscando se já existe nome no banco de dados    
    $buscaBanco = "SELECT COUNT(*) FROM estoque WHERE nome LIKE '$nome'";
    $resultado = mysqli_query($conectar, $buscaBanco);
    (int)$linha = mysqli_fetch_row($resultado);

    for ($i = 9; $i <= 35; $i++) {
        ${"n$i"} = 0;
    }

    //imagem 
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
        $nomeArquivo = "estoque_" . preg_replace('/[^a-zA-Z0-9_-]/', '', $nome) . '.png';
        $caminhoImagem = "/imagem/imagens_Estoque/" . $nomeArquivo;

        if($nome == '/imagem/imagens_Estoque/estoque_Nenhum.png' || $nome == 'nenhum'){

        echo "<script>alert('Tente outro nome')</script>";
        return; 
        }
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], dirname(__DIR__, 3) . $caminhoImagem)) {
            $imagem = $caminhoImagem;
        } else {
            echo "<script>alert('Erro ao fazer upload da imagem!')</script>";
            return;
        }
    }

    if($nome == 'Nenhum' || $nome == 'nenhum'){

        echo "<script>alert('Não Pode ter esse nome')</script>";
        return; 
    }
    if( $linha[0] == 0 ){
        // Para criar estoque ----------------------------------------------------

        salvarBanco($conectar , 'estoque' , $nome, $descricao, $peso, $imagem, 
        $n9, $n10, $n11, $n12, $n13, 
        $n14, $n15, $n16, $n17, $n18, $n19, $n20, $n21, 
        $n22, $n23, $n24, $n25, $n26, $n27, $n28, $n29, $n30, $n31, $n32, $n33, $n34, $n35);

        // Para reabastecer ----------------------------------------------------
        salvarBanco($conectar , 'reabastecer_estoque' , $nome, $descricao, $peso, $imagem, 
        $n9, $n10, $n11, $n12, $n13, 
        $n14, $n15, $n16, $n17, $n18, $n19, $n20, $n21, 
        $n22, $n23, $n24, $n25, $n26, $n27, $n28, $n29, $n30, $n31, $n32, $n33, $n34, $n35);

        // Para o Polimento ----------------------------------------------------
        salvarBanco($conectar , 'reabastecer_estoque_polimento' , $nome, $descricao, $peso, $imagem, 
        $n9, $n10, $n11, $n12, $n13, 
        $n14, $n15, $n16, $n17, $n18, $n19, $n20, $n21, 
        $n22, $n23, $n24, $n25, $n26, $n27, $n28, $n29, $n30, $n31, $n32, $n33, $n34, $n35);
        
        echo "<script>alert('Enviado com sucesso')</script>";
    }
    else{
        echo "<script>alert('O estoque já existe!! \\n Tente outro nome')</script>";
    }
}

