<?php 

    $peticionAjax= true;

    require_once "../config/APP.php";

    if(isset($_POST['numero_doc_usu_reg'])){

       /*------ Instacia al controlador ------*/
       require_once "../controladores/usuarioControlador.php";
       $insta_usuario = new usuarioControlador();

       /*------ Agregar un usuario ------*/
       if (isset($_POST['numero_doc_usu_reg'])&& isset($_POST['nombre_usu_reg'])) {
            echo $insta_usuario->agregar_usuario_controlador();
       }
    } else {
        session_start(['name'=>'Tapp']);
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit();
        
    }
    