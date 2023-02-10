<?php

$peticionAjax  = true;

require_once "../config/APP.php";
require_once "../controladores/clienteControlador.php";

/*------ Intancia al controlador ------*/
$insta_cliente = new clienteControlador();
$value = "";
$value = $_GET['value'];
/*--------------------------------------*/



/*------ Opciones del controlador ------*/
/*====== Agregar cliente masivo ======*/
if($value==1){
    if (isset($_FILES['fileCliente'])) {
        echo $insta_cliente->agregar_clientes_masivo_controlador();
    }else{
        header("Location:".SERVERURL."home/");
    }
/*====== Agregar cliente simple ======*/    
}elseif ($value==2) {
    if(isset($_POST['nom_client_reg'])){
        echo $insta_cliente->agregar_cliente_simple_controlador();
    }else{
        header("Location:".SERVERURL."home/"); 
    }
/*====== Consultar cliente ======*/
}elseif ($value == 3) {
    if(isset($_POST['busqueda'])){
        echo $insta_cliente->busqueda_clientes_instantanea_controlador();
    }else {
        $mensaje ="no esta llegando";
    }
}
