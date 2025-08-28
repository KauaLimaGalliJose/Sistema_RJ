<?php include_once('../../../conexao.php');?>
<?php


    //dados do Post
    $nome = $_POST['estoque_nome']  ?? 'Falta';
    $loca_do_estoque = $_POST['local']  ?? 'Falta';
    $numero_do_estoque = $_POST['numero_'] ?? 'Falta';
    $valor_do_estoque = $_POST['numero_value']  ?? 'Falta';

    if($_POST['estoque_nome'] == 'Falta' || $_POST['local'] == 'Falta' || $_POST['numero_'] == 'Falta' || $_POST['numero_value'] == 'Falta' ) {
        echo '<p>Erro os dados não estão sendo eviados.</p>';

        echo 'estoque_nome: ' . $estoque_nome ;
        echo 'local: ' . $loca_do_estoque;
        echo 'numero_estoque: ' . $numero_do_estoque ;
        echo 'valor_do_estoque: ' . $valor_do_estoque ;
        exit;
    }

        $queryEstoque = "SELECT `$numero_do_estoque` FROM estoque_esgotado WHERE nome = ?";
        $stmtSelect = $conectar->prepare($queryEstoque);
        $stmtSelect->bind_param("s", $nome);
        $stmtSelect->execute();
        $result = $stmtSelect->get_result();

        if ($linha = $result->fetch_assoc()) {

            if($valor_do_estoque == 'positivo'){

               $numero_f = $linha[$numero_do_estoque] + 1;


                $updateQuery = "UPDATE estoque_esgotado SET `$numero_do_estoque` = ? WHERE nome = ?";
                $stmtUpdate = $conectar->prepare($updateQuery);
                $stmtUpdate->bind_param("is", $numero_f, $nome);
                $stmtUpdate->execute();
                $stmtUpdate->close();


            }
            elseif($valor_do_estoque == 'negativo'){

                $numero_f = $linha[$numero_do_estoque] - 1;
                
                if($numero_f <= 0){

                    $numero_f = 0;
                }

                $updateQuery = "UPDATE estoque_esgotado SET `$numero_do_estoque` = ? WHERE nome = ?";
                $stmtUpdate = $conectar->prepare($updateQuery);
                $stmtUpdate->bind_param("is", $numero_f, $nome);
                $stmtUpdate->execute();
                $stmtUpdate->close();
            }

                    
        }
        $stmtSelect->close();
        echo "torno " ;   

mysqli_close($conectar);
echo "chegou aaaeeee";