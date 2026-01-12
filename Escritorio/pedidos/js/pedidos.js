//Imports

// Atualiza a página
setInterval(function() {
    window.onload = function() {
      document.getElementById('formulario').submit();
    };
    location.reload();
  }, 3000000); //40 segundos
  

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

let scrollTarget = window.scrollY;
let isScrolling = false;
let manualScrollTimeout = null;
let isUserScrollingManually = false;

window.addEventListener('wheel', function(e) {
  e.preventDefault();

  const delta = e.deltaY;
  scrollTarget += delta;

  if (!isScrolling && !isUserScrollingManually) {
    smoothScroll();
  }
}, { passive: false });

window.addEventListener('scroll', function () {
  // Detecção de scroll manual (ex: arraste da barra)
  if (!isScrolling) {
    isUserScrollingManually = true;
    scrollTarget = window.scrollY;

    // Aguarda um tempo sem scroll para assumir que parou
    clearTimeout(manualScrollTimeout);
    manualScrollTimeout = setTimeout(() => {
      isUserScrollingManually = false;
    }, 150); // 150ms sem scroll = parou
  }
});

function smoothScroll() {
  isScrolling = true;

  const currentY = window.scrollY;
  const distance = scrollTarget - currentY;
  const step = distance * 0.13;

  if (Math.abs(step) > 0.5) {
    window.scrollTo(0, currentY + step);
    requestAnimationFrame(smoothScroll);
  } else {
    isScrolling = false;
  }
}


// Fim do Scroll------------------------------------------------------------------------------------

// Adiciona favicon dinamicamente coroa.ico
(function() {
    let link = document.createElement('link');
    link.rel = 'shortcut icon';
    link.type = 'image/x-icon';
    link.href = '../Escritorio_img/coroa.ico'; 
    document.head.appendChild(link);
})();

// -----------------------------------------------------------------------------------------------