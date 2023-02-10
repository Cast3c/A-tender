<?php

require_once "mainModel.php";

class configProducModelo extends mainModel
{

   #===================================================================#
   /*------   INICIO MODELO TIPO DE EMPAQUE     ------*/

   protected static function agregar_tipo_empaque($datos)
   {
      $sql = mainModel::conectar()->prepare("INSERT INTO tipoempaque(nombreEmpaque) VALUES (:nombre)");

      $sql->bindParam(":nombre", $datos['nombre']);
      $sql->execute();

      return $sql;
   }

   protected static function consultar_tipEmpaque()
   {
      $consulta = ("SELECT * FROM tipoempaque");
      $sql = mainModel::ejecutar_consulta_simple($consulta);
      return $sql;
   }

   protected static function consultar_tipEmpaque_exists($tipoEmpaque)
   {
      $consulta = ("SELECT * FROM tipoempaque WHERE nombreEmpaque='$tipoEmpaque'");
      $sql = mainModel::ejecutar_consulta_simple($consulta);
      if ($sql->rowCount()) {
         $sql == false;
      } else {
         $sql == true;
      }

      return $sql;
   }

   /*------   FIN MODELO TIPO DE EMPAQUE     ------*/
   #===================================================================#

   #===================================================================#
   /*------    INICIO MODELO PROVEEDOR     ------*/

   protected static function agregar_proveedor($datos)
   {
      $sql = mainModel::conectar()->prepare("INSERT INTO proveedores(nomProveedor, nitProveedor, nomContacto, telContacto, fechaCreacion, sucursal_idSucursal) VALUES (:nombre, :nit, :nomContacto, :telContacto, :fecha,:sucursal)");

      $fecha = date('Y-m-d');
      $sql->bindParam(":nombre", $datos['nombre']);
      $sql->bindParam(":nit", $datos['nit']);
      $sql->bindParam(":nomContacto", $datos['nomContacto']);
      $sql->bindParam(":telContacto", $datos['telContacto']);
      $sql->bindParam(":fecha", $fecha);
      $sql->bindParam(":sucursal", $datos['idSucursal']);
      $sql->execute();

      return $sql;
   }

   protected static function consultar_proveedor()
   {
      $consulta = ("SELECT * FROM proveedores");
      $sql = mainModel::ejecutar_consulta_simple($consulta);
      return $sql;
   }

   protected  static function consultar_proveedor_exists($proveedor)
   {
      $consulta = ("SELECT * FROM proveedores WHERE nitProveedor='$proveedor'");
      $sql = mainModel::ejecutar_consulta_simple($consulta);
      if ($sql->rowCount()) {
         $sql == false;
      } else {
         $sql == true;
      }

      return $sql;
   }

   protected static function agregar_proveedor_vendor($datos)
   {
      $sql = mainModel::conectar()->prepare("INSERT INTO vendedores(nombreVendedor, telefonoVendedor, proveedores_idProveedor) VALUES (:nombreVendor, :telVendor, :idProvee)");

      $sql->bindParam(":nombreVendor", $datos['nombreVendor']);
      $sql->bindParam(":telVendor", $datos['telVendor']);
      $sql->bindParam(":idProvee", $datos['idProvee']);
      $sql->execute();

      return $sql;
   }

   protected static function consultar_proveedor_vendor()
   {
      $consulta = ("SELECT * FROM vendedores");
      $sql = mainModel::ejecutar_consulta_simple($consulta);
      return $sql;
   }

   protected static function agregar_categoria_producto($datos){

      $sql= mainModel::conectar()->prepare("INSERT INTO categoria(nomCategoria) VALUES (:nombre)");

   
      $sql->bindParam(":nombre" ,$datos['nombreCategoria']);
      $sql-> execute();

      return $sql;
   }
   #===================================================================#   
}
