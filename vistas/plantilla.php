<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./vistas/inc/head.php"; ?>
    <?php include "./vistas/inc/links.php" ?>
</head>

<body>
    <?php
    $peticionAjax = false;
    include_once "./controladores/vistasControlador.php";
    $IV = new vistasControlador();
    $vistas = $IV->obtener_vistas_controlador();

    if ($vistas == "login" || $vistas == "404") {
        require_once "./vistas/contenidos/" . $vistas . "-view.php";
    } else {
        session_start(['name'=>'Tapp']);
        
        $pag=explode("/", $_GET['vistas']);
        require_once "./controladores/loginControlador.php";
        $lc = new loginControlador();
        
        if(!isset($_SESSION['token_Tapp']) || !isset($_SESSION['id_Tapp'])){
            echo $lc->forzar_cierre_sesion_controlador();
            exit();
        }
    ?>
    <div class="page">
        <?php include "./vistas/inc/navbar.php" ?>

    <?php
    
        include $vistas;
    ?>
     </div>
    <?php  
    }
    ?>
    <?php 
    
    /* include "./vistas/inc/logout.php"; */
    
    include "./vistas/inc/script.php";
    
    ?>
</body>

</html>