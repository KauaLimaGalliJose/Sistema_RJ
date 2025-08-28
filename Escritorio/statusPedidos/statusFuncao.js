// Atualiza a página
setInterval(function() {
    window.onload = function() {
      document.getElementById('formulario').submit();
    };
    location.reload();
  }, 10000); //


//Radios PF PG e PE
document.addEventListener('DOMContentLoaded', function() {
  const radios = document.querySelectorAll('.input[type="radio"]');
  radios.forEach(function(radio) {
    radio.addEventListener('change', function(e) {
      setTimeout(function() {
        document.getElementById('formulario').submit();
      }, 500); // 3 segundos de delay
    });
  });
});

//DATA
 document.getElementById('dataInput').addEventListener('change', function() {
    document.getElementById('formulario').submit();
  });

// Adiciona favicon dinamicamente coroa.ico
(function() {
    let link = document.createElement('link');
    link.rel = 'shortcut icon';
    link.type = 'image/x-icon';
    link.href = '../Escritorio_img/coroa.ico'; 
    document.head.appendChild(link);
})();



