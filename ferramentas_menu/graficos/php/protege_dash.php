<?php



function verifica_senha($senha, $usuario, $cookie) {

    $usuario_atual = ['admin', 'kaua'];
    $senha_atual   = ['0000', '0000'];

    // Se já tiver cookie liberado
    if ($cookie == "liberado") {
        return true;
    }

    // Verifica se usuário existe
    $index_usuario = array_search($usuario, $usuario_atual);

    if ($index_usuario !== false) {
        // Pega a senha correta desse usuário
        $senha_correta = $senha_atual[$index_usuario];

        // Compara senha digitada com a correta
        if ($senha === $senha_correta) {

            // Detecta HTTPS automaticamente
            $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
                       || $_SERVER['SERVER_PORT'] == 443; // se está sendo acessado pelo dominio
                       

            // Define o cookie
            setcookie(
                "acesso_grafico",
                "liberado",
                [
                    'expires'  => time() + (7 * 24 * 60 * 60),
                    'path'     => '/',
                    'secure'   => $isHttps, // funciona local e produção
                    'httponly' => true,
                    'samesite' => 'Lax'
                ]
            );

            return true;
        }
    }

    return false;
}


    if($_POST){

        $chave = verifica_senha($_POST['log_senha'] , $_POST['log_name'] , '' );

        if($chave == true){

            header("Location: ../dasboard/index.php");
            
        }
        elseif($chave == false){
            
            $erro_login = "Senha ou Usuario Incorreto";
            
        }
    }
    else{

        $cookie_l = $_COOKIE['acesso_grafico'] ?? '';
    
            if($cookie_l == "liberado"){
    
                header("Location: ../dasboard/index.php");
                
            }
    }

    
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="../js/protege_dash.js" type="module" ></script>
    <link rel="stylesheet" href="../../../scripts/importadosLocais/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.2.0/css/line.css">


    <title>Login</title>
    <style>        

        body {
            margin: 0;
            min-height: 100vh;

            font-weight: 300;
            font-size: 15px;
            line-height: 1.7;
            color: #ffffff;

            overflow-x: hidden;

            display: flex;
            align-items: center;
            justify-content: center;

            background:
                radial-gradient(circle at 20% 25%, rgba(96, 154, 192, 0.53), transparent 45%),
                radial-gradient(circle at 80% 30%, rgba(33, 95, 165, 0.74), transparent 45%),
                radial-gradient(circle at 50% 80%, rgba(46, 124, 98, 0.6), transparent 45%),
                linear-gradient(135deg, #020617, #3ea16aff);
        }

        a {
            cursor: pointer;
            transition: all 200ms linear;
            text-decoration: none;
            margin-right: 10px;
        }
        a:hover {
            text-decoration: none;
        }
        .link {
        color: #ffffffff;
        }
        .link:hover {
        color: #ffffffff;
        }
        p {
        font-weight: 500;
        font-size: 14px;
        line-height: 1.7;
        }
        h4 {
        font-weight: 600;
        color: white;
        }
        h6 span{
        padding: 0 20px;
        text-transform: uppercase;
        font-weight: 700;
        }
        .section{
        position: relative;
        width: 100%;
        display: block;
        }
        .full-height{
        min-height: 100vh;
        }
        [type="checkbox"]:checked,
        [type="checkbox"]:not(:checked){
        position: absolute;
        left: -9999px;
        }
        .checkbox:checked + label,
        .checkbox:not(:checked) + label{
        position: relative;
        display: block;
        text-align: center;
        width: 60px;
        height: 16px;
        border-radius: 8px;
        padding: 0;
        margin: 10px auto;
        cursor: pointer;
        background-color: #ffffffff;
        }
        .checkbox:checked + label:before,
        .checkbox:not(:checked) + label:before{
        position: absolute;
        display: block;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        color: #ffffffff;
        background-color: #102770;
        content: '\eb4f';
        z-index: 20;
        top: -10px;
        left: -10px;
        line-height: 36px;
        text-align: center;
        font-size: 24px;
        transition: all 0.5s ease;
        }
        .checkbox:checked + label:before {
        transform: translateX(44px) rotate(-270deg);
        }


        .card-3d-wrap {
        position: relative;
        width: 440px;
        max-width: 100%;
        height: 400px;
        -webkit-transform-style: preserve-3d;
        transform-style: preserve-3d;
        perspective: 800px;
        margin-top: 60px;
        }
        .card-3d-wrapper {
        width: 100%;
        height: 100%;
        position:absolute;    
        top: 0;
        left: 0;  
        -webkit-transform-style: preserve-3d;
        transform-style: preserve-3d;
        transition: all 600ms ease-out; 
        }
        .card-front, .card-back {
        width: 100%;
        height: 100%;
        background-color: transparent;
        background-position: bottom center;
        background-repeat: no-repeat;
        background-size: 300%;
        position: absolute;
        border-radius: 6px;
        left: 0;
        top: 0;
        -webkit-transform-style: preserve-3d;
        transform-style: preserve-3d;
        -webkit-backface-visibility: hidden;
        -moz-backface-visibility: hidden;
        -o-backface-visibility: hidden;
        backface-visibility: hidden;
        }
        .card-back {
        transform: rotateY(180deg);
        }
        .checkbox:checked ~ .card-3d-wrap .card-3d-wrapper {
        transform: rotateY(180deg);
        }
        .center-wrap{
        position: absolute;
        width: 100%;
        padding: 0 35px;
        top: 50%;
        left: 0;
        transform: translate3d(0, -50%, 35px) perspective(100px);
        z-index: 20;
        display: block;
        }


        .form-group{ 
        position: relative;
        display: block;
            margin: 0;
            padding: 0;
        }
        .form-style {
        padding: 13px 20px;
        padding-left: 55px;
        height: 48px;
        width: 100%;
        font-weight: 500;
        border-radius: 4px;
        font-size: 14px;
        line-height: 22px;
        letter-spacing: 0.5px;
        outline: none;
        color: #c4c3ca;
        background-color: #1f2029;
        border: none;
        -webkit-transition: all 200ms linear;
        transition: all 200ms linear;
        box-shadow: 0 4px 8px 0 rgba(21,21,21,.2);
        }
        .form-style:focus,
        .form-style:active {
        border: none;
        outline: none;
        box-shadow: 0 4px 8px 0 rgba(21,21,21,.2);
        }
        .input-icon {
        position: absolute;
        top: 0;
        left: 18px;
        height: 48px;
        font-size: 24px;
        line-height: 48px;
        text-align: left;
        color: #ffffffff;
        -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
        }

        .form-group input:-ms-input-placeholder  {
        color: #c4c3ca;
        opacity: 0.7;
        -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
        }
        .form-group input::-moz-placeholder  {
        color: #ffffffff;
        opacity: 0.7;
        -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
        }
        .form-group input:-moz-placeholder  {
        color: #ffffffff;
        opacity: 0.7;
        -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
        }
        .form-group input::-webkit-input-placeholder  {
        color: #ffffffff;
        opacity: 0.7;
        -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
        }
        .form-group input:focus:-ms-input-placeholder  {
        opacity: 0;
        -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
        }
        .form-group input:focus::-moz-placeholder  {
        opacity: 0;
        -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
        }
        .form-group input:focus:-moz-placeholder  {
        opacity: 0;
        -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
        }
        .form-group input:focus::-webkit-input-placeholder  {
        opacity: 0;
        -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
        }

        .btn{  
        border-radius: 4px;
        height: 44px;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        -webkit-transition : all 200ms linear;
        transition: all 200ms linear;
        padding: 0 30px;
        margin-left: 10px;
        margin-right: 10px;
        letter-spacing: 1px;
        display: -webkit-inline-flex;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -webkit-align-items: center;
        -moz-align-items: center;
        -ms-align-items: center;
        align-items: center;
        -webkit-justify-content: center;
        -moz-justify-content: center;
        -ms-justify-content: center;
        justify-content: center;
        -ms-flex-pack: center;
        text-align: center;
        border: none;
        background-color: #18658eff;
        color: #ffffffff;
        box-shadow: 0 8px 24px 0 rgba(255,235,167,.2);
        }
        .btn:active,
        .btn:focus{  
        background-color: #102770;
        color: #e9e9e9d5;
        box-shadow: 0 8px 24px 0 rgba(16,39,112,.2);
        }
        .btn:hover{  
        background-color: #102770;
        color: #ffffffff;
        box-shadow: 0 8px 24px 0 rgba(16,39,112,.2);
        }




        .logo {
            position: absolute;
            top: 30px;
            right: 30px;
            display: block;
            z-index: 100;
            transition: all 250ms linear;
        }
        .logo img {
            height: 26px;
            width: auto;
            display: block;
        }

        /*Estilo cursor */
        body, html, #app {
        margin: 0;
        width: 100%;
        height: 100%;
        }

        body {
        touch-action: none;
        }

        #app {
        height: 100%;
        }

        #app a {
        text-decoration: none;
        color: #fff;
        }

        .hero {
        position: relative;
        height: 500px;
        max-width: 80%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
         background: #2a2b38;
        border-radius: 20px;
        gap: 10px;
        }

        h1, h2, p {
        margin: 0;
        padding: 0;
        color: white;
        text-shadow: 0 0 20px rgba(0, 0, 0, 1);
        line-height: 100%;
        user-select: none;
        }

        h1 {
        font-size: 80px;
        font-weight: 700;
        text-transform: uppercase;
        }

        h2 {
        font-size: 60px;
        font-weight: 500;
        text-transform: uppercase;
        }

        #canvas {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        overflow: hidden;
        }

        .toggle-senha {
            position: absolute;
            right: 15px;
            top: 0;
            height: 48px;
            width: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #c4c3ca;
            transition: color 0.2s ease;
        }

        .toggle-senha:hover {
            color: #ffffff;
        }

        .toggle-senha svg {
            width: 22px;
            height: 22px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
        }

    </style>
