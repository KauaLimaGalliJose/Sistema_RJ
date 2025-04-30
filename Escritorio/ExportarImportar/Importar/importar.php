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

    echo "Arquivos extraídos com sucesso!";
    unlink('./zipTemporarios/zipTemporario.zip');
  }


} else {
  echo 'Arquivo não enviado ou ocorreu um erro no upload.';
}

ler_Salvar_csv('pedidosp',$conectar);
?>