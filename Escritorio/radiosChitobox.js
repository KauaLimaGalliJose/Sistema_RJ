
 //Variaveis Clientes
const cliente1 = document.getElementById('c1');
const cliente2 = document.getElementById('c2');
const cliente3 = document.getElementById('c3');

export function radioCabecalho(){

    if(cliente1.checked){
        document.getElementById('nome_p').style.visibility = 'hidden';
        document.getElementById('outros').style.visibility = 'hidden';
        document.getElementById('n_p').style.visibility = 'visible';
        document.getElementById('nome_m').style.visibility = 'visible';
        document.getElementById('outros').value = null;
    
    }
    if(cliente2.checked){
        document.getElementById('outros').style.visibility = 'hidden';
        document.getElementById('nome_p').style.visibility = 'visible';
        document.getElementById('n_p').style.visibility = 'hidden';
        document.getElementById('nome_m').style.visibility = 'hidden';
        document.getElementById('outros').value = null;
    }
    if(cliente3.checked){
        document.getElementById('outros').style.visibility = 'visible';
        document.getElementById('nome_p').style.visibility = 'visible';
        document.getElementById('n_p').style.visibility = 'hidden';
        document.getElementById('nome_m').style.visibility = 'hidden';
    }
}

export function check_unidade(){
    //variaveis Chetobox
    var check = document.getElementById('checkboxFeminina');

    // Verifica se o checkbox está marcado
    if (check.checked) {
        document.getElementById('numeracao_f').style.visibility = 'hidden';
        document.getElementById('numeracao_f').value = 1;
        console.log(document.getElementById('numeracao_f').value)
    } 
    else{
        document.getElementById('numeracao_f').style.visibility = 'visible';
    }
}

export function gravacaoExterna(){
    //Variaveis
    const gravacaoCheckbox = document.getElementById('gravacao_externa')
    const gravacaoInput = document.getElementById('grav_externaInput')
 
    if(gravacaoCheckbox.checked){
        gravacaoInput.style.visibility = "visible"
    }
    else{
        gravacaoInput.style.visibility = "hidden"
        gravacaoInput.value = null;
    }
}
