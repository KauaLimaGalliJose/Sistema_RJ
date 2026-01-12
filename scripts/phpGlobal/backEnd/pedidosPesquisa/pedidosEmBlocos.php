<?php
namespace pedidosPesquisa;

class Pedidos_Blocos{

    //Variaveis ---------------------------
    
    // Sobre o pedido
    protected string $dataPedido ;
    protected string $tipo;
    protected string $pesquisa = '';
    protected string $quemRecebe = '';
    protected string $largura = '';
    protected string $caminhoImgem;
    
    // Banco de dados
    protected \mysqli $conectar;
    protected \mysqli_result $resultadoDados;
    protected string $types;
    protected array $params;

    // filtro pelo menu ($cookies)
    protected array $cookies;
    //---------------------------------------

    public function __construct(string $tipoConst  , $caminhoImagemConst , \mysqli $conectarConst){

        // Variaveis do Pedidos Obrigatorias para Class funcionar 
        $this->tipo = $tipoConst;
        $this->conectar   = $conectarConst;
        $this->caminhoImgem   = $caminhoImagemConst;

        // Cookies de filtragem
        $this->cookies = [

            // Parte Inputs
            'estoqueMenu'   => $_COOKIE['estoqueMenu']   ?? 'Todos',
            'numeracaoMenu' => $_COOKIE['numeracaoMenu'] ?? '',
            // esse eu deixei na hora de montar o Sql já que é outra tabela
            'pedidosMenu'   => $_COOKIE['pedidosMenu']   ?? 'Mercado_Livre',


            // parte CheckBoox
            'filtro_flex'   => $_COOKIE['filtro_flex']   ?? '',
            'nao_repor_estoque' => $_COOKIE['check_config_estoque'] ?? 'check_config_estoque',
            
            // parte Radio 
            'estilo_pedido' => $_COOKIE['estilo_pedido'] ?? 'pedidosLinha'
            
        ];

    }

    //Gets Variaveis do Pedidos opcional 
    function getquemRecebe(string $quemRecebeConst) { $this->quemRecebe = $quemRecebeConst; }
    function getdata(string $dataConst) { $this->dataPedido = $dataConst; }
    function getpesquisa(string $pesquisaConst ) { $this->pesquisa = $pesquisaConst; }
    function getlargura(string $larguraConst ) { $this->largura = $larguraConst; }


    protected function fitroSql(){

        // Variaveis
        $complemetoSql = '';
        $this->params = [];
        $this->types  = '';


        if($this->cookies['pedidosMenu'] == 'Todos'){

            $complemetoSql .= "WHERE imagem LIKE ? ";

            $this->params[] = '%' . '/' . '%' ;
            $this->types  = 's' ;
        }
        else{
            $complemetoSql .= "WHERE cliente = ? ";

            $this->params[] = $this->cookies['pedidosMenu'] ;
            $this->types  = 's' ;
        }


        // filtragem dos Cookies do Menu ===========================================================

        // Filtrar numerações --------------------------------------
        if ($this->cookies['numeracaoMenu'] !== '') {

            $complemetoSql .= " AND (numeM = ? OR numF = ?) ";
            $this->params[] = $this->cookies['numeracaoMenu'];
            $this->params[] = $this->cookies['numeracaoMenu'];
            $this->types   .= 'ii';

        }

        // Filtrar por estoque --------------------------------------
        if ($this->cookies['estoqueMenu'] !== 'Todos') {

            $complemetoSql .= " AND estoque = ? ";
            $this->params[] = $this->cookies['estoqueMenu'];
            $this->types   .= 's';
        }


        // Filtrar por Flex -----------------------------------------
        if ($this->cookies['filtro_flex'] !== '') {

            $complemetoSql .= " AND nomePedido LIKE ? ";
            $this->params[] = '%Flex%';
            $this->types   .= 's';
        }



        // filtragem de variveis (inputs de pesquisa ) ===========================================================
        
        // Filtrar Por data --------------------------------------
       if($this->dataPedido !== '' && $this->dataPedido !== null){

            $complemetoSql .= "AND data_digitada LIKE ? ";
            $this->params[] = $this->dataPedido ;
            $this->types .= 's';
        }
        elseif($this->dataPedido == ''){

            $complemetoSql .= "AND data_digitada BETWEEN ? AND ? ";

            $this->params[] = date('Y-m-d');
            $this->params[] = date('Y-m-d', strtotime('+30 days'));
            $this->types .= 'ss';
        }
        else{

            $hoje = date('Y-m-d'); // data de hoje

            $complemetoSql .= " AND data_digitada LIKE  ? ";
            $this->params[] = $hoje;
            $this->types .= 's';

        }

        //filtrar Por quemRecebe no caso o Cliente --------------------------------------
        if($this->quemRecebe !== ''){

            $complemetoSql .= "AND descricaoPedido LIKE ? ";
            $this->params[] = "%" . $this->quemRecebe . "%";
            $this->types .= 's';
        }

        //filtrar Por Titulo do pedido  --------------------------------------
        if($this->pesquisa !== ''){

            $complemetoSql .= "AND ( nomePedido LIKE ? OR idpedidos LIKE ? )";
            $this->params[] = "%" . $this->pesquisa . "%";
            $this->params[] = "%" . $this->pesquisa . "%";
            $this->types .= 'ss';
        }

        // filtrar Por largura da Aliança (pedido)  -----------------------------
        if($this->largura !== ''){

            $complemetoSql .= "AND largura LIKE ? ";
            $this->params[] = $this->largura;
            $this->types .= 's';
        }


        return $complemetoSql;
    }

