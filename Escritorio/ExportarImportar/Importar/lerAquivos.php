<?php 

function ler_Salvar_csv($tabela,$conectar){

    $arquivo = './zipTemporarios/pastas/csv/' . $tabela . '.csv';

    //Carcacter do Pedido
    $caracter = $tabela;
    $caractereMaiusculo = strtoupper($caracter[0]); // 'strtoupper' Pega o primeiro caractere e transforma em maiúsculo

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
            $datacsv = $linha[17];

            $result = $conectar->query(
                "SELECT *
                 FROM `$tabela` WHERE `$cabecalho[0]` <> 0 
                 AND data_digitada LIKE '$datacsv'
                 ORDER BY `$cabecalho[0]` ASC"
                );

            if($result->num_rows !== 0){

                while($verificador = mysqli_fetch_assoc($result)){

                    if($verificador['idpedidos'] !== $linha[1]){

                        print_r($linha[1]);

                        mysqli_query($conectar, "INSERT INTO `$tabela`
                        (`$cabecalho[0]`,`$cabecalho[1]`,`$cabecalho[2]`, `$cabecalho[3]`, `$cabecalho[4]`, `$cabecalho[5]`, `$cabecalho[6]`, `$cabecalho[7]`,`$cabecalho[8]`, `$cabecalho[9]`, `$cabecalho[10]`,`$cabecalho[11]`,`$cabecalho[12]`,`$cabecalho[13]`,`$cabecalho[14]`,`$cabecalho[15]`, `$cabecalho[16]`,`$cabecalho[17]`) 
                        VALUES ('$linha[0]','$linha[1]','$linha[2]', '$linha[3]', '$linha[4]', '$linha[5]', '$linha[6]', '$linha[7]','$linha[8]', '$linha[9]', '$linha[10]','$linha[11]' , '$linha[12]' ,'$linha[13]', '$linha[14]' , '$linha[15]' , '$linha[16]' , '$datacsv' )");
                    
                    }
                    else{
                        echo 'Já tem pedidos existentes';?><br><?php
                        break;
                    }
                }
            }
            else{
                echo ' Erro não há pedidos';?><br><?php
                break;
            }
            print('Arquivo Salvo com Sucesso!!');?><br><?php
            break;
        }

        unlink('./zipTemporarios/pastas/csv/' . $tabela . '.csv');
    }
    else{
        echo 'Falha sem pedidos ou arquivo danificado'; ?><br><?php
    }
}
?>