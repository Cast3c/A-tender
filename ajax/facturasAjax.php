<?php

$peticionAjax = true;

require_once "./config/APP.php";
require_once "../controladores/facturasControlador.php";

/*------ Intancia al controlador ------*/
$insta_facturas = new facturasControlador();
$value = "";
$value = $_GET['value'];
/*--------------------------------------*/

/*====== OPCIONES DE CONTROLADOR ======*/

if ($value == 1) {
    if (isset($_POST['factura'])) {
        echo $insta_facturas->agregar_factura_controlador();
    }
} else {
    # code...
}
