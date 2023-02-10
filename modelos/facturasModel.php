<?php

require_once "./modelos/mainModel.php";

class facturasModel extends mainModel
{
    protected static function agregar_factura($datos){
        $sql = mainModel::conectar()->prepare("INSERT INTO facturas(fechaFactura, valorFactura, idCliente, idTipoFactura, idUnidOrganizativa, idUsuario, tokenFact) VALUES (:fecha, :valor, :cliente, :tipoFactura, :idSede, :vendedor, :token)");

        $fecha = date('Y-m-d');

        $sql-> bindParam(":fecha",$fecha);
        $sql-> bindParam(":valor", $datos['valor']);
        $sql-> bindParam(":cliente", $datos['cliente']);
        $sql-> bindParam(":tipoFactura", $datos['tipFact']);
        $sql-> bindParam(":idSede", $datos['sede']);
        $sql-> bindParam(":vendedor", $datos['usuario']);
        $sql-> bindParam(":token", $datos['tokenFact']);
        $sql->execute();

        return $sql;
    }  
}