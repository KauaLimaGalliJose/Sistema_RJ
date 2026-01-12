<?php
    include_once '../../../conexao.php';

    $cookie_l = $_COOKIE['acesso_grafico'] ?? '';

    if($cookie_l != "liberado"){

        header("Location: ../php/protege_dash.php");
    }

    //Puxando classes
    require "../php/ApresentarPedidos.php";
        
    use php\Pedidos_Quantidade;

    // variveis e classes
    $pedidos = new Pedidos_Quantidade();
    $pedidosG = new Pedidos_Quantidade();
    $pedidosE = new Pedidos_Quantidade();
    
?>
<?php 

    if ($_POST) {

       $login = $_POST['desconectar'] ?? 'conterct';

        if($login == 'desconect'){

            setcookie("acesso_grafico", "negado", time() + (24 * 60 * 60), "/");

            header("location:../../../");
        }

        $dataInicio = !empty($_POST['dataInicio']) ? new DateTime($_POST['dataInicio']) : (new DateTime())->modify('-30 days');
        $dataTermino = !empty($_POST['dataTermino']) ? new DateTime($_POST['dataTermino']) : new DateTime();
        $pedidos_input = $_POST['pedidos'] ?? 'Todos';
        $estoque = $_POST['estoque'] ?? 'Todos';
        $data_radio = $_POST['dataR'] ?? 'indefinido';

        if($data_radio == 'outro'){

            $dataInicio = $_POST['dataInicio'] ? new DateTime($_POST['dataInicio']) : new DateTime();
            $dataTermino = $_POST['dataTermino'] ? new DateTime($_POST['dataTermino']) : new DateTime();

        }
        elseif($data_radio == '30'){
            
            $dataInicio = (new DateTime())->modify('-30 days') ;
            $dataTermino = new DateTime();

        }
        elseif($data_radio == '90'){
            
            $dataInicio = (new DateTime())->modify('-90 days') ;
            $dataTermino = new DateTime();
        }
        elseif($data_radio == '180'){
            
            $dataInicio = (new DateTime())->modify('-180 days') ;
            $dataTermino = new DateTime();           
        }
        elseif($data_radio == '365'){
           
            $dataInicio = (new DateTime())->modify('-365 days') ;
            $dataTermino = new DateTime();            
        }

    } else {
        $dataInicio = (new DateTime())->modify('-30 days') ;
        $dataTermino = new DateTime();
        $pedidos_input = 'Todos';
        $estoque = 'Todos';

        $dataInicio->format('Y-m-d');
        $dataTermino->format('Y-m-d');
    }

    // Data pedidos
    $pedidos->setData_Inicio($dataInicio->format('Y-m-d'));
    $pedidosG->setData_Inicio($dataInicio->format('Y-m-d'));
    $pedidosE->setData_Inicio($dataInicio->format('Y-m-d'));
        
    $pedidos->setData_Termino($dataTermino->format('Y-m-d'));
    $pedidosG->setData_Termino($dataTermino->format('Y-m-d'));
    $pedidosE->setData_Termino($dataTermino->format('Y-m-d'));

    // Tipos de Pedidos
    $pedidos->setTipo("PF");
    $pedidosG->setTipo("PG");
    $pedidosE->setTipo("PE");

    //Tem ou não estoque
    $pedidos->setEstoque($estoque);
    $pedidosG->setEstoque($estoque);
    $pedidosE->setEstoque($estoque);

    //Montando SQL
    $pedidos->montar_sql();
    $pedidosG->montar_sql();
    $pedidosE->montar_sql();

    // Mostra quantidade pedidos e datas em um array
    $pedidosArray = $pedidos->mostrar_pedidos_por_data($conectar);
    $pedidosArrayG = $pedidosG->mostrar_pedidos_por_data($conectar);
    $pedidosArrayE = $pedidosE->mostrar_pedidos_por_data($conectar);

    
    ksort($pedidosArray);
    ksort($pedidosArrayG);
    ksort($pedidosArrayE);
    
    // juntando todos os arrays dos Pedidos
    $pedidosTotais_array = [$pedidosArray ,$pedidosArrayG , $pedidosArrayE];
    $final_array = [];

    foreach ($pedidosTotais_array as $arr) {

        foreach ($arr as $data => $valor) {
            $final_array[$data] = ($final_array[$data] ?? 0) + $valor;
        }
    }
    ksort($final_array);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="../../../scripts/importadosLocais/apexcharts.min.js" ></script>
    <script src="../js/graficos_js.js" ></script>

    <title>Painel</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">
