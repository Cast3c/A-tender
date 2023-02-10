<?php

    class vistasModelo{

        /*------ Modelo para obtene vistas ------*/
        protected static function obtener_vistas_Modelo($vistas){
            $listaBlanca=["home","new-user","new-product","new-transacciones","new-facturas","list-user","list-product","list-transacciones","list-cliente","updt-user","resum-cliente","config-cliente","config-produc","sales"];
            if(in_array($vistas, $listaBlanca)){
                if (is_file("./vistas/contenidos/".$vistas."-view.php")) {
                    $contenido="./vistas/contenidos/".$vistas."-view.php";
                } else {
                    $contenido="404";
                }
                
            } elseif($vistas=="login" || $vistas=="index"){
                $contenido="login";
            }else{
                $contenido="404";
            }
            return $contenido;
            
        }
    }