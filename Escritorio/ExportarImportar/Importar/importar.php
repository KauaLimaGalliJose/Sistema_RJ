<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../coroa.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
</head>
<body>
  
</body>
</html>
<?php 
//imports
include_once('./lerAquivos.php');
include_once('../../../conexao.php');

if (isset($_FILES['dadosImport']) && $_FILES['dadosImport']['error'] === UPLOAD_ERR_OK) {
  $arquivoTmp = $_FILES['dadosImport']['tmp_name'];

  move_uploaded_file($arquivoTmp,'./zipTemporarios/zipTemporario.zip');

  $zip = new ZipArchive;

  if($zip->open('./zipTemporarios/zipTemporario.zip') === TRUE){

    $extractTo = './zipTemporarios/pastas/';
    $zip->extractTo($extractTo);
    $zip->close();

    echo "Arquivos extraídos com sucesso!";?><br><?php
    unlink('./zipTemporarios/zipTemporario.zip');
  }

  ler_Salvar_csv('pedidosp',$conectar);
  ler_Salvar_csv('pedidospg',$conectar);
  ler_Salvar_csv('pedidospe',$conectar);

} else {
  echo 'Arquivo não enviado ou ocorreu um erro no upload.'; ?><br><?php
}

?>