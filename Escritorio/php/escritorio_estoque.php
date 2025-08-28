<?php
include_once(__DIR__ . '/../../scripts/phpGlobal/backEnd/estoqueFunction.php');


function tirar_do_estoque($n,$estoquePersonalizado,$conectar) {
    // aqui caso não lembrrar ele verifica se o estoque está zerado ele cria ou atualiza a tabela estoque_esgotado se não estiver zerado ele só da baixa mesmo 

    if($n == 40 || $n == '40' || $estoquePersonalizado == null || $n > 35 ){

        return;
    }

    $queryEstoque = "SELECT * FROM estoque WHERE nome = ?";
    $stmtSelect = $conectar->prepare($queryEstoque);
    $stmtSelect->bind_param("s", $estoquePersonalizado);
    $stmtSelect->execute();
    $result = $stmtSelect->get_result();

    if ($linha = $result->fetch_assoc()) {

         if( (int)$linha[$n]  == 0 ){

                $imagem = '..' . $linha['imagem'];
                $peso =  $linha['peso'];
                $descricao = $linha['descricaoEstoque'];

                criarAtualizar_pedido_estoque($n,$estoquePersonalizado,"estoque_esgotado",$imagem,$peso,$descricao,$conectar);
        }
        else{
            // Subtrai 1 
            $numero = (int)$linha[$n] - 1;

            // Atualiza o estoque
            $updateQuery = "UPDATE estoque SET `$n` = ? WHERE nome = ?";
            $stmtUpdate = $conectar->prepare($updateQuery);
            $stmtUpdate->bind_param("is", $numero, $estoquePersonalizado);
            $stmtUpdate->execute();
            $stmtUpdate->close();

        }
    }
    $stmtSelect->close();
    
}


