<?php 
include_once('separador.php');

function pedidosPf($dataInput) {

    
    $jsonPath = dirname(__DIR__, 3) . '/arquivoJson/pedidos.json';
    $pedidos = [];
        // Array para cookies a serem criados
    $cookiesParaCriar = [];


    if (file_exists($jsonPath)) {
        $json = file_get_contents($jsonPath);
        $pedidos = json_decode($json, true);
    }

    ?>
    <div id='processo'>

        <div id="torno">
            <div class="TextoTitulo">
                <p>Torno</p>
            </div>
            <div>
                <?php Torno($pedidos, $cookiesParaCriar,$dataInput); ?>
            </div>
        </div>

        <div id="polimento">
            <div class="TextoTitulo">
                <p>Polimento</p>
            </div>
            <div>
                <?php Polimento($pedidos, $cookiesParaCriar,$dataInput); ?>
            </div>
        </div>

        <div id="gravacao">
            <div class="TextoTitulo">
                <p>Gravação</p>
            </div>
            <div>
                <?php gravacao($pedidos, $cookiesParaCriar,$dataInput); ?>
            </div>
        </div> 

        <div id="escritorio">
            <div class="TextoTitulo">
                <p>Escritório</p>
            </div>
            <div>
                <?php escritorio($pedidos, $cookiesParaCriar,$dataInput);  ?>
            </div>
        </div>

    </div>
    </div>
    <?php   
}

function pedidosPg($dataInput) {

            // Lê e decodifica o arquivo JSON
     $jsonPath = dirname(__DIR__, 3) . '/arquivoJson/pedidosPg.json';
    $pedidos = [];
    if (file_exists($jsonPath)) {
        $json = file_get_contents($jsonPath);
        $pedidos = json_decode($json, true);
    }

    // Array para cookies a serem criados
    $cookiesParaCriar = [];

    ?>  
          <div id='processo'>

            <div id="gravacao">
                <div class="TextoTitulo">
                    <p>Gravação</p>
                </div>
                <div>
                    <?php gravacaoPg($pedidos, $cookiesParaCriar,$dataInput); ?>
                </div>
            </div> 

            <div id="escritorio">
              <div class="TextoTitulo">
                <p>Escritório</p>
              </div>
                <div>
                    <?php escritorioPg($pedidos, $cookiesParaCriar,$dataInput); ?>
                </div>
            </div>

          </div>
        </div>
    <?php   
}

function pedidosPe($nenhumPedido) {
    ?>  
          <div id='processo'>


            <div id="escritorio">
              <div class="TextoTitulo">
                <p>Escritório</p>
              </div>
                <div>
                    <?php echo $nenhumPedido ?>
                </div>
            </div>

            <div id="pronto">
                <div class="TextoTitulo">
                    <p>Pronto</p>
                </div>
                <div>
                    <?php echo $nenhumPedido ?>
                </div>
            </div>

          </div>
        </div>
    <?php   
}

function todos($dataInput){

    //PF
    $jsonPath = dirname(__DIR__, 3) . '/arquivoJson/pedidos.json';
    $pedidos = [];
    if (file_exists($jsonPath)) {
        $json = file_get_contents($jsonPath);
        $pedidos = json_decode($json, true);
    }
    // Array para cookies a serem criados
    $cookiesParaCriar = [];

    //PG
    $jsonPathpg = dirname(__DIR__, 3) . '/arquivoJson/pedidosPg.json';
    $pedidospg = [];
    if (file_exists($jsonPath)) {
        $json = file_get_contents($jsonPathpg);
        $pedidospg = json_decode($json, true);
    }

    // Array para cookies a serem criados
    $cookiesParaCriarPG = [];


    ?>
    <div id='processo'>

        <div id="torno">
            <div class="TextoTitulo">
                <p>Torno</p>
            </div>
            <div>
                <?php Torno($pedidos, $cookiesParaCriar,$dataInput); ?>
                <?php  ?>
            </div>
        </div>

        <div id="polimento">
            <div class="TextoTitulo">
                <p>Polimento</p>
            </div>
            <div>
                <?php Polimento($pedidos, $cookiesParaCriar,$dataInput); ?>
            </div>
        </div>

        <div id="gravacao">
            <div class="TextoTitulo">
                <p>Gravação</p>
            </div>
            <div>
                <?php gravacao($pedidos, $cookiesParaCriar,$dataInput); ?>
                <?php gravacao($pedidospg, $cookiesParaCriarPG,$dataInput); ?>
            </div>
        </div> 

        <div id="escritorio">
            <div class="TextoTitulo">
                <p>Escritório</p>
            </div>
            <div>
                <?php escritorio($pedidos, $cookiesParaCriar,$dataInput);  ?>
                <?php escritorio($pedidospg, $cookiesParaCriarPG,$dataInput);  ?>
            </div>
        </div>

    </div>
    </div>
    <?php   
}