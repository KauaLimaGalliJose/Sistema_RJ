// imports
import { voltar, avancar, limpar , atualizarDiv} from "./funcao.js";
import { radioCabecalho, check_unidade, gravacaoExterna, checkboxRodape } from "./radiosChitobox.js";
import img_modelo  from "./imagemInput.js";
import { dataCabecalho, dataEntrega} from "./dataHora.js";
import { enviar, naoenviar, verificar } from "./verificarEnviar.js";
import { getCookie } from "./cookies.js";

//Buttons
const voltarBt = document.getElementById('seta_esquerda');
const avancarBt = document.getElementById('seta_direita');
const limparBt = document.getElementById('limpar');
const imagemBt = document.getElementById('uploadimg');
const enviarBt = document.getElementById('btEnviar');

//Global Variaveis
export let contador = { 
contador_P:0,
contador_Pg:0, 
contador_Pe:0
}

//acresentando dados do Banco de Dados
contador.contador_P = getCookie('contadorPf');
contador.contador_Pg = getCookie('contadorPg');
contador.contador_Pe = getCookie('contadorPe');

//Funções com Buttons

voltarBt.addEventListener('click', function(){
   contador =  voltar(contador.contador_P,contador.contador_Pg,contador.contador_Pe)
});

avancarBt.addEventListener('click', function(){
   contador =  avancar(contador.contador_P,contador.contador_Pg,contador.contador_Pe)
});

addEventListener('change', function(){
    radioCabecalho()
    check_unidade()
    gravacaoExterna()
    checkboxRodape()
}); 

imagemBt.addEventListener('click', function(){
    img_modelo()
});

limparBt.addEventListener('click',function(){
    limpar()
});

enviarBt.addEventListener('click',function(){
    if(verificar() === true){
        contador =  avancar(contador.contador_P,contador.contador_Pg,contador.contador_Pe)
        console.log(document.cookie);
        atualizarDiv("#envioP", 'divrodape.php');
        enviar()
    }
    else{
        return naoenviar()
    }
});

//Funções para ser iniciadas
dataCabecalho()
dataEntrega()
console.log(document.cookie);
