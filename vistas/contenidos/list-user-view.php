<div class="main-container">
  <?php

    require_once "./controladores/usuarioControlador.php";

    $ins_usuario = new usuarioControlador();

    echo $ins_usuario-> paginador_usuarios_controlador(1,15,$_SESSION['id_Tapp'] , $_SESSION['rol_Tapp'],$pag[0],"");
  /*$_SESSION['id_Tapp'] $_SESSION['rol_Tapp'] */ 
  ?>
  
</div>