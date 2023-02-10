<?php

if ($peticionAjax) {
    require_once "../modelos/transacModel.php";
} else {
    require_once "./modelos/transacModel.php";
}

class transacControlador extends transacModel
{
    #===================================================================#
    /*========= CONTROLADOR TRNASACCIONES =========*/

    /*--------- controlador agregar transacciones ------*/
    public function agregar_transac()
    {

        $datos = $_POST['data'];

        /*--------- Almacenado de datos ---------*/

        $fecha       = $datos[4];
        $lineaVenta  = $datos[3];
        $producto    = $datos[0];
        $transaccion = $datos[2];
        $usuario     = $datos[5];
        $cantidad    = $datos[6];

        $fechaCheck       = mainModel::limpiar_cadena($fecha);
        $lineVentCheck    = mainModel::limpiar_cadena($lineaVenta);
        $productoCheck    = mainModel::limpiar_cadena($producto);
        $transaccionCheck = mainModel::limpiar_cadena($transaccion);
        $usuarioCheck     = mainModel::limpiar_cadena($usuario);
        $cantidadCheck    = mainModel::limpiar_cadena($cantidad);


        if ($fechaCheck == "" || $productoCheck == "" || $transaccionCheck == "" || $lineVentCheck == "" || $usuarioCheck == "" || $cantidadCheck == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se llenaron todos los campos del formulario",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $fechaDate = date('Y-m-d');
        $datos_transac = [
            "fecha" => $fechaDate,
            "lineaVenta" => $lineVentCheck,
            "producto" => $productoCheck,
            "usuario" => $usuarioCheck,
            "tipoTransaccion" => $transaccionCheck,
            "cantidad" => $cantidadCheck
        ];

        $addTransac = transacModel::agregar_transaccion($datos_transac);
        if ($addTransac->rowCount()) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Operacion exitosa",
                "Texto" => "La transaccion de se han guardado con exito ",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se pudo registrar el producto",
                "Tipo" => "error"
            ];
        }

        echo json_encode($alerta);
        //echo json_encode($fechaCheck);
    }
    /*--------------------------------------------------*/

    /*--------- controlador listar trasacciones --------- */
    public function listar_transac()
    {

        $lista_transac = transacModel::consultar_transacciones();
        $tabla = "";

        if ($lista_transac->rowCount()) {
            $tabla .= '
                    <div class="card-content">
                        <div class="content">
                            <table class="table table-dark">
                                <thead class="thead-dark">
                                    <tr>
                                        <th> # </th>
                                        <th> Codigo Transac</th>
                                        <th> Producto </th>
                                        <th> Transaccion </th>
                                        <th> Fecha </th>
                                        <th> Cantidad </th>
                                        <th> Usuario </th>
                                    </tr>
                                </thead>
                                <tbody>';
            $contador=1;
            foreach($lista_transac as $row){
                $tabla.= '
                                    <tr>
                                        <td>'.$contador.'</td>
                                        <td>'.$row['idtransacInventario'].'</td>
                                        <td>'.$row['nomProducto'].'</td>
                                        <td>'.$row['nombreTipoTransac'].'</td>
                                        <td>'.$row['fechaTransaccion'].'</td>
                                        <td>'.$row['cantUnidades'].'</td>
                                        <td>'.$row['NomUsuario'].'<td>
                                    </tr>                 
                ';
            }
            $tabla .= '
                                </tbody>
                            </table>
                        </div>
                    </div>            
            ';
        } else {
            $tabla.=
            '
                    <div class="card-content">
                        <div class="content">
                            <table class="table table-dark">
                                <thead class="thead-dark">
                                    <tr>
                                        <th> # </th>
                                        <th> Codigo Transac</th>
                                        <th> Producto </th>
                                        <th> Transaccion </th>
                                        <th> Fecha </th>
                                        <th> Cantidad </th>
                                        <th> Usuario </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>                
            ';
        }

        return $tabla;
    }
    /*----------------------------------------------------*/

}
