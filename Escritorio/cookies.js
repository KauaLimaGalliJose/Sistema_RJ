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

export function deleteCookie(nome) {
    document.cookie = nome + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

export function CreateCookie(nome, valor, dias) {
    const data = new Date();
    data.setTime(data.getTime() + (dias * 24 * 60 * 60 * 1000)); // Definindo a data de expiração
    const expires = "expires=" + data.toUTCString();
    document.cookie = nome + "=" + valor + "; " + expires + "; path=/";
}