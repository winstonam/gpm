var url_nuevo = base_url + 'ventas/asignarPedidos/guardar';
// var url_editar = base_url + 'inventario/productos/actualizar';
$(document).ready(function()
{
	 var tabla_asigPedido=$('#tblAsignPedido').DataTable(
	 {
		languague:
		{
		'url':"//cdn.datatables.net/plug-ins/1.10.10/i18n/Spanish.json"
		},
		"paginingType":"number",
		"pageLenth":"10",
		"ordering":false,
		"scrollY":200,
		"scrollX":true,
		ajax:{
			"url":base_url + "ventas/asignarPedidos/obtener/",
			"type":'POST',
			"dataSrc":""
		},
		"columns":[
			{"data":"nombres"},
			{"data":"fecha_pedido"},
			{"data":"descripcion"},
			{"data":"estado"}
		],
	 });

	 // eventos de seleccion de filas
	 $('#tblAsignPedido tbody').on('click','tr',function()
	 {
	 	if($(this).hasClass('selected'))
	 	{
	 		$(this).removeClass('selected');
	 	}else
	 	{
	 		tabla_producto.$('tr.selected').removeClass('selected');
	 		$(this).addClass('selected');
	 	}
	 	if($('#tblAsignPedido tr.selected').length>0)
	 	{
	 		$("#btn_editar").removeAttr('disabled');
	 	}else
	 	{
	 		$("#btn_editar").attr('disabled','disabled');
	 	}
	 });
	   /*btn nuevo registro*/
	$("#btn_nuevo").on('click', function (e) {
	        $('#formulario_pedidoReg')[0].reset();
	        $("#formulario_pedidoReg").attr('action', url_nuevo);
	});

	    /*btn editar registro seleccionado*/
	$("#btn_editar").on('click', function (e) {
	        $("#formulario_pedidoReg").attr('action', url_editar);
	        var seleccion = $('#tblAsignPedido tr.selected');
	        var fila_data = tabla_asigPedido.row(seleccion).data();
	        $("#id_producto").val(fila_data.id_producto);
	        $("#id_empresa").val(fila_data.id_empresa);
	        $("#codigo").val(fila_data.codigo);
	        $("#nombre_producto").val(fila_data.Nombre_producto);
	        $("#precio").val(fila_data.precio_sugerido);
	        $("#existencia").val(fila_data.existencia_Max);
	        $("#estado").val(fila_data.estado);
	});
	   /*btn guardar/actualizar registro*/
    $("#btn_guardar").on('click', function () {
        var datos_formulario = $("#formulario_pedidoReg").serialize();
        // $.blockUI({message: '<h1>Por favor espere</h1>'});
        $.ajax({
            type: "POST",
            url: $("#formulario_pedidoReg").attr('action'),
            dataType: 'json',
            data: datos_formulario,
            success: function (respuesta) {
                // $.unblockUI();
                if (respuesta.estado) {
                    alerta(respuesta.mensaje, 'success');
                    $("#formulario_pedidoReg")[0].reset();
                    $("#btn_editar").attr('disabled', 'disabled');
                    tabla_producto.ajax.reload();
                    $("#mdlAsigPedido").modal('hide');
                }
                else
                    alerta(respuesta.mensaje, 'error');
            },
            error: function (error) {
                $.unblockUI();
                alerta(error.responseText, 'error');
            }
        });
    });
});