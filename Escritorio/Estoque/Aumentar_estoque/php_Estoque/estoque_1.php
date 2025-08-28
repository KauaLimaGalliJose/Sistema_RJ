<?php 
    include_once '../../../../phpIndex/protege.php';
    proteger();

include_once('../../../../conexao.php');

//variaveis
$nome = $_POST['nome'];
$local = $_POST['local'];


if($local == 'polimento'){

    $puxar_dados = "SELECT * FROM reabastecer_estoque_polimento WHERE nome = '$nome'";
    $puxar_conect = $conectar->prepare($puxar_dados);
    $puxar_conect->execute();
    $result = $puxar_conect->get_result();

    if($linha = $result->fetch_assoc()){

        for ($i = 9; $i <= 35; $i++) {
            
            ${"n$i"} = $_POST['valores'][$i] + $linha[$i];

            // aparece no console
            //echo  ${"n$i"};
        }
    }
    $result->close();

    $sql_update = "UPDATE reabastecer_estoque_polimento SET `9` = ?, `10` = ?, `11` = ?, `12` = ?, `13` = ?, `14` = ?, `15` = ?, `16` = ?, `17` = ?, `18` = ?, `19` = ?,
    `20` = ?, `21` = ?, `22` = ?, `23` = ?, `24` = ?, `25` = ?, `26` = ?, `27` = ?, `28` = ?, `29` = ?, `30` = ?, `31` = ?, `32` = ?, `33` = ?, `34` = ?, `35` = ?  WHERE nome = ?";

    $stmt = $conectar->prepare($sql_update);
    $stmt->bind_param("ssssssssssssssssssssssssssss",$n9, $n10, $n11, $n12, $n13, $n14, $n15, $n16, $n17, $n18, $n19, $n20, $n21, $n22, $n23, $n24, $n25, $n26, $n27, $n28, $n29, $n30, $n31, $n32, $n33, $n34, $n35  , $nome);
    $stmt->execute();
    $stmt->close();
}
elseif($local == 'torno'){

    $puxar_dados = "SELECT * FROM reabastecer_estoque WHERE nome = '$nome'";
    $puxar_conect = $conectar->prepare($puxar_dados);
    $puxar_conect->execute();
    $result = $puxar_conect->get_result();

    if($linha = $result->fetch_assoc()){

        for ($i = 9; $i <= 35; $i++) {
            
            ${"n$i"} = $_POST['valores'][$i] + $linha[$i];

            // aparece no console
            //echo  ${"n$i"};
        }
    }   
    $result->close();

    $sql_update = "UPDATE reabastecer_estoque SET `9` = ?, `10` = ?, `11` = ?, `12` = ?, `13` = ?, `14` = ?, `15` = ?, `16` = ?, `17` = ?, `18` = ?, `19` = ?,
    `20` = ?, `21` = ?, `22` = ?, `23` = ?, `24` = ?, `25` = ?, `26` = ?, `27` = ?, `28` = ?, `29` = ?, `30` = ?, `31` = ?, `32` = ?, `33` = ?, `34` = ?, `35` = ?  WHERE nome = ?";

    $stmt = $conectar->prepare($sql_update);
    $stmt->bind_param("ssssssssssssssssssssssssssss",$n9, $n10, $n11, $n12, $n13, $n14, $n15, $n16, $n17, $n18, $n19, $n20, $n21, $n22, $n23, $n24, $n25, $n26, $n27, $n28, $n29, $n30, $n31, $n32, $n33, $n34, $n35  , $nome);
    $stmt->execute();
    $stmt->close();
}
else{
    echo "Erro__backend";
}

mysqli_close($conectar);
?>
