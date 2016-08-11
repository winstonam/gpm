var url_nuevo = base_url + 'admon_empresa/RutaEmpleado/guardar';
// var url_editar = base_url + 'ventas/clientes/actualizar';
$(document).ready(function(){
	cargar_rutas();
	cargar_empleados();
	var  tabla_rutaEmpleado=$("#tblRutaEmpleado").DataTable({
		 language: {
		            'url': "//cdn.datatables.net/plug-ins/1.10.10/i18n/Spanish.json"
		},
		"pagingType": "numbers",
	       	"pageLength": 5,
	                "ordering": false,
	                "scrollY": 200,
	                "scrollX": true,
	                ajax:{
			"url":base_url + "admon_empresa/RutaEmpleado/obtnerRutaEmpleado/",
			"type":'POST',
			"dataSrc":""
		},
		"columns":[
			{"data":"codigo_empleado"},
			{"data":"nombres"},
			{"data":"primer_apellido"},
			{"data":"segundo_apellido"}
		],
	});

	/*btn nuevo registro*/
	$("#btn_nuevo").on('click', function (e) {

		 var indice = document.getElementById('id_ruta').selectedIndex;
		if(indice !=0)
		{
	                       var texto=document.getElementById('id_ruta').options[indice].text;
	                       var idrt=document.getElementById('id_ruta').options[indice].value;
		        // $('#formulario_rutasEmp')[0].reset();
		        $("#formulario_rutasEmp").attr('action', url_nuevo);
		        document.getElementById('txtruta').value=texto;
		        document.getElementById('idruta').value=idrt;
		}
	});

	  /*btn guardar/actualizar registro*/
	    $("#btn_guardar").on('click', function () {
	        var datos_formulario = $("#formulario_rutasEmp").serialize();
	        // $.blockUI({message: '<h1>Por favor espere</h1>'});
	        $.ajax({
	            type: "POST",
	            url: $("#formulario_rutasEmp").attr('action'),
	            dataType: 'json',
	            data: datos_formulario,
	            success: function (respuesta) {
	                // $.unblockUI();
	                if (respuesta.estado) {
	                    alerta(respuesta.mensaje, 'success');
	                    $("#formulario_rutasEmp")[0].reset();
	                    $("#btn_editar").attr('disabled', 'disabled');
	                    tabla_rutaEmpleado.ajax.reload();
	                    $("#mdlRutaEmp").modal('hide');
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

	    $('#id_ruta').on('change',function(){
	    	tabla_rutaEmpleado.clear().draw();
		url_nueva = base_url + 'admon_empresa/RutaEmpleado/obtnerRutaEmpleado/' + document.getElementById("id_ruta").value;        
		 tabla_rutaEmpleado.ajax.url(url_nueva).load();
	    });
});

function cargar_rutas() {
    $.getJSON(base_url + "admon_empresa/RutaEmpleado/obtenerRutas", function (data) {
        $.each(data, function (key, val) {
            var cadena = '<option value="' + val.id_ruta + '">' + val.Nombre_ruta + ' </option>';
            $("#id_ruta").append(cadena);
        });
    });
}

function cargar_empleados() {
    $.getJSON(base_url + "admon_empresa/RutaEmpleado/obtnerEmpleado", function (data) {
        $.each(data, function (key, val) {
            var cadena = '<option value="' + val.id_empleado + '">' + val.nombres+' ' +val.primer_apellido+' '+val.segundo_apellido+' '+ ' </option>';
            $("#id_empleado").append(cadena);
        });
    });
}