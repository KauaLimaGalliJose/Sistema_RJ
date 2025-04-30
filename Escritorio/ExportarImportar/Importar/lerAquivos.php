<?php 

function ler_Salvar_csv($tabela,$conectar){

    $enviarDados = fopen('./zipTemporarios/pastas/csv/' . $tabela . '.csv', 'r');

    if ($enviarDados !== false) {
        
        $cabecalho = fgetcsv($enviarDados, 10000, ",");     
        print_r($cabecalho[0]);

        while (($linha = fgetcsv($enviarDados, 10000, ",")) !== false) {
            // $linha é um array com os dados da linha do CSV
         $dados = mysqli_query($conectar, "INSERT INTO `$tabela`
            (`$cabecalho[0]`,`$cabecalho[1]`,`$cabecalho[2]`, `$cabecalho[3]`, `$cabecalho[4]`, `$cabecalho[5]`, `$cabecalho[6]`, `$cabecalho[7]`,`$cabecalho[8]`, `$cabecalho[9]`, `$cabecalho[10]`,`$cabecalho[11]`,`$cabecalho[12]`,`$cabecalho[13]`,`$cabecalho[14]`,`$cabecalho[15]`, `$cabecalho[16]`,`$cabecalho[17]`) 
            VALUES ('$linha[0]','$linha[1]','$linha[2]', '$linha[3]', '$linha[4]', '$linha[5]', '$linha[6]', '$linha[7]','$linha[8]', '$linha[9]', '$linha[10]','$linha[11]' , '$linha[12]' ,'$linha[13]', '$linha[14]' , '$linha[15]' , '$linha[16]' , '$linha[17]' )");
        }
    }
}
?>