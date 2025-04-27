<?php 
  $arquivo = $_FILES['dadosImport'];

  move_uploaded_file($_FILES['dadosImport']['tmp_name'],'./zipTemporarios/');
  
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename="' . basename($arquivo) . '"');
  header('Content-Length: ' . filesize($arquivo));
  flush(); // limpa o buffer

?>