<?php
    function pegar_tipo_pedidos($tabela , $conectar , $dataInput){

        $sql = "SELECT DISTINCT cliente FROM $tabela WHERE data_digitada >= ?";
        $stmt = $conectar->prepare($sql);
        $stmt->bind_param("s", $dataInput );
        $stmt->execute();
        $result = $stmt->get_result();

        while($dados = $result->fetch_assoc()){
            

            ?>
            <option id = "<?= $dados['cliente'] ?>" value='<?= $dados['cliente'] ?>' ><?= $dados['cliente'] ?></option>
            <?php
        }
    }

    function pegar_tipo_pedidos_Escritorio($tabela , $conectar){

        $sql = "SELECT DISTINCT cliente FROM $tabela                         
                    WHERE peso = '0.00' 
                    AND data_digitada >= DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 4 MONTH), '%Y-%m-01')
                    AND data_digitada <= CURDATE()";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        while($dados = $result->fetch_assoc()){
            

            ?>
            <option id = "<?= $dados['cliente'] ?>" value='<?= $dados['cliente'] ?>' ><?= $dados['cliente'] ?></option>
            <?php
        }
    }

?>