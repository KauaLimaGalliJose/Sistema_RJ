<?php 

//Função para repor (quaquer estoque) -------------------------------------------------------------------
// Paginas que usam essa função: Escritorio/php/escritorio_estoque.php
function repor_estoque($n,$estoquePersonalizado,$nomeTabela ,$conectar) {

    $reabastece_estoque = "SELECT `$n` FROM $nomeTabela WHERE nome = ?";

    $reabastece_estoque_dados = $conectar->prepare($reabastece_estoque);
    $reabastece_estoque_dados->bind_param("s", $estoquePersonalizado);
    $reabastece_estoque_dados->execute();
    $result_reabastece_estoque = $reabastece_estoque_dados->get_result();

    if($dados = $result_reabastece_estoque->fetch_assoc() ){

        // Adiciona 1 de cada campo
        $numero = (int)$dados[$n] + 1;

        echo '--- Adicionando Estoque na tabela ==> '.$nomeTabela;

        // Atualiza o reabastecer_estoque
        $updateQuery = "UPDATE $nomeTabela SET `$n` = ? WHERE nome = ?";
        $stmtUpdate = $conectar->prepare($updateQuery);
        $stmtUpdate->bind_param("is", $numero, $estoquePersonalizado);
        $stmtUpdate->execute();
        $stmtUpdate->close();

    }
}

//Função para tirar (quaquer estoque) -------------------------------------------------
// Paginas que usam essa função: Escritorio/php/escritorio_estoque.php
// Paginas que usam essa função: Torno\scriptsphp\repor2.php
function tira_estoque($n,$estoquePersonalizado,$nomeTabela ,$conectar) {

    $reabastece_estoque = "SELECT `$n` FROM $nomeTabela WHERE nome = ?";

    $reabastece_estoque_dados = $conectar->prepare($reabastece_estoque);
    $reabastece_estoque_dados->bind_param("s", $estoquePersonalizado);
    $reabastece_estoque_dados->execute();
    $result_reabastece_estoque = $reabastece_estoque_dados->get_result();

    if($dados = $result_reabastece_estoque->fetch_assoc() ){

        // Adiciona 1 de cada campo
        $numero = (int)$dados[$n] - 1;

        echo '---Tirando Estoque na tabela --'.$nomeTabela;

        // Atualiza o reabastecer_estoque
        $updateQuery = "UPDATE $nomeTabela SET `$n` = ? WHERE nome = ?";
        $stmtUpdate = $conectar->prepare($updateQuery);
        $stmtUpdate->bind_param("is", $numero, $estoquePersonalizado);
        $stmtUpdate->execute();
        $stmtUpdate->close();

    }
}

//função para verificar se o estoque está zerado (quaquer estoque)-------------------------------------------------
// Paginas que usam essa função: Escritorio/php/escritorio_estoque.php
function verifica_estoque_esgotado($n,$estoque,$nomeTabela,$conectar){

    if( $estoque == null ){

        echo "Erro estoque  Indefinido ou não existe " . $estoque;

        return;
    }
    

    $sql_pedido_desatualizado = "SELECT * FROM $nomeTabela WHERE nome = '$estoque'";
    $puxardados =  $conectar->prepare($sql_pedido_desatualizado);
    $puxardados->execute();
    $result = $puxardados->get_result();

    if($linha_es = $result->fetch_assoc()){

        $quantidade = $linha_es[$n];
    }
    $puxardados->close();
    if($quantidade == 0){
        
        //echo "---" . $nomeTabela . "--- zerado reetornando true ";
        return true;
    }
    elseif($quantidade > 0){

        //echo "--- ". $nomeTabela . "--- não zerado retornando false";
        return false;
    }
}

