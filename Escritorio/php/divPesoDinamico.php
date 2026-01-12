<?php 
include_once('../../conexao.php');
require "../Peso/cadastrar_Peso.php";
use Peso\cadastrarPeso;

$peso_pf = new cadastrarPeso('PF', $conectar ,'');
$peso_pg = new cadastrarPeso('PG', $conectar ,'');
$peso_pe = new cadastrarPeso('PE', $conectar ,'');
$peso_pedidos = new cadastrarPeso('pedidos', $conectar ,'');

$peso_pf->peso_indefinido(''); 
$peso_pg->peso_indefinido(''); 
$peso_pe->peso_indefinido('');  
$peso_pe_Number = $peso_pedidos->peso_indefinido('echo');

echo $peso_pe_Number;
