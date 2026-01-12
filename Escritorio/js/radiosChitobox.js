
 //Variaveis Clientes
const cliente1 = document.getElementById('c1');
const cliente2 = document.getElementById('c2');
const cliente3 = document.getElementById('c3');

export function radioCabecalho(){

    if(cliente1.checked){
        document.getElementById('nome_p').style.display = 'none';
        document.getElementById('outros').style.display = 'none';
        document.getElementById('n_p').style.display = 'flex';
        document.getElementById('nome_m').style.display = 'flex';
        document.getElementById('outros').value = null;
    
    }
    if(cliente2.checked){
        document.getElementById('outros').style.display = 'none';
        document.getElementById('nome_p').style.display = 'flex';
        document.getElementById('n_p').style.display = 'none';
        document.getElementById('nome_m').style.display = 'none';
        document.getElementById('outros').value = null;
    }
    if(cliente3.checked){
        document.getElementById('outros').style.display = 'flex';
        document.getElementById('nome_p').style.display = 'flex';
        document.getElementById('n_p').style.display = 'none';
        document.getElementById('nome_m').style.display = 'none';
    }
}

export function check_unidade(){
    //variaveis Chetobox
    var check = document.getElementById('checkboxFeminina');

    // Verifica se o checkbox está marcado
    if (check.checked) {
        document.getElementById('numeracao_f').style.visibility = 'hidden';
        document.getElementById('numeracao_f').value = 40;
    } 
    else{
        document.getElementById('numeracao_f').style.visibility = 'visible';
        document.getElementById('numeracao_f').value = null;
    }
}

export function aguardar_grav(){
    //Variaveis
    const gravacaoCheckbox = document.getElementById('gravacao_externa')

    const gravInternaM = document.getElementById('gravInternaM')
    const gravInternaF = document.getElementById('gravInternaF')

    if(gravacaoCheckbox.checked){
        
        gravInternaM.value = 'Confirmar_Gravação';
        gravInternaF.value = 'Confirmar_Gravação';
        gravInternaM.disabled = true;
        gravInternaF.disabled = true;
    }
    else{
        
        gravInternaM.disabled = false;
        gravInternaF.disabled = false;
        gravInternaM.value = '';
        gravInternaF.value = '';
    }
}

export function checkboxRodape(){
    const semPedra = document.querySelector("#semPedra");
    const comPedra = document.querySelector('#comPedra');
    const estoqueMasculina = document.querySelector('#estoqueMasculina');
    const estoqueFeminina = document.querySelector('#estoqueFeminina');
 
//--------------------------------------------verificando Pedra
    if(semPedra.checked){
        semPedra.value = true;
    }
    if(comPedra.checked){
        comPedra.value = true;
        
    }
    if(!comPedra.checked && !semPedra.checked){
        semPedra.value = false;
        comPedra.value = false;
    }
//--------------------------------------------verificando estoque 
    if(estoqueFeminina.checked){
        estoqueFeminina.value = true;
        estoqueMasculina.value = false;
    }
    if(estoqueMasculina.checked){
        estoqueMasculina.value = true;
        estoqueFeminina.value = false;
    }
    if(estoqueFeminina.checked && estoqueMasculina.checked){
        estoqueFeminina.value = true;
        estoqueMasculina.value = true;
    }
    if(!estoqueFeminina.checked && !estoqueMasculina.checked){
        estoqueFeminina.value = false;
        estoqueMasculina.value = false;
    }
}