    public function montar_Sql(){

        $complemetoSql = $this->fitroSql();

        if($this->cookies['pedidosMenu'] == 'Mercado_Livre'){

            $dados = "";

            if($this->tipo == "PF"){

                $tabela = 'pedidosp';
                $contador = 'contadorpf';
            }

            elseif($this->tipo == "PG"){
                
                $tabela = 'pedidospg';
                $contador = 'contadorpg';
            }

            elseif($this->tipo == "PE"){
                
                $tabela = 'pedidospe';
                $contador = 'contadorpe';
            }
            else {
                throw new \Exception('Tipo de pedido inválido');
            }


             $dados =  "SELECT RIGHT(idpedidos, 5) AS idpedido, imagem, PedraF, PedraM, parEstoqueF, 
                               parEstoqueM, descricaoPedido, descricaoAlianca, idpedidos, numF, numeM, 
                               largura, gravacaoInternaM, gravacaoInternaF, peso, nomePedido , data_digitada , pdf ,estoque
                                    FROM `$tabela` 
                                    " . $complemetoSql . "
                                    ORDER BY `$contador` ASC";

        }
        else{
            
            $dados = "SELECT RIGHT(idpedidos, 5) AS idpedido, imagem, PedraF, PedraM, parEstoqueF, 
                        parEstoqueM, descricaoPedido, descricaoAlianca, idpedidos, numF, numeM, 
                        largura, gravacaoInternaM, gravacaoInternaF, peso, nomePedido , data_digitada , pdf ,estoque
                             FROM `pedidos`" . $complemetoSql;


        }
        
        $stmt = $this->conectar->prepare($dados);
        $stmt->bind_param($this->types, ...$this->params);
        $stmt->execute();
        $this->resultadoDados = $stmt->get_result();

        //para ver sql a quantidade que retornou
        //echo $this->resultadoDados->num_rows;
        //echo $dados;
    }

    // Functions para mostrar Pedidos 

