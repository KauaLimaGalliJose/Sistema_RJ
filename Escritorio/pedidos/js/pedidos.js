//Imports
import { atualizarDiv } from "./funcao.js";

// Atualiza a página
setInterval(function() {
    location.reload();
  }, 5400000); //1:30H

//Buttons 
const buttonImprimir =  document.getElementById('imprimir');

//Funções 

buttonImprimir.addEventListener('click',function(){
    document.getElementById('formulario').style.display = 'none'

    /////
    window.print();
    document.getElementById('formulario').style.display = 'flex'
})
// 34 escala
  
atualizarDiv('#phpmae' , "../../../semPedidos/semPedidos.php");