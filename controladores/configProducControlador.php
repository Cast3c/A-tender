<?php

if ($peticionAjax) {
    require_once "../modelos/configProducModel.php";
} else {
    require_once "./modelos/configProducModel.php";
}

class configProducControlador extends configProducModelo
{

    #===================================================================#
    /*------    CONTROLADOR TIPO DE EMPAQUE     ------*/

    /*------ controlador agregar empaque masivo------*/
    public function agregar_tipo_empaque_controladorMasivo()
    {

        /*------ almacenado de datos ------*/
        $tipo = $_FILES['fileEmpaq']['type'];
        $tamaño = $_FILES['fileEmpaq']['size'];
        $tempNom = $_FILES['fileEmpaq']['tmp_name'];
        $lineas = file($tempNom);

        /*------ registrando datos en BD ------*/
        $i = 0;
        foreach ($lineas as $dato) {
            $cantidad_registros = count($lineas);
            $cantidad_registros_agregados = ($cantidad_registros - 1);

            if ($i != 0) {
                $reg = explode(";", $dato);

                $nombre = !empty($reg[0]) ? ($reg[0]) : '';

                $tipEmpaq = [
                    "nombre" => $nombre
                ];

                $result = configProducModelo::agregar_tipo_empaque($tipEmpaq);
            } else {
                $i++;
            }
        }
        /*------ respuesta ------*/
        if ($result->rowCount()) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Operacion exitosa",
                "Texto" => "Los datos del nuevo usuario se han guardado con exito ",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se pudo registrar el usuario",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /*------ controlador listar tipo de empaque------*/
    public function listar_tipoempaque_controlador()
    {

        $lista_tipEmpaq = configProducModelo::consultar_tipEmpaque();
        $tabla = "";

        if ($lista_tipEmpaq->rowCount()) {
            $tabla .= '
                <div class="card-content">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr class="">
                                <th> # </th>
                                <th>Empaque</th>
                                <th>Editar</th>
                                <th>Borrar</th>
                            </tr>
                        </thead>
                        <tbody>';

            $contador = 1;

            foreach ($lista_tipEmpaq as $row) {
                $tabla .= '
                        <tr class="">
                            <td>' . $contador . '</td>
                            <td>' . $row['nombreEmpaque'] . '</td>
                            <td><a href="' . SERVERURL . 'updt-user/' . mainModel::encryption($row['idEmpaque']) . '" class"button"><i class="icon fa-regular fa-pen-to-square"></i></a></td>
                            <td><a href="" class"button"><i class="icon fa-solid fa-trash"></i></a></th>
                        </tr>';
                $contador++;
            }
            $tabla .= '
                        </tbody>
                    </table>
                </div>';
        }
        return $tabla;
    }

    /*------ controlador agregar empaque ------*/
    public function agregar_tipo_empaque_controlador()
    {

        /*------ Almacenado de datos ------*/
        $nombreEmpaque = mainModel::limpiar_cadena($_POST['nombre_empaque_reg']);

        /*------ Verificacion de campos obligatorios ------*/
        if ($nombreEmpaque = "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se llenaron todos los campos del formulario",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*------ verificacion de integridad de datos ------*/
        if (mainModel::verificar_datos("[a-zA-ZñÑÁÉÍÓÚáéíóú]{1,90}", $nombreEmpaque)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El nombre no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*------ verificar existencia de tipo de empaque ------*/
        $tipoEmpaExist = configProducModelo::consultar_tipEmpaque_exists($nombreEmpaque);
        if ($tipoEmpaExist) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "Este tipo de empaque ya se encuentra registrado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*------ agregar tipo de empaque simple ------*/
        $nombreEmpaq = [
            "nombre" => $nombreEmpaque
        ];

        $agregarTipoEmpaq = configProducModelo::agregar_tipo_empaque($nombreEmpaq);
        if ($agregarTipoEmpaq->rowCount()) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Operacion exitosa",
                "Texto" => "Los datos del nuevo usuario se han guardado con exito ",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se pudo registrar el usuario",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /*------ controlador select tipo de empaque ------*/
    public function listar_tipoEmpaq_select_controlador()
    {

        $sel = configProducModelo::consultar_tipEmpaque();

        $select = "";

        if ($sel->rowCount()) {
            $select .= '
                <select name="tipEmpaque_produc_reg" id="rol">
                    <option>Selecciona empaque</option>';
            foreach ($sel as $row) {
                $select .= ' 
                    <option value="' . $row['idEmpaque'] . '">' . $row['nombreEmpaque'] . '</option>';
            }
            $select .= '
                </select>';
        } else {
            $select .= '
                <select name="tipEmpaque_produc_reg" id="rol">
                    <option>No hay empaques registrados</option>
                </select>';
        }
        return $select;
    }

    /*------    FIN CONTROLADOR TIPO DE EMPAQUE     ------*/
    #===================================================================#

    #===================================================================#
    /*------    CONTROLADOR PROVEEDORES     ------*/

    /*------ controlador agregar proveedores masivo ------*/
    public function agregar_proveedor_masivo_controlador()
    {

        /*------Almacenado de datos------*/
        $tipo = $_FILES['fileProvee']['type'];
        $tamaño = $_FILES['fileProvee']['size'];
        $tempNom = $_FILES['fileProvee']['tmp_name'];
        $lineas = file($tempNom);


        /*------ registrando datos en BD ------*/
        $i = 0;
        foreach ($lineas as $dato) {
            $cantidad_registros = count($lineas);
            $cantidad_registros_agregados = ($cantidad_registros - 1);

            if ($i != 0) {
                $reg = explode(";", $dato);

                $nombre      = !empty($reg[0]) ? ($reg[0]) : '';
                $nit         = !empty($reg[1]) ? ($reg[1]) : '';
                $nomContacto = !empty($reg[2]) ? ($reg[2]) : '';
                $telContacto = !empty($reg[3]) ? ($reg[3]) : '';
                $idSucursal  = !empty($reg[5]) ? ($reg[5]) : '';

                $proveedores = [
                    "nombre" => $nombre,
                    "nit" => $nit,
                    "nomContacto" => $nomContacto,
                    "telContacto" => $telContacto,
                    "idSucursal" => $idSucursal
                ];

                $result = configProducModelo::agregar_proveedor($proveedores);
            } else {
                $i++;
            }
        }

        /*------ respuesta ------*/
        if ($result->rowCount()) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Operacion exitosa",
                "Texto" => "Los datos del nuevo usuario se han guardado con exito ",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se pudo registrar el usuario",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /*------ controlador agregar proveedor ------*/
    public function agregar_proveedor_controlador()
    {
    }
    
    /*------ controlador listar proveedores ------*/
    public function listar_proveedores_controlador()
    {
        $lista_proveedores = configProducModelo::consultar_proveedor();
        $tabla = "";

        if ($lista_proveedores->rowCount()) {
            $tabla .= '
                <div class="table-container">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr class="">
                                <th> # </th>
                                <th>Nombre</th>
                                <th>Editar</th>
                                <th>Borrar</th>
                            </tr>
                        </thead>
                        <tbody>';

            $contador = 1;

            foreach ($lista_proveedores as $row) {
                $tabla .= '
                        <tr class="">
                            <td>' . $contador . '</td>
                            <td>' . $row['nomProveedor'] . '</td>
                            <td><a href="' . SERVERURL . 'updt-user/' . mainModel::encryption($row['idproveedores']) . '" class"button"><i class="icon fa-regular fa-pen-to-square"></i></a></td>
                            <td><a href="" class"button"><i class="icon fa-solid fa-trash"></i></a></th>
                        </tr>';
                $contador++;
            }
            $tabla .= '
                        </tbody>
                    </table>
                </div>';
        } else {
            $tabla .= '
            <div class="card-content">
                <table class="table">
                    <thead class="thead-dark">
                        <tr class="">
                            <th> # </th>
                            <th>Nombre</th>
                            <th>Editar</th>
                            <th>Borrar</th>
                        </tr>
                    </thead>
                    <tbody>';
            $tabla .= '
                    <tr class="">
                        <td colspan="4"> No existen registros en el sistema</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>';
            $tabla .= '
                    </tbody>
                </table>
            </div>';
        }
        return $tabla;
    }

    /*------ controlador select proveedor ------*/
    public function listar_proveedor_select_controlador()
    {

        $sel = configProducModelo::consultar_proveedor();

        $select = "";

        if ($sel->rowCount()) {
            $select .= '
                <select name="proveedor_reg" id="proveedor">
                    <option>Selecciona el proveedor de tu producto</option>';
            foreach ($sel as $row) {
                $select .= ' 
                    <option value="' . $row['idproveedores'] . '">' . $row['nomProveedor'] . '</option>';
            }
            $select .= '
                </select>';
        } else {
            $select .= '
                <select name="proveedor_reg" id="proveedor">
                    <option>No hay proveedores registrados</option>
                    </select>';
        }

        return $select;
    }

    /*------ controlador agregar vendedor proveedores ------*/
    public function agregar_vendedor_proveedores_controlador()
    {

        /*------ Almacenado de datos ------*/
        $nombreVendor = mainModel::limpiar_cadena($_POST['nomVendor_reg']);
        $telVendor = mainModel::limpiar_cadena($_POST['telVendor_reg']);
        $idProveedor = mainModel::limpiar_cadena($_POST['proveedor_reg']);

        /*------ Verificacion de campos obligatorios ------*/
        if ($nombreVendor=="" || $telVendor=="" || $idProveedor =="") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se llenaron todos los campos del formulario",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*------ verificacion de integridad de datos ------*/
        if (mainModel::verificar_datos("[a-zA-ZñÑÁÉÍÓÚáéíóú]{4,90}", $nombreVendor))
        {
            $alerta=[
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" =>  "El nombre no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[0-9]{7,90}", $telVendor)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El telefono no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*------ agregar vendedor proveedores ------*/
        $vendedor=[
            "nombreVendor"=> $nombreVendor,
            "telVendor"   => $telVendor,
            "idProvee"    => $idProveedor
        ];

        $agregarVendedor = configProducModelo::agregar_proveedor_vendor($vendedor);
        if ($agregarVendedor->rowCount()) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Operacion exitosa",
                "Texto" => "Los datos del vendedor se han guardado con exito ",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se pudo registrar el vendedor",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /*------ controlador listar vendedores provvedor ------*/
    public function listar_vendors_provee_controlador()
    {
        $lista_vendedores = configProducModelo::consultar_proveedor_vendor();
        $tabla = "";

        if ($lista_vendedores->rowCount()) {
            $tabla .= '
                <div class="table-container">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr class="">
                                <th> # </th>
                                <th>Nombre</th>
                                <th>Editar</th>
                                <th>Borrar</th>
                            </tr>
                        </thead>
                        <tbody>';

            $contador = 1;

            foreach ($lista_vendedores as $row) {
                $tabla .= '
                        <tr class="">
                            <td>' . $contador . '</td>
                            <td>' . $row['nombreVendedor'] . '</td>
                            <td><a href="' . SERVERURL . 'updt-user/' . mainModel::encryption($row['idVendedor']) . '" class"button"><i class="icon fa-regular fa-pen-to-square"></i></a></td>
                            <td><a href="" class"button"><i class="icon fa-solid fa-trash"></i></a></th>
                        </tr>';
                $contador++;
            }
            $tabla .= '
                        </tbody>
                    </table>
                </div>';
        } else {
            $tabla .= '
            <div class="card-content">
                <table class="table">
                    <thead class="thead-dark">
                        <tr class="">
                            <th> # </th>
                            <th>Nombre</th>
                            <th>Editar</th>
                            <th>Borrar</th>
                        </tr>
                    </thead>
                    <tbody>';
            $tabla .= '
                    <tr class="">
                        <td colspan="4"> No existen registros en el sistema</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>';
            $tabla .= '
                    </tbody>
                </table>
            </div>';
        }
        return $tabla;
    }

    /*------ controlador listar vendor select proveedor ------*/
    public function listar_vendors_select_provee_controlador()
    {
        $sel = configProducModelo::consultar_proveedor_vendor();

        $select = "";

        if($sel->rowCount()){
            $select.='
                <select name="vendor_proveedor_reg" id="vendor_proveedor">
                    <option>Seleccional el vendedor de tu producto</option>';
            foreach($sel as $row){
                $select .='
                    <option value="'.$row['idVendedor'].'">'.$row['nombreVendedor'].'</option>;
                ';
            }
            $select.='
                </select>';
        }else{
            $select.='
                <select>
                    <option>No existen vendedores registrados</option>
                </select>
            ';
        }
        return $select;
    }

    /* ------ contolador agregar categoria producto ------ */
    public function agregar_categoria_produto_controlador()
    {
      /*------ Almacenado de datos ------*/
      $nombreCategoria = mainModel::limpiar_cadena($_POST['categoria']);

      /*------ Verificacion de campos obligatorios ------*/
      if ($nombreCategoria=="") {
          $alerta = [
              "Alerta" => "simple",
              "Titulo" => "Ocurrio un error inesperado",
              "Texto" => "No se llenaron todos los campos del formulario",
              "Tipo" => "error"
          ];
          echo json_encode($alerta);
          exit();
      }

      /*------ verificacion de integridad de datos ------*/
      if (mainModel::verificar_datos("[a-zA-ZñÑÁÉÍÓÚáéíóú]{4,90}", $nombreCategoria))
      {
          $alerta=[
              "Alerta" => "simple",
              "Titulo" => "Ocurrio un error inesperado",
              "Texto" =>  "El nombre no coincide con el formato solicitado",
              "Tipo" => "error"
          ];
          echo json_encode($alerta);
          exit();
      }

      /*------ agregar vendedor proveedores ------*/
      $categoria=[
          "nombreCategoria"=> $nombreCategoria,
      ];

      $agregarCategoria = configProducModelo::agregar_categoria_producto($categoria);
      if ($agregarCategoria->rowCount()) {
          $alerta = [
              "Alerta" => "limpiar",
              "Titulo" => "Operacion exitosa",
              "Texto" => "Los datos del vendedor se han guardado con exito ",
              "Tipo" => "success"
          ];
      } else {
          $alerta = [
              "Alerta" => "simple",
              "Titulo" => "Ocurrio un error inesperado",
              "Texto" => "No se pudo registrar el vendedor",
              "Tipo" => "error"
          ];
      }
      echo json_encode($alerta);   
    }
    /*------    FIN CONTROLADOR PROVEEDORES     ------*/
    #===================================================================#   

    public function listar_categ_products(){
        $lista_categoria = configProducModelo::listar_categoria_producto();
        $tabla = "";

        if ($lista_categoria->rowCount()) {
            $tabla .= '
                <div class="card-content">
                <table class="table">
                    <thead class="thead-dark">
                        <tr class="">
                            <th> # </th>
                            <th>Categoria</th>
                            <th>Editar</th>
                            <th>Borrar</th>
                        </tr>
                    </thead>
                <tbody>';
            $contador = 1;

            foreach($lista_categoria as $row){
                $tabla .= '
                <tr class="">
                    <td>' . $contador . '</td>
                    <td>' . $row['nomCategoria'] . '</td>
                    <td><a href="' . SERVERURL . 'updt-user/' . mainModel::encryption($row['id']) . '" class"button"><i class="icon fa-regular fa-pen-to-square"></i></a></td>
                    <td><a href="" class"button"><i class="icon fa-solid fa-trash"></i></a></th>
                </tr>';
                $contador++;
            }
            $tabla .= '
                        </tbody>
                    </table>
                </div>';
        } 
       return $tabla; 

    }
}
