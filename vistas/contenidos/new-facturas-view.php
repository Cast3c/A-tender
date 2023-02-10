<!--=================================================================-->
<!--========= INICIO CONTENIDO FACTURACION =========-->
<div class="main-container">
    <div class="container">
        <div class="content-box ">
            <!--====== SECCION BUSQUEDA DE CLIENTES ======-->
            <h1 class="title">Facturacion</h1>
            <div class="content">
                <div class="field-busqueda">
                    <!--====== Busqueda de clientes ======-->
                    <form>
                        <p class="control has-icons-left">
                            <input class="input is-success is-medium" type="text" placeholder="Buscar cliente" name="busc_cliente_reg" id="buscar_cliente">
                            <span class="icon is-small is-left">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                        </p>
                    </form>
                    <!--===================================-->
                    <!------ Resultado busqueda clientes ------>
                    <div>
                        <table class="table table-light">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Cedula</th>
                                    <th>Sede</th>
                                    <th>Seleccionar</th>
                                </tr>
                            </thead>
                            <tbody id="sel_cliente">
                            </tbody>
                        </table>
                    </div>
                    <!--===================================-->
                </div>
            </div>
            <!--==========================================-->
        </div>
        <!--====== INICIO CONTENEDOR CUADRO BLANCO ======-->
        <div class="content-box">
            <div class="columns">
                <!--====== SECCION ESTRUCTURA DOCUMENTO PREFACTURA ======-->
                <div class="column">
                    <div class="card">
                        <!--====== Encabezado de facturacion ======-->
                        <div class="card-header">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Cliente: </th>
                                        <td id="nomCliente"></td>
                                        <th>Cedula:</th>
                                        <td id="ccCliente"></td>
                                    </tr>
                                    <tr>
                                        <th>Sede:</th>
                                        <td id="sedeCliente"></td>
                                        <th>Fecha:</th>
                                        <?php
                                        $fecha = date('Y-m-d');
                                        ?>
                                        <td><?php echo $fecha?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!--=======================================-->
                        <!---====== Tabla listado de productos facturados ======-->
                        <div class="card-content">
                            <div class="content">
                                <table class="table table-light" id="table-transac">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="visibility:collapse; display:none;"> linea de venta </th>
                                            <th style="visibility:collapse; display:none;"> idProduc </th>
                                            <th style="visibility:collapse; display:none;"> usuario </th>
                                            <th> Producto </th>
                                            <th> Precio x unid </th>
                                            <th> Cantidad </th>
                                            <th> Total </th>
                                            <th> Eliminar </th>
                                        </tr>
                                    </thead>
                                    <tbody id="producs_factura">
                                    </tbody>
                                    <tfoot>
                                        <td></td>
                                        <td></td>
                                        <th>----Total:</th>
                                        <td id="totalFactura"></td>
                                        <td></td>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!--===========================================================-->
                        <!--====== Form para guardar facturas ======-->
                        <form action="" method="post" class="FormularioAjax" data-form="save">
                            <footer class="card-footer">
                                <div class="columns">
                                    <div class="column">
                                        <div class="button is-success" id="save_factura">Generar factura</div>
                                    </div>
                                    <div class="column">
                                        <button class="button is-link is-danger">Cancelar</button>
                                    </div>
                                </div>
                            </footer>
                        </form>
                        <!--=============================================-->
                    </div>
                </div>
                <!--=====================================================-->
                <!--====== SECCION DE BUSQUEDA DE OPCIONES DE FACTURACION ======-->
                <div class="column">
                    <div class="card">
                        <div class="content">
                            <div class="field">
                                <!--====== Busqueda de productos ======-->
                                <form>
                                    <p class="control has-icons-left">
                                        <input class="input" type="text" placeholder="Buscar producto" name="busc_product_reg" id="buscar_produc">
                                        <span class="icon is-small is-left">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </span>
                                    </p>
                                </form>
                                <div>
                                    <table class="table table-light">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>cod</th>
                                                <th>Producto</th>
                                                <th>Precio</th>
                                                <th>Seleccionar</th>
                                            </tr>
                                        </thead>
                                        <tbody id="sel_produc">
                                        </tbody>
                                    </table>
                                </div>
                                <!--===================================-->
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="content">
                                <!--====== Form agregar movimiento de inventario ======-->
                                <div class="columns">
                                    <div class="column">
                                        <input type="hidden" name="" id="fechaFact" value="<?php echo $fecha = date('Y-m-d') ?>">
                                        <input type="hidden" type="number" name="id_product_reg" id="id_product">
                                        <input type="hidden" name="idUsuarioTransac" id="idUsu" value="<?php echo $_SESSION['id_Tapp'] ?>">
                                        <input class="input is-primary" type="text" name="nom_product_reg" id="nom_product" pattern="[a-zA-ZñÑÁÉÍÓÚáéíóú-_]{1,90}" placeholder="Nombre producto" required readonly>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        <input class="input is-primary" type="text" name="precio_product_reg" id="precio_product" pattern="[a-zA-ZñÑÁÉÍÓÚáéíóú-_]{1,90}" placeholder="Precio" required readonly>
                                    </div>
                                    <div class="column">
                                        <div class="select is-primary">
                                            <select name="linea_venta_reg" class="select" id="lineaVenta" placeholder="Linea de venta">
                                                <option value="" hidden selected>Selecciona la linea de venta </option>
                                                <option value="1">Cafeteria</option>
                                                <option value="2">Restaurante</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        <input class="input is-primary" type="number" name="cantProduct" id="cant_product" pattern="[0-9]{3,10}" placeholder="Cantidad">
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        <div class="button is-success" id="add_producto">Agregar producto</div>
                                    </div>
                                    <div class="column">
                                        <button class="button is-link is-danger">Cancelar</button>
                                    </div>
                                </div>
                                <!--====================================================-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--============================================================-->
            </div>
        </div>
        <!--====== FIN CONTENEDOR CUADRO BLANCO ======-->
    </div>
</div>
<!--========= FINAL CONTENIDO FACTURACION =========-->
<!--=================================================================-->