// aqui seria a fuction mestre onde se encintra outras funções
function repor_estoque_antigo($conectar, $pedido_Tabela, $nome_pedido, $numero,$tipo, $estoquePersonalizado){

    $estoque_Pedido = null; // ← garante que a variável exista

    $sql_pedido_desatualizado = "SELECT * FROM $pedido_Tabela WHERE idpedidos = '$nome_pedido'";
    $puxardados =  $conectar->prepare($sql_pedido_desatualizado);
    $puxardados->execute();
    $result = $puxardados->get_result();

    if($linha = $result->fetch_assoc()){

        $estoque_Pedido = $linha['estoque']??null;
        
        //Numerações Antigas 
        if($tipo == 'F'){

            //Numeração feminina
            $numeracao_Antiga = $linha['numF']??null;
        }
        elseif($tipo == 'M'){
            
            //Numeração Masculina
            $numeracao_Antiga = $linha['numeM']??null;
        }
        else{
            echo "Erro a variavel tipo não está definida corretamente!!!! ";
            return;
        }

    }
    $puxardados->close();

    // verificações ------------------------------
    if($estoquePersonalizado == null ){

        return;
    }
    if( $numero > 35 ){

        if($numeracao_Antiga <= 35 ){

            //Numeração antiga -----------------------------------------------------------------------------------
            $verificar = verifica_estoque_esgotado($numeracao_Antiga,$estoque_Pedido,'estoque_esgotado',$conectar);
            if($verificar == true){

                repor_estoque($numeracao_Antiga,$estoque_Pedido,'estoque',$conectar);
                tira_estoque($numeracao_Antiga,$estoque_Pedido,"reabastecer_estoque",$conectar);
            }
            elseif($verificar == false){

                tira_estoque($numeracao_Antiga,$estoque_Pedido,'estoque_esgotado' ,$conectar);
            }
            return;
        }

        return;
    }
    if($estoque_Pedido == null ){

        if($numero == 40 || $numero == '40'){

            return;
        }

        $verificar = verifica_estoque_esgotado($numero,$estoquePersonalizado,'estoque',$conectar);
        if($verificar == true){

            tirar_do_estoque($numero,$estoquePersonalizado,$conectar);
        }
        else{

            tira_estoque($numero,$estoquePersonalizado,'estoque' ,$conectar);
            repor_estoque($numero,$estoquePersonalizado,'reabastecer_estoque' ,$conectar);
        }
        return;
    }
    // vê se é so um pé de coencidencia é o numero 40
    if($numero == 40 || $numero == '40' || $numeracao_Antiga == 40 || $numeracao_Antiga == '40'){

        if($numeracao_Antiga == $numero){

            return;
        }
        elseif($numeracao_Antiga != $numero ){

            if($numero == 40 || $numero == '40'){

                //Numeração antiga -----------------------------------------------------------------------------------
                $verificar = verifica_estoque_esgotado($numeracao_Antiga,$estoque_Pedido,'estoque_esgotado',$conectar);
                if($verificar == true){

                    repor_estoque($numeracao_Antiga,$estoque_Pedido,'estoque',$conectar);
                    tira_estoque($numeracao_Antiga,$estoque_Pedido,"reabastecer_estoque",$conectar);
                }
                elseif($verificar == false){

                    tira_estoque($numeracao_Antiga,$estoque_Pedido,'estoque_esgotado' ,$conectar);
                }

                return;
            }

            tirar_do_estoque($numero,$estoquePersonalizado,$conectar);
            return;
        }
        return;
    }
    
    if($estoque_Pedido == $estoquePersonalizado){

        if($numeracao_Antiga == $numero){

            return;
        }
        elseif($numeracao_Antiga != $numero){


            //Numeraçao nova -----------------------------------------------------------------------------------
            $verificar1 = verifica_estoque_esgotado($numero,$estoquePersonalizado,'estoque',$conectar);
            if($verificar1 == true){

                tirar_do_estoque($numero,$estoquePersonalizado,$conectar);
            }
            elseif($verificar1 == false){

                tira_estoque($numero,$estoquePersonalizado,'estoque' ,$conectar);
                repor_estoque($numero,$estoquePersonalizado,'reabastecer_estoque' ,$conectar);
        
            }

            //Numeração antiga -----------------------------------------------------------------------------------
            $verificar = verifica_estoque_esgotado($numeracao_Antiga,$estoque_Pedido,'estoque_esgotado',$conectar);
            if($verificar == true){

                repor_estoque($numeracao_Antiga,$estoque_Pedido,'estoque',$conectar);
                tira_estoque($numeracao_Antiga,$estoque_Pedido,"reabastecer_estoque",$conectar);
            }
            elseif($verificar == false){

                tira_estoque($numeracao_Antiga,$estoque_Pedido,'estoque_esgotado' ,$conectar);
            }

            return;
        }
    }
    else{
        //Numeraçao nova -----------------------------------------------------------------------------------
        $verificar1 = verifica_estoque_esgotado($numero,$estoquePersonalizado,'estoque',$conectar);
        if($verificar1 == true){

            tirar_do_estoque($numero,$estoquePersonalizado,$conectar);
        }
        elseif($verificar1 == false){

            tira_estoque($numero,$estoquePersonalizado,'estoque' ,$conectar);
            repor_estoque($numero,$estoquePersonalizado,'reabastecer_estoque' ,$conectar);
                    
        }

        //Numeração antiga -----------------------------------------------------------------------------------
        $verificar = verifica_estoque_esgotado($numeracao_Antiga,$estoque_Pedido,'estoque_esgotado',$conectar);
        if($verificar == true){
            $verificar_repor_estoque = verifica_estoque_esgotado($numeracao_Antiga,$estoque_Pedido,'reabastecer_estoque',$conectar);

            if($verificar_repor_estoque == true){

                repor_estoque($numeracao_Antiga,$estoque_Pedido,'estoque',$conectar);
            }
            elseif($verificar_repor_estoque == false){
                
                tira_estoque($numeracao_Antiga,$estoque_Pedido,'reabastecer_estoque' ,$conectar);
             }
        }
        elseif($verificar == false){
                
            tira_estoque($numeracao_Antiga,$estoque_Pedido,'estoque_esgotado' ,$conectar);
        }

        return;

    }
}
