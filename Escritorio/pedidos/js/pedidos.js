//Imports

// Atualiza a página
setInterval(function() {
    location.reload();
  }, 1200000); //20 minutos

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
  
