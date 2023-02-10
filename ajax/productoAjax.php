<?php

$peticionAjax = true;

require_once "../config/APP.php";
require_once "../controladores/productoControlador.php";

/*------ Instancia al controlador ------*/
$insta_produc = new productoControlador();
$value = "";
$value= $_GET['value'];

if ($value==1){
    if(isset($_POST['nombre_product_reg'])){
        echo $insta_produc->agregar_producto_controlador();
    }else{
        header("Location:".SERVERURL."home/");
    }
}else if ($value==3) {
    if(isset($_POST['busqueda'])){
        echo $insta_produc->busqueda_productos_instantanea_controlador();   
    }else{
        $mensaje ="no esta llegando";
    }
}else if ($value==4) {
    if (isset($_FILES['fileProduct'])) {
        echo $insta_produc->agregar_producto_masivo_controlador();
    } else {
        header("Location:".SERVERURL."home/");
    }
}else{
    session_start(['name' => 'Tapp']);
    session_unset();
    session_destroy();
    header("Location: " . SERVERURL . "login/");
    exit();
}

