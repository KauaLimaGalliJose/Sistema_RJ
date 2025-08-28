<?php
//Função para atualizar o nome do estoque em todas as tabelas relacionadas(quaquer pedido)-------------------------------------------------
// Paginas que usam essa função: Escritorio/Estoque/Ver_estoque/php_Estoque/estoque_editar.php
function atualizar_chaveEstrageira_pedido($nomeAntigo, $nomeNovo, $nomeTabela ,$pedidos , $conectar) {

    if(!empty($pedidos) || $pedidos != null){

        foreach($pedidos as $idpedidos){

            $sql_update = "UPDATE $nomeTabela SET estoque = ? WHERE idpedidos = ?";

            $stmt = $conectar->prepare($sql_update);
            $stmt->bind_param("ss", $nomeNovo, $idpedidos);
            $stmt->execute();

            $stmt->close();
        }
        
    }
    else{

        $selct = "SELECT * FROM $nomeTabela WHERE estoque = ?";
        $selectConect = $conectar->prepare($selct);
        $selectConect->bind_param("s", $nomeAntigo);
        $selectConect->execute();
        $result = $selectConect->get_result();

        //variaveis
        $pedidos = [];

        while($dados = $result->fetch_assoc()){

        $pedidos[] =  $dados['idpedidos'];
        }


        $sql_update = "UPDATE $nomeTabela SET estoque = ? WHERE estoque = ?";

        $stmt = $conectar->prepare($sql_update);
        $stmt->bind_param("ss", $nomeNovo, $nomeAntigo);
        $stmt->execute();

        $stmt->close();

        return $pedidos;
    }

}