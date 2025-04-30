//Imports

// Atualiza a página
setInterval(function() {
    window.onload = function() {
      document.getElementById('formulario').submit();
    };
    location.reload();
  }, 40000); //40 segundos
  
