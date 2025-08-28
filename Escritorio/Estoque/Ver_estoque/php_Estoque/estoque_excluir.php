<?php 
    include_once '../../../../phpIndex/protege.php';
    proteger();

include_once('../../../../conexao.php');
include_once('../../../../scripts/phpGlobal/backEnd/estoqueFunction.php');

function chave_estrangeira($nome, $conectar, $tabelas){

    $sql_update_pedidosp = "UPDATE $tabelas SET estoque = NULL WHERE estoque = ?";
    $stmt = $conectar->prepare($sql_update_pedidosp);
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $stmt->close();
}
//variavel 
$nome = $_POST['nome'];


chave_estrangeira($nome, $conectar, 'pedidos');
chave_estrangeira($nome, $conectar, 'pedidosp');
chave_estrangeira($nome, $conectar, 'pedidospg');
chave_estrangeira($nome, $conectar, 'pedidospe');


//excluir da tabela reabastecer_estoque
excluir_estoque('reabastecer_estoque',$nome,$conectar);

//excluir da tabela reabastecer_estoque
excluir_estoque('reabastecer_estoque_polimento',$nome,$conectar);

//excluir da tabela estoque
excluir_estoque('estoque',$nome,$conectar);

//excluir da tabela reabastecer_estoque
excluir_estoque('estoque_esgotado',$nome,$conectar);


?>
