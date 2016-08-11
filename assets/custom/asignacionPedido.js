var url_nuevo = base_url + 'ventas/asignarPedidos/guardar';
// var url_editar = base_url + 'inventario/productos/actualizar';
$(document).ready(function()
{
	cargar_empleados();
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
	 		tabla_asigPedido.$('tr.selected').removeClass('selected');
	 		$(this).addClass('selected');
	 	}
	 	if($('#tblAsignPedido tr.selected').length>0)
	 	{
	 		$("#btn_nuevo").removeAttr('disabled');
	 	}else
	 	{
	 		$("#btn_nuevo").attr('disabled','disabled');
	 	}
	 });
	   /*btn nuevo registro*/
	$("#btn_nuevo").on('click', function (e) {
	        $('#formulario_pedidoReg')[0].reset();
	        $("#formulario_pedidoReg").attr('action', url_nuevo);
	        var seleccion = $('#tblAsignPedido tr.selected');
	        var fila_data = tabla_asigPedido.row(seleccion).data();
	        $("#id_pedido").val(fila_data.id_pedido);
	        $("#cliente").val(fila_data.nombres);
	        $("#fecha").val(fila_data.fecha_pedido);
	        $("#tipoPago").val(fila_data.descripcion);
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
                    $("#btn_nuevo").attr('disabled', 'disabled');
                    tabla_asigPedido.ajax.reload();
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

function cargar_empleados() {
    $.getJSON(base_url + "admon_empresa/RutaEmpleado/obtnerEmpleado", function (data) {
        $.each(data, function (key, val) {
            var cadena = '<option value="' + val.id_empleado + '">' + val.nombres+' ' +val.primer_apellido+' '+val.segundo_apellido+' '+ ' </option>';
            $("#id_repartidor").append(cadena);
        });
    });
}