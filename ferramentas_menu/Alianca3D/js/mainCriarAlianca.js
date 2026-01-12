// bibliotecas
import * as THREE from 'three';
import { OrbitControls } from 'three/import/controls/OrbitControls.js';
 // arquivos js
import { ouro_amarelo } from './material.js';
import { alianca_reta } from './geometria.js';
import { criando_camera } from './camera.js';
import { renderizando } from './render.js';

async function iniciarCena() {
  
    const container = document.getElementById('div_conteudo_three');

    // Cena
    const cena = new THREE.Scene();
    cena.background = new THREE.Color(0xF0FFFF);

    // Camera
    const camera = criando_camera();

    // Render
    const renderer = renderizando(container);
    renderer.setClearColor(0xF0FFFF); // Cor de fundo

    // Luz


    // Adiciona geometria
    const material =  ouro_amarelo();
    const objeto3D = await alianca_reta(cena , material);


    // Loop de animação
    function animate() {
    requestAnimationFrame(animate);

        objeto3D.rotation.z += 0.01;
        //objeto3D.rotation.x = 0;
        //objeto3D.rotation.z = 0;
    renderer.render(cena, camera);
    }
    animate();
}

iniciarCena();