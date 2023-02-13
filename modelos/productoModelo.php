<?php

    require_once "mainModel.php";

    class productoModelo extends mainModel{

        /*------ Modelo agregar producto ------*/
        protected static function agregar_producto_modelo($datos){

            $sql = mainModel::conectar()->prepare("INSERT INTO productos(nomProducto, precioCosto, precioVenta, fechaCreacion, idEmpaque, proveedores_idproveedores, id_cat) VALUES (:nombre, :val_costo, :val_venta, :fecha, :empaque, :proveedor, :categoria)");

            $sql->bindParam(":nombre",$datos['nombre']);
            $sql->bindParam(":val_costo",$datos['val_costo']);
            $sql->bindParam(":val_venta",$datos['val_venta']);
            $sql->bindParam(":fecha",$datos['fecha']);
            $sql->bindParam(":empaque",$datos['empaque']);
            $sql->bindParam(":proveedor",$datos['proveedor']);
            $sql->bindParam(":categoria",$datos['categoria']);
            $sql->execute();

            return $sql;
        }

        /*--------- Lista producto ---------*/
        protected static function consultar_producto(){
            $consulta = ("SELECT * FROM lista_productos" );
            $sql= mainModel::ejecutar_consulta_simple($consulta);
            return $sql;
        }

        /*--------- busqueda de producto ---------*/
        protected static function busqueda_producto($buscar){
            $consulta = ("SELECT * FROM lista_productos WHERE (nomProducto LIKE '%$buscar$' OR idproductos LIKE '%$buscar%' OR precioVenta LIKE '%$buscar%' OR nombreEmpaque LIKE '%$buscar%' OR nomProveedor LIKE '%$buscar%') ORDER BY nomProducto");

            $sql = mainModel::ejecutar_consulta_simple($consulta);
            return $sql;
        }

        /*--------- categoria producto ---------*/
        protected static function lista_categorias(){
            $consulta = ("SELECT * FROM categoria");
            $sql = mainModel::ejecutar_consulta_simple($consulta);
            return $sql;
        }

    }