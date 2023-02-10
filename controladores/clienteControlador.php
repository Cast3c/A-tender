<?php

if ($peticionAjax) {
    require_once "../modelos/clienteModel.php";
} else {
    require_once "./modelos/clienteModel.php";
}

class clienteControlador extends clienteModel 
{
    public function agregar_clientes_masivo_controlador()
    {

        $tipo = $_FILES['fileCliente']['type'];
        $tempNom = $_FILES['fileCliente']['tmp_name'];
        $lineas = file($tempNom);

        $i = 0;
        if ($tipo == "text/csv") {
            foreach($lineas as $dato){
                $cantidad_registros = count($lineas);
                $cantidad_registros_agregados = ($cantidad_registros -1);

                if ($i != 0 ) {
                    $reg = explode(";", $dato);
                    $nombre   = !empty($reg[0]) ? ($reg[0]): '';
                    $apellido = !empty($reg[1]) ? ($reg[1]): '';
                    $numeroId = !empty($reg[2]) ? ($reg[2]): '';
                    $unidad   = !empty($reg[3]) ? ($reg[3]): '';
                    
                    $cliente = [
                        "nombre"   => $nombre,
                        "apellido" => $apellido,
                        "numeroId" => $numeroId,
                        "unidad"   => $unidad
                    ];
                    $result = clienteModel::agregar_cliente($cliente);
                }else{
                    $i++;
                }
            }
            if ($result ->rowCount()) {
                $alerta = [
                    "Alerta" => "limpiar",
                    "Titulo" => "Operacion exitosa",
                    "Texto" => "Se han cargado ".$cantidad_registros_agregados." clientes con exito",
                    "Tipo" => "success"
                ];
            }else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error con el archivo",
                    "Texto"  => "El archivo no ha podido cargarse al sistema",
                    "Tipo"   => "error"
                ];
            }

        }else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error con el archivo",
                "Texto"  => "El archivo no tiene el formato permitido",
                "Tipo"   => "error"
            ];
        }

      echo json_encode($alerta);  
    }

    public function agregar_cliente_simple_controlador(){
        
        /*------ Almacenado de datos ------*/
        $nomCliente = mainModel::limpiar_cadena($_POST['nom_client_reg']);
        $apellidoCliente = mainModel::limpiar_cadena($_POST['apell_client_reg']);
        $identificacionCliente = mainModel::limpiar_cadena($_POST['cc_cliente_reg']);
        $unidadOrganizativa = mainModel::limpiar_cadena($_POST['unidad_oranizativa_reg']);

        /*------  Verificado campos vacios ------*/
        if($nomCliente == "" || $apellidoCliente == "" || $identificacionCliente == "" || $unidadOrganizativa == "" ){
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se llenaron todos los campos del formulario",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*------ Verificar formato ------*/
        if(mainModel::verificar_datos("[a-zA-ZñÑÁÉÍÓÚáéíóú ]{1,90}",$nomCliente)){
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrio un error inesperado",
                "Texto"=>"El nombre no coincide con el formato solicitado",
                "Tipo"=>"error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        if (mainModel::verificar_datos("[a-zA-ZñÑÁÉÍÓÚáéíóú ]{1,90}",$apellidoCliente)) {
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrio un error inesperado",
                "Texto"=>"El apellido no coincide con el formato solicitado",
                "Tipo"=>"error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[0-9]{1,90}", $identificacionCliente)) {
            $alerta=[
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto"  => "El numero de identificacion no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
        }

        /*------ Verificar existencia del cliente ------*/ 
        $check_doc = clienteModel::consultar_cliente_exist($identificacionCliente);
        if($check_doc){
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => $check_doc,//"Este numero de documento ya se encuentra registrado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*------ Array datos cliente ------*/
        $datosCliente = [
            "nombre" => $nomCliente,
            "apellido" => $apellidoCliente,
            "numeroId" => $identificacionCliente,
            "unidad" => $unidadOrganizativa
        ];

        /*------ Agregar cliente a BD ------*/
        $agregarCliente = clienteModel::agregar_cliente($datosCliente);
        if ($agregarCliente->rowCount()) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Operacion exitosa",
                "Texto" => "El nuevo cliente se ha creado con exito",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se ha podiod crear el cliente",
                "Tipo" => "error"
            ];
        }

        echo json_encode($alerta);
    }  
    
    public function listar_clientes_tabla_controlador()
    {
        $listar_clientes = clienteModel::consultar_cliente();

        $tabla="";

        if ($listar_clientes->rowCount()) {
            $contador = 1;

            foreach($listar_clientes as $row) {
                $tabla.='
                    <tr>
                        <td>'.$contador.'</td>
                        <td>'.$row['nombreCliente'].' '.$row['apellidoCliente'].'</td>
                        <td>'.$row['numeroIdentificacion'].'</td>
                        <td>'.$row['idUnidadOrganizativa_unidadorganizativa'].'</td>
                    </tr>    
                ';
                $contador++;   
            }
            
        }else{
            $tabla.='
                <tr>
                    <td>No existen registros para mostrar</td>
                </tr>
            ';
        }
        return $tabla;
    }
    
    public function busqueda_clientes_instantanea_controlador()
    {
        /*------ Almacenado de datos ------*/
        $busqueda = mainModel::limpiar_cadena($_POST['busqueda']);
        /*---------------------------------*/

        /*------ consulta a bd ------*/ 
        $consulta = clienteModel::busqueda_cliente($busqueda);

        $resultado=[];
        if ($consulta->rowCount()) {
            while ($row = $consulta->fetch()) {
                $resultado[]= $row;
            }
            return json_encode($resultado);
        } else {
            $mensaje = "no hay reigistros para mostrar";
            return json_encode($mensaje);
        }

        //return json_encode($consulta);
        
    }

}
