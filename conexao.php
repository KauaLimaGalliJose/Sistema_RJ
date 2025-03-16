<?php
$servidor = "localhost"; 
$usuario = "root";
$senha = "";
$banco = "teste";
$porta = 3306; 


$conectar = new mysqli($servidor, $usuario, $senha, $banco, $porta);


if ($conectar->connect_error) {
    die("Falha na conexão: " . $conectar->connect_error);
}
echo "Conectado com sucesso: " . $usuario .PHP_EOL;
?>