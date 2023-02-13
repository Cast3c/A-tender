<?php
if ($_SESSION['rol_Tapp'] != 1) {
  echo $lc->forzar_cierre_sesion_controlador();
  exit();
}
?>
<div class="configuracion" id="configuracion">
  <div class="container-1 config-option">
    <button type="submit" class="btn-config btn-opt">Productos</button>
    <button type="submit" class="btn-config btn-opt">Factura</button>
  </div>
  <div class="container-1 config-prod">
    <span class="title">Categoria</span>
    <div class="input-set">
      <form action="" method="post">
        <fieldset>
          <legend>Ingresa tu nueva categoria</legend>
          <input type="text">
          <button type="submit" class="btn-config save-btn">Guardar</button>
          <button type="submit" class="btn-config cancel-btn">Cancelar</button>
          <input type="file" name="" id="file_input">
        </fieldset>
      </form>
      <div class="list-config">
        <?php
        require_once "./controladores/productoControlador.php";
        $insta_configProduc = new productoControlador();
        echo $insta_configProduc->listar_categoria_producto();
        ?>
      </div>
    </div>
  </div>
  <div class="container-1 config-prod">
    <span class="title">Tipo de empaque</span>
    <div class="input-set">
      <form action="" method="post">
        <fieldset>
          <legend>Ingresa tu nuevo tipo de empaque</legend>
          <input type="text">
          <button type="submit" class="btn-config save-btn">Guardar</button>
          <button type="submit" class="btn-config cancel-btn">Cancelar</button>
          <input type="file" name="" id="file_input">
        </fieldset>
      </form>
      <div class="list-config">
        <?php
        require_once "./controladores/configProducControlador.php";
        $ins_Config = new configProducControlador();
        echo $ins_Config->listar_tipoempaque_controlador();
        ?>
      </div>
    </div>
  </div>
  <div class="container-1 config-prod">
    <span class="title">Proveedores</span>
    <div class="input-set">
      <form action="" method="post">
        <fieldset>
          <legend>Ingresa tu nuevo proveedor

          </legend>
          <input type="text">
          <button type="submit" class="btn-config save-btn">Guardar</button>
          <button type="submit" class="btn-config cancel-btn">Cancelar</button>
          <input type="file" name="" id="file_input">
        </fieldset>
      </form>
      <div class="list-config">
        <?php
        require_once "./controladores/configProducControlador.php";
        $ins_Config = new configProducControlador();
        echo $ins_Config->listar_proveedores_controlador();
        ?>
      </div>
    </div>
  </div>
  <div class="container-1 config-prod">
    <span class="title"></span>
    <form action="" method="post"></form>
    <div class="list-config"></div>
  </div>
</div>
<!--  <div class="main-container">
  <div class="container"> -->

<!--****************************************************************************** -->
<!--  INICIO MODULO CONFIGURACION DE PRODUCTOS -->
<!-- <div class="content-box">
      <h1 class="title">Configuraciones de productos</h1>
    </div>
    <div class="content-box">
      <div class="columns">

        <!- Inicio Modulo tipo de empaque lista y nuevo empaque-->
<!-- <div class="column">
          <div class="card">
            <header class="card-header">
              <p class="card-header-title">
                Tipo de empaque
              </p>
              <button class="card-header-icon" aria-label="more options">
                <span class="icon">
                  <i class="fas fa-angle-down" aria-hidden="true"></i>
                </span>
              </button>
            </header>
            <div class="card-content">
              <?php
              require_once "./controladores/configProducControlador.php";
              $ins_Config = new configProducControlador();
              echo $ins_Config->listar_tipoempaque_controlador();
              ?>
            </div>
            <div class="card-footer">
              <div class="content">
                <form class="FormularioAjax" data-form="save" action="<?php ?>" method="post"  autocomplete="off">
                  <div class="columns">
                    <div class="column">
                      <input class="input is-primary" type="text" name="nombre_empaque_reg" id="nom_empaque" pattern="[a-zA-ZñÑÁÉÍÓÚáéíóú]{1,90}" placeholder="Tipo de empaque" required>
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
              </div>
            </div>
          </div> -->
<!--</div> -->
<!-- Fin Modulo tipo de empaque lista y nuevo empaque-->

