<?php

include_once('../../conexao.php');

if ($_POST) {

    $queries = []; // ← guarda as queries para usar UNION

    //VERIFICA OS CHECKBOX
    if (empty($_POST['PF_peso']) && empty($_POST['PG_peso']) && empty($_POST['PE_peso'])) {

        $todos = "liberado";
        echo "liberado";

    } else {

        $todos = "negado";
        echo "negado";
    }

    // PF
    if (!empty($_POST['PF_peso']) && $_POST['PF_peso'] === "PF" || $todos == "liberado") {

        $queries[] = "SELECT 
                        imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido, descricaoAlianca, 
                        idpedidos, numF, numeM, largura, gravacaoInternaM, gravacaoInternaF, peso, nomePedido, data_digitada, pdf, estoque
                      FROM pedidosp
                      WHERE contadorpf != 0
                        AND MONTH(data_digitada) = MONTH(CURDATE())
                        AND YEAR(data_digitada) = YEAR(CURDATE())";
    }

    // PG
    if (!empty($_POST['PG_peso']) && $_POST['PG_peso'] === "PG" || $todos == "liberado") {

        $queries[] = "SELECT 
                        imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido, descricaoAlianca, 
                        idpedidos, numF, numeM, largura, gravacaoInternaM, gravacaoInternaF, peso, nomePedido, data_digitada, pdf, estoque
                      FROM pedidospg
                      WHERE contadorpg != 0
                        AND MONTH(data_digitada) = MONTH(CURDATE())
                        AND YEAR(data_digitada) = YEAR(CURDATE())";
    }

    // PE
    if (!empty($_POST['PE_peso']) && $_POST['PE_peso'] === "PE" || $todos == "liberado") {

        $queries[] = "SELECT 
                        imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido, descricaoAlianca, 
                        idpedidos, numF, numeM, largura, gravacaoInternaM, gravacaoInternaF, peso, nomePedido, data_digitada, pdf, estoque
                      FROM pedidospe
                      WHERE contadorpe != 0
                        AND MONTH(data_digitada) = MONTH(CURDATE())
                        AND YEAR(data_digitada) = YEAR(CURDATE())";
    }


    // Junta tudo com UNION ALL
    $sql = implode(" UNION ALL ", $queries);

    // Executa
    $resultado = mysqli_query($conectar, $sql);

    while ($linha = mysqli_fetch_assoc($resultado)) {

        $pedido = explode('-',$linha['idpedidos']);
        $pedidosInput = 'input_peso_' . $pedido[0] . '_' . $pedido[3] . '_' . $pedido[2] ;
        $peso_enviado = $_POST[$pedidosInput];
            
        if (!empty($peso_enviado) && $peso_enviado != "") {
            
            $peso_enviado = $_POST[$pedidosInput];
            $id_peso_enviado = $linha['idpedidos'];


            $partes = explode(' ', $pedido[0]);
            $duasPrimeiras = implode(' ', array_slice($partes, 0, 2)); // pega só 2 palavras
            $duasPrimeiras = preg_replace('/[^A-Za-z]/', '', $duasPrimeiras);


            // PF → tabela pedidosp
            if ($duasPrimeiras == "PF") {

                $stmt = $conectar->prepare("UPDATE pedidosp SET peso = ? WHERE idpedidos = ?");
                $stmt->bind_param("ds", $peso_enviado, $id_peso_enviado);
                $stmt->execute();

            }


            // PG → tabela pedidospg
            elseif ($duasPrimeiras == "PG") {

                $stmt = $conectar->prepare("UPDATE pedidospg SET peso = ? WHERE idpedidos = ?");
                $stmt->bind_param("ds", $peso_enviado, $id_peso_enviado);
                $stmt->execute();
            }


            // PE → tabela pedidospe
            elseif ($duasPrimeiras == "PE") {

                $stmt = $conectar->prepare("UPDATE pedidospe SET peso = ? WHERE idpedidos = ?");
                $stmt->bind_param("ds", $peso_enviado, $id_peso_enviado);
                $stmt->execute();
            }

        }
    }
    
}

?>