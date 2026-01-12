import * as THREE from 'three';


export function criando_camera(){

    //Criando a camera ------
    const camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 0.1, 1000 );
    
       // Definindo a posição da câmera
        camera.position.z = 0;
        camera.position.y = 0;

    return camera;
}

