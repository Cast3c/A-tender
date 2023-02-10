<?php 
    
    if($peticionAjax){
         require_once "../modelos/usuarioModelo.php";
    }else{
        require_once "./modelos/usuarioModelo.php";
    }

    class usuarioControlador extends usuarioModelo{


        /*------ Controlador agregar usuario ------*/
        public function agregar_usuario_controlador(){

            /*------ Almacenado de datos ------*/
            $nombre = mainModel::limpiar_cadena($_POST['nombre_usu_reg']);
            $apellido = mainModel::limpiar_cadena($_POST['apellido_usu_reg']);
            $documento = mainModel::limpiar_cadena($_POST['numero_doc_usu_reg']);
            $mail = mainModel::limpiar_cadena($_POST['mail_usu_reg']);
            $pass1 = mainModel::limpiar_cadena($_POST['pass1_usu_reg']);
            $pass2 = mainModel::limpiar_cadena($_POST['pass2_usu_reg']);
            $sucursal = mainModel::limpiar_cadena($_POST['sucursal_usu_reg']);
            $rol = mainModel::limpiar_cadena($_POST['rol_usu_reg']);
            /*$alerta=[
                "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>$nombre,
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();

            /*------ verificacion de campos obligatorios ------*/
            if ($nombre =="" || $apellido =="" || $documento=="" || $mail=="" || $pass1=="" || $pass2=="") {
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No se llenaron todos los campos del formulario",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
            
           
            /*------ verificacion de integridad de los datos ------*/
            if (mainModel::verificar_datos("[a-zA-ZñÑÁÉÍÓÚáéíóú]{1,90}",$nombre)) {
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El nombre no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
            if (mainModel::verificar_datos("[a-zA-ZñÑÁÉÍÓÚáéíóú]{1,90}",$apellido)) {
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El apellido no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if (mainModel::verificar_datos("[0-9]{6,20}",$documento)) {
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>$documento,
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
            /*if (mainModel::verificar_datos("[0-9.@a-zA-Z_-]{6,90}",$mail)) {
                $check_email = usuarioModelo::verifica_exixtencia_correo($mail);
                if(filter_var($mail,FILTER_VALIDATE_EMAIL)){
                    if ($check_email) {
                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrio un error inesperado",
                            "Texto"=>"Este correo ya se encuentra registrado",
                            "Tipo"=>"error"
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
                }else {
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"El correo electronico no coincide con el formato solicitado",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }*/
            if (mainModel::verificar_datos("[a-zA-Z0-9-+*$@.]{7,100}",$pass1) || 
                mainModel::verificar_datos("[a-zA-Z0-9-+*$@.]{7,100}",$pass2)) {
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El nombre no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
            if ($pass1 != $pass2) {
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"Las claves no coinciden",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else {
                $pass= mainModel::encryption($pass1);
            }
            /*if ($telefono!="") {
                if (mainModel::verificar_datos("pattern",$tel)) {
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"El telefono no coincide con el formato solicitado",
                        "Tipo"=>"Error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }*/
            $check_documento = usuarioModelo::verificar_existencia_documento($documento);
            if ($check_documento) {
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"Este numero de documento ya se encuentra regitrado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            $datos_usuario_reg = [
                 "nombre"=>$nombre,
                 "apellido"=>$apellido,
                 "documento"=>$documento,
                 "pass"=>$pass,
                 "sucursal"=>$sucursal,
                 "rol"=>$rol
            ];

            $agregar_usuario = usuarioModelo::agregar_usuario_modelo($datos_usuario_reg);
            /*echo $datos_usuario_reg;
            /*$is_empty= empty($agregar_usuario);*/
            
            if ($agregar_usuario->rowCount()) {
                $alerta=[
                    "Alerta"=>"limpiar",
                    "Titulo"=>"Operacion exitosa",
                    "Texto"=>"Los datos del nuevo usuario se han guardado con exito ",
                    "Tipo"=>"success"
                ];
            } else {
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No se pudo registrar el usuario",
                    "Tipo"=>"error"
                ];
                
            }
            echo json_encode($alerta);
            
        }/*------ Fin controlador ------*/

        /*------ Controlador paginar usuarios ------*/
        public function paginador_usuarios_controlador($pagina,$cant_registros,$rol,$id,$url,$busqueda){

            $pagina=mainModel::limpiar_cadena($pagina); 
            $cant_registros=mainModel::limpiar_cadena($cant_registros);
            $rol=mainModel::limpiar_cadena($rol);
            $id=mainModel::limpiar_cadena($id);

            $url=mainModel::limpiar_cadena($url);
            $url=SERVERURL.$url."/";

            $busqueda=mainModel::limpiar_cadena($busqueda);
            $tabla="";

            $pagina= (isset($pagina) && $pagina>0) ? (int) $pagina  : 1 ;
            $inicio= ($pagina>0) ? (($pagina*$cant_registros)-$cant_registros):0;
            
            if(isset($busqueda) && $busqueda!=""){
                $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM usuarios WHERE ((idUsuarios!='1' AND idUsuarios!=$id) AND(NumDocumento LIKE %$busqueda% OR ApellidoUsuario LIKE %$busqueda% ) ORDER BY NomUsuario ASC LIMIT $inicio,$cant_registros";
            } else {
                $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM usuarios WHERE idUsuarios!='1' AND idUsuarios!=$id ORDER BY NomUsuario ASC LIMIT $inicio,$cant_registros";
            }

            $conexion= mainModel::conectar();

            $datos = $conexion->query($consulta);
            $datos=$datos->fetchAll();

            $total=$conexion->query("SELECT FOUND_ROWS()");
            $total=(int) $total->fetchColumn();

            $Npaginas=ceil($total/$cant_registros);

            $tabla.= '<div class="content-box">
                <h1 class="title">Usuarios</h1>
                <div class="content-table">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th> # </th>
                                <th> Nombre</th>
                                <th> Apellidos </th>
                                <th> Numero de documento</th>
                                <th> Sucursal</th>
                                <th> Rol </th>
                                <th> Editar </th>
                                <th> Borrar</th>    
                            </tr>
                        </thead>
                        <tbody>';
            if($total>=1 && $pagina<=$Npaginas){
                $contador=$inicio+1;
                $reg_inicio=$inicio+1;
                foreach ($datos as $rows){
                    $tabla.='<tr class="text-center">
                                <td>'.$contador.'</td>
                                <td>'.$rows['NomUsuario'].'</td>
                                <td>'.$rows['ApellidoUsuario'].'</td>
                                <td>'.$rows['NumDocumento'].'</td>
                                <td>'.$rows['sucursal_idSucursal'].'</td>
                                <td>'.$rows['rol_idRol'].'</td>
                                <td><a href="'.SERVERURL.'updt-user/'.mainModel::encryption($rows['idUsuarios']).'" class"button"><i class="icon fa-regular fa-pen-to-square"></i></a></td>
                                <td><a href="" class"button"><i class="icon fa-solid fa-trash"></i></a></th>
                            </tr>';
                    $contador++;           
                }
                $reg_final=$contador-1;
            } else {
                if ($total>=1) {
                    $tabla.='<tr class=text-center><td colspan="4">
                    <a href="'.$url.'" class="button is-success">Recargar listado</a>
                    </td></tr>';
                } else {
                    $tabla.='<tr class=right><td colspan="6">No hay registros en la base de datos</td>
                        <td><a href=""><i class="icon fa-regular fa-pen-to-square"></i></a></td>
                        <td><a href="" class"button"><i class="icon fa-solid fa-trash"></i></a></th>
                        </tr>'; 
                }
            }
            $tabla.= '  </tbody>
                        <tfoot>
                        </tfoot>
                    </table>';
            if($total>=1){
                $tabla.='<p class="text-center">Mostrando usuario'.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
            }

        if ($total>=1 && $pagina<=$Npaginas) {

            $tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7 );
        }

            return $tabla;
        }/*------ fin controlador ------*/

    }