    function select(){

        $this->montar_Sql();
        ?>
        <link rel="stylesheet" href="<?php echo $this->caminhoImgem . '../scripts/cssGlobal/pedidosPesquisa/pedidosEmBlocos.css' ?>">
        <?php
    
        while($linha = $this->resultadoDados->fetch_assoc()){
    
            // Variaveis para verificação ---
            $nomePedido = $linha['nomePedido'];
    
            if(stripos($nomePedido, 'flex') !== false){
    
                $flex = 'flex';
            }
            else{
    
                $flex = 'none';
            }


            
            //Variaveis
            $pedido = explode('-',$linha['idpedidos']);
            $estoqueF = '';
            $estoqueM = '';
            $PedraF = '';
            $PedraM = '';
            $gravacaoF = $linha['numF'] ;
            
            // para indentificar cada pedido 
            $checkboxClass = $pedido[0] . '-' . $pedido[3] . '/' . $pedido[2];
            $checkboxId_gravacao = 'check_ID_gravacao_' . '-' . $pedido[0] . '-' . $pedido[3] . '/' . $pedido[2];
            $checkboxId_escritorio = 'check_ID_escritorio_'. '-' . $pedido[0] . '-' . $pedido[3] . '/' . $pedido[2];
            $checkboxId3 = 'check_ID_desmarcado_'. '-' . $pedido[0] . '-' . $pedido[3] . '/' . $pedido[2];
            // Salvar numeração checkbox
            $numeroCheckboxF = 'numF_-' . $pedido[0] . '-' . $pedido[3] . '/' . $pedido[2];
            $numeroCheckboxM = 'numM_-' . $pedido[0] . '-' . $pedido[3] . '/' . $pedido[2];
            
            //Verificações 
            if($this->cookies['pedidosMenu'] != 'Mercado_Livre' ){
                
                $pedidosOutros = $pedido[1] .'-' . $pedido[2] . '-' . $pedido[3] . '-' . $pedido[4];  
                $pedido = explode('-',$pedidosOutros);

                $pedidoLabel = '<span class = "fontBlu" >' . $linha['nomePedido'] . ' - <span class = "fontRed" > ' . $pedido[3] . '/' . $pedido[2] . '</span></span>';

                
                $checkboxClass = $linha['nomePedido'] . '-' . $pedido[3] . '/' . $pedido[2];
                $checkboxId = 'check_ID_polimento_-' . $linha['nomePedido'] . '-' . $pedido[3] . '/' . $pedido[2];
                $checkboxId2 = 'check_ID_torno_-' . $linha['nomePedido'] . '-' . $pedido[3] . '/' . $pedido[2];
                $checkboxId3 = 'check_ID_desmarcado_-' . $linha['nomePedido'] . '-' . $pedido[3] . '/' . $pedido[2];
                // Salvar numeração checkbox
                $numeroCheckboxF = 'numF_-' . $linha['nomePedido'] . '-' . $pedido[3] . '/' . $pedido[2];
                $numeroCheckboxM = 'numM_-' . $linha['nomePedido'] . '-' . $pedido[3] . '/' . $pedido[2];
            }
            else{

                $pedidoLabel = '<span class = "fontBlu" >' . $pedido[0] . ' - ' .$linha['nomePedido'] . ' - <span class = "fontRed" > ' . $pedido[3] . '/' . $pedido[2] . '</span></span>';
            }

           if($linha['numF'] == 40){

               $numeroFeminino = 'não tem';
               $numeroFemininoLabel = 'Unidade :';
               $gravacaoF = '';
               $finalSpanF ='';
           }
           else{

               $numeroFeminino = $linha['numF'];
               $numeroFemininoLabel = 'Masculina: ';
           }
           //Verificando Estoque 
           if(!empty($linha['parEstoqueF'])){

               $estoqueF = ' Estoque' ;
           }
           if(!empty($linha['parEstoqueM'])){
               $estoqueM = ' Estoque' ;
           }
           //Verificando Pedra 
           if($linha['PedraF'] == true){
               $PedraF = '&#128142;' ;
           }
           if( $linha['PedraM'] == true){
               $PedraM = '&#128142;' ;
           }
           //Gravação 
           if($linha['gravacaoInternaF'] !== '' || $linha['gravacaoInternaM'] !== '' ){

               $gravInterna = '<span class = "fontBlu" >
                                   <span class = "fontRed" >'. $gravacaoF . '</span> F: ' . $linha['gravacaoInternaF'] . '<br>
                                   <span class = "fontRed" >' . $linha['numeM'] .'</span> M: ' . $linha['gravacaoInternaM'] .  
                           '</span>';
           }
           else{

               $gravInterna = '<span class = "fontBlu" >Não</span>';
           }
       ?>
       <div class="carrossel">
           <div class="flex" style="display: <?php echo $flex ?>;">
               Flex
           </div>
           <div class="carrosselSuperior">
               <img class="carrosselImg" src="<?php echo $this->caminhoImgem . $linha['imagem']; ?>" alt="ERRO">
               <div id="pedido">
               <label class="fontPedido" for="<?php echo $checkboxId3; ?>"><label for="<?php echo $checkboxId3; ?>"><?php echo $pedidoLabel ?></label><input name="marcado_<?php echo $checkboxClass; ?>" title="desmarcar" value="polimento" id="<?php echo $checkboxId3; ?>" class="desmarcar <?php echo $checkboxClass; ?>" onchange="salvarEstadoRadio(this , '<?php echo $this->caminhoImgem ?>')" type="radio" >
                   <a class="PdfAncora" target="_blank" href="<?php echo './phpScripts/editarPedido.php?idpedidos=' . $linha['idpedidos'] . '&estoque=' . $linha['estoque'] ; ?>"><button class = 'Pdf_blocos' type="button">Editar</button></a>
               </label>
               </div>
               <div class="caixaSelecao">
                   <label class="fontCheckboxPolimento">Gravação </label>
                   <input name="marcado_<?php echo $checkboxClass; ?>" title="gravação" value="gravacao" id="<?php echo $checkboxId_gravacao; ?>"  class="polimentoRadio <?php echo $checkboxClass; ?>" onchange="salvarEstadoRadio(this , '<?php echo $this->caminhoImgem ?>')" type="radio" >
                   <label class="fontCheckboxTorno">Escritório </label>
                   <input name="marcado_<?php echo $checkboxClass; ?>" title="Polimento" value="escritorio" id="<?php echo $checkboxId_escritorio; ?>" class="tornoRadio <?php echo $checkboxClass; ?>" onchange="salvarEstadoRadio(this , '<?php echo $this->caminhoImgem ?>' )" type="radio" >
               </div>
           </div>
           <div class="carrosselInferior">
               <div id="<?php echo $checkboxClass; ?>" class="checklist">
                   <?php
                   if($numeroFeminino !== 'não tem'){
                   ?>
                   <form id="<?php echo 'F' . $checkboxClass; ?>">
                       <input  value="checkF" name="checkNumero" type="checkbox" id="<?php echo $numeroCheckboxF ?>" class="input_num <?php echo $checkboxClass; ?> F" onchange="salvarCheckbox(this , '<?php echo $this->caminhoImgem ?>'); enviarFormulario('<?php echo 'F' . $checkboxClass; ?>' , '<?php echo $this->caminhoImgem ?>')">
                       <label for="<?php echo $numeroCheckboxF ?>" class="numeracaoFont"> Feminina: <?php echo $numeroFeminino . $estoqueF; ?><?php echo ' ' .  $PedraF ?></label>
                       <input type="hidden" name="estoquePedido" value="<?php echo $linha['estoque']; ?>">
                       <input type="hidden" name="numero" value="<?php echo $linha['numF']; ?>">
                   </form>
                   <?php }?>
                   <form id="<?php echo 'M' . $checkboxClass; ?>">
                       <input value="checkM" name="checkNumero" type="checkbox" id="<?php echo $numeroCheckboxM ?>" class="input_num <?php echo $checkboxClass; ?> M" onclick="salvarCheckbox(this , '<?php echo $this->caminhoImgem ?>'); enviarFormulario('<?php echo  'M' . $checkboxClass; ?>' , '<?php echo $this->caminhoImgem ?>')">
                       <label for="<?php echo $numeroCheckboxM ?>" class="numeracaoFont"> <?php echo $numeroFemininoLabel . $linha['numeM']. " " . $estoqueM; ?><?php echo ' ' .  $PedraM ?></label>
                       <input type="hidden" name="estoquePedido" value="<?php echo $linha['estoque']; ?>">
                       <input type="hidden" name="numero" value="<?php echo $linha['numeM']; ?>">
                   </form>
               </div>
               <div class="informacaoInferior">
                   <h3>--- Gravação ---</h3> <?php echo $gravInterna  ?>
                   <h3>--- Descrição --- <?php echo "Largura: " .  $linha['largura'] .  '</h3>' . $linha['descricaoAlianca'] ?>
               </div>
           </div>
       </div>
       <?php


        }
    }
          //  echo '<script> alert(' . $_POST['numF'] . ')</script>';
    
