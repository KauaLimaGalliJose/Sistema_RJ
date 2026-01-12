<?php
function estiloConfig_pedidos_menu(){

    $valor_Cookie =$_COOKIE['estilo_pedido'] ?? "pedidosLinha" ;

    return $valor_Cookie;
}


?>