<?php

if ($peticionAjax) {
    require_once "../modelos/facturasModel.php";
} else {
    require_once "./modelos/facturasModel.php";
}

class facturasControlador extends facturasModel
{

    public function agregar_factura_controlador(){
        
        $fecha = date('Y-m-d');
        
        $datos = $_POST['factura'];
        $tkn = mainModel::generar_codigo_aleatorio("TKN","9", $fecha);

        /*------ ALmacenado de datos ------*/
        
        $valor    = $datos[7];
        $cliente  = $datos[6];
        $tipoFac  = $datos[5];
        $idSede   = $datos[4];
        $idVendor = $datos[3];
        $token    = $tkn;
        /*---------------------------------*/


        /*------ Procesos de seguridad  y validacion------*/
        $valor    = mainModel::limpiar_cadena($valor);
        $cliente  = mainModel::limpiar_cadena($cliente);
        $tipoFac  = mainModel::limpiar_cadena($tipoFac);
        $idSede   = mainModel::limpiar_cadena($idSede);
        $idVendor = mainModel::limpiar_cadena($idVendor);
        $token    = mainModel::limpiar_cadena($token);

        if ($valor== "" || $cliente=="" || $tipoFac=="" || $idSede=="" || $idVendor=="" || $token = "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se llenaron todos los datos de la factura",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        /*------------------------------------------------*/

        /*------ Operacion facturacion controlador ------*/
        $datos_factura = [
            "valor"     => $valor,
            "cliente"   => $cliente,
            "tipoFact"  => $tipoFac,
            "sede"      => $idSede,
            "usuario"   => $idVendor,
            "tokenFact" => $token
        ];
        
        $add_fact = facturasModel::agregar_factura($datos_factura);
        if ($add_fact->rowCount()) {
            return json_encode($token);
            exit();
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se pudo registrar la factura",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
        }
        /*-----------------------------------------------*/
        
    }


}