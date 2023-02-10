<!--================== HEAD ==================-->
<header>
  <nav class="container header-nav">
    <div class="brand-btn">
      <i class="fa-solid fa-bars nav-btn"></i>
      <span class="logo-brand">
        <img src="<?php echo SERVERURL ?>vistas/assets/img/logoTecDev.png" alt="">
        <a href="#" class="name-brand">App-Tender</a>
      </span>

    </div>
    <div class="user-menu">
      <span class="user-name">
        <i class="fa-solid fa-bell nav-btn"></i>
      </span>
      <span class="avatar btn-profile">
        <img src="<?php echo SERVERURL ?>vistas/assets/img/profile-1.jpg" alt="">
      </span>
      <div class="dropdown-menu">
        <a href="#">Perfil</a>
        <a href="#">Configuración</a>
        <a href="#">Cerrar sesión</a>
      </div>

    </div>
  </nav>
</header>
<!--================== SIDEBAR ==================-->
<aside>
  <nav class="nav-menu">
    <ul class="nav-list">
      <li class="nav-item">
        <a href="#dashboard" class="nav-link" id="dashboard-btn">
          <i class='bx bxs-dashboard nav-btn'></i>
          <p class="nav-title">Dashboard</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?php echo SERVERURL ?>sales/" class="nav-link" id="puntoVenta-btn">
          <i class="fa-solid fa-cash-register nav-btn"></i>
          <p class="nav-title">Punto de venta</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="#clientes" class="nav-link" id="clientes-btn">
          <i class="fa-solid fa-user nav-btn"></i>
          <p class="nav-title">Clientes</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="#facturacion" class="nav-link" id="facturas-btn">
          <i class="fa-solid fa-file-invoice-dollar nav-btn"></i>
          <p class="nav-title">Facturacion</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="#inventarios" class="nav-link" id="inventarios-btn">
          <i class="fa-solid fa-list-check nav-btn"></i>
          <p class="nav-title">Inventarios</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?php echo SERVERURL ?>config-produc/" class="nav-link" id="config-btn">
          <i class="fa-solid fa-gear nav-btn"></i>
          <p class="nav-title">Configuración</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="" class="nav-link">
          <i class="fa-solid fa-right-from-bracket logout-btn"></i>
          <p class="logout-title">Salir</p>
        </a>
      </li>
    </ul>
  </nav>
</aside>


<!--   <nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item" href="<?php echo SERVERURL ?>home/">
        <h1 class="title">Tenderapp</h1>
      </a>
      <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>
    <div id="navbarBasicExample" class="navbar-menu">
      <div class="navbar-start">
        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link">Facturacion</a>
          <div class="navbar-dropdown">
            <a href="<?php echo SERVERURL ?>new-facturas/" class="navbar-item">Nueva factura</a>
            <a href="<?php echo SERVERURL ?>list-cliente/" class="navbar-item">Listado</a>
          </div>
        </div>
        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link">Clientes</a>
          <div class="navbar-dropdown">
            <a href="<?php echo SERVERURL ?>resum-cliente/" class="navbar-item">Resumen</a>
            <a href="<?php echo SERVERURL ?>list-cliente/" class="navbar-item">Listado</a>
          </div>
        </div>
        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link">Productos</a>
          <div class="navbar-dropdown">
            <?php if ($_SESSION['rol_Tapp'] == 1) { ?>
              <a class="navbar-item" href="<?php echo SERVERURL ?>new-product/">Nuevo Producto</a>
            <?php } ?>
            <a class="navbar-item" href="<?php echo SERVERURL ?>list-product/">Lista de productos</a>
            <a class="navbar-item" href="index.php?vista=find_user">Buscar</a>
            <a class="navbar-item" href="index.php?vista=updt_user">Actualizar</a>
            <hr class="navbar-divider">
          </div>
        </div>
        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link">Inventarios</a>
          <div class="navbar-dropdown">
            <?php if ($_SESSION['rol_Tapp'] == 1) { ?>
              <a class="navbar-item" href="<?php echo SERVERURL ?>new-transacciones/">Crear transaccion</a>
            <?php } ?>
            <a class="navbar-item" href="<?php echo SERVERURL ?>list-transacciones/">Lista de transacciones</a>
            <a class="navbar-item" href="index.php?vista=find_user">Buscar</a>
            <a class="navbar-item" href="index.php?vista=updt_user">Actualizar</a>
            <hr class="navbar-divider">
          </div>
        </div>
        <?php if ($_SESSION['rol_Tapp'] == 1) { ?>
          <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link ">Usuarios</a>
            <div class="navbar-dropdown">
              <a class="navbar-item" href="<?php echo SERVERURL ?>new-user/">Nuevo Usuario</a>
              <a class="navbar-item" href="<?php echo SERVERURL ?>list-user/">Lista de usuarios</a>
              <a class="navbar-item" href="index.php?vista=find_user">Buscar</a>
              <a class="navbar-item" href="index.php?vista=updt_user">Actualizar</a>
              <hr class="navbar-divider">
            </div>
          </div>
        <?php } ?>
        <?php if ($_SESSION['rol_Tapp'] == 1) { ?>
          <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">Configuracion</a>
            <div class="navbar-dropdown">
              <a class="navbar-item" href="<?php echo SERVERURL ?>config-cliente/">Clientes</a>
              <a class="navbar-item" href="<?php echo SERVERURL ?>config-produc/">Productos</a>
              <a class="navbar-item" href="<? ?>">Inventarios</a>
              <a class="navbar-item" href="">Usuarios</a>
            </div>
          </div>
        <?php } ?>
      </div>

      <div class="navbar-end">
        <div class="navbar-item">
          <div class="buttons">
            <a class="button is-primary is-rounded">
              <strong><?php echo  $_SESSION['nombre_Tapp'] ?></strong>
            </a>
            <a class="button btn-log-out is-light is-rounded">
              salir
            </a>
          </div>
        </div>
      </div>
    </div>
  </nav> -->