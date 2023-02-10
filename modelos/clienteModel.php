<?php

require_once "mainModel.php";

class clienteModel extends mainModel
{

    protected static function agregar_cliente($datos){
        $sql = mainModel::conectar()->prepare("INSERT INTO clientes(nombreCliente, apellidoCliente, numeroIdentificacion, idUnidadOrganizativa_unidadorganizativa) VALUES(:nombre, :apellido, :numeroId, :unidad)");

        $sql->bindParam(":nombre", $datos['nombre']);
        $sql->bindParam(":apellido", $datos['apellido']);
        $sql->bindParam(":numeroId", $datos['numeroId']);
        $sql->bindParam(":unidad", $datos['unidad']);
        $sql->execute();

        return $sql;
    }

    protected static function consultar_cliente(){
        $consulta = ("SELECT * FROM clientes");
        $sql = mainModel::ejecutar_consulta_simple($consulta);
        return $sql;
    }

    protected static function consultar_cliente_exist($datos){
        $consulta = ("SELECT * FROM clientes WHERE numeroIdentificacion = $datos");
        $sql = mainModel::ejecutar_consulta_simple($consulta);

        if($sql->rowCount()){
            $sql = true;
        }else{
            $sql = false;
        }

        return $sql;
    }

    protected static function busqueda_cliente($buscar){
        $consulta = ("SELECT * FROM clientes WHERE (idCliente LIKE '%$buscar%' OR nombreCliente LIKE '%$buscar%' OR apellidoCliente LIKE '%$buscar%' OR numeroIdentificacion LIKE '%$buscar%' OR idUnidadOrganizativa_unidadorganizativa LIKE '%$buscar%') ORDER BY nombreCliente ");

        $sql = mainModel::ejecutar_consulta_simple($consulta);
        return $sql;
    }
}
