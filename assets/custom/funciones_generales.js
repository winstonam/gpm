function alerta(contenido, tipo){
	if(contenido == '' || contenido == 'undefinied')
		contenido = 'Ocurrio un error al realizar la acción';
	if(tipo == '' || tipo == 'undefinied')
		tipo = 'error'
	var e = noty({
		text: contenido,
		layout: 'topRight',
		animation: {
			open: 'animated bounceIn',
			close: 'animated fadeOutUp'
		},
		type: tipo,
		timeout: 500,
		theme: 'bootstrapTheme',
		closeWith: 'click'
	});

	e.setTimeout(6000);
}

function deshabilitar_botones(){
	$(".tabla_acciones button").attr('disabled', 'disabled');
}

function habilitar_botones(div_id){
	$("#"+div_id+" button").removeAttr('disabled');
}

/**
* tabla_id id de la tabla
* tabla_obj objeto datatables
* contenedor_id id del contenedor de los botones
*/
function tablas_botones(tabla_id, tabla_obj, contenedor_id){
	$('#'+tabla_id+' tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            tabla_obj.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        if(tabla_obj.$('tr.selected').length > 0)
        	habilitar_botones(contenedor_id);
        else
        	deshabilitar_botones();
    } );
}


function restablecer(formulario_id){
	$('#'+formulario_id)[0].reset();
	$('#'+formulario_id+' input:hidden').val('');
}