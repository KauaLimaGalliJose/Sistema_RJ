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
  
buttonPdf.addEventListener('click',function(){
  const pdfDiv =  document.getElementById('PdfDivMae');

  if(pdfDiv.style.visibility == 'hidden'){
    pdfDiv.style.visibility = 'visible';

    document.getElementById('phpmae').style.filter = 'brightness(0.65) contrast(0.85) blur(2px)';
    document.getElementById('formulario').style.filter = 'brightness(0.75) contrast(0.95) blur(2px)';
    
  }
  else{
    pdfDiv.style.visibility = 'hidden';

    document.getElementById('phpmae').style.filter = '';
    document.getElementById('formulario').style.filter = '';
  }
})

buttonPdfDiv.addEventListener('click', function(){
  const pdfDiv =  document.getElementById('PdfDivMae');

  pdfDiv.style.visibility = 'hidden';

  document.getElementById('phpmae').style.filter = '';
  document.getElementById('formulario').style.filter = '';
})