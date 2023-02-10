<?php
if ($_SESSION['rol_Tapp'] != 1) {
  echo $lc->forzar_cierre_sesion_controlador();
  exit();
}
?>
<div class="main-container">
  <div class="container">

    <!--****************************************************************************** -->
    <!--  INICIO MODULO CONFIGURACION DE CLIENTES -->
    <div class="content-box">
      <h1 class="title">Configuraciones de clientes</h1>
    </div>
    <div class="content-box">
      <div class="columns">
        <!------ Inicio Modulo unidades organizativas ------>
        <!------ SECCION LISTADO DE UNIDADES ORGANIZATIVAS  ------>
        <div class="column">
          <div class="card">
            <header class="card-header">
              <p class="card-header-title">
                Listado de unidades organizativas
              </p>
              <button class="card-header-icon" aria-label="more options">
                <span class="icon">
                  <i class="fas fa-angle-down" aria-hidden="true"></i>
                </span>
              </button>
            </header>
            <div class="card-content">
              <div class="content">
                <table class="table table-light" id="table-transac">
                  <thead class="thead-light">
                    <tr>
                      <th> # </th>
                      <th> Nombre </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    require_once "./controladores/configClienteControlador.php";
                    $insta_configCliente = new configClienteControlador();
                    echo $insta_configCliente->listar_unidad_organizativa_tabla_controlador();
                    ?>
                  </tbody>
                </table>
                
              </div>
            </div>
          </div>
        </div>
        <!--==================================================================-->
        <!------ SECCION CREAR UNIDAD ORGANIZATIVA ------>
        <div class="column">
          <div class="card">
            <header class="card-header">
              <p class="card-header-title">
                Crear unidad Organizativa
              </p>
              <button class="card-header-icon" aria-label="more options">
                <span class="icon">
                  <i class="fas fa-angle-down" aria-hidden="true"></i>
                </span>
              </button>
            </header>
            <div class="card-content">
              <div class="content">
                <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/configAjax.php?value=8" data-form="save" method="post" autocomplete="off">
                  <div class="columns">
                    <div class="column">
                      <input class="input is-primary" type="text" name="nombre_unidad_organizativa_reg" id="nom_uni_organi" pattern="[áéíóúñÑÁÉÍÓÚa-zA-Z ]{3,90}" placeholder="Nombre unidad organizativa" required>
                    </div>
                  </div>
                  <div class="columns">
                    <div class="column">
                      <button class="button is-success" type="submit">Guardar</button>
                    </div>
                    <div class="column">
                      <button class="button is-link is-danger">Cancelar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!--========= Form carga archivo unidades organizativas clientes =========-->
            <footer class="card-footer">
              <div class="columns">
                <p class="card-header-title">
                  Listado de unidades organizativas
                </p>
              </div>
              <div class="column">
                <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/configAjax.php?value=7" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
                  <div class="custom-file">
                    <div class="file">
                      <label class="file-label">
                        <input class="file-input custom-file-input" type="file" name="fileUnitOrgan">
                        <span class="file-cta">
                          <span class="file-icon">
                            <i class="fas fa-upload"></i>
                          </span>
                          <span class="file-label">
                            Seleccionar archivo unidades organizativas...
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
        <!----------------------------------------------->
      </div>
    </div>
    <!--  FIN MODULO CONFIGURACION DE CLIENTE -->
    <!--****************************************************************************** -->
  </div>
</div>