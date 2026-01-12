<?php

namespace Peso;

class cadastrarPeso{

   //variaveis
   private string $tipo = '';
   private static int $falta_Peso = 0;
   private string $dados;
   private string $cliente;
   private $conectar;
   
   // functions para propria class
   private function montar_sql(){


       // Verifica o tipo 
       if($this->tipo == "PF"){

               $sql = "SELECT 
                           imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido, descricaoAlianca, 
                           idpedidos, numF, numeM, largura, gravacaoInternaM, gravacaoInternaF, peso, nomePedido , data_digitada , pdf , estoque
                   FROM `pedidosp` 
                   WHERE `contadorpf` != 0 
                        AND data_digitada >= DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 4 MONTH), '%Y-%m-01')
                        AND data_digitada <= CURDATE()";


       }
       elseif($this->tipo == "PG"){

               $sql = "SELECT
                           imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido, descricaoAlianca, 
                           idpedidos, numF, numeM, largura, gravacaoInternaM, gravacaoInternaF, peso, nomePedido , data_digitada , pdf , estoque
                   FROM `pedidospg` 
                   WHERE `contadorpg` != 0 
                        AND data_digitada >= DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 4 MONTH), '%Y-%m-01')
                        AND data_digitada <= CURDATE()";

       }
       elseif($this->tipo == "PE"){

               $sql = "SELECT  
                           imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido, descricaoAlianca, 
                           idpedidos, numF, numeM, largura, gravacaoInternaM, gravacaoInternaF, peso, nomePedido , data_digitada , pdf , estoque
                   FROM `pedidospe` 
                   WHERE `contadorpe` != 0 
                        AND data_digitada >= DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 4 MONTH), '%Y-%m-01')
                        AND data_digitada <= CURDATE()";

           
       }
       elseif($this->tipo == "pedidos" && $this->cliente != ''){

               $sql = "SELECT  
                           imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido, descricaoAlianca, 
                           idpedidos, numF, numeM, largura, gravacaoInternaM, gravacaoInternaF, peso, nomePedido , data_digitada , pdf , estoque
                   FROM `pedidos` 
                        WHERE cliente = '{$this->cliente}'
                        AND data_digitada BETWEEN
                            DATE_SUB(CURDATE(), INTERVAL 4 MONTH)
                            AND DATE_ADD(CURDATE(), INTERVAL 1 MONTH)";

           
       }
       elseif($this->tipo == "pedidos" && $this->cliente == ''){

               $sql = "SELECT  
                           imagem, PedraF, PedraM, parEstoqueF, parEstoqueM, descricaoPedido, descricaoAlianca, 
                           idpedidos, numF, numeM, largura, gravacaoInternaM, gravacaoInternaF, peso, nomePedido , data_digitada , pdf , estoque
                   FROM `pedidos` 
                   WHERE data_digitada BETWEEN
                            DATE_SUB(CURDATE(), INTERVAL 4 MONTH)
                            AND DATE_ADD(CURDATE(), INTERVAL 1 MONTH)";

           
       }
       else{

          echo 'Erro tabela não encontrada';

          exit;
       }

       $this->dados = $sql;
}

   function __construct(string $tipoInt , $conectarIn , $clienteIn){

       $this->tipo = $tipoInt;
       $this->conectar = $conectarIn;
       $this->cliente = $clienteIn;
       $this->montar_sql();

   } 


    function peso_indefinido($mostrar){

        $resultado = mysqli_query($this->conectar, $this->dados);

        while ($linha = mysqli_fetch_assoc($resultado)) {

            $pedido = explode('-',$linha['idpedidos']);
            // garante formato YYYY-MM-DD
            if($linha['peso'] == 0.00){


                if($mostrar == 'pedido'){
                    
                    ?>
                        <!-- Div Para os Pedidos -->
                         <div class="pedidos_peso">

                            <div class="conteiners_Peso">
                                <img class="img_peso" src="<?= $linha['imagem']; ?>" alt="">
                            </div>
                            <div class="conteiners_Peso">
                                <label class="font_peso_titulo"><?= $pedido[0] . ' ' . $pedido[3] . '/' . $pedido[2] ?></label>
                                <input class="input_peso" name ="input_peso_<?= $pedido[0] . '_' . $pedido[3] . '_' . $pedido[2]?>" type="number" min = '0' placeholder="Peso Gr" step="0.1">
                            </div>
                         </div>
                    <?php
                    
                }
                elseif($mostrar == 'pedido_outros'){
                    
                    ?>
                        <!-- Div Para os Pedidos -->
                         <div class="pedidos_peso">

                            <div class="conteiners_Peso">
                                <img class="img_peso" src="<?= $linha['imagem']; ?>" alt="">
                            </div>
                            <div class="conteiners_Peso">
                                <label class="font_peso_titulo"><?= $linha['nomePedido'] . ' ' . $pedido[3] . '/' . $pedido[2] ?></label>
                                <input class="input_peso" name ="input_peso_<?= $linha['nomePedido'] . '_' . $pedido[3] . '_' . $pedido[2]?>" type="number" min = '0' placeholder="Peso Gr" step="0.1">
                            </div>
                         </div>
                    <?php
                    
                }
                else{
                    self::$falta_Peso++;
                }
            }
        }

        if($mostrar == "echo"){

            return self::$falta_Peso;
        }

    }

    // sets 
    function set_sql_externo($sql_ex){

        $this->dados .= $sql_ex;
    }
}
?>