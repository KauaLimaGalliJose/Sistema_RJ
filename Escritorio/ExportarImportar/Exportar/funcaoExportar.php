<?php
function htmlErro(){
?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="../../coroa.ico" type="image/x-icon">
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
            <Label class="titulo">Preencha Corretamente Todos os campos !!</Label>
        </div>
        <div id="textoDiv">
            Ops! Você precisa preencher todos os campos antes de fazer o download. Por favor, revise os Campos.
        </div>
        <div id="voltar">
            <a class="link" href="../../PG2-Escritorio.php">Voltar</a>
        </div>
        <div id="dadosPost">
            
            <?php // Ative Caso Precise!!
             //var_dump($_POST); 
             ?>
             
        </div>
    </body>
    </html>
<?php 
} 

    //Cria Um Documento .csv
function criarCsv($conectar, $data_Digitada, $tabela , $contador){
    
    $enviarDados = fopen('./csvTemporarios/' . $tabela . '-' . $data_Digitada. '.csv', 'w');

     //Cria um cabecalho para indentificar cada dado
    $result = $conectar->query(
        "SELECT *
         FROM `$tabela` WHERE `$contador` <> 0 
         AND data_digitada LIKE '$data_Digitada'
         ORDER BY `$contador` ASC"
           );
    
    if ( $result->num_rows !== 0) {
        $colunas = array_keys($result->fetch_assoc());
        fputcsv($enviarDados, $colunas);
    }else{
         htmlErro();
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

function zipar($data_Digitada,$pf,$pg,$pe,$conectar){

    $titulo = './zipTemporarios/Pedidos-'. $data_Digitada .'.zip';
    $zip = new ZipArchive;

    $zip->open($titulo, ZipArchive::CREATE);
    $zip->addEmptyDir('csv');

    //Verificando arquivo csv
    if($pf === 'PF'){
        $csv = './csvTemporarios/pedidosp-'. $data_Digitada . '.csv';
        $zip->addFile($csv, 'csv/' . basename($csv));

        //Imagens e PDF  Para Zipar PF
        $imagem = $conectar->query(
            "SELECT imagem,pdf
             FROM `pedidosp` WHERE `contadorpf` <> 0 
             AND data_digitada LIKE '$data_Digitada'
             ORDER BY `contadorpf` ASC"
                );
    
        $zip->addEmptyDir('imagensPF');
        $zip->addEmptyDir('pdfs-PF');
        while($dados = mysqli_fetch_assoc($imagem)){

            $img = $dados['imagem'];
            $zip->addFile('../../' . $img ,'imagensPF/' . basename($img));
            
            $pdf = $dados['pdf'];
            $zip->addFile('../../' . $pdf ,'pdfs-PF/' . basename($pdf)); //esse basename serve para não deixar ir todo o caminho mais sim apenas o nome do arquivo , Não tira se não , não pega!!
        }
        
    }   
    if($pg === 'PG'){
        $csv = './csvTemporarios/pedidospg-'. $data_Digitada . '.csv';
        $zip->addFile($csv, 'csv/' . basename($csv));

        //Imagens e PDF  Para Zipar PG
        $imagem = $conectar->query(
            "SELECT imagem,pdf
             FROM `pedidospg` WHERE `contadorpg` <> 0 
             AND data_digitada LIKE '$data_Digitada'
             ORDER BY `contadorpg` ASC"
                );
     
        $zip->addEmptyDir('imagensPG');
        $zip->addEmptyDir('pdfs-PG');
        while($dados = mysqli_fetch_assoc($imagem)){

            $img = $dados['imagem'];
            $zip->addFile('../../' . $img ,'imagensPG/' . basename($img));

            $pdf = $dados['pdf'];
            $zip->addFile('../../' . $pdf ,'pdfs-PG/' .  basename($pdf));   
        }
    }
    if($pe === 'PE'){
        $csv = './csvTemporarios/pedidospe-'. $data_Digitada . '.csv';
        $zip->addFile($csv, 'csv/' . basename($csv));
        
        //Imagens e PDF Para Zipar PE
        $imagem = $conectar->query(
            "SELECT imagem,pdf
             FROM `pedidospe` WHERE `contadorpe` <> 0 
             AND data_digitada LIKE '$data_Digitada'
             ORDER BY `contadorpe` ASC"
                );
        
        $zip->addEmptyDir('imagensPE');
        $zip->addEmptyDir('pdfs-PE');
        while($dados = mysqli_fetch_assoc($imagem)){

            $img = $dados['imagem'];
            $zip->addFile('../../' . $img ,'imagensPE/' .basename($img));

            $pdf = $dados['pdf'];
            $zip->addFile('../../' . $pdf ,'pdfs-PE/' . basename($pdf));
        }
        
    }
    
    
    $zip->close();

    //Baixando Zip ---------------------------------------------------------------------
    $arquivo = './zipTemporarios/Pedidos-'. $data_Digitada .'.zip';
    if (file_exists($arquivo)) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($arquivo) . '"');
        header('Content-Length: ' . filesize($arquivo));
        flush(); // limpa o buffer
        readfile($arquivo); // envia o conteúdo do arquivo
        unlink($arquivo);// exclui

        //Excluindo Arquivos Csv ----------------------------------------------------------
        //PF 
        $arquivo = './csvTemporarios/pedidosp-'. $data_Digitada .'.csv';
        unlink($arquivo);
        //PG
        $arquivo = './csvTemporarios/pedidospg-'. $data_Digitada .'.csv';
        unlink($arquivo);
        //PE
        $arquivo = './csvTemporarios/pedidospe-'. $data_Digitada .'.csv';
        unlink($arquivo);
        exit;
    } 
    
}
