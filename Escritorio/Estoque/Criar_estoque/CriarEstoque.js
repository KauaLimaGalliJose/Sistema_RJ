// Variveis globais
const fileInput = document.getElementById('InputImagem');
const formulario = document.getElementById('formulario');

// Evento para o input de arquivo Para pré-visualizar a imagem
fileInput.addEventListener('change', function() {
        const file = this.files[0];
        
        if (file) {
            const reader = new FileReader();
            let preview =  document.getElementById('preview');
            let inputImage =  document.querySelector('.custum-file-upload');
            let trocarImg =  document.getElementById('trocarImgDiv');

            reader.onload = function(event) {
                preview.src = event.target.result;
                preview.style.display = 'block'; // Mostra a imagem de pré-visualização
                inputImage.style.display = 'none'; // Esconde o input de upload
                trocarImg.style.display = 'block'; // Mostra o botão de trocar imagem
            }

            reader.readAsDataURL(file); // Lê o arquivo como uma URL de dados
        }
        if (!file) {
            reader.onload = function(event) {
                preview.src = event.target.result;
                preview.style.display = 'block'; // Mostra a imagem de pré-visualização
                inputImage.style.display = 'none'; // Esconde o input de upload
                trocarImg.style.display = 'block'; // Mostra o botão de trocar imagem
            }
        }
    });


formulario.addEventListener("submit", function(event) {

    //Variaveis dos Inputs
    let nome_Estoque = document.getElementById('nome_Estoque');
    let peso = document.getElementById('peso');
    let descricao_Estoque = document.getElementById('descricao_Estoque');
    let InputImagem = document.getElementById('InputImagem');
    let InputLabel = document.getElementById('labelImagem');

    if(!nome_Estoque.value || !descricao_Estoque.value || !InputImagem.value) {
        
        event.preventDefault(); // Impede o envio do formulário
        
        // Adiciona borda vermelha aos campos vazios
        if (!nome_Estoque.value || nome_Estoque.value.trim() === "") {
            nome_Estoque.style.border = "3px solid red";
        }
        if (!peso.value || peso.value.trim() === "") {
            peso.style.border = "3px solid red";
        }
        if (!descricao_Estoque.value || descricao_Estoque.value.trim() === "") {
            descricao_Estoque.style.border = "3px solid red";
        }
        if (!InputImagem.value) {
            InputLabel.style.border = "5px dashed red";
        }
        
        alert("Por favor, preencha todos os campos.");
        return;
    }
    else {
        
        // Remove a borda vermelha se os campos estiverem preenchidos
        nome_Estoque.style.border = "";
        descricao_Estoque.style.border = "";
        InputImagem.style.border = "";

        // Se todos os campos estiverem preenchidos, o formulário pode ser enviado
        formulario.submit();
    }

});
