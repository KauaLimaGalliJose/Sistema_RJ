
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Rainha Joias</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Pg1-inicial.css">
    <script src="Pg1-inicial.js" defer></script>
    <link rel="shortcut icon" href="../coroa.png" type="image/x-icon">
    
</head>
<body>
    <div>
        <header id="header">
            <div id="logo" name="logo">
                <div id="menu_de_cima">
                        <button id= "botao" title="Configuração" class="config" onclick="abrir()"></button>
                    <div id="div_config">
                        <div id="fechar">
                            <button id="fechar_b" onclick="fechar()"><img class='fechar' src="./img_menu/X.png" alt=""></button>
                        </div>
                        <div id="cor_P">Cor da Página</div>
                        <div id = 'temas'>
                            <form name="cor" class="div_config">
                                    <label for="tema_Escuro">
                                        <input type="radio" name="tema" onchange="tema_1()" id="tema_Escuro" value="t_c" > Tema Escuro
                                    </label>
                                    <label for="tema_Claro">
                                        <input type="radio" name="tema" onchange="tema_2()" id="tema_Claro" value="t_e" checked > Tema Claro
                                    </label>
                            </form>
                        </div>
                        <div id ="php" >
                            <a class="botaoconfig" href="conversor/conversor.html">Converter PDF</a>
                        </div>
                        <div class="div_deslogar"> 
                        <button id="btnDeslogar" onclick="deslogar()">
                            &lArr; 
                            <span>Desconectar</span>
                        </button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="Menu">
                <div id="Escritorio" class="Menu1">
                    <a class="B_menu" href="../Escritorio/PG2-Escritorio.php">Escritório</a>
                </div>
                </div>
            </div>
        </header>
        <main id="conteudo">
            <div id = "ferramentas">
                <div class="ferramenta" >
                    <a title="Acessar Drive" href="https://drive.google.com/drive/home"><img class="ferramenta_img" src="./img_menu/ferramentas_img/Drive.png" alt="Drive"></a>   
                    <label><h1>Drive</h1></label>
                </div>

                <div class="ferramenta" >
                    <a title="Acessar estatistica" href="../ferramentas_menu/graficos/php/protege_dash.php"><img class="ferramenta_img" src="./img_menu/ferramentas_img/growth.png" alt="3D"></a>   
                    <label><h1>Graficos</h1></label>
                </div>
            </div>
        </main>
            <div id="relogio">
                00:00:00        
            </div> 
        <footer>

        </footer>
    </div>
</body>
</html>