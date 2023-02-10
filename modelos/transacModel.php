<?php

require_once "mainModel.php";

class transacModel extends mainModel{

    protected static function agregar_transaccion($datos){

        $sql = mainModel::conectar()->prepare("INSERT INTO transacinventario(fechaTransaccion, lineaVenta_idlineaVenta, productos_idproductos, Usuarios_idUsuarios,          tipoTransac_idtipoTransac, cantUnidades) VALUES (:fecha, :lineaVenta, :producto, :usuario, :tipoTransaccion, :cantidad)");

        $sql->bindParam(":fecha",$datos['fecha']);
        $sql->bindParam(":lineaVenta", $datos['lineaVenta']);
        $sql->bindParam(":producto",$datos['producto']);
        $sql->bindParam(":usuario",$datos['usuario']);
        $sql->bindParam(":tipoTransaccion",$datos['tipoTransaccion']);
        $sql->bindParam(":cantidad",$datos['cantidad']);
        $sql->execute();

        return $sql;
    }

    protected static function consultar_transacciones(){
        $consulta = ("SELECT * FROM movimientos_inventario");
        $sql = mainModel::ejecutar_consulta_simple($consulta);
        return $sql;
    }

}