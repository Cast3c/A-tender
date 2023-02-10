<!--=================================================================-->
<!--========= iNICIO CONTENIDO LISTADO TRANSACCIONES DE INVENTARIOS =========-->
<div class="main-container">
  <div class="container">
    <div class="content-box">
      <h1 class="title">Listado de transacciones</h1>
    </div>
    <!--====== Inicio contenedor cuadro blanco ======-->
    <div class="content-box">
      <div class="columns">
        <!---====== Tabla listado de transacciones de inventario ======-->
        <div class="column">
          <div class="card">
            <?php
            require_once "./controladores/transacControlador.php";
            $inst_transacs = new transacControlador();
            echo $inst_transacs->listar_transac();
            ?>
          </div>
        </div>
      </div>
    </div>
    <!--====== Fin contenedor cuadro blanco ======-->
  </div>
</div>
<!--========= FINAL CONTENIDO TRANSACCIONES DE INVENTARIOS =========-->
<!--================================================================-->