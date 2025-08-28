 <?php       

    // Torno
    function Torno($pedidos , $dataInput) {

        if ($pedidos == null) {
            return;
        }
        if (is_array($pedidos)) {
            foreach ($pedidos as $nome => $valor) {
                if ( $valor['estado'] == 'torno' && ($valor['data'] === date("Y-m-d") || $valor['data'] == $dataInput )) {

                    $pedidoId = $nome;
                    $pedidoSafe = htmlspecialchars($pedidoId);
                    $tornoSaida = $valor['horaEntrega_Escritorio'];
                    
                    // Pedidos
                    echo "<p title='" . htmlspecialchars($cookieValue ?? '') . "'>" . $pedidoSafe . '_' . $valor['conta'];
                        echo " <span style='color:#888;font-size:0.9em;'>(" . $tornoSaida . ")</span>";
                    echo "</p>";
                    
                }

            }
        }
    }
    //Polimento
    function Polimento($pedidos , $dataInput) {

        if (is_array($pedidos)) {
            foreach ($pedidos as $nome => $valor) {
                if ($valor['estado'] == 'polimento' && ($valor['data'] === date("Y-m-d") || $valor['data'] == $dataInput )) {

                    $pedidoId = $nome;
                    $pedidoSafe = htmlspecialchars($pedidoId);
                    $polimentoSaida = $valor['horaEntrega_Torno'];
                    
                    // Pedidos
                    echo "<p title='" . htmlspecialchars($cookieValue ?? '') . "'>" . $pedidoSafe . '_' . $valor['conta'];
                        echo " <span style='color:#888;font-size:0.9em;'>(" . $polimentoSaida . ")</span>";
                    echo "</p>";
                    
                }

            }
        }
    }
    //Gravacao
    function gravacao($pedidos , $dataInput) {

        if (is_array($pedidos)) {
            foreach ($pedidos as $nome => $valor) {
                if ($valor['estado'] == 'escritorio' && $valor['gravacao'] == 'sim' && ($valor['data'] === date("Y-m-d") || $valor['data'] == $dataInput )) {

                    $pedidoId = $nome;
                    $pedidoSafe = htmlspecialchars($pedidoId);
                    $gravacaoSaida = $valor['horaEntrega_Polimento'];
                    
                    // Pedidos
                    echo "<p title='" . htmlspecialchars($cookieValue ?? '') . "'>" . $pedidoSafe . '_' . $valor['conta'];
                        echo " <span style='color:#888;font-size:0.9em;'>(" . $gravacaoSaida . ")</span>";
                    echo "</p>";
                }

            }
        }

    }
    //Escritorio
    function escritorio($pedidos , $dataInput) {

        if (is_array($pedidos)) {
            foreach ($pedidos as $nome => $valor) {
                if ($valor['estado'] == 'escritorio' && $valor['gravacao'] == '' && ($valor['data'] === date("Y-m-d") || $valor['data'] == $dataInput )) {
                    $pedidoId = $nome;
                    $pedidoSafe = htmlspecialchars($pedidoId);
                    $escritorioSaida = $valor['horaEntrega_Gravacao'] ?? $valor['horaEntrega_Polimento'] ?? $valor['horaEntrega_Escritorio'];
                    
                    // Pedidos
                    echo "<p title='" . htmlspecialchars($cookieValue ?? '') . "'>" . $pedidoSafe . '_' . $valor['conta'];
                        echo " <span style='color:#888;font-size:0.9em;'>(" . $escritorioSaida . ")</span>";
                    echo "</p>";
                   
                }

            }
        }

    }


        //Gravacao
    function gravacaoPg($pedidos, $dataInput) {

        if (is_array($pedidos)) {
            foreach ($pedidos as $nome => $valor) {
                if ($valor['estado'] == 'escritorio' && $valor['gravacao'] == 'sim' && ($valor['data'] === date("Y-m-d") || $valor['data'] == $dataInput )) {
                    $pedidoId = $nome;
                    $pedidoSafe = htmlspecialchars($pedidoId);
                    $gravacaoSaida = $valor['horaEntrega_Escritorio'];
                    
                    // Pedidos
                    echo "<p title='" . htmlspecialchars($cookieValue ?? '') . "'>" . $pedidoSafe . '_' . $valor['conta'];
                        echo " <span style='color:#888;font-size:0.9em;'>(" . $gravacaoSaida . ")</span>";
                    echo "</p>";
                }

            }
        }
    }
    //Escritorio
    function escritorioPg($pedidos , $dataInput) {

        if (is_array($pedidos)) {
            foreach ($pedidos as $nome => $valor) {
                if ($valor['estado'] == 'escritorio' && $valor['gravacao'] == '' && ($valor['data'] === date("Y-m-d") || $valor['data'] == $dataInput )) {
                    $pedidoId = $nome;
                    $pedidoSafe = htmlspecialchars($pedidoId);
                    $gravacaoSaida = $valor['horaEntrega_Gravacao'] ?? $valor['horaEntrega_Polimento'] ?? $valor['horaEntrega_Escritorio'];
                    
                    // Pedidos
                    echo "<p title='" . htmlspecialchars($cookieValue ?? '') . "'>" . $pedidoSafe . '_' . $valor['conta'];
                        echo " <span style='color:#888;font-size:0.9em;'>(" . $gravacaoSaida . ")</span>";
                    echo "</p>";
                   
                }

            }
        }
    }
