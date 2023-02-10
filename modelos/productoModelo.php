<?php

    require_once "mainModel.php";

    class productoModelo extends mainModel{

        /*------ Modelo agregar producto ------*/
        protected static function agregar_producto_modelo($datos){

            $sql = mainModel::conectar()->prepare("INSERT INTO productos(nomProducto, precioCosto, precioVenta, fechaCreacion, idEmpaque, idVendedor, proveedores_idproveedores) VALUES (:nombre, :val_costo, :val_venta, :fecha, :empaque, :vendedor, :proveedor)");

            $sql->bindParam(":nombre",$datos['nombre']);
            $sql->bindParam(":val_costo",$datos['val_costo']);
            $sql->bindParam(":val_venta",$datos['val_venta']);
            $sql->bindParam(":fecha",$datos['fecha']);
            $sql->bindParam(":empaque",$datos['empaque']);
            $sql->bindParam(":vendedor",$datos['vendedor']);
            $sql->bindParam(":proveedor",$datos['proveedor']);
            $sql->execute();

            return $sql;
        }

        protected static function consultar_producto(){
            $consulta = ("SELECT * FROM productos" );
            $sql= mainModel::ejecutar_consulta_simple($consulta);
            return $sql;
        }

        protected static function busqueda_producto($buscar){
            $consulta = ("SELECT * FROM lista_productos WHERE (nomProducto LIKE '%$buscar$' OR idproductos LIKE '%$buscar%' OR precioVenta LIKE '%$buscar%' OR nombreEmpaque LIKE '%$buscar%' OR nomProveedor LIKE '%$buscar%') ORDER BY nomProducto");

            $sql = mainModel::ejecutar_consulta_simple($consulta);
            return $sql;
        }

    }