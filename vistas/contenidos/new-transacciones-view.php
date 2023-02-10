<!--=================================================================-->
<!--========= INICIO CONTENIDO TRANSACCIONES DE INVENTARIOS =========-->
<div class="main-container">
    <div class="container">
        <div class="content-box">
            <h1 class="title">Transacciones</h1>
        </div>
        <!--====== INICIO CONTENEDOR CUADRO BLANCO ======-->
        <div class="content-box">

            <div class="columns">
                <!--====== SECCION LISTADO DE TRANSACCIONES DE INVENTARIO ======-->
                <div class="column">
                    <div class="card">
                        <div class="card-content">
                            <div class="content">
                                <!---====== Tabla listado de transacciones de inventario ======-->
                                <table class="table table-light" id="table-transac">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="visibility:collapse; display:none;"> cod </th>
                                            <th> Producto </th>
                                            <th> Transaccion </th>
                                            <th> Linea Venta</th>
                                            <th style="visibility:collapse; display:none;"> Fecha </th>
                                            <th style="visibility:collapse; display:none;"> Usuario </th>
                                            <th> Cantidad </th>
                                            <th> Eliminar </th>
                                        </tr>
                                    </thead>
                                    <tbody id="transacciones">
                                    </tbody>
                                </table>
                                <!--===========================================================-->
                            </div>
                        </div>
                        <!--====== form para guardar transacciones ======-->
                        <form action="" method="post" class="FormularioAjax" data-form="save">
                            <footer class="card-footer">
                                <div class="columns">
                                    <div class="column">
                                        <div class="button is-success" id="save_transacs">Guardar lista transacciones</div>
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
                <!--============================================================-->
                <!--====== SECCION DE TRANSACCION DE INVENTARIO ======-->
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
                                <!--====== Form agregar transaccion de inventario ======-->
                                <div class="columns">
                                    <div class="column">
                                        <input type="hidden" name="" id="fechaTransac" value="<?php echo $fecha = date('Y-m-d') ?>">
                                        <input type="hidden" type="number" name="id_product_reg" id="id_product">
                                        <input class="input is-primary" type="text" name="nom_product_reg" id="nom_product" pattern="[a-zA-ZñÑÁÉÍÓÚáéíóú-_]{1,90}" placeholder="Nombre producto" required readonly>
                                        <input type="hidden" name="idUsuarioTransac" id="idUsu" value="<?php echo $_SESSION['id_Tapp'] ?>">
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        <div class="select is-primary">
                                            <select name="tipo_Transac_reg" class="select" id="tipoTransac" placeholder="tipo de transaccion">
                                                <option value="" hidden selected> Selecciona la transaccion</option>
                                                <option value="4">Venta</option>
                                                <option value="5">Devolucion</option>
                                                <option value="3">Pedido</option>
                                            </select>
                                        </div>
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
                                        <div class="button is-success" id="add_transac">Agregar transaccion</div>
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
                <!--==================================================-->
            </div>
        </div>
        <!--====== FIN CONTENEDOR CUADRO BLANCO ======-->
    </div>
</div>
<!--========= FINAL CONTENIDO TRANSACCIONES DE INVENTARIOS =========-->
<!--================================================================-->