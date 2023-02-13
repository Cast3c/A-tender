<div class="login-cont">
    <div class="login">
        <h1 class="title">A-tender</h1>
        <form class="form-login" action="" method="post" autocomplete="off">
            <label for="Usuario">Usuario</label>
            <input class="input is-success is-rounded" type="number" name="numero_documento" id="numDoc" pattern="[0-9]{6,20}" placeholder="Ingresa tu documento">
            <label for="Usuario">Clave</label>
            <input class="input is-success is-rounded" type="password" name="usuPass" id="usuPass" pattern="[a-zA-Z0-9-+*$@.]{7,100}" placeholder="Ingresa tu clave">
            <div class="btn-group">
                <button class="btn-login btn-in">Login</button>
                <button class="btn-login btn-cancel">Cancel</button>
            </div>
        </form>
    </div>
</div>
<?php

if (isset($_POST['numero_documento']) && isset($_POST['usuPass'])) {
    require_once "./controladores/loginControlador.php";

    $ins_login = new loginControlador();

    echo $ins_login->iniciar_sesion_controlador();
}
?>