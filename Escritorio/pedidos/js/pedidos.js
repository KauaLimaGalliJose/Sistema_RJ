

const buttonImprimir =  document.getElementById('imprimir')

buttonImprimir.addEventListener('click',function(){
    document.getElementById('formulario').style.display = 'none'
    window.print();
})