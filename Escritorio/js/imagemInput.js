export default function img_modelo(){
    const fileInput = document.getElementById('uploadimg');
    const mRainha = document.getElementById('modelo_rainha');
 
    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        
        if (file) {
            const reader = new FileReader();
            let preview =  document.getElementById('modelo2');

            reader.onload = function(event) {
                preview.src = event.target.result;
                preview.style.display = 'block'; // Mostra a imagem de pré-visualização
                mRainha.style.display = 'none'
            }

            reader.readAsDataURL(file); // Lê o arquivo como uma URL de dados
        }
    });
}