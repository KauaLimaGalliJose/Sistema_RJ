<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../coroa.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
</head>
<style>
  body{
    background-color: azure;
}
*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    list-style: none;

}
main{
    display: flex;
    align-items: center;
    flex-direction: column;
}
#cabecalho{
    display: flex;
    align-items: center; 

    width: 100%;
    height: 85px;
    border: solid black 5px;
    border-bottom: solid rgb(0, 0, 0) 5px ;
    background-color: antiquewhite;
    overflow: auto; /* Garante que o menu não "quebre" */
    padding-left: 10px;
    padding-right: 10px;
    flex-direction: column;
}
#cabecalho_menu{
    display: flex;
    align-items: center;
    width: 100%;
    height: 100%;
}
.botao{
    background-color: antiquewhite;
    border: 0px;
    padding: 2px;
}
.botao:hover{
    transition: 0.5s;
    transform: scale(110%);
    background-color: rgb(247, 94, 94);
    border-radius: 10%;
}
.itens{
    width: 50px;
    height: 50px;
    margin-left: 19px;
    margin-right: 19px;
}
/* --------------------------------------- */ 
#conteudo{
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 88vb;
  background-color: azure ;
}
#mensagem{
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  width: 100%;
  height: 100%;
  background-color: azure ;
  font-size: 300%;
}
#pedidosPai{
  width: 100%;
  height: 100%;
  display: flex;
  align-items: flex-start;
  justify-content: space-evenly;
  border-radius: 10px;
  flex-direction: row;
  margin-top: 30px;

}
.pedidos{
  height: 100%;
  width: 33%;
  font-size: 70%;
  font-weight: 700;
  font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
  margin-left:15px;
  margin-right:15px ;
  padding: 20px;
  border: solid black 10px;
  border-radius: 30px;
  background-color: rgb(157, 188, 228);
}
</style>
<body>
<div id="cabecalho">
        <div id="cabecalho_menu">
            <div id="casa">
                <button type="button" value=""  class="botao" >
                <a href="../../PG2-Escritorio.php"><img class="itens" src="../../casa.png"></a>
                </button>
            </div>
        </div>
    </div>
    <div id="conteudo">
      <div id="mensagem">
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

            echo "&#9989;Arquivos extraídos com sucesso!";?><br><?php
            unlink('./zipTemporarios/zipTemporario.zip');
          }

          ?><div id="pedidosPai"><?php
              ?><div class="pedidos"><?php
                  ler_Salvar('pedidosp',$conectar);
              ?></div><?php

              ?><div class="pedidos"><?php
                  ler_Salvar('pedidospg',$conectar);
              ?></div><?php

              ?><div class="pedidos"><?php
                  ler_Salvar('pedidospe',$conectar);
              ?></div><?php
          ?></div><?php

        } else {
          echo  '&#10060;Ocorreu um erro no upload.'; ?><br><?php
        }

        ?>
      </div>
    </div>
</body>
</html>