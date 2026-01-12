<?php
namespace php;

class Pedidos_Quantidade{

   protected  string $tipo = '';
   protected  string $data_inicio = '';
   protected  string $data_termino = '';
   protected  string $dados = '';
   protected  string $estoque = '';

   // set Variaveis
   public function setTipo( string $tipoInt ){ $this->tipo = $tipoInt; }
   public function setEstoque( string $estoqueInt ){ $this->estoque = $estoqueInt; }
   public function setData_Inicio( string $data_inicio_Str ){ $this->data_inicio = $data_inicio_Str; }
   public function setData_Termino( string $data_termino_Str ){ $this->data_termino = $data_termino_Str; }

    // Functions internas e private

    private function estoque_peso($conectar , $estoque){

        $sql = "SELECT peso 
                    FROM estoque
                    WHERE nome = '$estoque' ";

        $query = mysqli_query($conectar, $sql);
        $resultado = mysqli_fetch_assoc($query);

        return $resultado['peso'] ?? null;
            

    }

    // Functions publicas
   //Comandos SQL
   function montar_sql(){


       // Verifica o tipo 
       if($this->tipo == "PF"){

           if($this->estoque == "Todos"){

               $sql = "SELECT 
                           imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido, descricaoAlianca, 
                           idpedidos, numF, numeM, largura, gravacaoInternaM, gravacaoInternaF, peso, nomePedido , data_digitada , pdf , estoque
                   FROM `pedidosp` 
                   WHERE `contadorpf` != 0 
                   AND `data_digitada` BETWEEN '{$this->data_inicio}' AND '{$this->data_termino}'";
           }
           else{

               $sql = "SELECT 
                           imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido, descricaoAlianca, 
                           idpedidos, numF, numeM, largura, gravacaoInternaM, gravacaoInternaF, peso, nomePedido , data_digitada , pdf , estoque
                   FROM `pedidosp` 
                   WHERE `contadorpf` != 0 
                   AND `estoque` = '{$this->estoque}' 
                   AND `data_digitada` BETWEEN '{$this->data_inicio}' AND '{$this->data_termino}'";

           }

       }
       elseif($this->tipo == "PG"){

           if($this->estoque == "Todos"){

               $sql = "SELECT
                           imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido, descricaoAlianca, 
                           idpedidos, numF, numeM, largura, gravacaoInternaM, gravacaoInternaF, peso, nomePedido , data_digitada , pdf , estoque
                   FROM `pedidospg` 
                   WHERE `contadorpg` != 0 
                   AND `data_digitada` BETWEEN '{$this->data_inicio}' AND '{$this->data_termino}'";
           }
           else{

               $sql = "SELECT
                           imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido, descricaoAlianca, 
                           idpedidos, numF, numeM, largura, gravacaoInternaM, gravacaoInternaF, peso, nomePedido , data_digitada , pdf , estoque
                   FROM `pedidospg` 
                   WHERE `contadorpg` != 0 
                   AND `estoque` = '{$this->estoque}' 
                   AND `data_digitada` BETWEEN '{$this->data_inicio}' AND '{$this->data_termino}'";
           }

       }
       elseif($this->tipo == "PE"){

           if($this->estoque == "Todos"){

               $sql = "SELECT  
                           imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido, descricaoAlianca, 
                           idpedidos, numF, numeM, largura, gravacaoInternaM, gravacaoInternaF, peso, nomePedido , data_digitada , pdf , estoque
                   FROM `pedidospe` 
                   WHERE `contadorpe` != 0 
                   AND `data_digitada` BETWEEN '{$this->data_inicio}' AND '{$this->data_termino}'";
           }
           else{

               $sql = "SELECT  
                           imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido, descricaoAlianca, 
                           idpedidos, numF, numeM, largura, gravacaoInternaM, gravacaoInternaF, peso, nomePedido , data_digitada , pdf , estoque
                   FROM `pedidospe` 
                   WHERE `contadorpe` != 0 
                   AND `estoque` = '{$this->estoque}' 
                   AND `data_digitada` BETWEEN '{$this->data_inicio}' AND '{$this->data_termino}'";
           }

       }
       elseif($this->tipo == "pedidos"){

           if($this->estoque == "Todos"){

               $sql = "SELECT
                           imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido, descricaoAlianca, 
                           idpedidos, numF, numeM, largura, gravacaoInternaM, gravacaoInternaF, peso, nomePedido , data_digitada , pdf , estoque
                   FROM `pedidos` 
                   WHERE `data_digitada` BETWEEN '{$this->data_inicio}' AND '{$this->data_termino}'";
           }
           else{

               $sql = "SELECT
                           imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido, descricaoAlianca, 
                           idpedidos, numF, numeM, largura, gravacaoInternaM, gravacaoInternaF, peso, nomePedido , data_digitada , pdf , estoque
                   FROM `pedidos` 
                   WHERE `estoque` = '{$this->estoque}' 
                   AND `data_digitada` BETWEEN '{$this->data_inicio}' AND '{$this->data_termino}'";
           }

       }
       else{

          echo 'Erro tabela não encontrada';

          exit;
       }

       $this->dados = $sql;

   }
   // Pedidos
   
    function mostrar_pedidos_quantidade($conectar) {

        $resultadoDados = mysqli_query($conectar, $this->dados);

        $quantidade = 0;

        while ($linha = mysqli_fetch_assoc($resultadoDados)) {
            $linha['idpedidos'];
            if($linha['numF'] == 40){

                $quantidade += 0.5;
            }
            else{

                $quantidade++;
            }
        }

        return $quantidade;
    }

