
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