<!--Inicio modulo vendores lista y nuevo vendedor-->
<!-- <div class="column">
          <div class="card">
            <header class="card-header">
              <p class="card-header-title">
                Vendedores
              </p>
              <button class="card-header-icon" aria-label="more options">
                <span class="icon">
                  <i class="fas fa-angle-down" aria-hidden="true"></i>
                </span>
              </button>
            </header>
            <div class="card-content">
              <div class="content">
                <?php
                require_once "./controladores/configProducControlador.php";
                $inst_controlador = new configProducControlador();
                echo $inst_controlador->listar_vendors_provee_controlador();
                ?>
              </div>
            </div>
            <div class="card-footer">
              <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/configAjax.php?value=4" method="post" data-form="save" autocomplete="off">
                <div class="columns">
                  <div class="column">
                    <input class="input is-primary" type="text" name="nomVendor_reg" id="nom_vendor" placeholder="Nombre vendedor" required>
                  </div>
                </div>
                <div class="columns">
                  <div class="column">
                    <input class="input is-primary" type="number" name="telVendor_reg" id="tel_vendor" pattern="[0-9]{7,10}" placeholder="Tel del proveedor" required>
                  </div>
                </div>
                <div class="columns">
                  <div class="column">
                    <div class="select is-primary">
                      <?php
                      require_once "./controladores/configProducControlador.php";
                      $inst_controlador = new configProducControlador();
                      echo $inst_controlador->listar_proveedor_select_controlador();
                      ?>
                    </div>
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
            </div>
          </div>
        </div> -->
<!--Fin modulo vendores lista y nuevo vendedor-->

<!------ Inicio modulo proveedores lista y nuevo proveedor ------>
<!-- <div class="column">
          <div class="card">
            <header class="card-header">
              <p class="card-header-title">
                Proveedores
              </p>
              <button class="card-header-icon" aria-label="more options">
                <span class="icon">
                  <i class="fas fa-angle-down" aria-hidden="true"></i>
                </span>
              </button>
            </header>
            <div class="card-content">
              <?php
              require_once "./controladores/configProducControlador.php";
              $ins_Config = new configProducControlador();
              echo $ins_Config->listar_proveedores_controlador();
              ?>
            </div>
            <div class="card-footer">
              <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/productoAjax.php" method="post" data-form="save" autocomplete="off">
                <div class="columns">
                  <div class="column">
                    <input class="input is-primary" type="text" name="nombre_proveedor_reg" id="nom_product" pattern="[a-zA-ZñÑÁÉÍÓÚáéíóú-_]{1,90}" placeholder="Nombre del Proveedor" required>
                  </div>
                  <div class="column">
                    <input class="input is-primary" type="number" name="nit_proveedor_reg" id="cost_product" pattern="[0-9]{3,10}" placeholder="Nit del proveedor" required>
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
            </div>
          </div>
        </div> -->
<!------ fin modulo proveedores lista y nuevo proveedor ------>

<!-- </div>
    </div> -->

<!--  FIN MODULO CONFIGURACION DE PRODUCTOS -->
<!--****************************************************************************** -->


<!--****************************************************************************** -->
<!-- INICIO MODULO CARGA DE ARCHIVOS -->
<!-- <div class="content-box">
      <div class="columns"> -->
<!------ Inicio form subir archivo tipo empaque ------>
<!-- <div class="column">
          <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/configAjax.php?value=1" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
            <div class="custom-file">
              <div class="file">
                <label class="file-label">
                  <input class="file-input custom-file-input" type="file" name="fileEmpaq">
                  <span class="file-cta">
                    <span class="file-icon">
                      <i class="fas fa-upload"></i>
                    </span>
                    <span class="file-label">
                      Seleccionar archivo empaque...
                    </span>
                  </span>
                  <div class="custom-file-label">
                    <button type="submit" class="button is-success">Guardar</button>
                  </div>

                </label>
              </div>
            </div>
          </form>
        </div> -->
<!------ fin form subir archivo tipo empaque ------>

<!------ Inicio form subir archivo vendedores ------>
<!-- <div class="column">
          <form class="" action="<?php echo SERVERURL ?>ajax/configAjax.php?value=" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
            <div class="custom-file">
              <div class="file">
                <label class="file-label">
                  <input class="file-input custom-file-input" type="file" name="fileVende">
                  <span class="file-cta">
                    <span class="file-icon">
                      <i class="fas fa-upload"></i>
                    </span>
                    <span class="file-label">
                      Seleccionar archivo vendedores...
                    </span>
                  </span>
                  <div class="custom-file-label">
                    <button type="submit" class="button is-success">Guardar</button>
                  </div>

                </label>
              </div>
            </div>
          </form>
        </div> -->
<!------ fin form subir archivo vendedores ------>

<!------ Inicio form subir archivo proveedores ------>
<!--  <div class="column">
          <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/configAjax.php?value=3" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
            <div class="custom-file">
              <div class="file">
                <label class="file-label">
                  <input class="file-input custom-file-input" type="file" name="fileProvee">
                  <span class="file-cta">
                    <span class="file-icon">
                      <i class="fas fa-upload"></i>
                    </span>
                    <span class="file-label">
                      Seleccionar archivo empaque...
                    </span>
                  </span>
                  <div class="custom-file-label">
                    <button type="submit" class="button is-success">Guardar</button>
                  </div>

                </label>
              </div>
            </div>
          </form>
        </div> -->
<!------ fin form subir archivo proveedores ------>

<!-- </div>
    </div> -->
<!--fin modulo carga de archivos-->
<!--****************************************************************************** -->
<!-- </div>
</div> -->