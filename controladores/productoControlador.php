<?php

if ($peticionAjax) {
    require_once "../modelos/productoModelo.php";
} else {
    require_once "./modelos/productoModelo.php";
}

class productoControlador extends productoModelo
{

    #===================================================================#
    /*------        CONTROLADOR PRODUCTOS       ------*/

    /*------ controlador agregar producto ------*/
    public function agregar_producto_controlador()
    {

        /*------Almacenado de datos ------*/
        $nombre = mainModel::limpiar_cadena($_POST['nombre_product_reg']);
        $val_costo = mainModel::limpiar_cadena($_POST['costo_product_reg']);
        $val_venta = mainModel::limpiar_cadena($_POST['venta_product_reg']);
        $empaque = mainModel::limpiar_cadena($_POST['tipEmpaque_produc_reg']);
        $id_vendedor = mainModel::limpiar_cadena($_POST['vendor_proveedor_reg']);
        $id_proveedor = mainModel::limpiar_cadena($_POST['proveedor_reg']);
        $fecha = date('Y-m-d');

        
        /*------ verificacion de campos obligatorios ------*/
        if ($nombre == "" || $val_costo == "" || $val_venta == "" || $empaque == "" || $id_proveedor == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se llenaron todos los campos del formulario",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        /*------ verificacion de integridad de los datos ------*/
        
        if (mainModel::verificar_datos("[0-9]{3,10}", $val_costo)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El costo del producto no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9]{3,10}", $val_venta)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El valor de venta del producto no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*------ Agregar producto a base de datos ------*/
        $fecha = date('Y-m-d');
        $datos_producto_reg = [
            "nombre" => $nombre,
            "val_costo" => $val_costo,
            "val_venta" => $val_venta,
            "empaque" => $empaque,
            "vendedor"=> $id_vendedor,
            "fecha" => $fecha,
            "proveedor" => $id_proveedor
        ];

        $agregar_producto = productoModelo::agregar_producto_modelo($datos_producto_reg);
        if ($agregar_producto->rowCount()) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Operacion exitosa",
                "Texto" => "Los datos del nuevo producto se han guardado con exito ",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se pudo registrar el producto",
                "Tipo" => "error"
            ];
        }

        echo json_encode($alerta);
    }
    
    /* ------ listar productos ------ */
    public function listar_productos_controlador()
    {
        $lista_produc = productoModelo::consultar_producto();
        $resultado = [];

        if ($lista_produc->rowCount()) {
            while ($row = $lista_produc->fetch()) {
                $resultado[] = $row;
            }
            return json_encode($resultado);
        } else {
            $mensaje = "No hay productos registrados aun";
            return json_encode($mensaje);
        }   
    }

    /*------    Controlador agregar producto masivo     ------*/
    public function agregar_producto_masivo_controlador()
    {

        /*------ almacenado de datos ------*/
        $tipo = $_FILES['fileProduct']['type'];
        $tamaño = $_FILES['fileProduct']['size'];
        $tempNom = $_FILES['fileProduct']['tmp_name'];
        $lineas = file($tempNom);

        /*------ registrando datos en BD ------*/
        $i = 0;
        foreach ($lineas as $dato) {
            $cantidad_registros = count($lineas);
            $cantidad_registros_agregados = ($cantidad_registros - 1);

            if ($i != 0) {
                $reg = explode(";", $dato);
                
                $nombre       = !empty($reg[0]) ? ($reg[0]) : '';
                $val_costo    = !empty($reg[1]) ? ($reg[1]) : '';
                $val_venta    = !empty($reg[2]) ? ($reg[2]) : '';
                $empaque      = !empty($reg[3]) ? ($reg[3]) : '';
                $id_proveedor = !empty($reg[4]) ? ($reg[4]) : '';
                $categoria    = !empty($reg[5]) ? ($reg[5]) : '';

                $fecha = date('Y-m-d');
                $datos_producto_reg = [
                    "nombre" => $nombre,
                    "val_costo" => $val_costo,
                    "val_venta" => $val_venta,
                    "fecha" => $fecha,
                    "empaque" => $empaque,
                    "proveedor" => $id_proveedor,
                    "categoria" => $categoria
                ];

                $result = productoModelo::agregar_producto_modelo($datos_producto_reg);
            } else {
                $i++;
            }
        }
        /*------ respuesta ------*/
        if ($result->rowCount()) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Operacion exitosa",
                "Texto" => "Los datos de los nuevos productos se han guardado con exito ",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se pudieron registrar los productos",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /*------ Controlador busqueda de productos ------*/
    public function busqueda_productos_instantanea_controlador()
    {
        /*------ almacenado de datos ------*/
        $busqueda= mainModel::limpiar_cadena($_POST['busqueda']);
        
        $consulta = productoModelo::busqueda_producto($busqueda);

        $resultado= [];
       if ($consulta->rowCount()) {
            while ($row = $consulta->fetch()) {
                $resultado[] = $row;
            }
            return json_encode($resultado);
       }else{
            $mensaje = "no hay registros";
            return $mensaje;
       }
    }

    /*--------- Controlador categoria productos ---------*/
    public function listar_categoria_producto(){

        $lista_categoria = productoModelo::lista_categorias();

        $resultado = [];
        if ($lista_categoria->rowCount()) {
            while ($row = $lista_categoria->fetch()) {
                $resultado[] = $row;
            }
            return json_encode($resultado);
        } else {
            $mensaje = "No hay categorias registradas";
            return json_encode($mensaje);
        }
        
    }
}
