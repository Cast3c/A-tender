const formularios_ajax= document.querySelectorAll(".FormularioAjax");

function enviar_formulario_ajax(e){
    e.preventDefault();

    let data = new FormData(this);
    let method = this.getAttribute("method");
    let action = this.getAttribute("action");
    let tipo = this.getAttribute("data-form");

    let encabezados = new Headers();

    let config = {
        method: method,
        headers: encabezados,
        mode: 'cors',
        cache: 'no-cache',
        body: data
    }

    let texto_alerta;

    if (tipo==="save") {
        texto_alerta="La informacion sera guardada en el sistema"
    }else if (tipo==="delete") {
        texto_alerta="Los datos seran borrados completamente del sistema "
    }else if (tipo==="update") {
        texto_alerta="Los datos del sistema seran actualizados "
    }else if (tipo==="search") {
        texto_alerta="Se eliminara el termino de busqueda ingrese uno nuevopara volver a buscar"
    }else{
        texto_alerta="Quieres realizar la operacion solicitada?"
    }

    Swal.fire({
        title: 'Estas seguro?',
        text: texto_alerta,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#15bf81',
        cancelButtonColor: '#131426',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if(result.isConfirmed) {
            fetch(action,config)
            .then(respuesta => respuesta.json())
            .then(respuesta => {
                return alertas_ajax(respuesta);
            });
        }
    });
}

formularios_ajax.forEach(formularios=> {
    formularios.addEventListener("submit", enviar_formulario_ajax);
});

function alertas_ajax(alerta){
    if (alerta.Alerta === "simple") {
        Swal.fire({
            title: alerta.Titulo,
            text: alerta.Texto,
            icon: alerta.Tipo,
            confirmButtonText: 'Aceptar' 
          });
    }else if(alerta.Alerta === "recargar"){
        Swal.fire({
            title: alerta.Titulo,
            text: alerta.Texto,
            icon: alerta.Tipo,
            confirmButtonText: 'Aceptar' 
        }).then((result) => {
            if (result.value) {
                location.reload();
            }
        });
    }else if (alerta.Alerta === "limpiar") {
        Swal.fire({
            title: alerta.Titulo,
            text: alerta.Texto,
            icon: alerta.Tipo,
            confirmButtonText: 'Aceptar' 
        }).then((result) => {
            if (result.value) {
                document.querySelector(".FormularioAjax").reset();
                window.location.reload();
            }
        });
    }else if(alerta.Alerta  === "redireccionar"){
        window.location.href=alerta.URL;
    }
}




