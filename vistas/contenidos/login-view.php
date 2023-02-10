<div class="main-container">
    <div class="login">
        <h1 class="title">Tenderapp</h1>
        <form class="" action="" method="post" autocomplete="off">
            <label for="Usuario">Usuario</label>
            <input class="input is-success is-rounded" type="number" name="numero_documento" id="numDoc" pattern="[0-9]{6,20}" placeholder="Ingresa tu documento">
            <label for="Usuario">Clave</label>
            <input class="input is-success is-rounded" type="password" name="usuPass" id="usuPass" pattern="[a-zA-Z0-9-+*$@.]{7,100}" placeholder="Ingresa tu clave">
            <div class="field container-button is-grouped">
                <div class="control container-button">
                    <button class="button is-success">Login</button>
                </div>
                <div class="control container-button">
                    <button class="button is-link is-light">Cancel</button>
                </div>

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