<form id="formDashbord" method="post" action="./index.php">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion position-fixed top-0 start-0" id="accordionSidebar">


            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon ">
                    <img src="../../../scripts/imagem_global/cabecalho_img/coroa.ico" alt="Coroa" style="width: 50px; height: 50px;">
                
                </div>
                <div class="sidebar-brand-text mx-3">Painel<sup>RJ</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Painel</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Home -->
            <li class="nav-item">
                <a class="nav-link" href="../../../index.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Voltar</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Configurações</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="./index.php">Pedidos</a>
                        <a class="collapse-item" href="cards.html">Abastecer Material</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item mb-3">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                        aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-filter"></i>
                        <span>Filtrar</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Filtrar Dados:</h6>
    
                            <label class="collapse-item" ><b>Inicio</b>
                                <input name="dataInicio" value="<?=  $dataInicio->format('Y-m-d') ?>" type="date" class="form-control form-control-sm"  onchange="this.form.submit()"/>
                            </label>
    
                            <label class="collapse-item" ><b>Término</b>
                                <input name="dataTermino" value="<?=  $dataTermino->format('Y-m-d') ?>" type="date" class="form-control form-control-sm" onchange="this.form.submit()" />
                            </label>
    
    
                            <label class="collapse-item" ><b>Estoque</b>
                                <select name="estoque" class="w-80 form-control form-control-sm" onchange="this.form.submit()">
                                    <option>Todos</option>
                                    <?php
                                
                                    $estoqueTituloGe = $estoque ?? 'Todos';

                                        if( $estoqueTituloGe != 'Todos' ){

                                            $nomeEstoque = $estoque ;

                                            echo "<option class='font_blu' id = '$nomeEstoque' value='$nomeEstoque' selected>$nomeEstoque</option>";

                                            $estoqueTitulo = "SELECT nome FROM estoque WHERE nome <> '$nomeEstoque'";
                                            $conectarEstoque = mysqli_query($conectar, $estoqueTitulo);
                                        }
                                        else{
                                        
                                            $estoqueTitulo = "SELECT nome FROM estoque";
                                            $conectarEstoque = mysqli_query($conectar, $estoqueTitulo);
                                        }
                                        
                                        while ($linha = mysqli_fetch_assoc($conectarEstoque)) {

                                            $nome = $linha['nome'] ;
                                            echo "<option  id = '$nome' value='$nome'>$nome</option>";

                                        }
                                ?>
                                </select>
                            </label>
    
                        </div>
                    </div>
            </li>
            
            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button type="button" class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

                        <!-- Nav Item - Home -->
            <li class="nav-item d-flex align-items-center justify-content-center ">
                <button type="submit" class="btn bg-gradient-danger" name="desconectar" value="desconect"><strong style="color:aliceblue;"><i class="fas fa-sign-out-alt"></i></strong></button>
            </li>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style="overflow-x:auto; white-space:nowrap;">
                    
                    <button type="button" id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                        <div class="body">
                            <div class="tabs">
                                <input
                                <?php echo (isset($_POST['dataInicio']) && isset($_POST['dataTermino']) ) ? 'checked' : ''; ?>
                                value="outro"
                                name="dataR"
                                id="pg"
                                type="radio"
                                class="input"
                                onchange="this.form.submit()"
                                />
                                <label for="pg" class="label">Outro</label>
                                <input
                                <?php echo (isset($_POST['dataR']) && $_POST['dataR'] == '30') ? 'checked' : ''; ?>
                                value="30"
                                name="dataR"
                                id="pf"
                                type="radio"
                                class="input"
                                onchange="this.form.submit()"
                                />
                                <label for="pf" class="label">1 Mês</label>
                                <input
                                <?php echo (isset($_POST['dataR']) && $_POST['dataR'] == '90') ? 'checked' : ''; ?>
                                value="90"
                                name="dataR"
                                id="pf90"
                                type="radio"
                                class="input"
                                onchange="this.form.submit()"
                                />
                                <label for="pf90" class="label">3 Meses</label>
                                <input
                                <?php echo (isset($_POST['dataR']) && $_POST['dataR'] == '180') ? 'checked' : ''; ?>
                                value="180"
                                name="dataR"
                                id="pe"
                                type="radio"
                                class="input"
                                onchange="this.form.submit()"
                                />
                                <label for="pe" class="label">6 Meses</label>
                                <input
                                <?php echo (isset($_POST['dataR']) && $_POST['dataR'] == '365') ? 'checked' : ''; ?>
                                value="365"
                                name="dataR"
                                id="todos"
                                type="radio"
                                class="input"
                                onchange="this.form.submit()"
                                />
                                <label for="todos" class="label">1 ano</label>
                            </div>
                        </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="  text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Pares vendidos </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php

                                                        if($pedidos_input == "Todos"){

                                                            $totalPedidos = $pedidos->mostrar_pedidos_quantidade($conectar) + $pedidosG->mostrar_pedidos_quantidade($conectar) + $pedidosE->mostrar_pedidos_quantidade($conectar);
                                                            echo  $totalPedidos . " Pares";
                                                        }
                                                        elseif($pedidos_input == "PF" ){
                                                            
                                                            $totalPedidos = $pedidos->mostrar_pedidos_quantidade($conectar);
                                                            echo  $totalPedidos . " Pares";
                                                        }
                                                        elseif($pedidos_input == "PG" ){

                                                            $totalPedidos = $pedidosG->mostrar_pedidos_quantidade($conectar);
                                                            echo  $totalPedidos . " Pares";
                                                        }
                                                        elseif($pedidos_input == "PE" ){

                                                            $totalPedidos = $pedidosE->mostrar_pedidos_quantidade($conectar);
                                                            echo  $totalPedidos . " Pares";
                                                        }

                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-sort-amount-up-alt fa-2x text-gray-500"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Material usado</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php 
                                                    if($pedidos_input == "Todos"){

                                                        $totalPedidos = $pedidos->mostrar_quantidade_gravacao($conectar) + $pedidosG->mostrar_quantidade_gravacao($conectar) + $pedidosE->mostrar_quantidade_gravacao($conectar);
                                                        echo  $totalPedidos/2 . " Pares (" . $totalPedidos . " Unidades)";
                                                    }
                                                    elseif($pedidos_input == "PF" ){
                                                            
                                                        $totalPedidos = $pedidos->mostrar_quantidade_gravacao($conectar);
                                                        echo  $totalPedidos/2 . " Pares (" . $totalPedidos . " Unidades)";
                                                    }
                                                    elseif($pedidos_input == "PG" ){

                                                        $totalPedidos = $pedidosG->mostrar_quantidade_gravacao($conectar);
                                                        echo  $totalPedidos/2 . " Pares (" . $totalPedidos . " Unidades)";
                                                    }
                                                    elseif($pedidos_input == "PE" ){

                                                        $totalPedidos = $pedidosE->mostrar_quantidade_gravacao($conectar);
                                                        echo  $totalPedidos/2 . " Pares (" . $totalPedidos . " Unidades)";
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-ring fa-2x text-gray-500"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Numeração mais Vendida
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php 

                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-coins fa-2x text-gray-500"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold  text-uppercase mb-1">
                                                Mês passado</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php 

                                                    
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary mr-5">Vendas PF ,PG e PE</h6>

                                    
                                    <div class="dropdown no-arrow d-flex flex-row align-items-center">
                                        <div id = "div_vendas">
                                            <button type="button" class="btn btn-primary  ml-2 mr-4" id="reset_zoom">Resetar</button>
                                        </div>
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Baixar</div>
                                        <button type="button" class="dropdown-item" id="download_png">PNG</button>
                                        <button type="button" class="dropdown-item" id="download_csv">CSV</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <div id="grafico_Vendas" ></div>
                                        <?php 

                                        if($pedidos_input == "Todos"){

                                            ?>
                                                <script>
                                                    const dadosP = <?=  json_encode($pedidosArray); ?>;
                                                    const dadosG = <?=  json_encode($pedidosArrayG); ?>;
                                                    const dadosE = <?=  json_encode($pedidosArrayE); ?>;
                                                    
                                                    graficos_todos(dadosP,dadosG,dadosE , 'grafico_Vendas' , 'area' );
                                                </script>
                                            <?php
                                        }
                                        elseif($pedidos_input == "PF" ){
                                                            
                                            ?>
                                                <script>
                                                    const dadosP = <?=  json_encode($pedidosArray); ?>;
                                                    
                                                    graficos(dadosP , 'grafico_Vendas' , 'area');
                                                </script>
                                            <?php        
                                        }
                                        elseif($pedidos_input == "PG" ){
                                              
                                            ?>
                                                <script>
                                                    const dadosG = <?=  json_encode($pedidosArrayG); ?>;

                                                    graficos(dadosG , 'grafico_Vendas' , 'area' );
                                                </script>
                                            <?php          
                                        }
                                        elseif($pedidos_input == "PE" ){

                                            ?>
                                                <script>
                                                    const dadosE = <?=  json_encode($pedidosArrayE); ?>;

                                                    graficos(dadosE , 'grafico_Vendas' , 'area' );
                                                </script>
                                            <?php         
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Estoques</h6>
                                             
                                    <div class="dropdown no-arrow d-flex flex-row align-items-center">
                                        <div id = "div_vendas">
                                            <button type="button" class="btn btn-primary  ml-2 mr-4" id="reset_zoom_2">Resetar</button>
                                        </div>
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Baixar</div>
                                        <button type="button" class="dropdown-item" id="download_png_2">PNG</button>
                                        <button type="button" class="dropdown-item" id="download_csv_2">CSV</button>
                                        </div>
                                    </div>
                                </div>
                                    <div id="grafico_Pizza"></div>

                                        <?php 

                                            if($pedidos_input == "Todos"){

                                                $estoque_quatidade_Array = $pedidos->mostrar_peso_pedidos($conectar, "Quantidade");
                                                $estoque_quatidade_Array += $pedidosG->mostrar_peso_pedidos($conectar, "Quantidade");
                                                $estoque_quatidade_Array += $pedidosE->mostrar_peso_pedidos($conectar, "Quantidade");
                                            }
                                            elseif($pedidos_input == "PF" ){
                                                    
                                                $estoque_quatidade_Array = $pedidos->mostrar_peso_pedidos($conectar, "Quantidade");
                                            }
                                            elseif($pedidos_input == "PG" ){
                 $estoque_quatidade_Array = $pedidosG->mostrar_peso_pedidos($conectar, "Quantidade");
                                            }
                                            elseif($pedidos_input == "PE" ){

                                                $estoque_quatidade_Array = $pedidosE->mostrar_peso_pedidos($conectar, "Quantidade");
                                            }

                                        ?>

                                        <script>
                                                const arrayEstoque = <?= json_encode($estoque_quatidade_Array) ?>                                      
                                                 
                                                console.log(arrayEstoque);
                                                graficos_pizza(arrayEstoque , 'grafico_Pizza');
                                        </script>
                                </div>
                                <div class=" mb-4">
                                    <div class="card bg-gradient-blue shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">

                                                    <div class="text-sm font-weight-bold text-primary text-uppercase mb-1 row">

                                                        Recorde de Vendas  => 

                                                        <div class="mb-0 ml-2 font-weight-bold text-gray-800">
                                                            <?php
                                                                // Aqui uso uma funçao apenas por conta do array com todos os pedidos
                                                               $resul_total = $pedidos->mostrar_dia_maisVendidos($final_array);
                                                               $mais_vendidosSplit = explode("_",$resul_total);
                                                               $mais_data = explode("-",$mais_vendidosSplit[1]);


                                                               echo '<span class="text-danger">' . $mais_vendidosSplit[0] . "</span> - " . $mais_data[2] . '/' . $mais_data[1] . '/' . $mais_data[0];
                                                            ?>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-sort-amount-up-alt fa-2x text-gray-500"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                            </div>
                        </div>

                        <!-- Content Row -->
            <div class="row">

                    <!-- Area Chart -->
                <div class="col-xl-8 col-lg-7">
                        <div class="card shadow  mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary mr-5">Vendas Totais</h6>
                                
                            <div class="dropdown no-arrow d-flex flex-row align-items-center">
                               <div id = "div_vendas">
                                   <button type="button" class="btn btn-primary  ml-2 mr-4" id="reset_zoom_totais">Resetar</button>
                               </div>
                               <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                               </a>
                               <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                   aria-labelledby="dropdownMenuLink">
                                   <div class="dropdown-header">Baixar</div>
                                    <button type="button" class="dropdown-item" id="download_png_totais">PNG</button>
                                <button type="button" class="dropdown-item" id="download_csv_totais">CSV</button>
                               </div>
                            </div>
                        </div>
                            <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                    <div id="grafico_Vendas_totais" ></div>
                                    <?php 
                                    if($pedidos_input == "Todos"){
                                        ?>
                                            <script>
                                                const dados_juntos = <?= json_encode($final_array) ?>
                                                
                                                graficos_barra(dados_juntos, 'grafico_Vendas_totais' , 'bar' );
                                            </script>
                                        <?php
                                    }
                                    elseif($pedidos_input == "PF" ){
                                                        
                                        ?>
                                            <script>
                                                const dadosPg = <?=  json_encode($pedidosArray); ?>;
                                                
                                                graficos_barra(dadosP , 'grafico_Vendas_totais' , 'bar');
                                            </script>
                                        <?php        
                                    }
                                    elseif($pedidos_input == "PG" ){
                                          
                                        ?>
                                            <script>
                                                const dadosGg = <?=  json_encode($pedidosArrayG); ?>;
                                                graficos_barra(dadosG , 'grafico_Vendas_totais' , 'bar' );
                                            </script>
                                        <?php          
                                    }
                                    elseif($pedidos_input == "PE" ){
                                        ?>
                                            <script>
                                                const dadosEg = <?=  json_encode($pedidosArrayE); ?>;
                                                graficos_barra(dadosE , 'grafico_Vendas_totais' , 'bar' );
                                            </script>
                                        <?php         
                                    }
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card bg-gradient-blue shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                                        Fluxo de Vendas </div>
                                        
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
        
                                        ?>
                                        
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>   
        </div>
                    

                        

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.js"></script>
    
</form>
</body>

</html>