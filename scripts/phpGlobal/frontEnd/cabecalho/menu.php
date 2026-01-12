 <?php
// função sendo utilizada no 'SistemaPrivado\Torno\torno.php' 
// função sendo utilizada no 'SistemaPrivado\Escritorio\pedidos\pedidos.php' 
function menu_($caminho){

    
?>  
    <!DOCTYPE html>
    <link rel="stylesheet" href=" <?php echo $caminho . 'scripts/cssGlobal/cabecalho/menu/menu_conteiner.css'?>">
    <link rel="stylesheet" href=" <?php echo $caminho . 'scripts/cssGlobal/fonts/fonts.css' ?>">
    <link rel="stylesheet" href=" <?php echo $caminho . 'scripts/cssGlobal/fonts/fonts.css' ?>">
    <script src= <?php echo $caminho . 'scripts/jsGlobal/menu/menu.js' ?>  defer></script>
    <style>
        .menu {
        position: relative;
        width: 40px;
        height: 30px;
        cursor: pointer;
        display: block;
        margin-right: 20px;
        }

        .menu input {
        display: none;
        }

        .menu span {
        display: block;
        position: absolute;
        height: 4px;
        width: 100%;
        background: black;
        border-radius: 9px;
        opacity: 1;
        left: 0;
        transform: rotate(0deg);
        transition: .25s ease-in-out;
        }

        .menu span:nth-of-type(1) {
        top: 0px;
        transform-origin: left center;
        }

        .menu span:nth-of-type(2) {
        top: 50%;
        transform: translateY(-50%);
        transform-origin: left center;
        }

        .menu span:nth-of-type(3) {
        top: 100%;
        transform-origin: left center;
        transform: translateY(-100%);
        }

        .menu input:checked ~ span:nth-of-type(1) {
        transform: rotate(45deg);
        top: 0px;
        left: 5px;
        }

        .menu input:checked ~ span:nth-of-type(2) {
        width: 0%;
        opacity: 0;
        }

        .menu input:checked ~ span:nth-of-type(3) {
        transform: rotate(-45deg);
        top: 28px;
        left: 5px;
        }
    </style>
        <label class="menu" for="burger">
            <input type="checkbox" value="checked" name="menu_cabecalho"  id="burger" onclick="abrir_Menu()" >
            <span></span>
            <span></span>
            <span></span>
        </label>
<?php

} ?>

