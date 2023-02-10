<?php

    require_once "mainModel.php";

    class usuarioModelo extends mainModel {

        /*------ Modelo agregar usuario ------*/
        protected static function agregar_usuario_modelo($datos){
            /*$sql=$datos;*/
            $sql = mainModel::conectar()->prepare("INSERT INTO usuarios (NomUsuario,ApellidoUsuario,NumDocumento,passUsuario,sucursal_idSucursal,rol_idRol)
            VALUES (:nombre,:apellido,:documento,:pass,:sucursal,:rol)");
            
            $sql->bindParam(":nombre",$datos['nombre']);
            $sql->bindParam(":apellido",$datos['apellido']);
            $sql->bindParam(":documento",$datos['documento']);
            $sql->bindParam(":pass",$datos['pass']);
            $sql->bindParam(":sucursal",$datos['sucursal']);
            $sql->bindParam(":rol",$datos['rol']);
            $sql->execute();

            return $sql;
        }

        protected static function verificar_existencia_documento($datos){
            $doc=mainModel::conectar()->prepare(
                " SELECT * FROM usuarios WHERE NumDocumento = '$datos'"
            );
            if($doc->rowCount()==0){
                $doc=false;
            }else{
                $doc=true;
            }
            return $doc;
        }
        
        protected static function verifica_exixtencia_correo($correo){
            $mail= mainModel::conectar()->prepare(
                " SELECT * FROM usuarios WHERE usu_mail = '$correo'"
            );
            if ($mail->rowCount()>0) {
                $mail == false;
            }else {
                $mail == true;
            }
        }
        
    }