</head>
<body>
        <!-- <div id="app"> <canvas id="canvas"></canvas> -->
        <div class="hero">
            <div class="section">
                <div class="container">
                    <form action="./protege_dash.php" method="post">
                    <div class="row full-height justify-content-center">
                        <div class="col-12 text-center align-self-center py-5">
                            <div class="section pb-5 pt-5 pt-sm-2 text-center">
                                <label for="reg-log"></label>
                                <div class="card-3d-wrap mx-auto">
                                    <div class="card-3d-wrapper">
                                        <div class="card-front">
                                            <div class="center-wrap">
                                                <div class="section text-center">
                                                    <h4 class="h1 mb-4 pb-3">Entrar</h4>
                                                    <label class="h6 fw-bold mb-3 text-danger "><?php echo  $erro_login ?? ''; ?></label>
                                                    <div class="form-group">
                                                        <input type="text" name="log_name" class="form-style" placeholder="Usuario" id="logemail" autocomplete="off">
                                                        <i class="input-icon uil uil-user"></i>
                                                    </div>	
                                                    <div class="form-group mt-2">
                                                        <input type="password" name="log_senha" class="form-style" placeholder="Senha" id="logpass" autocomplete="off">
                                                        <i class="input-icon uil uil-lock-alt"></i>

                                                        <!-- OLHO -->
                                                        <span class="toggle-senha" onclick="toggleSenha()">
                                                            <svg id="iconeOlho" viewBox="0 0 24 24">
                                                                <path d="M2 12s4-6 10-6 10 6 10 6-4 6-10 6-10-6-10-6z"/>
                                                                <circle cx="12" cy="12" r="3"/>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <a href="../../../index.php" >
                                                        <button type="button" class="btn mt-4 ">Voltar</button>
                                                    </a>
                                                    <button type="submit"  class="btn mt-4 ">Entrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
   <!-- </div> -->
</div>
</div>
    <script>
    function toggleSenha() {
        const input = document.getElementById('logpass');
        const olho = document.getElementById('iconeOlho');

        if (input.type === 'password') {
            input.type = 'text';
            olho.innerHTML = `
                <path d="M3 3l18 18"/>
                <path d="M2 12s4-6 10-6c1.6 0 3 .3 4.2.8"/>
                <path d="M22 12s-4 6-10 6c-1.6 0-3-.3-4.2-.8"/>
                <circle cx="12" cy="12" r="3"/>
            `;
        } else {
            input.type = 'password';
            olho.innerHTML = `
                <path d="M2 12s4-6 10-6 10 6 10 6-4 6-10 6-10-6-10-6z"/>
                <circle cx="12" cy="12" r="3"/>
            `;
        }
    }
    </script>
</body>
</html>