    function select_gravacao(){
    
            ?>
        <link rel="stylesheet" href="<?php echo $this->caminhoImgem . '../scripts/cssGlobal/pedidosPesquisa/pedidosEmBlocos.css' ?>">
        <script src= <?php echo $this->caminhoImgem . '../scripts/jsGlobal/menu/estilosPedidosGrav.js' ?>  defer></script>
        <?php

        $this->montar_Sql();
        //Variavel -----------------------------------------------
        $gravacaoF = '';
 
    
        while($linha = mysqli_fetch_assoc($this->resultadoDados)){
    
            // Variaveis para verificação ---
            $nomePedido = $linha['nomePedido'];
    
            if(stripos($nomePedido, 'flex') !== false){
    
                $flex = 'flex';
            }
            else{
    
                $flex = 'none';
            }
    
            
                
            //Variaveis
            $pedido = explode('-',$linha['idpedidos']);
            $estoqueF = '';
            $estoqueM = '';
            $PedraF = '';
            $PedraM = '';
            $gravacaoF = $linha['numF'] ;
             // checkbox gravação Escritorio e desmarcar 
             // para indentificar cada pedido 
            $checkboxClass = $pedido[0] . '-' . $pedido[3] . '/' . $pedido[2];
             $checkboxId_gravacao = 'check_ID_gravacao_' . '-' . $pedido[0] . '-' . $pedido[3] . '/' . $pedido[2];
            $checkboxId_escritorio = 'check_ID_escritorio_'. '-' . $pedido[0] . '-' . $pedido[3] . '/' . $pedido[2];
            $checkboxId3 = 'check_ID_desmarcado_'. '-' . $pedido[0] . '-' . $pedido[3] . '/' . $pedido[2];
             // Salvar numeração checkbox
            $numeroCheckboxF = 'numF_-' . $pedido[0] . '-' . $pedido[3] . '/' . $pedido[2];
            $numeroCheckboxM = 'numM_-' . $pedido[0] . '-' . $pedido[3] . '/' . $pedido[2];
        
            //Verificações 
            if($this->cookies['pedidosMenu'] != 'Mercado_Livre' ){
                
                $pedidosOutros = $pedido[1] .'-' . $pedido[2] . '-' . $pedido[3] . '-' . $pedido[4];  
                $pedido = explode('-',$pedidosOutros);

                $pedidoLabel = '<span class = "fontBlu" >' . $linha['nomePedido'] . ' - <span class = "fontRed" > ' . $pedido[3] . '/' . $pedido[2] . '</span></span>';

                $checkboxClass = $linha['nomePedido'] . '-' . $pedido[3] . '/' . $pedido[2];
                $checkboxId = 'check_ID_polimento_-' . $linha['nomePedido'] . '-' . $pedido[3] . '/' . $pedido[2];
                $checkboxId2 = 'check_ID_torno_-' . $linha['nomePedido'] . '-' . $pedido[3] . '/' . $pedido[2];
                $checkboxId3 = 'check_ID_desmarcado_-' . $linha['nomePedido'] . '-' . $pedido[3] . '/' . $pedido[2];
                // Salvar numeração checkbox
                $numeroCheckboxF = 'numF_-' . $linha['nomePedido'] . '-' . $pedido[3] . '/' . $pedido[2];
                $numeroCheckboxM = 'numM_-' . $linha['nomePedido'] . '-' . $pedido[3] . '/' . $pedido[2];
            }
            else{

                $pedidoLabel = '<span class = "fontBlu" >' . $pedido[0] . ' - ' .$linha['nomePedido'] . ' - <span class = "fontRed" > ' . $pedido[3] . '/' . $pedido[2] . '</span></span>';
            }

            if($linha['numF'] == 40){
                $numeroFeminino = 'não tem';
                $numeroFemininoLabel = 'Unidade :';
             $gravacaoF = '';
            }
            else{
                $numeroFeminino = $linha['numF'];
                $numeroFemininoLabel = 'Masculina: ';
            }
            //Verificando Estoque 
            if(!empty($linha['parEstoqueF'])){
                $estoqueF = ' Estoque' ;
            }
            if(!empty($linha['parEstoqueM'])){
                $estoqueM = ' Estoque' ;
            }
             //Verificando Pedra 
            if($linha['PedraF'] == true){
                $PedraF = '&#128142;' ;
            }
            if( $linha['PedraM'] == true){
                $PedraM = '&#128142;' ;
            }
             //Gravação 
            if($linha['gravacaoInternaF'] !== '' || $linha['gravacaoInternaM'] !== '' ){
             
                $gravInterna = '<span class = "fontBlu" >
                                    <span class = "fontRed" >'. $gravacaoF . '</span> F: ' . $linha['gravacaoInternaF'] . '<br>
                                    <span class = "fontRed" >' . $linha['numeM'] .'</span> M: ' . $linha['gravacaoInternaM'] .  
                            '</span>';
            }
            else{
                $gravInterna = '<span class = "fontRed" >Não tem</span>';
             }

             ?>
            <div class="carrossel">
                <div class="flex" style="display: <?php echo $flex ?>;">
                    Flex
                </div>
                <div class="carrosselSuperior">
                    <img class="carrosselImg" src="<?php echo $this->caminhoImgem . $linha['imagem']; ?>" alt="<?php echo 'Erro'  //echo $linha['imagem'] ?>">
                    <div id="pedido">
                    <label class="fontPedido" for="<?php echo $checkboxId3; ?>"><label for="<?php echo $checkboxId3; ?>"><?php echo $pedidoLabel ?></label><input name="marcado_<?php echo $checkboxClass; ?>" title="desmarcar" value="torno" id="<?php echo $checkboxId3; ?>" class="desmarcar <?php echo $checkboxClass; ?>" onchange="salvarEstadoRadio(this , '<?php echo $this->caminhoImgem ?>')" type="radio" ></label>
                    </div>
                    <div class="caixaSelecao">
                        <label class="fontCheckboxPolimento">Gravação </label>
                        <input name="marcado_<?php echo $checkboxClass; ?>" title="gravação" value="gravacao" id="<?php echo $checkboxId_gravacao; ?>"  class="polimentoRadio <?php echo $checkboxClass; ?>" onchange="salvarEstadoRadio(this , '<?php echo $this->caminhoImgem ?>')" type="radio" >
                        <label class="fontCheckboxTorno">Escritório </label>
                        <input name="marcado_<?php echo $checkboxClass; ?>" title="Polimento" value="escritorio" id="<?php echo $checkboxId_escritorio; ?>" class="tornoRadio <?php echo $checkboxClass; ?>" onchange="salvarEstadoRadio(this , '<?php echo $this->caminhoImgem ?>' )" type="radio" >
                    </div>
                </div>
                <div class="carrosselInferior">
                    <form class="checklist">
                        <?php
                        if($numeroFeminino !== 'não tem'){
                        ?>
                        <input  value="<?php echo $numeroFeminino ?>" name="numF" type="checkbox" id="<?php echo $numeroCheckboxF ?>" class="input_num <?php echo $checkboxClass; ?> F" onchange="salvarCheckbox(this , '<?php echo $this->caminhoImgem ?>')">
                        <label for="<?php echo $numeroCheckboxF ?>" class="numeracaoFont"> Feminina: <?php echo $numeroFeminino . $estoqueF; ?><?php echo ' ' .  $PedraF ?></label>
                        <?php }?>
    
                            <input value="<?php echo $linha['numeM'] ?>" name="numM" type="checkbox" id="<?php echo $numeroCheckboxM ?>" class="input_num <?php echo $checkboxClass; ?> M" onchange="salvarCheckbox(this , '<?php echo $this->caminhoImgem ?>')">
                        <label for="<?php echo $numeroCheckboxM ?>" class="numeracaoFont"> <?php echo $numeroFemininoLabel . $linha['numeM']. " " . $estoqueM; ?><?php echo ' ' .  $PedraM ?></label>
                    </form>
                    <div class="informacaoInferior">
                        <h3>--- Gravação ---</h3> <?php echo $gravInterna  ?>
                        <h3>--- Descrição ---</h3> <?php echo $linha['descricaoAlianca']  ?>
                    </div>
                </div>
            </div>
            <?php
                    
                
            
        }
    }
    
