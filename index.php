<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<style>
    /* Estilos base para todos os tamanhos */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

header, nav, main, footer {
  padding: 20px;
  text-align: center;
}

nav ul {
  list-style: none;
  padding: 0;
}

nav li {
  display: inline-block;
  margin: 0 10px;
}

/* Layout para telas pequenas (celulares) */
@media (max-width: 767px) {
  nav li {
    display: block;
    margin: 10px 0;
  }
}

/* Layout para telas maiores (desktops) */
@media (min-width: 768px) {
  nav li {
    margin: 0 20px;
  }

  main {
    display: flex;
    justify-content: center;
  }

  section {
    max-width: 800px;
    text-align: left;
  }
}

</style>

<body>

</body>
</html>