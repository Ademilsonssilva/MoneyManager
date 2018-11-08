$(document).ready(function () {

    $('.valor_formatado').mask('999.999.990,00', {reverse: true});

    $('.btn_excluir_component').on('click', function () {
        btn = $(this);
        swal_confirm('Deseja realmente excluir o registro?', function () {
			btn.parent().find('form').submit();
		});
    });
});