<?php

    function bnt($caminho , $caminho_img){
    ?>
        <button type="button" value="" class="botao" >
            <a href= <?php echo $caminho; ?> ><img class="itens" src="<?php echo $caminho_img; ?>"></a>
        </button>
    <?php        
    }

    function data($tipo, $texto_input , $nome){
    ?>
        <input name="<?php echo $nome ?>" class="input_cabecalho" type="<?php echo $tipo ?>" placeholder="<?php echo $texto_input ?>" >
    <?php        
    }

?>
