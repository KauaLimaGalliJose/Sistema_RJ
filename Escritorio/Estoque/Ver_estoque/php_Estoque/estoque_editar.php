<?php 


include_once('../../../../conexao.php');
include_once('../../../../scripts/phpGlobal/backEnd/estoque/estoqueFunction.php');
include_once('../../../../scripts/phpGlobal/backEnd/estoque/pedidosFunction.php');

// Variáveis
$nome        = $_POST['nome'];
$nome_Input  = $_POST['nome_Esoque'];
$peso        = $_POST['Peso_Esoque'];
$descricao   = $_POST['descricao_Esoque'];
$imagem_estoque = $_POST['Imagem_Esoque'] ?? null;

$imagem = null; // default

// Gera nome do arquivo
$nomeArquivo = "estoque_" . preg_replace('/[^a-zA-Z0-9_-]/', '', $nome) . '.png';
$caminhoImagem = "/arquivos_Sistema/imagens_Estoque/" . $nomeArquivo;

// Verifica se veio upload
if (isset($_FILES['Imagem_Esoque']) && $_FILES['Imagem_Esoque']['error'] === UPLOAD_ERR_OK) {
    $tmpName = $_FILES['Imagem_Esoque']['tmp_name'];

    // move o arquivo pro destino final
    if (move_uploaded_file($tmpName, dirname(__DIR__, 4) . $caminhoImagem)) {
        $imagem = $caminhoImagem;
    }
} elseif ($imagem_estoque) {
    // Se não enviou novo upload mas já existe imagem salva
    $imagem = $imagem_estoque;
}

$estoques_pedidos = [];

// "Apaga" o nome antigo em todas as tabelas (define como NULL ou faz o que a função fizer com null) apenas a chave estrangeira estoque
$estoques_pedidos = array_merge(
    $estoques_pedidos,
    atualizar_chaveEstrageira_pedido($nome, null, 'pedidos', null ,$conectar),
    atualizar_chaveEstrageira_pedido($nome, null, 'pedidosp', null ,$conectar),
    atualizar_chaveEstrageira_pedido($nome, null, 'pedidospg', null ,$conectar),
    atualizar_chaveEstrageira_pedido($nome, null, 'pedidospe', null ,$conectar)
);

// estoque ---------------------------------------------------------------------------------------------
editar_pedido_estoque('estoque',$nome_Input,$nome,$imagem,$peso,$descricao,$conectar);

// reabastecer_estoque ----------------------------------------------------------------------------------
editar_pedido_estoque('reabastecer_estoque',$nome_Input,$nome,$imagem,$peso,$descricao,$conectar);

// reabastecer_estoque_polimento ------------------------------------------------------------------------
editar_pedido_estoque('reabastecer_estoque_polimento',$nome_Input,$nome,$imagem,$peso,$descricao,$conectar);

// estoque_esgotado -------------------------------------------------------------------------------------
editar_pedido_estoque('estoque_esgotado',$nome_Input,$nome,$imagem,$peso,$descricao,$conectar);

// Atualiza o nome do estoque em todas as tabelas relacionadas
atualizar_chaveEstrageira_pedido($nome, $nome_Input, 'pedidos' ,$estoques_pedidos,$conectar);
atualizar_chaveEstrageira_pedido($nome, $nome_Input, 'pedidosp' ,$estoques_pedidos,$conectar);
atualizar_chaveEstrageira_pedido($nome, $nome_Input, 'pedidospg' ,$estoques_pedidos,$conectar);
atualizar_chaveEstrageira_pedido($nome, $nome_Input, 'pedidospe' ,$estoques_pedidos,$conectar);
?>