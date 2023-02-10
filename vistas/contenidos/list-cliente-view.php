<!--=================================================================-->
<!--========= INICIO CONTENIDO LISTADO DE CLIENTES =========-->
<div class="main-container">
  <div class="container">
    <div class="content-box">
      <h1 class="title">Clientes</h1>
    </div>
    <!--====== INICIO CONTENEDOR CUADRO BLANCO ======-->
    <div class="content-box">
      <div class="columns">
        <!--========= SECCION LISTADO DE CLIENTES =========-->
        <div class="column">
          <div class="card">
            <header class="card-header">
              <p class="card-header-title">
                Listado de clientes
              </p>
              <button class="card-header-icon" aria-label="more options">
                <span class="icon">
                  <i class="fas fa-angle-down" aria-hidden="true"></i>
                </span>
              </button>
            </header>
            <div class="card-content">
              <div class="content">
                <!---====== Tabla listado de transacciones de inventario ======-->
                <table class="table table-light" id="table-transac">
                  <thead class="thead-light">
                    <tr>
                      <th style="visibility:collapse; display:none;"> cod </th>
                      <th> cod </th>
                      <th> Nombres </th>
                      <th> Num identificacion</th>
                      <th> Unidad organizativa </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    require "./controladores/clienteControlador.php";
                    $insta_clientes = new clienteControlador();
                    echo $insta_clientes::listar_clientes_tabla_controlador();
                    ?>
                  </tbody>
                </table>
                <!--===========================================================-->
              </div>
            </div>
          </div>
        </div>
        <!--==================================================================-->
        <!--========= SECCION FORMULARIO CREAR CLIENTE =========-->
        <div class="column">
          <div class="card">
            <!--========= Titulo formulario =========-->
            <header class="card-header">
              <p class="card-header-title">
                Nuevo cliente
              </p>
              <button class="card-header-icon" aria-label="more options">
                <span class="icon">
                  <i class="fas fa-angle-down" aria-hidden="true"></i>
                </span>
              </button>

            </header>
            <!--====================================-->
            <!--========= Form agregar cliente nuevo =========-->
            <div class="card-content">
              <div class="content">
                <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/clienteAjax.php?value=2" data-form="save" method="post" autocomplete="off">
                  <div class="columns">
                    <div class="column">
                      <input class="input is-primary is-small" type="text" name="nom_client_reg" id="nom_cliente" pattern="[a-zA-ZñÑÁÉÍÓÚáéíóú ]{1,90}" placeholder="Nombre cliente" required>
                    </div>
                    <div class="column">
                      <input class="input is-primary is-small" type="text" name="apell_client_reg" id="apellido_cliente" pattern="[a-zA-ZñÑÁÉÍÓÚáéíóú ]{1,90}" placeholder="Apellido cliente" required>
                    </div>
                  </div>
                  <div class="columns">
                    <div class="column">
                      <input class="input is-primary is-small" type="number" name="cc_cliente_reg" id="cedula_cliente" pattern="[0-9]{1,90}" placeholder="Numero de identificacion" required>
                    </div>
                    <div class="column">
                      <div class="select is-primary is-small">
                        <select name="unidad_oranizativa_reg" class="select" id="unidadOrganizativa">
                          <option value="" hidden selected>Selecciona la unidad organizativa</option>
                          <?php
                          require_once "./controladores/configClienteControlador.php";
                          $insta_cliente = new configClienteControlador();
                          echo $insta_cliente->listar_unidad_organizativa_select_controlador();
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="columns">
                    <div class="column">
                      <div class="button is-success">Agregar cliente</div>
                    </div>
                    <div class="column">
                      <button class="button is-link is-danger">Cancelar</button>
                    </div>
                  </div>
                </form>
                <!--==============================================-->
              </div>
            </div>
            <!--===============================================-->
            <!--========= Form carga archivo clientes =========-->
            <footer class="card-footer">
              <div class="columns">
                <p class="card-header-title">
                  Listado de clientes
                </p>
              </div>
              <div class="column">
                <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/clienteAjax.php?value=1" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
                  <div class="custom-file">
                    <div class="file">
                      <label class="file-label">
                        <input class="file-input custom-file-input" type="file" name="fileCliente">
                        <span class="file-cta">
                          <span class="file-icon">
                            <i class="fas fa-upload"></i>
                          </span>
                          <span class="file-label">
                            Seleccionar archivo clientes...
                          </span>
                        </span>
                        <div class="custom-file-label">
                          <button type="submit" class="button is-success">Guardar</button>
                        </div>
                      </label>
                    </div>
                  </div>
                </form>
              </div>
            </footer>
            <!--===============================================-->
          </div>
        </div>
        <!--====================================================-->
      </div>
    </div>
  </div>
  <!--====== FIN CONTENEDOR CUADRO BLANCO ======-->
</div>
</div>
<!--========= FINAL CONTENIDO LISTADO DE CLIENTES =========-->
<!--================================================================-->