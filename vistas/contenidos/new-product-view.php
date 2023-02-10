<div class="main-container">
  <div class="container">
    <div class="content-box">
      <div class="columns">
        <!--******************************************************************-->
        <!------ columna de producto nuevo ------>
        <div class="column">
          <div class="card-header"></div>
          <div class="card-content"></div>
          
          <h1 class="title">Producto nuevo</h1>
          <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/productoAjax.php?value=1" method="post" data-form="save" autocomplete="off">
            <div class="columns">
              <div class="column">
                <input class="input is-primary " type="text" name="nombre_product_reg" id="nom_product" placeholder="Nombre del Producto" required>
              </div>
            </div>
            <div class="columns">
              <div class="column">
                <div class="select is-primary">
                  <?php
                  require_once "./controladores/configProducControlador.php";
                  $inst_proveedor = new configProducControlador();
                  echo $inst_proveedor->listar_proveedor_select_controlador();
                  ?>
                </div>
              </div>
            </div>
            <div class="columns">
              <div class="column">
                <div class="select is-primary">
                  <?php
                  require_once "./controladores/configProducControlador.php";
                  $select = new configProducControlador();
                  echo $select->listar_tipoEmpaq_select_controlador();
                  ?>
                </div>
              </div>
              <div class="column">
                <div class="select is-primary">
                  <?php
                  require_once "./controladores/configProducControlador.php";
                  $select = new configProducControlador();
                  echo $select->listar_vendors_select_provee_controlador();
                  ?>
                </div>
              </div>
            </div>
            <div class="columns">
              <div class="column">
                <input class="input is-primary" type="number" name="costo_product_reg" id="cost_product" pattern="[0-9]{3,10}" placeholder="Precio de compra" required>
              </div>
              <div class="column">
                <input class="input is-primary " type="number" name="venta_product_reg" id="venta_product" pattern="[0-9]{3,20}" placeholder="Precio de venta" required>
              </div>
            </div>
            <div class="columns">
              <div class="column">
                <button class="button is-success">Guardar</button>
              </div>
              <div class="column">
                <button class="button is-link is-danger">Cancelar</button>
              </div>
            </div>
          </form>

          <div class="form-container">
            <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/productoAjax.php?value=4" method="post" data-form="save" autocomplete="off">
              <div class="file has-name is-fullwidth">
                <label class="file-label">
                  <input class="file-input" type="file" name="fileProduct">
                  <span class="file-cta">
                    <span class="file-icon">
                      <i class="fas fa-upload"></i>
                    </span>
                    <span class="file-label">
                      …
                    </span>
                  </span>
                  <span class="file-name">
                    Selecciona un archivo para subir varios productos
                  </span>
                </label>
                <div class="custom-file-label">
                  <button type="submit" class="button is-success">Guardar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!------ fin columna producto nuevo ------>
        <!--******************************************************************-->
        <!--******************************************************************-->
        <!------ columna listado de productos ------>
        <div class="column">
          <div class="card">
            <header class="card-header">
              <p class="card-header-title">
                Lista productos
              </p>
              <button class="card-header-icon" aria-label="more options">
                <span class="icon">
                  <i class="fas fa-angle-down" aria-hidden="true"></i>
                </span>
              </button>
            </header>
            <div class="card-content">
              <table class="table">
                <thead class="thead-dark">
                  <tr class="">
                    <th> # </th>
                    <th>Nombre</th>
                    <th>Precio venta</th>
                    <th>Empaque</th>
                    <th>Vendedor</th>
                    <th>Proveedor</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  require_once "./controladores/productoControlador.php";
                  $ins_Produc = new productoControlador();
                  echo $ins_Produc->listar_productos_controlador();
                  ?>
                </tbody>
              </table>
            </div>
            <div class="card-footer">
              <div class="content">

              </div>
            </div>
          </div>
        </div>
        <!------ fin coluna listado de productos ------>
        <!--******************************************************************-->
      </div>
    </div>
  </div>
</div>