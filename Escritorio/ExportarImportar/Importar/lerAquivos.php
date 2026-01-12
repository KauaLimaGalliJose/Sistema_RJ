<?php 
include_once('./salvarArquivos.php');
function ler_Salvar($tabela,$imagem,$pdfs,$conectar){

    //variaveis
    $contador = 0;
    $arquivo = './zipTemporarios/pastas/csv/' . $tabela . '.csv';
    $i = 0;

    if (file_exists($arquivo)) {

        $enviarDados = fopen('./zipTemporarios/pastas/csv/' . $tabela . '.csv', 'r');

    } 
    else{
        $enviarDados = false ;
    }

    if ($enviarDados !== false) {
        
        $cabecalho = fgetcsv($enviarDados, 10000, ",");    

        while (($linha = fgetcsv($enviarDados, 10000, ",")) !== false) {
            // $linha é um array com os dados da linha do CSV
            
            //VARIAVEL PARA DATA PARA CONSULTA NO BANCO DE DADOS
            $datacsv = $linha[18];
            $contador++;

            $result = $conectar->query(
                "SELECT *
                 FROM `$tabela` WHERE `$cabecalho[0]` <> 0 
                 AND data_digitada LIKE '$datacsv'
                 ORDER BY `$cabecalho[0]` ASC"
                );
            $result2 = $conectar->query(
                "SELECT *
                 FROM `$tabela` WHERE `$cabecalho[0]` <> 0 
                 AND data_digitada LIKE '$datacsv'
                 ORDER BY `$cabecalho[0]` ASC"
                );

            while($verificador = mysqli_fetch_assoc($result)){

                $verificar[] = $verificador['idpedidos'];
                $verificarImagem[] = $verificador['imagem'];
                $verificarExpode = explode("-",$verificador['idpedidos']);
                $PedidosRepetidos[] = $verificarExpode[0];
                
            }
            if($repetidos = mysqli_fetch_assoc($result2)){

                $repetidosV = $repetidos['idpedidos'];
            }

            // Salva os Pedidos no Banco ------------------------
            mysqli_query($conectar, "INSERT IGNORE INTO `$tabela`
            (`$cabecalho[0]`,`$cabecalho[1]`,`$cabecalho[2]`, `$cabecalho[3]`, `$cabecalho[4]`, `$cabecalho[5]`, `$cabecalho[6]`, `$cabecalho[7]`,`$cabecalho[8]`, `$cabecalho[9]`, `$cabecalho[10]`,`$cabecalho[11]`,`$cabecalho[12]`,`$cabecalho[13]`,`$cabecalho[14]`,`$cabecalho[15]`, `$cabecalho[16]`,`$cabecalho[17]`,`$cabecalho[18]`) 
            VALUES ('$linha[0]','$linha[1]','$linha[2]', '$linha[3]', '$linha[4]', '$linha[5]', '$linha[6]', '$linha[7]','$linha[8]', '$linha[9]', '$linha[10]','$linha[11]' , '$linha[12]' ,'$linha[13]', '$linha[14]' , '$linha[15]' , '$linha[16]' , '$linha[17]', '$linha[18]' )");
            
            //Verifica os Duplicados -------------------------------
            if ($result->num_rows !== 0) {
                // Verifica as Informações do Banco de Dados
                if($contador === 1){
                    echo substr($repetidosV, 0, 2) . " Não Enviados (Duplicados):<br>";
                }
                while ($i < count($verificar)) {

                    if($verificar[$i] == $linha[1]){

                        print('&#10060;' .$PedidosRepetidos[$i] . '<br>' );     
                    }
                    else{

                        
                    }
                    $i++;
                }
            }
            else{
                if($contador === 1){
                    echo "&#9989; Todos pedidos enviados<br>";
                }
            }
           //-----------------------------------------------------------
        }
        //Imagens ------------------------------------------------------
        $origem = './zipTemporarios/pastas/' . $imagem . '/' ;
        $destino = '../../../arquivos_Sistema/imagem_pedidos/';

        moverArquivos($origem, $destino);

        //PDFs ------------------------------------------------------
        $origemPdf = './zipTemporarios/pastas/' . $pdfs . '/' ;
        $destinoPdf = '../../../arquivos_Sistema/PDFs/';

        moverArquivos($origemPdf, $destinoPdf);
            
        unlink($arquivo);
        apagarDiretorio('./zipTemporarios/pastas/'. $imagem );
        apagarDiretorio('./zipTemporarios/pastas/'. $pdfs );
        return;
    }
    else{
        echo '&#10060; Falha sem pedidos ou arquivo danificado'; ?><br><?php
        return;
    }
     // Enviando Imagens
     
}

?>