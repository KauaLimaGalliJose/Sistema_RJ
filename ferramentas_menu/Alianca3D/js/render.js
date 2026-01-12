import * as THREE from 'three';

export function renderizando(local){

    //Criando o renderizador -----
    const renderizador = new THREE.WebGLRenderer();

        // Definindo o tamanho do renderizador
        renderizador.setSize(local.clientWidth, local.clientHeight);
        
        // Adicionando o renderizador ao corpo do documento HTML
        local.appendChild(renderizador.domElement);

    return renderizador;
}