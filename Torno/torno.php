<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../coroa.png" type="image/x-icon">
    <link rel="stylesheet" href="torno.css">
    <script src="torno.js" defer></script>
    <title>Torno</title>
</head>
<body>
<form id="formulario" method="POST" action="torno.php">
    <div id="cabecalho">
        <div id="cabecalho_menu">
            <div id="casa">
                <button type="button" value=""  class="botao" >
                <a href="../index.html"><img class="itens" src="../Escritorio/casa.png"></a>
                </button>
            </div>
                <select name="largura" id="larguraSelect">
                        <option value="todos">Todos</option>
                        <option value="2mm">2mm</option>
                        <option value="3mm">3mm</option>
                        <option value="4mm">4mm</option>
                        <option value="5mm">5mm</option>
                        <option value="6mm">6mm</option>
                        <option value="7mm">7mm</option>
                        <option value="8mm">8mm</option>
                        <option value="9mm">9mm</option>
                        <option value="10mm">10mm</option>
                </select>

                <div id="pesquisa">
                    <input id="pesquisaInput" type="text" oninput="this.value = this.value.toUpperCase();" placeholder="Número Pedido">
                </div>
                <button type="submit" id="enviar"><h1>Enviar</h1></button>
        </div>
    </div>
</form>
    <?php include_once('../conexao.php');?>
    <div id="phpmae">
        <div class="carrossel">
            <div class="carrosselSuperior">
                <img class="carrosselImg" src="../imagem/PF1-2025-04-21.png" alt="">
            </div>
            <div class="carrosselInferior">
                <label>Nueração</label>
            </div>
        </div>
        <div class="carrossel">
            <div class="carrosselSuperior">
                <img class="carrosselImg" src="../imagem/PF1-2025-04-21.png" alt="">
            </div>
            <div class="carrosselInferior">
                <label>Numeração</label>
            </div>
        </div>
        <div class="carrossel">
            <div class="carrosselSuperior">
                <img class="carrosselImg" src="../imagem/PF1-2025-04-21.png" alt="">
            </div>
            <div class="carrosselInferior">
                <label>Numeração</label>
            </div>
        </div>
        <div class="carrossel">
            <div class="carrosselSuperior">
                <img class="carrosselImg" src="../imagem/PF1-2025-04-21.png" alt="">
            </div>
            <div class="carrosselInferior">
                <label>Numeração</label>
            </div>
        </div>
        <div class="carrossel">
            <div class="carrosselSuperior">
                <img class="carrosselImg" src="../imagem/PF1-2025-04-21.png" alt="">
            </div>
            <div class="carrosselInferior">
                <label>Numeração</label>
            </div>
        </div>
        <div class="carrossel">
            <div class="carrosselSuperior">
                <img class="carrosselImg" src="../imagem/PF1-2025-04-21.png" alt="">
            </div>
            <div class="carrosselInferior">
                <label>Numeração</label>
            </div>
        </div>
        <div class="carrossel">
            <div class="carrosselSuperior">
                <img class="carrosselImg" src="../imagem/PF1-2025-04-21.png" alt="">
            </div>
            <div class="carrosselInferior">
                <label>Numeração</label>
            </div>
        </div>
        <div class="carrossel">
            <div class="carrosselSuperior">
                <img class="carrosselImg" src="../imagem/PF1-2025-04-21.png" alt="">
            </div>
            <div class="carrosselInferior">
                <label>Numeração</label>
            </div>
        </div>
        <div class="carrossel">
            <div class="carrosselSuperior">
                <img class="carrosselImg" src="../imagem/PF1-2025-04-21.png" alt="">
            </div>
            <div class="carrosselInferior">
                <label>Numeração</label>
            </div>
        </div>
        <div class="carrossel">
            <div class="carrosselSuperior">
                <img class="carrosselImg" src="../imagem/PF1-2025-04-21.png" alt="">
            </div>
            <div class="carrosselInferior">
                <label>Numeração</label>
            </div>
        </div>
        <div class="carrossel">
            <div class="carrosselSuperior">
                <img class="carrosselImg" src="../imagem/PF1-2025-04-21.png" alt="">
            </div>
            <div class="carrosselInferior">
                <label>Numeração</label>
            </div>
        </div>
        <div class="carrossel">
            <div class="carrosselSuperior">
                <img class="carrosselImg" src="../imagem/PF1-2025-04-21.png" alt="">
            </div>
            <div class="carrosselInferior">
                <label>Numeração</label>
            </div>
        </div>
        <div class="carrossel">
            <div class="carrosselSuperior">
                <img class="carrosselImg" src="../imagem/PF1-2025-04-21.png" alt="">
            </div>
            <div class="carrosselInferior">
                <label>Numeração</label>
            </div>
        </div>
        <div class="carrossel">
            <div class="carrosselSuperior">
                <img class="carrosselImg" src="../imagem/PF1-2025-04-21.png" alt="">
            </div>
            <div class="carrosselInferior">
                <label>Numeração</label>
            </div>
        </div>
        <div class="carrossel">
            <div class="carrosselSuperior">
                <img class="carrosselImg" src="../imagem/PF1-2025-04-21.png" alt="">
            </div>
            <div class="carrosselInferior">
                <label>Numeração</label>
            </div>
        </div>
        <div class="carrossel">
            <div class="carrosselSuperior">
                <img class="carrosselImg" src="../imagem/PF1-2025-04-21.png" alt="">
            </div>
            <div class="carrosselInferior">
                <label>Numeração</label>
            </div>
        </div>
        <div class="carrossel">
            <div class="carrosselSuperior">
                <img class="carrosselImg" src="../imagem/PF1-2025-04-21.png" alt="">
            </div>
            <div class="carrosselInferior">
                <label>Numeração</label>
            </div>
        </div>
        <div class="carrossel">
            <div class="carrosselSuperior">
                <img class="carrosselImg" src="../imagem/PF1-2025-04-21.png" alt="">
            </div>
            <div class="carrosselInferior">
                <label>Numeração</label>
            </div>
        </div>
    </div>
</body>
</html>
