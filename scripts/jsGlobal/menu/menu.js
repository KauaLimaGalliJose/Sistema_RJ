// Função para enviar o formulário
function abrir_Menu() {
    
    let menu = document.getElementById('div_menu_conteiner');
    let menu_button = document.getElementById('burger');
    
    if(menu_button.checked){
        
        // aqui adiciona classe e salva no localStorage (armazenamento do navegador )
        menu.classList.add('ativo_localstage', 'ativo');
        localStorage.setItem('menu_cabecalho', 'aberto');
    }
    else{

        menu.classList.remove('ativo' ,'ativo_localstage');
        localStorage.setItem('menu_cabecalho', 'fechado');
    }
}

// Função para criar/alterar cookies
function criarCookie(nomeTitulo, nome, diasExpira) {

    let agora = new Date();
    agora.setTime(agora.getTime() + (diasExpira * 24 * 60 * 60 * 1000));
    let expira = "expires=" + agora.toUTCString();

    document.cookie = nomeTitulo + "=" + nome + "; " + expira + "; path=/";
}



// Função para enviar dados ao localStorage
function enviarLocalStorage(nomeTitulo, nome){

    if(nome === null || nome === undefined){

        nome = '';
    }

    localStorage.setItem( nomeTitulo , nome );

}

function enviarLocalStoCheckBox(nomeTitulo, checkbox) {
    const valor = checkbox.checked ? checkbox.value : ''; // "checkFlex" ou ""
    enviarLocalStorage(nomeTitulo, valor);
    criarCookie(nomeTitulo, valor , 1)
}


// Restaura o estado do menu com base no localStorage
window.onload = function() {
    
    // Pegando itens LocalStorage ---
    let estadoMenu = localStorage.getItem('menu_cabecalho');
    let estilo_pedido = localStorage.getItem('estilo_pedido');

    // Variaveis ID ---
    let menu = document.getElementById('div_menu_conteiner');
    let menu_button = document.getElementById('burger');

    // Verifica se o menu está aberto ou fechado
    if (estadoMenu === 'aberto') {
        menu.classList.add('ativo_localstage');
        menu_button.checked = true;
    } else {
        menu.classList.remove('ativo_localstage');
        menu_button.checked = false;
    }

    // Verifica a escolha do estilo dos pedidos
    if(estilo_pedido == 'pedidosLinha'){

       const pedidosEmLinha = document.getElementById('pedidosEmLinha_label');

        pedidosEmLinha.style.cssText = 'background-color: rgb(247, 94, 94); border-radius: 10px;';
        criarCookie('estilo_pedido', estilo_pedido , 7);
        
    }
    else{
        
        const pedidosEmLinha = document.getElementById('pedidosEmBlocos_label');
        
        pedidosEmLinha.style.cssText = 'background-color: rgb(247, 94, 94); border-radius: 10px;';
        criarCookie('estilo_pedido', 'pedidosBlocos' , 7);
    }

    // Verifica a parte do filtro dos pedidos ---
    let filtro_estoque = localStorage.getItem('filtro_estoque');
    let filtro_pedidos = localStorage.getItem('filtro_pedido');
    let filtro_numero = localStorage.getItem('filtro_numero');
    let filtro_flex = localStorage.getItem('filtro_flex');
    let check_config_estoque = localStorage.getItem('check_config_estoque');
    
    const filtroEstoqueInput = document.getElementById('filtro_estoque');
    const filtroPedidosInput = document.getElementById('filtro_pedidos');
    const filtroNumeroInput = document.getElementById('filtro_numero');
    const filtroflexInput = document.getElementById('filtro_flex');
    const check_config_estoqueInput = document.getElementById('check_config_estoque');

    // Parte do filtro do estoque
    if(filtro_estoque !== 'Todos' ){

        filtroEstoqueInput.value = filtro_estoque;
    }
    else{
        filtroEstoqueInput.value = 'Todos';
    }
    
    // Parte do filtro do pedidos
    if(filtro_pedidos !== 'Todos' ){

        filtroPedidosInput.value = filtro_pedidos;
    }
    else{
        filtroPedidosInput.value = 'Todos';
    }


    // Parte do filtro do numeração dos pedidos
    if(filtro_numero !== null ){

        filtroNumeroInput.value = filtro_numero;
    }
    else{
        filtroNumeroInput.value = '';
    }
    
    // Parte do filtro do Flex
    filtroflexInput.checked = (filtro_flex === 'checkFlex');
    check_config_estoqueInput.checked = (check_config_estoque === 'check_config_estoque');

}
