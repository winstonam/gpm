var url_nuevo = base_url + 'administracion/empresa/guardar';
var url_editar = base_url + 'administracion/empresa/actualizar';
$(document).ready(function () {
    /*cargar tabla principal*/
    var tabla_empresas = $('#tabla_empresas').DataTable({
        language: {
            'url': "//cdn.datatables.net/plug-ins/1.10.10/i18n/Spanish.json"
        },
        "pagingType": "numbers",
        "pageLength": 10,
        "ordering": false,
        "scrollY": 200,
        "scrollX": true,
        ajax: {
            "url": base_url + "administracion/empresa/obtener/",
            "type": 'POST',
            "dataSrc": ""
        },
        "columns": [
            {"data": "Nombre_Empresa"},
            {"data": "Direccion_empresa"},
            {"data": "Nombre_Paquete"},
            {"data": "Precio_Mensual"},
            {"data": "nombres"},
            {"data": "telefono"},
            {"data": "estado"}
        ],
        "columnDefs": [
            {
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function ( data, type, row ) {
                    return data +' '+ row.primer_apellido +' '+ row.segundo_apellido +' ('+ row.cedula+')';
                },
                "targets": 4
            },
            {
                "render" : function(data, type, row){
                    var estado = row.estado;
                    var cadena = "Activo";
                    if(estado < 1)
                        cadena = "Inactivo"
                    return cadena;
                },
                "targets" : 6
            }
        ]
    });
    cargar_paquetes();

    /*eventos para seleccionar fila*/
    $('#tabla_empresas tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        }
        else {
            tabla_empresas.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        if ($('#tabla_empresas tr.selected').length > 0) {
            $("#btn_editar").removeAttr('disabled')
        }
        else {
            $("#btn_editar").attr('disabled', 'disabled');
        }
    });
    /*btn editar registro seleccionado*/
    $("#btn_editar").on('click', function (e) {
        $("#formulario_empresas").attr('action', url_editar);
        var seleccion = $('#tabla_empresas tr.selected');
        var fila_data = tabla_empresas.row(seleccion).data();
        $("#id_empresa").val(fila_data.id_empresa);
        $("#id_persona").val(fila_data.id_persona);
        $("#id_paquete").val(fila_data.id_paquete);
        $("#Nombre_Empresa").val(fila_data.Nombre_Empresa);
        $("#Direccion_empresa").val(fila_data.Direccion_empresa);
        $("#cedula").val(fila_data.cedula);
        $("#nombres").val(fila_data.nombres);
        $("#primer_apellido").val(fila_data.primer_apellido);
        $("#segundo_apellido").val(fila_data.segundo_apellido);
        $("#direccion").val(fila_data.direccion);
        $("#telefono").val(fila_data.telefono);
        $("#email").val(fila_data.email);
        $("#estado").val(fila_data.estado);
    });

    /*btn nuevo registro*/
    $("#btn_nuevo").on('click', function (e) {
        restablecer("formulario_empresas");
        $("#formulario_empresas").attr('action', url_nuevo);
    });

    /*btn guardar/actualizar registro*/
    $("#btn_guardar").on('click', function () {
        var datos_formulario = $("#formulario_empresas").serialize();
        $.blockUI({message: '<h1>Por favor espere</h1>'});
        $.ajax({
            type: "POST",
            url: $("#formulario_empresas").attr('action'),
            dataType: 'json',
            data: datos_formulario,
            success: function (respuesta) {
                $.unblockUI();
                if (respuesta.estado) {
                    alerta(respuesta.mensaje, 'success');
                    $("#formulario_empresas")[0].reset();
                    $("#btn_editar").attr('disabled', 'disabled');
                    tabla_empresas.ajax.reload();
                    $("#rEmpresaModal").modal('hide');
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

function cargar_paquetes(){
    $.getJSON(base_url+"administracion/paquetes_sistema/obtener", function(data){
        $.each(data, function(key, val){
            var cadena = '<option value="'+val.id_paquete+'">'+val.Nombre_Paquete+' (US $ '+val.Precio_Mensual+') </option>';
            $("#id_paquete").append(cadena);
        });
    });
}