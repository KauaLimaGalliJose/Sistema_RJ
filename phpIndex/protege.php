<?php 
    include_once 'verifica_Token.php';

    function proteger() {

        if((isset($_COOKIE['token']) && !empty($_COOKIE['token'])) ) {
            // Token válido, prosseguir com a lógica do sistema

        } else {
            // Token inválido, redirecionar ou exibir mensagem de erro
            echo "Token inválido. Acesso negado.";
            header("Location: ../index.php"); 
            exit();
        }
    }

?>