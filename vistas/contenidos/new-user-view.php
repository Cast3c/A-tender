<?php 
    if ( $_SESSION['rol_Tapp']!= 1) {
        echo $lc->forzar_cierre_sesion_controlador();
        exit();
    }
?>
<div class="main-container">
    <div class="container">
        <div class="content-box">
            <h1 class="title">Usuario nuevo</h1>
            <div class="form-container">
                <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/usuarioAjax.php" method="post" data-form="save" autocomplete="off">
                    <div class="columns">
                        <div class="column">
                            <input class="input is-primary" type="text" name="nombre_usu_reg" id="nom" pattern="[a-zA-ZñÑÁÉÍÓÚáéíóú]{1,90}" placeholder="Nombre" required>
                        </div>
                        <div class="column">
                            <input class="input is-primary" type="text" name="apellido_usu_reg" id="apell" pattern="[a-zA-ZñÑÁÉÍÓÚáéíóú]{1,90}" placeholder="Apellidos" required>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <input class="input is-primary " type="number" name="numero_doc_usu_reg" id="doc" pattern="[0-9]{6,20}" placeholder="Numero Documento" required>
                        </div>
                        <div class="column">
                            <input class="input is-primary " type="text" name="mail_usu_reg" id="mail" pattern="[0-9.@a-zA-Z_-]{6,90}" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <input class="input is-primary " type="password" name="pass1_usu_reg" id="pass1" pattern="[a-zA-Z0-9-+*$@.]{7,100}" placeholder="Clave" required>
                        </div>
                        <div class="column">
                            <input class="input is-primary " type="password" name="pass2_usu_reg" id="pass2" pattern="[a-zA-Z0-9-+*$@.]{7,100}" placeholder="repita su clave" required>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <div class="select is-primary">
                                <select name="sucursal_usu_reg" id="suc">
                                    <option>Selecciona la sucursal </option>
                                    <option value="1">Principal</option>
                                </select>
                            </div>
                        </div>
                        <div class="column">
                            <div class="select is-primary">
                                <select name="rol_usu_reg" id="rol">
                                    <option>Selecciona el perfil</option>
                                    <option value="1">SuperAdmin</option>
                                    <option value="2">Admin</option>
                                    <option value="3">Supervisor</option>
                                    <option value="4">Caja</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="field is-grouped">
                            <div class="control">
                                <button class="button is-success">Guardar</button>
                            </div>
                            <div class="control">
                                <button class="button is-link is-danger">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>