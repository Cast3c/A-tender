<?php

if ($peticionAjax) {
    require_once "../modelos/configClienteModel.php";
} else {
    require_once "./modelos/configClienteModel.php";
}

class configClienteControlador extends configClienteModel
{
    #===================================================================#
    /*------ CONTROLADOR UNIDADES ORGANIZATIVAS ------*/

    /*------ Agregar unidades organizativas masivo ------*/
    public function agregar_unidad_organizativa_controlador_masivo()
    {

        $tipo = $_FILES['fileUnitOrgan']['type'];
        $tempNom = $_FILES['fileUnitOrgan']['tmp_name'];
        $lineas = file($tempNom);

        $i = 0;

        if ($tipo == "text/csv") {
            foreach ($lineas as $dato) {
                $cantidad_registros = count($lineas);
                $cantidad_registros_agregados = ($cantidad_registros - 1);

                if ($i != 0) {
                    $reg = explode(";", $dato);
                    $nombre   = !empty($reg[0]) ? ($reg[0]) : '';
                    $unidad = [
                        "nombre"   => $nombre
                    ];
                    $result = configClienteModel::agregar_unidad_organizativa($unidad);
                } else {
                    $i++;
                }
            }
            if ($result->rowCount()) {
                $alerta = [
                    "Alerta" => "limpiar",
                    "Titulo" => "Operacion exitosa",
                    "Texto" => "Se han cargado " . $cantidad_registros_agregados . " con exito",
                    "Tipo" => "success"
                ];
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error con el archivo",
                    "Texto"  => "El archivo no ha podido cargarse al sistema",
                    "Tipo"   => "error"
                ];
            }
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error con el archivo",
                "Texto"  => "El archivo no tiene el formato permitido",
                "Tipo"   => "error"
            ];
        }

        echo json_encode($alerta);
    }

    /*------ Agregar unidades organizativas simple ------*/
    public function agregar_unidad_organizativa_simple_controlador()
    {

        /*--- Almacenado de datos ---*/
        $nombreUnidad = mainModel::limpiar_cadena($_POST['nombre_unidad_organizativa_reg']);

        /*------ Verificacion de campos obligatorios ------*/
        if ($nombreUnidad == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se llenaron todos los campos del formulario",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if(mainModel::verificar_datos("[áéíóúñÑÁÉÍÓÚa-zA-Z ]{3,90}",$nombreUnidad)){
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El nombre no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*------ verificar existencia de tipo de empaque ------*/
        $unidadExist = configClienteModel::consultar_unidad_organizativa_exist($nombreUnidad);
        if ($unidadExist) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "Esta unidad organizativa ya se encuentra registrada",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*------ agregar tipo de empaque simple ------*/
        $nombreUnid = [
            "nombre" => $nombreUnidad
        ];

        $agregarUnidad = configClienteModel::agregar_unidad_organizativa($nombreUnid);
        if ($agregarUnidad->rowCount()) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Operacion exitosa",
                "Texto" => "Los datos de la nuevo unidad oragnizativa se han guardado con exito ",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se pudo registrar la unidad organizativa",
                "Tipo" => "error"
            ];
        }
        
        echo json_encode($alerta);
    }

    /*------ listar tabla unidades organizativas ------*/
    public function listar_unidad_organizativa_tabla_controlador()
    {
        $listaUnidadOrganizativa = configClienteModel::consultar_unidad_organizativa();
        
        $tabla = "";

        if ($listaUnidadOrganizativa->rowCount()) {
            $contador =1;
            foreach($listaUnidadOrganizativa as $row){
                $tabla.='
                            <tr>
                                <td>'.$contador.'</td>   
                                <td>'.$row['nombreUnidadOrganizativa'].'</td>
                            </tr>
                ';
                $contador++;
            }
        } else {
            $tabla.="
                <tr>
                    <td>No hay registros para mostrar</td>
                </tr>
            ";    
        }
        return $tabla;
        
    }

    /*------ Listar select unidades organizativas ------*/
    public function listar_unidad_organizativa_select_controlador()
    {
        $sel = configClienteModel::consultar_unidad_organizativa();

        $select = "";

        if ($sel->rowCount()) {

            foreach($sel as $row){
                $select .= "
                <option value=".$row['idUnidadOrganizativa'].">".$row['nombreUnidadOrganizativa']."</option>
            ";
            }
            
        } else {
            $select.="
                <option> No hay unidades registradas </option>
            ";
        }
        return $select;
    }
    /*------ FIN CONTROLADOR UNIDADES ORGANIZATIVAS ------*/
    #===================================================================#
}
