<?php

    require_once "mainModel.php";

    class loginModelo extends mainModel{
        
        /*------ Modelo iniciar sesion------*/
        protected static function iniciar_sesion_modelo($datos){
            $sql = mainModel::conectar()->prepare("SELECT * FROM usuarios WHERE NumDocumento= :documento
            AND passUsuario= :pass ");

            $sql->bindParam(":documento",$datos['documento']);
            $sql->bindParam(":pass",$datos['pass']);
            $sql->execute();

            return $sql;
        }
    }