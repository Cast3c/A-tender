<?php

require_once "mainModel.php";

class configClienteModel extends mainModel
{

    ###==================================================###
    ###====== INICIO MODELO UNIDADES ORGANIZATIVAS ======###

    /*------ Agregar unidad organizativa ------*/
    protected static function agregar_unidad_organizativa($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO unidadorganizativa (nombreUnidadOrganizativa) VALUES (:nombre)");

        $sql->bindParam(":nombre", $datos['nombre']);
        $sql->execute();

        return $sql;
    }
    /*------ Consultar unidad organizativa ------*/
    protected static function consultar_unidad_organizativa(){
        $consulta = ("SELECT * FROM unidadorganizativa");
        $sql = mainModel::ejecutar_consulta_simple($consulta);

        return $sql;
    }
    /*------ Consultar unidad organizativa exist ------*/
    protected static function consultar_unidad_organizativa_exist($nombre){
        $consulta = ("SELECT * FROM unidadorganizativa WHERE nombreUnidadOrganizativa='$nombre'");
        $sql = mainModel::ejecutar_consulta_simple($consulta);
      /*if($sql->rowCount()){
        $sql = false;
      }else{
        $sql = true; 
      }*/

      $sql = false;

      return $sql;
    }  
    ###====== FIN MODELO UNIDADES ORGANIZATIVAS ======###
}