    function select_tornoPolimento(){
    
    
        ?>
        <link rel="stylesheet" href="<?php echo $this->caminhoImgem . '../scripts/cssGlobal/pedidosPesquisa/pedidosEmBlocos.css' ?>">
        <script src= <?php echo $this->caminhoImgem . '../scripts/jsGlobal/menu/estilosPedidosPolimentoTorno.js' ?>  defer></script>
        <?php

        $this->montar_Sql();

        while($linha = mysqli_fetch_assoc($this->resultadoDados)){
    
            // Variaveis para verificação ---
            $nomePedido = $linha['nomePedido'];
    
            if(stripos($nomePedido, 'flex') !== false){
    
                $flex = 'flex';
            }
            else{
    
                $flex = 'none';
            }           

            //Variaveis
            $pedido = explode('-',$linha['idpedidos']);
            $estoqueF = '';
            $estoqueM = '';
            $PedraF = '';
            $PedraM = '';
            $checkboxClass = $pedido[0] . '-' . $pedido[3] . '/' . $pedido[2];
            $checkboxId = 'check_ID_polimento_-' . $pedido[0] . '-' . $pedido[3] . '/' . $pedido[2];
            $checkboxId2 = 'check_ID_torno_-' . $pedido[0] . '-' . $pedido[3] . '/' . $pedido[2];
            $checkboxId3 = 'check_ID_desmarcado_-' . $pedido[0] . '-' . $pedido[3] . '/' . $pedido[2];
            // Salvar numeração checkbox
            $numeroCheckboxF = 'numF_-' . $pedido[0] . '-' . $pedido[3] . '/' . $pedido[2];
            $numeroCheckboxM = 'numM_-' . $pedido[0] . '-' . $pedido[3] . '/' . $pedido[2];
            
            //Verificações 
            if($this->cookies['pedidosMenu'] != 'Mercado_Livre' ){
                
                $pedidosOutros = $pedido[1] .'-' . $pedido[2] . '-' . $pedido[3] . '-' . $pedido[4];  
                $pedido = explode('-',$pedidosOutros);

                $pedidoLabel = '<span class = "fontBlu" >' . $linha['nomePedido'] . ' - <span class = "fontRed" > ' . $pedido[3] . '/' . $pedido[2] . '</span></span>';

                $checkboxClass = $linha['nomePedido'] . '-' . $pedido[3] . '/' . $pedido[2];
                $checkboxId = 'check_ID_polimento_-' . $linha['nomePedido'] . '-' . $pedido[3] . '/' . $pedido[2];
                $checkboxId2 = 'check_ID_torno_-' . $linha['nomePedido'] . '-' . $pedido[3] . '/' . $pedido[2];
                $checkboxId3 = 'check_ID_desmarcado_-' . $linha['nomePedido'] . '-' . $pedido[3] . '/' . $pedido[2];
                // Salvar numeração checkbox
                $numeroCheckboxF = 'numF_-' . $linha['nomePedido'] . '-' . $pedido[3] . '/' . $pedido[2];
                $numeroCheckboxM = 'numM_-' . $linha['nomePedido'] . '-' . $pedido[3] . '/' . $pedido[2];
            }
            else{

                $pedidoLabel = '<span class = "fontBlu" >' . $pedido[0] . ' - ' .$linha['nomePedido'] . ' - <span class = "fontRed" > ' . $pedido[3] . '/' . $pedido[2] . '</span></span>';
            }

            if($linha['numF'] == 40){

                $numeroFeminino = 'não tem';
                $numeroFemininoLabel = 'Unidade :';
            }
            else{

                $numeroFeminino = $linha['numF'];
                $numeroFemininoLabel = 'Masculina: ';
            }

            //Verificando Estoque 
            if(!empty($linha['parEstoqueF'])){
                $estoqueF = ' Estoque' ;
            }
            if(!empty($linha['parEstoqueM'])){
                $estoqueM = ' Estoque' ;
            }

            //Verificando Pedra 
            if($linha['PedraF'] == true){
                $PedraF = '&#128142;' ;
            }
            if( $linha['PedraM'] == true){
                $PedraM = '&#128142;' ;
            }

            //Gravação 
            if($linha['gravacaoInternaF'] !== '' || $linha['gravacaoInternaM'] !== '' ){
                
                $gravInterna = '<span class = "fontRed" >Sim</span>';
            }
            else{
                $gravInterna = '<span class = "fontBlu" >Não</span>';
            }
             ?>
             <div class="carrossel">
                 <div class="flex" style="display: <?php echo $flex ?>;">
                     Flex
                 </div>
                 <div class="carrosselSuperior">
                     <img class="carrosselImg" src="<?php echo $this->caminhoImgem . $linha['imagem']; ?>" alt="ERRO">
                     <div id="pedido">
                     <label class="fontPedido" for="<?php echo $checkboxId3; ?>"><label for="<?php echo $checkboxId3; ?>"><?php echo $pedidoLabel ?></label><input name="marcado_<?php echo $checkboxClass; ?>" title="desmarcar" value="torno" id="<?php echo $checkboxId3; ?>" class="desmarcar <?php echo $checkboxClass; ?>" onchange="salvarEstadoRadio(this , '<?php echo $this->caminhoImgem ?>')" type="radio" ></label>
                     </div>
                     <div class="caixaSelecao">
                         <label class="fontCheckboxPolimento">Polimento </label>
                         <input name="marcado_<?php echo $checkboxClass; ?>" title="Polimento" value="Escritorio" id="<?php echo $checkboxId; ?>"  class="polimentoRadio <?php echo $checkboxClass; ?>" onchange="salvarEstadoRadio(this , '<?php echo $this->caminhoImgem ?>')" type="radio" >
                         <label class="fontCheckboxTorno">Torno </label>
                         <input name="marcado_<?php echo $checkboxClass; ?>" title="Torno" value="Polimento" id="<?php echo $checkboxId2; ?>" class="tornoRadio <?php echo $checkboxClass; ?>"  onchange="salvarEstadoRadio(this , '<?php echo $this->caminhoImgem ?>')" type="radio" >
                     </div>
                 </div>
                 <div class="carrosselInferior">
                     <div class="checklist">
                         <?php
                         if($numeroFeminino !== 'não tem'){
                         ?>
                         <input  value="<?php echo $numeroFeminino ?>" name="numF" type="checkbox" id="<?php echo $numeroCheckboxF ?>" class="input_num <?php echo $checkboxClass; ?> F" >
                         <label for="<?php echo $numeroCheckboxF ?>" class="numeracaoFont"> Feminina: <?php echo $numeroFeminino . $estoqueF; ?><?php echo ' ' .  $PedraF ?></label>
                         <?php }?>
                         <input value="<?php echo $linha['numeM'] ?>" name="numM" type="checkbox" id="<?php echo $numeroCheckboxM ?>" class="input_num <?php echo $checkboxClass; ?> M" >
                         <label for="<?php echo $numeroCheckboxM ?>" class="numeracaoFont"> <?php echo $numeroFemininoLabel . $linha['numeM']. " " . $estoqueM; ?><?php echo ' ' .  $PedraM ?></label>
                     </div>
                     <div class="informacaoInferior">
                         <h3>--- Descrição ---</h3> <?php echo " <h4> Largura: " .  $linha['largura'] . ' --  Gravação:' . $gravInterna  . '</h4>' . $linha['descricaoAlianca'] ?>
                     </div>
                 </div>
             </div>
             <?php
        }
    }
}

?>