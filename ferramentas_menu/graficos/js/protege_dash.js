import TubesCursor from "../js/bibliotecas/cursor.js"


// Adiciona favicon dinamicamente coroa.ico
(function() {
  let link = document.createElement('link');
  link.rel = 'shortcut icon';
  link.type = 'image/x-icon';
  link.href = '../../../Escritorio/Escritorio_img/coroa.ico'; 
  document.head.appendChild(link);
})();


/*
const app = TubesCursor(document.getElementById('canvas'), {
  tubes: {
    colors: ["#daa520"],
    lights: {
      intensity: 100,
      colors: ["#daa520"]
    }
  }
})

document.body.addEventListener('click', () => {
  const colors = randomColors(1)
  const lightsColors = randomColors(4)
  console.log(colors, lightsColors)
  app.tubes.setColors(colors)
  app.tubes.setLightsColors(lightsColors)
})

function randomColors (count) {
    return new Array(count)
        .fill(0)
        .map(() => "#" + Math.floor(Math.random() * 16777215).toString(16).padStart(6, '0'))
}
*/