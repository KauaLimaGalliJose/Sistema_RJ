//Variaveis PHP que está no Coockies---
export function getCookie(nome) {
   
    let cookies = document.cookie.split("; ");
    
    
    for (let cookie of cookies) {
        
        let [chave, value] = cookie.split("=");

      
        if (chave === nome) {
            return value; 
        }
    }
    return null; 
}

export function alertcontador(chave){

   const numeroPedido = document.getElementById('n_p').value;

    if(numeroPedido.options[1].selected !== ('PF' + getCookie('contadorPf')) ){
            alert("Pedido já feito");
            return chave = false;
    }
}