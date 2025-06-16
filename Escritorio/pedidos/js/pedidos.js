//Imports

// Atualiza a página
setInterval(function() {
    window.onload = function() {
      document.getElementById('formulario').submit();
    };
    location.reload();
  }, 40000); //40 segundos
  

//Buttons 
const buttonImprimir =  document.getElementById('imprimir');
const buttonPdf = document.getElementById('pdfImprimir');
const buttonPdfDiv = document.getElementById('buttonPdf');
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
// 35 escala
  
// Parte do Scroll---------------------------------------------------------------------------------

window.addEventListener('wheel', function(e) {
    e.preventDefault(); // Impede o scroll padrão do navegador

    const scrollAmount = 500; // define a "passada"
    const direction = e.deltaY > 0 ? 1 : -1;

    window.scrollBy({
      top: scrollAmount * direction,
      behavior: 'auto' 
    });
  }, { passive: false }); // 'passive: false' é necessário para usar e.preventDefault