<?php

    require_once "./modelos/vistasModelo.php";

    class vistasControlador extends vistasModelo{
        
        /*------ Controlador para obtener plantilla de vista ------*/
        public function obtener_plantilla_controlador(){
            return require_once "./vistas/plantilla.php";
        }

        /*------ Controlador para obtener vistas ------*/
        public function obtener_vistas_controlador(){
            if (isset($_GET['vistas'])){
                $ruta=explode("/",$_GET['vistas']);
                $respuesta = vistasModelo::obtener_vistas_Modelo($ruta[0]);
            }else{
                $respuesta="login";
            }
            return $respuesta;
        }
    }