function swal_confirm(texto, func)
{
    swal({
        title: '<strong>Confirmação</strong>',
        type: 'warning',
        html: texto,
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: 'SIM',
        cancelButtonText: 'NÃO',
        resultado: func,
    }).then((result) => {
        if(result.value) {
            func.call();
        }
    });
}