//Função para verificar atualizar ou criar um pedido de estoque (quaquer estoque) -------------------------------------------------
// Paginas que usam essa função: Escritorio/php/escritorio_estoque.php
function criarAtualizar_pedido_estoque($n,$estoquePersonalizado,$nomeTabela,$imagem,$peso,$descricao,$conectar){
    
    //variaveis
    $data = date('Y-m-d');

    // Adiciona os pedidos caso o estoque esteja zerado ----------------------------------------------------------
    $sql_estoque_Pedido = "SELECT * FROM $nomeTabela WHERE nome = ? ";

    $pedido_estoque = $conectar->prepare($sql_estoque_Pedido);
    $pedido_estoque->bind_param("s", $estoquePersonalizado);
    $pedido_estoque->execute();
    $resultado_pedido = $pedido_estoque->get_result();
    // -------------------------------------------------------------------------------------------

    // esse é para contar 
    $sql_estoque_Pedido_count = "SELECT COUNT(*) FROM $nomeTabela WHERE nome = ? ";

    $pedido_estoque_count = $conectar->prepare($sql_estoque_Pedido_count);
    $pedido_estoque_count->bind_param("s", $estoquePersonalizado);
    $pedido_estoque_count->execute();
    $resultado_pedido_count = $pedido_estoque_count->get_result();

    //Pedidos para inteiro
    $linha_pedido = $resultado_pedido_count->fetch_row();
    $existe_pedido = (int)$linha_pedido[0];
    // -------------------------------------------------------------------------------------------

    
    // aqui verifica se já existe o pedido 
    if($existe_pedido == 0){

        echo '--- Criando pedido - ' . $nomeTabela;


        for ($i = 9; $i <= 35; $i++) {
                    
            if($i == $n){

                ${"n$i"} = 1; // Adiciona 1 ao campo específico
                    
            } 
            else 
            {
                ${"n$i"} = 0; // Zera os outros campos
            
            }
        }
                
        // passando pro banco de dados
        $dados = $conectar->prepare("INSERT INTO estoque_esgotado
        (nome, descricaoEstoque, imagem, peso, `9`, `10`, `11`, `12`, `13`, `14`, `15`, `16`, `17`, `18`, `19`, `20`, `21`, `22`, `23`, `24`, `25`, `26`, `27`, `28`, `29`, `30`, `31`, `32`, `33`, `34`, `35`, data_digitada)
        VALUES (?, ?, ?, ?, ? , ? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,?, ?)");

        $dados->bind_param("sssdiiiiiiiiiiiiiiiiiiiiiiiiiiis",$estoquePersonalizado, $descricao, $imagem, $peso,
        $n9, $n10, $n11, $n12, $n13, $n14, $n15, $n16, $n17, $n18, $n19, $n20, $n21, $n22, $n23, $n24, $n25, $n26, $n27, $n28, $n29, $n30, $n31, $n32, $n33, $n34, $n35, $data);

        $dados->execute();
        $dados->close();
            
    }
    else{

                                
        echo '--- Atualizando pedido -- ' . $nomeTabela;
                                
        if($linha_2 = $resultado_pedido->fetch_assoc()) {

            // Adiciona 1 de cada campo
            $numero_ = (int)$linha_2[$n] + 1;
                    
            // Atualiza o reabastecer_estoque
            $updateQuery = "UPDATE estoque_esgotado SET `$n` = ? WHERE nome = ?";
            $stmtUpdate = $conectar->prepare($updateQuery);
            $stmtUpdate->bind_param("is", $numero_, $estoquePersonalizado);
            $stmtUpdate->execute();
            $stmtUpdate->close();
                    
            }
    }
    $pedido_estoque->close();
    $pedido_estoque_count->close();
}

//Função para editar pedidos de estoque (quaquer estoque) -------------------------------------------------
// Paginas que usam essa função: Escritorio/Estoque/Ver_estoque/php_Estoque/estoque_editar.php
function editar_pedido_estoque($nomeTabela,$nome_Input,$nome,$imagem,$peso,$descricao,$conectar){

    
    $sql_pedido_desatualizado = "SELECT * FROM $nomeTabela WHERE nome = '$nome'";
    $puxardados =  $conectar->prepare($sql_pedido_desatualizado);
    $puxardados->execute();
    $result = $puxardados->get_result();

    if($linha = $result->fetch_assoc()){

        if($imagem == null){
            $imagem = $linha['imagem'];
        }

    }
    $puxardados->close(); 

    // aqui atualiza o estoque -------------------------------------------------
    $sql_update = "UPDATE $nomeTabela SET nome = ? , descricaoEstoque = ? , imagem = ? , peso = ? WHERE nome = ?";

    $stmt = $conectar->prepare($sql_update);
    $stmt->bind_param("sssss", $nome_Input , $descricao , $imagem , $peso , $nome);
    $stmt->execute();
    $stmt->close();
    
}

//Função para excluir pedidos de estoque (quaquer estoque) -------------------------------------------------
//Paginas que usam essa função: "Escritorio\Estoque\Ver_estoque\php_Estoque\estoque_excluir.php"
function excluir_estoque($nomeTabela,$nome,$conectar){

    // Depois: excluir do estoque
    $sql_delete_estoque = "DELETE FROM $nomeTabela WHERE nome = ?";
    $stmt = $conectar->prepare($sql_delete_estoque);
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $stmt->close();

}