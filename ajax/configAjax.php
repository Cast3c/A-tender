<?php

$peticionAjax = true;

require_once "../config/APP.php";
require_once "../controladores/configProducControlador.php";
require_once "../controladores/configClienteControlador.php";
###=============================================###
###========= AJAX PARA CONFIGURACIONES =========###
###=============================================###


/*====== Instancias al controlador ======*/
$value = "";
$value= $_GET['value'];
$insta_config = new configProducControlador();
$insta_cliente = new configClienteControlador();
/*=======================================*/


###==========================================================###
###======######### SECCIONES DE CONFIGURACION #########======###

/*INCOMPLETO*/
###====== CONFIG PRODUCTOS ======###
/*------ Agregar tipo empaque masivo ------*/
if ($value==1) {
    if (isset($_FILES['fileEmpaq'])) {
        echo $insta_config->agregar_tipo_empaque_controladorMasivo(); 
    }else{
        header("Location:".SERVERURL."home/");
    }
/*------ Agregar tipo empaque simple ------*/   
}elseif ($value==2) {
    # code...
/*------ Agregar vendedor masivo ------*/     
}else if( $value==3){
    if(isset($_FILES['fileVende'])){
        
    }else{
        header("Location:".SERVERURL."home/");
    }
/*------ Agregar vendedor simple ------*/    
}elseif ($value==4) {
    # code...
    
/*------ Agregar proveedor masivo ------*/    
}else if( $value==5) {
    if (isset($_FILES['fileProvee'])) {
       echo $insta_config->agregar_proveedor_masivo_controlador(); 
    } else {
        header("Location:".SERVERURL."home/");
    }
/*------ Agregar proveedor simple ------*/ 
}else if ($value==6) {
    if(isset($_POST['nomVendor_reg'])){
        $insta_config->agregar_vendedor_proveedores_controlador();
    }else{
        header("Location:".SERVERURL."home/");
    }
}elseif ($value == 7) {
    if (isset($_POST['nombreCategoria'])) {
        $insta_config->agregar_categoria_produto_controlador();
    }else{
        header("Location:".SERVERURL."home/");
    }
###====== FIN CONFIG PRODUCTOS ======###
###==================================###

###====== CONFIG CLIENTES ======###
/*------ Agregar unidad organizativa masivo ------*/
}elseif ($value==8) {
    if (isset($_FILES['fileUnitOrgan'])) {
        echo $insta_cliente->agregar_unidad_organizativa_controlador_masivo();
    } else {
        header("Location:".SERVERURL."home/");
    }
/*------ Agregar unidad organizativa simple ------*/  
}elseif ($value==9) {
    if (isset($_POST['nombre_unidad_organizativa_reg'])){
        echo $insta_cliente->agregar_unidad_organizativa_simple_controlador();
    }else{
        header("Location:".SERVERURL."home/");
    }
}
else {
    session_start(['name' => 'Tapp']);
    session_unset();
    session_destroy();
    header("Location: " . SERVERURL . "login/");
    exit();
}

