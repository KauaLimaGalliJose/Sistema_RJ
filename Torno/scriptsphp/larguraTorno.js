//Variaveis
const buttonImprimir = document.getElementById('imprimir')


buttonImprimir.addEventListener('click',function(){
  document.getElementById('cabecalho').style.display = 'none'

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
  document.getElementById('cabecalho').style.display = 'flex'
  //Buttons
  document.querySelectorAll('.btPedidos').forEach(element => {
    element.style.display = 'flex';
  });
  //Texto
  document.querySelectorAll('.pedidostexto').forEach(element => {
    element.style.marginBottom = '100px';
  });
})