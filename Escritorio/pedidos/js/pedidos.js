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
      element.style.marginTop = '0px';
    });
    //Imagem
    document.querySelectorAll('.pedidosImagem').forEach(element => {
      element.style.marginTop = '0px';
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
      element.style.marginTop = '82px';
    });
    //Imagem
    document.querySelectorAll('.pedidosImagem').forEach(element => {
      element.style.marginTop = '82px';
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

// Adiciona favicon dinamicamente coroa.ico
(function() {
    let link = document.createElement('link');
    link.rel = 'shortcut icon';
    link.type = 'image/x-icon';
    link.href = '../Escritorio_img/coroa.ico'; 
    document.head.appendChild(link);
})();

// -----------------------------------------------------------------------------------------------