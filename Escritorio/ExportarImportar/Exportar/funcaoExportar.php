<?php
function htmlErro(){
?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Algo deu Errado</title>
        <style>
            body{
                background-color: azure;
            }
            .titulo{
                font-size: 400%;
                font-weight: 800;
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            }
            #tituloDiv{
                display: flex;
                align-items: center;
                justify-content:center;
                background-color: rgb(223, 127, 127);
                border: solid rgb(211, 55, 55) 8px;
                border-radius: 20px;
            }
            #textoDiv{
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 200%;
                margin-top: 5%;
            }
            #voltar{
                display: flex;
                align-items: center;
                justify-content: center;
                
            }
            .link{
                display: flex;
                align-items: center;
                justify-content: center;
                margin-top: 5%;
                background-color: rgb(55, 162, 211);
                width: 10%;
                border-radius: 30px;
                border: solid rgb(21, 92, 124) 6px;
                color: azure;
                font-size: 180%;
                font-weight: 600;
            }
            #dadosPost{
                display: flex;
                margin-top: 20%;
                font-size: 180%;
                font-weight: 600;
            }
        </style>
    </head>
    <body>
        <div id="tituloDiv">
            <Label class="titulo">Preencha Todos os campos !!</Label>
        </div>
        <div id="textoDiv">
            Ops! Você precisa preencher todos os campos antes de fazer o download. Por favor, revise os Campos.
        </div>
        <div id="voltar">
            <a class="link" href="../../PG2-Escritorio.php">Voltar</a>
        </div>
        <div id="dadosPost">
            
            <?php // Ative Caso Precise!!
             var_dump($_POST); ?>
        </div>
    </body>
    </html>
<?php 
    } 

    //Cria Um Documento .csv
function criarCsv($conectar, $data_Digitada, $tabela , $contador){
    
    $enviarDados = fopen('./csvTemporarios/' . $tabela . '-' . $data_Digitada. '.csv', 'w+');

     //Cria um cabecalho para indentificar cada dado
    $result = $conectar->query(
        "SELECT *
         FROM `$tabela` WHERE `$contador` <> 0 
         AND data_digitada LIKE '$data_Digitada'
         ORDER BY `$contador` ASC"
           );
    
    if ($result) {
        $colunas = array_keys($result->fetch_assoc());
        fputcsv($enviarDados, $colunas);
    }
    
    // Busca e escreve os dados Busca todos os Pedidos
    $result = $conectar->query(
        "SELECT *
         FROM `$tabela` WHERE `$contador` <> 0 
         AND data_digitada LIKE '$data_Digitada'
         ORDER BY `$contador` ASC"
            );

    while ($dadosPedidos = $result->fetch_assoc()) {
        fputcsv($enviarDados, $dadosPedidos);
    }

    fclose($enviarDados);
}

function zipar($data_Digitada){

    $titulo = 'Pedidos'. $data_Digitada .'.zip';
    $zip = new ZipArchive;

    $zip->open($titulo, ZipArchive::CREATE);
}