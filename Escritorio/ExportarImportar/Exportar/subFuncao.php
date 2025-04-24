<?php function imagemZip($zip, $P,$data_Digitada,$conectar){

    if($P === 'PF'){
        $imagem = $conectar->query(
            "SELECT imagem
             FROM `pedidosp` WHERE `contadorpf` <> 0 
             AND data_digitada LIKE '$data_Digitada'
             ORDER BY `contadorpf` ASC"
                );
    
        $zip->addEmptyDir('imagensPF');
    }
    
    if($P === 'PG'){
        $imagem = $conectar->query(
            "SELECT imagem
             FROM `pedidospg` WHERE `contadorpg` <> 0 
             AND data_digitada LIKE '$data_Digitada'
             ORDER BY `contadorpg` ASC"
                );
     
        $zip->addEmptyDir('imagensPG');
    }
    
    if($P === 'PE'){
        $imagem = $conectar->query(
            "SELECT imagem
             FROM `pedidospe` WHERE `contadorpe` <> 0 
             AND data_digitada LIKE '$data_Digitada'
             ORDER BY `contadorpe` ASC"
                );
        
        $zip->addEmptyDir('imagensPE');
    }

    while($dados = mysqli_fetch_assoc($imagem)){

        $img = $dados['imagem'];
        $zip->addFile('../../' . $img . '.png','imagens/' . $P);
        //echo $dados['imagem'];
        
    }
    
}

?>