    function mostrar_pedidos_por_data($conectar) {
        $resultado = mysqli_query($conectar, $this->dados);

        $pedidosPorData = [];

        while ($linha = mysqli_fetch_assoc($resultado)) {
            // garante formato YYYY-MM-DD
            $data = date('Y-m-d', strtotime($linha['data_digitada']));

            if (!isset($pedidosPorData[$data])) {
                $pedidosPorData[$data] = 0;
            }

            $pedidosPorData[$data]++;
        }

        // ORDENA POR DATA
        ksort($pedidosPorData);

        return $pedidosPorData;
    }

    function mostrar_dia_maisVendidos($returnDados){
    
       $quantidade_maxima = 0;

       foreach($returnDados as $data => $quantidade){

           
            if($quantidade_maxima < $quantidade){
               
               $quantidade_maxima = $quantidade;
               $data_maxima_qt = $data;

               $resul = $quantidade_maxima . "_" . $data_maxima_qt;
            }
       }
       return $resul;
    }

    // Gravações
    function mostrar_quantidade_gravacao($conectar) {

        $resultadoDados = mysqli_query($conectar, $this->dados);

        $quantidade_gravacao = 0;
        $contadordePedidosunidade = 0;
        $contadordePedidosPar = 0;
        $contadordePedidos = 0;

        while ($linha = mysqli_fetch_assoc($resultadoDados)) {

            if( $linha['gravacaoInternaF'] != "Confirmar_Gravação" && $linha['gravacaoInternaM'] != "Confirmar_Gravação" ){   

                if($linha['numF'] == 40 && ( (!empty($linha['gravacaoInternaF']) && strlen($linha['gravacaoInternaF'])) >= 1 || (!empty($linha['gravacaoInternaM']) && strlen($linha['gravacaoInternaM']) >= 1) )  ){

                    $contadordePedidosunidade++;
                    $contadordePedidos++;
                }
                elseif( (!empty($linha['gravacaoInternaF']) && strlen($linha['gravacaoInternaF']) >= 1) && (!empty($linha['gravacaoInternaM']) && strlen($linha['gravacaoInternaM']) >= 1) ){

                    $contadordePedidosPar++;
                    $contadordePedidos++;
                }
                elseif( !empty($linha['gravacaoInternaF']) && strlen($linha['gravacaoInternaF']) >= 1 ){
                
                    $contadordePedidosunidade++;
                    $contadordePedidos++;
                }
                elseif( !empty($linha['gravacaoInternaM']) && strlen($linha['gravacaoInternaM']) >= 1 ){
                    
                    $contadordePedidosunidade++;
                    $contadordePedidos++;
                }

            }
        }

        $quantidade_Gravadas = $contadordePedidosunidade + $contadordePedidosPar*2;
        return $quantidade_Gravadas;
    }

    //Estoques
    function mostrar_peso_pedidos($conectar ,$variavel){

        $resultadoDados = mysqli_query($conectar, $this->dados);
        $estoque_Quantidade = [];
        $Peso_gramas = 0;


        while ($linha = mysqli_fetch_assoc($resultadoDados)) {
            
            if (!empty($linha['peso']) && $linha['peso'] !== null) {

                if ( !isset($estoque_Quantidade[$this->tipo]) ) {
                    
                    $estoque_Quantidade[$this->tipo] = 0;
                }

                if ($linha['numF'] == 40){

                    $estoque_Quantidade[$this->tipo] += $linha['peso']/2;
                } 
                else {

                    $estoque_Quantidade[$this->tipo] += $linha['peso'];
                }
                
            }


        }

        if ($variavel == "Quantidade"){
            return $estoque_Quantidade ;
        }
        elseif ($variavel == "Peso"){

            foreach ($estoque_Quantidade as $nome => $peso){



                    $Peso_gramas +=  $peso;
                
            }

            return $Peso_gramas;
        }
    }

    function comparacao_vendas($conectar){
        
        $quantidade_pares = $this->mostrar_pedidos_quantidade($conectar);
        
        //fazendo bkp da data antiga
        $data_inicio_antiga = $this->data_inicio;
        $data_termino_antiga = $this->data_termino;

        $data_Comparacao_inicio  = new \DateTime($this->data_inicio);
        $data_Comparacao_termino = new \DateTime($this->data_termino);

        // diferença em dias entre término e início
        $diferenca_dias = $data_Comparacao_inicio->diff($data_Comparacao_termino)->days;

        // período comparativo
        $termino_comp = clone $data_Comparacao_inicio;
        $inicio_comp  = clone $data_Comparacao_inicio;

        // desloca o início para trás pelo mesmo intervalo
        $inicio_comp->modify("-{$diferenca_dias} days");

        // formata para SQL
        $data_inicio_comp  = $inicio_comp->format('Y-m-d');
        $data_termino_comp = $termino_comp->format('Y-m-d');

        $this->data_inicio = $data_inicio_comp;
        $this->data_termino = $data_termino_comp;

        // Montar SQL novamente
        $this->montar_sql();
        $quantidade_pares_antigo = $this->mostrar_pedidos_quantidade($conectar);

        $comparacao = $quantidade_pares - $quantidade_pares_antigo;
        
        // Atualizando data antiga
        $this->data_inicio = $data_inicio_antiga;
        $this->data_termino = $data_termino_antiga;
        $this->montar_sql();
        return $comparacao;
    }

}


// Class Estoques 
class estoque_peddidos extends Pedidos_Quantidade{



}

?>