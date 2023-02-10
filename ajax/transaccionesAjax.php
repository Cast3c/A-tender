<?php

$peticionAjax = true;

require_once "../config/APP.php";
require_once "../controladores/transacControlador.php";

/*------ Instancia al controlador ------*/

$insta_transac = new transacControlador();
$value= $_GET['value'];


#========= agregar transacciones =========#
if($value==1){
    if (isset($_POST['data'])) {
        echo $insta_transac->agregar_transac();
    }else{
        
    }
}