<?php 
    
    if($peticionAjax){
         require_once "../modelos/loginModelo.php";
    }else{
        require_once "./modelos/loginModelo.php";
    }

    class loginControlador extends loginModelo {

        /*------ controlador iniciar sesion ------*/
        public function iniciar_sesion_controlador(){
            $numeroDocumento= mainModel::limpiar_cadena($_POST['numero_documento']);
            $pass= mainModel::limpiar_cadena($_POST['usuPass']);

            /*------ comprobar campos vacios ------*/
            if ($numeroDocumento=="" || $pass== "") {
                echo' 
                <script>
                    Swal.fire({
                        title: "Ocurrio un error inesperado",
                        text: "No se han llenado todos los campos que son requeridos",
                        icon: "error",
                        confirmButtonText:"Aceptar" 
                    });
                </script>
                ';
            } 
            
            /*------ verificando integridad de datos ------*/
            if (mainModel::verificar_datos("[0-9]{6,20}",$numeroDocumento)) {
                echo 
                '<script>
                
                    Swal.fire({
                    title: "Ocurrio un error inesperado",
                    text: "El numero de documento no coinicide con el formato solicitado",
                    icon: "error",
                    confirmButtonText:"Aceptar" 
                  });
                </script>
                ';
                exit();
            }

            if (mainModel::verificar_datos("[a-zA-Z0-9-+*$@.]{7,100}",$pass)) {
                echo 
                '<script>

                    Swal.fire({
                    title: "Ocurrio un erro inesperado",
                    text: "La clave no coincide con el formato solicitado",
                    icon: "error",
                    confirmButtonText:"Aceptar" 
                  });
                </script>
                ';
                exit();
            }

            $passw= mainModel::encryption($pass);

            $datos_login=[
                "documento"=>$numeroDocumento,
                "pass"=>$passw
            ];

            $datos_cuenta = loginModelo::iniciar_sesion_modelo($datos_login);

            if ($datos_cuenta->rowCount()) {
                
                $row=$datos_cuenta->fetch();

                session_start(['name'=>'Tapp']);
                $_SESSION['id_Tapp']=$row['idUsuarios'];
                $_SESSION['nombre_Tapp']=$row['NomUsuario'];
                $_SESSION['apellido_Tapp']=$row['ApellidoUsuario'];
                $_SESSION['usuario_Tapp']=$row['NumDocumento'];
                $_SESSION['rol_Tapp']=$row['rol_idRol'];
                $_SESSION['token_Tapp']=md5(uniqid(mt_rand(),true));
                return header("Location: ".SERVERURL."home/");
                /*echo $_SESSION['token_Tapp'];*/
            } else {
                /*$echo= implode(";", $datos_login);*/
                echo
                '<script>

                    Swal.fire({
                        title: "Ocurrio un error inesperado",
                        text: "El usuario o clave son incorrectos",
                        icon: "error",
                        confirmButtonText:"Aceptar" 
                  });
                </script>
                ';
            } 

        }/*------ Fin controlador ------*/

        /*------ Controlador forzar cierre de sesion ------*/
        public function forzar_cierre_sesion_controlador(){
            session_unset();
            session_destroy();
            if(headers_sent()){
                return "<script> window.location.href='".SERVERURL."login/';</script>";
            }else{
                return header("Location: ".SERVERURL."login/");
            }
        }/*------ Fin controlador ------*/

        public function cerrar_sesion_controlador(){
            session_start(['name'=>'Tapp']);
            $token=mainModel::decryption($_POST['token']);
            $usuario= mainModel::decryption($_POST['usuario']);

            if ($token==$_SESSION['token_Tapp'] && $usuario==$_SESSION['usuario_Tapp']) {
                session_unset();
                session_destroy();
                $alerta=[
                    "Alerta"=>"redireccionar",
                    "URL"=>SERVERURL."login",
                ];
            } else {
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No se pudo cerrar la sesion",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }

    }