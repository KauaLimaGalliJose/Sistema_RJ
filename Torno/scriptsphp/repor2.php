
<?php
include_once ('../../scripts/phpGlobal/backEnd/estoqueFunction.php');

function banco($nome, $conectar, $nomeTabela, $numero_estoque, $valor_do_estoque ,$loca_do_estoque ){

    $queryEstoque = "SELECT `$numero_estoque` FROM $nomeTabela WHERE nome = ?";
    $stmtSelect = $conectar->prepare($queryEstoque);
    $stmtSelect->bind_param("s", $nome);
    $stmtSelect->execute();
    $result = $stmtSelect->get_result();

    if ($linha = $result->fetch_assoc()) {

         if( (int)$linha[$numero_estoque]  <= 0 ){
                echo "Estoque esgotado";
                return;
        }
        else{
            
            if($valor_do_estoque == 'negativo'){

                $numero_f = (int)$linha[$numero_estoque] - 1;

                if($numero_f < 0){

                    $numero_f = 0;
                }
                
                // Atualiza o estoque
                $updateQuery = "UPDATE $nomeTabela SET `$numero_estoque` = ? WHERE nome = ?";
                $stmtUpdate = $conectar->prepare($updateQuery);
                $stmtUpdate->bind_param("is", $numero_f, $nome);
                $stmtUpdate->execute();
                $stmtUpdate->close();


            }
            elseif($valor_do_estoque == 'positivo'){

                $numero_f = (int)$linha[$numero_estoque] + 1;
                
                // Atualiza o estoque
                $updateQuery = "UPDATE $nomeTabela SET `$numero_estoque` = ? WHERE nome = ?";
                $stmtUpdate = $conectar->prepare($updateQuery);
                $stmtUpdate->bind_param("is", $numero_f, $nome);
                $stmtUpdate->execute();
                $stmtUpdate->close();

            }
            
        }
    }
    // daqui para baixo é só outras tabelas só uma em expecifico muda ela mesma
    if($loca_do_estoque == 'torno'){

        $queryEstoque = "SELECT `$numero_estoque` FROM reabastecer_estoque_polimento WHERE nome = ?";
        $stmtSelect = $conectar->prepare($queryEstoque);
        $stmtSelect->bind_param("s", $nome);
        $stmtSelect->execute();
        $result = $stmtSelect->get_result();

        if ($linha = $result->fetch_assoc()) {

            if($valor_do_estoque == 'positivo'){

               $numero_f = $linha[$numero_estoque] - 1;

                if($numero_f < 0){

                    $numero_f = 0;
                }

                $updateQuery = "UPDATE reabastecer_estoque_polimento SET `$numero_estoque` = ? WHERE nome = ?";
                $stmtUpdate = $conectar->prepare($updateQuery);
                $stmtUpdate->bind_param("is", $numero_f, $nome);
                $stmtUpdate->execute();
                $stmtUpdate->close();


            }
            elseif($valor_do_estoque == 'negativo'){

                $numero_f = $linha[$numero_estoque] + 1;

                $updateQuery = "UPDATE reabastecer_estoque_polimento SET `$numero_estoque` = ? WHERE nome = ?";
                $stmtUpdate = $conectar->prepare($updateQuery);
                $stmtUpdate->bind_param("is", $numero_f, $nome);
                $stmtUpdate->execute();
                $stmtUpdate->close();
            }

                    
        }
        $stmtSelect->close();
        echo "torno " ;
    }
    elseif($loca_do_estoque == 'polimento'){

        $queryEstoque = "SELECT `$numero_estoque` FROM estoque WHERE nome = ?";
        $stmtSelect = $conectar->prepare($queryEstoque);
        $stmtSelect->bind_param("s", $nome);
        $stmtSelect->execute();
        $result = $stmtSelect->get_result();

        if ($linha = $result->fetch_assoc()) {

            if($valor_do_estoque == 'positivo'){
  
                if($linha[$numero_estoque] <= 0){
                    
                    tira_estoque($numero_estoque,$nome, $nomeTabela ,$conectar);
                    
                    return;
                }

                $numero_f = $linha[$numero_estoque] - 1;

                $updateQuery = "UPDATE estoque SET `$numero_estoque` = ? WHERE nome = ?";
                $stmtUpdate = $conectar->prepare($updateQuery);
                $stmtUpdate->bind_param("is", $numero_f, $nome);
                $stmtUpdate->execute();
                $stmtUpdate->close();


            }
            elseif($valor_do_estoque == 'negativo'){

                $numero_f = $linha[$numero_estoque] + 1;

                $updateQuery = "UPDATE estoque SET `$numero_estoque` = ? WHERE nome = ?";
                $stmtUpdate = $conectar->prepare($updateQuery);
                $stmtUpdate->bind_param("is", $numero_f, $nome);
                $stmtUpdate->execute();
                $stmtUpdate->close();

            }

                    
        }
        $stmtSelect->close();
        echo "polimento " ;
    }
}



include_once '../../phpIndex/protege.php';
include_once('../../conexao.php');
proteger(); // Chama a função para verificar o token antes de carregar a página

    //dados do Post
    $estoque_nome = $_POST['estoque_nome'] = $_POST['estoque_nome'] ?? 'Falta';
    $loca_do_estoque = $_POST['local'] = $_POST['local'] ?? 'Falta';
    $numero_do_estoque = $_POST['numero_'] = $_POST['numero_'] ?? 'Falta';
    $valor_do_estoque = $_POST['numero_value'] = $_POST['numero_value'] ?? 'Falta';

    if($_POST['estoque_nome'] == 'Falta' || $_POST['local'] == 'Falta' || $_POST['numero_'] == 'Falta' || $_POST['numero_value'] == 'Falta' ) {
        echo '<p>Erro os dados não estão sendo eviados.</p>';

        echo 'estoque_nome: ' . $estoque_nome ;
        echo 'local: ' . $loca_do_estoque;
        echo 'numero_estoque: ' . $numero_do_estoque ;
        echo 'valor_do_estoque: ' . $valor_do_estoque ;
        exit;
    }
    else {
        if($_POST['local'] == 'torno') {
            banco($estoque_nome, $conectar, 'reabastecer_estoque', $numero_do_estoque, $valor_do_estoque, $loca_do_estoque);

        }
        elseif($_POST['local'] == 'polimento') {
            banco($estoque_nome, $conectar, 'reabastecer_estoque_polimento', $numero_do_estoque, $valor_do_estoque, $loca_do_estoque);

        }
        else {
            echo 'Esse valor não se encaixa em nenhum estoque.';
        }
    }
