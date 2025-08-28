<?php
//horario de brasilia
date_default_timezone_set('America/Sao_Paulo');

function Token(){
    // Token correto
    $senha = 3567;
    $data = date('H:i:s'); // Horas, minutos e segundos atuais
    $dataAtual = date('Y-m-d'); // Data atual no formato Y-m-d

    //split
    $dataSplit = explode(':', $data);
    $dataAtualSplit = explode('-', $dataAtual);


    $dataInteiro = (int)$dataSplit[0] + 2005 + 105;

    $conta = (($dataInteiro / 189) * (int)$dataSplit[0] * $senha);
    $token = ($conta / 4) * (int)$dataAtualSplit[0] * (int)$dataAtualSplit[1] * (int)$dataAtualSplit[2];

    $token_Final = substr((string)$token, 0, 4);
    
    return $token_Final;
}

function envia_Token() {
    // Verifica se o token foi enviado via POST
    $senha = 3567;
    $data = date('H:i:s'); // Horas, minutos e segundos atuais
    $dataAtual = date('Y-m-d'); // Data atual no formato Y-m-d

    //split
    $dataSplit = explode(':', $data);
    $dataAtualSplit = explode('-', $dataAtual);

    $dataInteiro = (int)$dataSplit[0] + 2005 + 105;

    $conta = (($dataInteiro / 189) * (int)$dataSplit[0] * $senha);
    $token = ($conta / 4) * (int)$dataAtualSplit[0] * (int)$dataAtualSplit[1] * (int)$dataAtualSplit[2];

    $token_Final = substr((string)$token, 0, 4);
    
    return $token_Final . '-'. $data . '-' . $dataAtual;


}


function verifica_Token($codigo) {
    // Verifica se o token foi enviado via POST
    $codigoSplit = explode('-', $codigo);

    $horaAtual = $codigoSplit[1];
    $data = $codigoSplit[2]; 

    $senha = 3567;
    $dataSplit = explode(':', $data);
    $dataAtualSplit = explode('-', $horaAtual);

    $dataInteiro = (int)$dataSplit[0] + 2005 + 105;

    $conta = (($dataInteiro / 189) * (int)$dataSplit[0] * $senha);
    $token = ($conta / 4) * (int)$dataAtualSplit[0] * (int)$dataAtualSplit[1] * (int)$dataAtualSplit[2];

    $token_Final = substr((string)$token, 0, 4);
    
    return $token_Final;


}