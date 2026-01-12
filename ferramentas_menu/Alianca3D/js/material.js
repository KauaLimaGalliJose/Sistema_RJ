import * as THREE from 'three';

export function ouro_amarelo(){

    const material = new THREE.MeshStandardMaterial({
        
        metalness: 1,
        roughness: 0.12, // mais baixo = mais polido
        color: 0xd4af37, // dourado
        clearcoat: 1.0,  // camada extra de brilho
        clearcoatRoughness: 0.7,
    });

    return material;
}