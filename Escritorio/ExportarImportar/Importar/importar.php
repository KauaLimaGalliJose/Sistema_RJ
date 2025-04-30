<?php 
if (isset($_FILES['dadosImport']) && $_FILES['dadosImport']['error'] === UPLOAD_ERR_OK) {
  $arquivoTmp = $_FILES['dadosImport']['tmp_name'];

  move_uploaded_file($arquivoTmp,'./zipTemporarios/zipTemporario.zip');
  echo 'Enviado';

  $zip = new ZipArchive;

  if($zip->open('./zipTemporarios/zipTemporario.zip') === TRUE){
    echo ' Aberto Com sucesso';

    $extractTo = './zipTemporarios/pastas/';
    $zip->extractTo($extractTo);
    $zip->close();
    echo "Arquivos extraídos com sucesso!";
  }

} else {
  echo 'Arquivo não enviado ou ocorreu um erro no upload.';
}

?>