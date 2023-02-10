<div class="main-container">
  <div class="container">
    <div class="content-box">
      <h1 class="title">Productos</h1>
      <div class="content-table">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th> Producto</th>
              <th> Costo </th>
              <th> Venta </th>
              <th> Proveedor </th>
              <th> Fecha creacion </th>
              <th></th>
              <?php if ($_SESSION['rol_Tapp']==1) {?>
                <th>Editar</th>
                <th>Borrar</th>
             <?php } ?>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
          <tfoot>
            
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>