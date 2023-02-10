<script>
    let btn_salir= document.querySelector(".btn-log-out");

    btn_salir.addEventListener('click', function(e){
        e.preventDefault();
        
        Swal.fire({
        title: 'Estas seguro que quieres cerrar la sesion?',
        text: 'Estas a punto de cerrar la sesion y salir del sistema',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#15bf81',
        cancelButtonColor: '#131426',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar' 
    }).then((result) => {
        if (result.value) {
            let url='<?php echo SERVERURL;?>ajax/loginAjax.php';
            let token = '<?php echo $lc->encryption($_SESSION['token_Tapp']); ?>'
            let usuario = '<?php echo $lc->encryption($_SESSION['usuario_Tapp']); ?>'

            let datos = new  FormData();
            datos.append("token",token);
            datos.append("usuario",usuario);

            fetch(url,{
                method: 'POST',
                body: datos
                })
            .then(respuesta => respuesta.json())
            .then(respuesta => {
                return alertas_ajax(respuesta);
            });
        }
    });
})
</script>