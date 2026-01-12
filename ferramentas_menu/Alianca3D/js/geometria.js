import { STLLoader } from 'three/import/loaders/STLLoader.js';
import * as THREE from 'three';


export async function alianca_reta(cena, material) {
  const loader = new STLLoader();

  // Criar Promise para esperar o carregamento
  const geometry = await new Promise((resolve, reject) => {
    loader.load(
      '../../arquivos_Sistema/modelos3D/modelos_inicais/aliancaReta.stl',
      resolve,
      undefined,
      reject
    );
  });

  const mesh = new THREE.Mesh(geometry, material);
  mesh.rotation.x = -Math.PI / 2;
  mesh.castShadow = true;
  mesh.receiveShadow = true;
  cena.add(mesh);

  return mesh; // <- Agora sim a função retorna o objeto carregado
}