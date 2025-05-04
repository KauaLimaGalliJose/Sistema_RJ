// Atualiza a página
setInterval(function() {
    window.onload = function() {
      document.getElementById('formulario').submit();
    };
    location.reload();
  }, 40000); //40 segundos

// JavaScript para manter estado dos checkboxes -->
function salvarEstadoCheckbox(checkbox) {

    localStorage.setItem(checkbox.id, checkbox.checked);
    const carrossel = checkbox.closest('.carrossel');
    const carrosselSuperior = checkbox.closest('.carrosselSuperior');
    if (!carrossel && !carrosselSuperior) return;

    if (checkbox.checked) {
        carrossel.style.border = '8px solid blue'; 
        carrosselSuperior.style.borderBottom = '8px solid blue'; 
    } else {
        carrossel.style.border = '';
        carrosselSuperior.style.borderBottom = ''; 
    }
}

window.addEventListener("load", function() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(cb => {
        const estado = localStorage.getItem(cb.id);
        if (estado === 'true') {
            cb.checked = true;

            const carrossel = cb.closest('.carrossel');
            if (carrossel) {
                carrossel.style.border = '8px solid blue'; 
            }

            const carrosselSuperior = cb.closest('.carrosselSuperior');
            if (carrosselSuperior) {
                carrosselSuperior.style.borderBottom = '8px solid blue'; 
            }
            
        }
    });
});

