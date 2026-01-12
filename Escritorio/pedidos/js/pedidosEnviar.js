async function enviarForm_recuperarEstiloRadio() {

    await enviarForm();

  // Restaurar checkboxes do localStorage
  document.querySelectorAll('.input_num').forEach(checkbox => {
    const estadoSalvo = localStorage.getItem(checkbox.id);
    checkbox.checked = estadoSalvo === 'true';
  });

  // Buscar JSONs em paralelo
  const [dadosJsonP, dadosJsonPg, dadosJsonPe] = await Promise.all([
    carregarPedidosJson('pedidos'),
    carregarPedidosJson('pedidosjsonpg'),
    carregarPedidosJson('pedidosjsonpe')
  ]);

  // Unir todos os pedidos
  const dadosJson = { ...dadosJsonP, ...dadosJsonPg, ...dadosJsonPe };

  // Sincronizar tudo de uma vez
  sincronizarPedidosJson(dadosJson);
  
}


//envia via ajax o pedido para o php
async function enviarForm() {
    const formulario = document.getElementById('formulario');
    const formData = new FormData(formulario);

   await fetch('./phpScripts/pedidos_Pesquisados.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(html => {
        // Atualiza SOMENTE a div
        document.getElementById('phpmae').innerHTML = html;
    })
    .catch(error => {
        console.error('Erro:', error);
    });

    
}


// Restaura o estado dos radios ao carregar a página
window.addEventListener("load", async function() {

    enviarForm_recuperarEstiloRadio();
});