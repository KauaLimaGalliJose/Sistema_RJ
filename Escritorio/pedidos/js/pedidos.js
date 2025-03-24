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

    //Buttons
    document.querySelectorAll('.btPedidos').forEach(element => {
      element.style.display = 'none';
    });
    //Texto
    document.querySelectorAll('.pedidostexto').forEach(element => {
      element.style.marginBottom = '10px';
    });

    ///// -------Antes
    window.print();
    ///// --------Depois
    document.getElementById('formulario').style.display = 'flex'
    //Buttons
    document.querySelectorAll('.btPedidos').forEach(element => {
      element.style.display = 'flex';
    });
    //Texto
    document.querySelectorAll('.pedidostexto').forEach(element => {
      element.style.marginBottom = '100px';
    });
})
// 34 escala
  
