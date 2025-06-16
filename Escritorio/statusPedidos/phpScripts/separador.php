 <?php       

    // Torno
    function Torno($pedidos, &$cookiesParaCriar, $dataInput) {
        $achou = false;
        if (is_array($pedidos)) {
            foreach ($pedidos as $nome => $valor) {
                if ( $valor['estado'] == 'torno' && ($valor['data'] === date("Y-m-d") || $valor['data'] == $dataInput )) {
                    $pedidoId = $nome;
                    $pedidoSafe = htmlspecialchars($pedidoId);
                    $cookieName = $pedidoSafe . "horarioEntrega_";

                    // Adiciona cookie para ser criado depois
                    if (!isset($_COOKIE[$cookieName])) {
                        $cookiesParaCriar[] = [
                            'name' => $cookieName,
                            'value' => "Saiu_"  . '_' . date("H:i"),
                            'expire' => time() + 3600 * 120,
                            'path' => "/"
                        ];
                        $hora = date("H:i");
                        $cookieValue = "Saiu__" . $hora;
                    } else {
                        $cookieValue = $_COOKIE[$cookieName];
                        $partes = explode('_', $cookieValue);
                        $hora = isset($partes[2]) ? $partes[2] : '';
                    }
                    // Pedidos
                    echo "<p title='" . htmlspecialchars($cookieValue ?? '') . "'>" . $pedidoSafe . '_' . $valor['conta'];
                    if (!empty($hora)) {
                        echo " <span style='color:#888;font-size:0.9em;'>(" . $hora . ")</span>";
                    }
                    echo "</p>";
                    $achou = true;
                }

            }
        }
        if (!$achou) {
            echo "<p>Nenhum pedido ainda</p>";
        }
        // CRIA OS COOKIES ANTES DE QUALQUER SAÍDA
        if (is_array($pedidos)) {
            foreach ($pedidos as $nome => $valor) {
                $pedidoId =  $nome;
                $pedidoSafe = htmlspecialchars($pedidoId);
                $cookieName = $pedidoSafe . "horarioEntrega_";
                if (!isset($_COOKIE[$cookieName])) {
                    setcookie($cookieName, "Saiu_"  . '_' . date("H:i"), time() + 3600 * 12, "/");
                }
            }
        }
    }
    //Polimento
    function Polimento($pedidos, &$cookiesParaCriar, $dataInput) {
        $achou = false;
        if (is_array($pedidos)) {
            foreach ($pedidos as $nome => $valor) {
                if ($valor['estado'] == 'polimento' && ($valor['data'] === date("Y-m-d") || $valor['data'] == $dataInput )) {
                    $pedidoId = $nome;
                    $pedidoSafe = htmlspecialchars($pedidoId);
                    $cookieName = $pedidoSafe . "horarioEntrega_";

                    // Adiciona cookie para ser criado depois
                    if (!isset($_COOKIE[$cookieName])) {
                        $cookiesParaCriar[] = [
                            'name' => $cookieName,
                            'value' => "Saiu_"  . '_' . date("H:i"),
                            'expire' => time() + 3600 * 120,
                            'path' => "/"
                        ];
                        $hora = date("H:i");
                        $cookieValue = "Saiu__" . $hora;
                    } else {
                        $cookieValue = $_COOKIE[$cookieName];
                        $partes = explode('_', $cookieValue);
                        $hora = isset($partes[2]) ? $partes[2] : '';
                    }
                    // Pedidos
                    echo "<p title='" . htmlspecialchars($cookieValue ?? '') . "'>" . $pedidoSafe . '_' . $valor['conta'];
                    if (!empty($hora)) {
                        echo " <span style='color:#888;font-size:0.9em;'>(" . $hora . ")</span>";
                    }
                    echo "</p>";
                    $achou = true;
                }

            }
        }
        if (!$achou) {
            echo "<p>Nenhum pedido ainda</p>";
        }
        // CRIA OS COOKIES ANTES DE QUALQUER SAÍDA
        if (is_array($pedidos)) {
            foreach ($pedidos as $nome => $valor) {
                $pedidoId =  $nome;
                $pedidoSafe = htmlspecialchars($pedidoId);
                $cookieName = $pedidoSafe . "horarioEntrega_";
                if (!isset($_COOKIE[$cookieName])) {
                    setcookie($cookieName, "Saiu_"  . '_' . date("H:i"), time() + 3600 * 12, "/");
                }
            }
        }
    }
    //Gravacao
    function gravacao($pedidos, &$cookiesParaCriar, $dataInput) {
        $achou = false;
        if (is_array($pedidos)) {
            foreach ($pedidos as $nome => $valor) {
                if ($valor['estado'] == 'escritorio' && $valor['gravacao'] == 'sim' && ($valor['data'] === date("Y-m-d") || $valor['data'] == $dataInput )) {
                    $pedidoId = $nome;
                    $pedidoSafe = htmlspecialchars($pedidoId);
                    $cookieName = $pedidoSafe . "horarioEntrega_";

                    // Adiciona cookie para ser criado depois
                    if (!isset($_COOKIE[$cookieName])) {
                        $cookiesParaCriar[] = [
                            'name' => $cookieName,
                            'value' => "Saiu_"  . '_' . date("H:i"),
                            'expire' => time() + 3600 * 120,
                            'path' => "/"
                        ];
                        $hora = date("H:i");
                        $cookieValue = "Saiu__" . $hora;
                    } else {
                        $cookieValue = $_COOKIE[$cookieName];
                        $partes = explode('_', $cookieValue);
                        $hora = isset($partes[2]) ? $partes[2] : '';
                    }
                    // Pedidos
                    echo "<p title='" . htmlspecialchars($cookieValue ?? '') . "'>" . $pedidoSafe . '_' . $valor['conta'];
                    if (!empty($hora)) {
                        echo " <span style='color:#888;font-size:0.9em;'>(" . $hora . ")</span>";
                    }
                    echo "</p>";
                    $achou = true;
                }

            }
        }
        if (!$achou) {
            echo "<p>Nenhum pedido ainda</p>";
        }
        // CRIA OS COOKIES ANTES DE QUALQUER SAÍDA
        if (is_array($pedidos)) {
            foreach ($pedidos as $nome => $valor) {
                $pedidoId =  $nome;
                $pedidoSafe = htmlspecialchars($pedidoId);
                $cookieName = $pedidoSafe . "horarioEntrega_";
                if (!isset($_COOKIE[$cookieName])) {
                    setcookie($cookieName, "Saiu_"  . '_' . date("H:i"), time() + 3600 * 12, "/");
                }
            }
        }
    }
    //Escritorio
    function escritorio($pedidos, &$cookiesParaCriar, $dataInput) {
        $achou = false;
        if (is_array($pedidos)) {
            foreach ($pedidos as $nome => $valor) {
                if ($valor['estado'] == 'escritorio' && $valor['gravacao'] == '' && ($valor['data'] === date("Y-m-d") || $valor['data'] == $dataInput )) {
                    $pedidoId = $nome;
                    $pedidoSafe = htmlspecialchars($pedidoId);
                    $cookieName = $pedidoSafe . "horarioEntrega_";

                    // Adiciona cookie para ser criado depois
                    if (!isset($_COOKIE[$cookieName])) {
                        $cookiesParaCriar[] = [
                            'name' => $cookieName,
                            'value' => "Saiu_"  . '_' . date("H:i"),
                            'expire' => time() + 3600 * 120,
                            'path' => "/"
                        ];
                        $hora = date("H:i");
                        $cookieValue = "Saiu__" . $hora;
                    } else {
                        $cookieValue = $_COOKIE[$cookieName];
                        $partes = explode('_', $cookieValue);
                        $hora = isset($partes[2]) ? $partes[2] : '';
                    }
                    // Pedidos
                    echo "<p title='" . htmlspecialchars($cookieValue ?? '') . "'>" . $pedidoSafe . '_' . $valor['conta'];
                    if (!empty($hora)) {
                        echo " <span style='color:#888;font-size:0.9em;'>(" . $hora . ")</span>";
                    }
                    echo "</p>";
                    $achou = true;
                }

            }
        }
        if (!$achou) {
            echo "<p>Nenhum pedido ainda</p>";
        }
        // CRIA OS COOKIES ANTES DE QUALQUER SAÍDA
        if (is_array($pedidos)) {
            foreach ($pedidos as $nome => $valor) {
                $pedidoId =  $nome;
                $pedidoSafe = htmlspecialchars($pedidoId);
                $cookieName = $pedidoSafe . "horarioEntrega_";
                if (!isset($_COOKIE[$cookieName])) {
                    setcookie($cookieName, "Saiu_"  . '_' . date("H:i"), time() + 3600 * 12, "/");
                }
            }
        }
    }


        //Gravacao
    function gravacaoPg($pedidos, &$cookiesParaCriar, $dataInput) {
        $achou = false;
        if (is_array($pedidos)) {
            foreach ($pedidos as $nome => $valor) {
                if ($valor['estado'] == 'escritorio' && $valor['gravacao'] == 'sim' && ($valor['data'] === date("Y-m-d") || $valor['data'] == $dataInput )) {
                    $pedidoId = $nome;
                    $pedidoSafe = htmlspecialchars($pedidoId);
                    $cookieName = $pedidoSafe . "horarioEntrega_";

                    // Adiciona cookie para ser criado depois
                    if (!isset($_COOKIE[$cookieName])) {
                        $cookiesParaCriar[] = [
                            'name' => $cookieName,
                            'value' => "Saiu_"  . '_' . date("H:i"),
                            'expire' => time() + 3600 * 120,
                            'path' => "/"
                        ];
                        $hora = date("H:i");
                        $cookieValue = "Saiu__" . $hora;
                    } else {
                        $cookieValue = $_COOKIE[$cookieName];
                        $partes = explode('_', $cookieValue);
                        $hora = isset($partes[2]) ? $partes[2] : '';
                    }
                    // Pedidos
                    echo "<p title='" . htmlspecialchars($cookieValue ?? '') . "'>" . $pedidoSafe . '_' . $valor['conta'];
                    if (!empty($hora)) {
                        echo " <span style='color:#888;font-size:0.9em;'>(" . $hora . ")</span>";
                    }
                    echo "</p>";
                    $achou = true;
                }

            }
        }
        if (!$achou) {
            echo "<p>Nenhum pedido ainda</p>";
        }
        // CRIA OS COOKIES ANTES DE QUALQUER SAÍDA
        if (is_array($pedidos)) {
            foreach ($pedidos as $nome => $valor) {
                $pedidoId =  $nome;
                $pedidoSafe = htmlspecialchars($pedidoId);
                $cookieName = $pedidoSafe . "horarioEntrega_";
                if (!isset($_COOKIE[$cookieName])) {
                    setcookie($cookieName, "Saiu_"  . '_' . date("H:i"), time() + 3600 * 12, "/");
                }
            }
        }
    }
    //Escritorio
    function escritorioPg($pedidos, &$cookiesParaCriar, $dataInput) {
        $achou = false;
        if (is_array($pedidos)) {
            foreach ($pedidos as $nome => $valor) {
                if ($valor['estado'] == 'escritorio' && $valor['gravacao'] == '' && ($valor['data'] === date("Y-m-d") || $valor['data'] == $dataInput )) {
                    $pedidoId = $nome;
                    $pedidoSafe = htmlspecialchars($pedidoId);
                    $cookieName = $pedidoSafe . "horarioEntrega_";

                    // Adiciona cookie para ser criado depois
                    if (!isset($_COOKIE[$cookieName])) {
                        $cookiesParaCriar[] = [
                            'name' => $cookieName,
                            'value' => "Saiu_"  . '_' . date("H:i"),
                            'expire' => time() + 3600 * 120,
                            'path' => "/"
                        ];
                        $hora = date("H:i");
                        $cookieValue = "Saiu__" . $hora;
                    } else {
                        $cookieValue = $_COOKIE[$cookieName];
                        $partes = explode('_', $cookieValue);
                        $hora = isset($partes[2]) ? $partes[2] : '';
                    }
                    // Pedidos
                    echo "<p title='" . htmlspecialchars($cookieValue ?? '') . "'>" . $pedidoSafe . '_' . $valor['conta'];
                    if (!empty($hora)) {
                        echo " <span style='color:#888;font-size:0.9em;'>(" . $hora . ")</span>";
                    }
                    echo "</p>";
                    $achou = true;
                }

            }
        }
        if (!$achou) {
            echo "<p>Nenhum pedido ainda</p>";
        }
        // CRIA OS COOKIES ANTES DE QUALQUER SAÍDA
        if (is_array($pedidos)) {
            foreach ($pedidos as $nome => $valor) {
                $pedidoId =  $nome;
                $pedidoSafe = htmlspecialchars($pedidoId);
                $cookieName = $pedidoSafe . "horarioEntrega_";
                if (!isset($_COOKIE[$cookieName])) {
                    setcookie($cookieName, "Saiu_"  . '_' . date("H:i"), time() + 3600 * 12, "/");
                }
            }
        }
    }
