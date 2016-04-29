var url_nuevo = base_url + 'admon_empresa/empleados/guardar';
var url_editar = base_url + 'admon_empresa/empleados/actualizar';
$(document).ready(function () {
    /*cargar tabla principal*/
    var tabla_empleados = $('#tabla_empleados').DataTable({
        language: {
            'url': "//cdn.datatables.net/plug-ins/1.10.10/i18n/Spanish.json"
        },
        "pagingType": "numbers",
        "pageLength": 10,
        "ordering": false,
        "scrollY": 200,
        "scrollX": true,
        ajax: {
            "url": base_url + "admon_empresa/empleados/obtener/",
            "type": 'POST',
            "dataSrc": ""
        },
        "columns": [
            {"data": "codigo_empleado"},
            {"data": "nombres"},
            {"data": "cargo"},
            {"data": "telefono"},
            {"data": "estado_empleado"}
        ],
        "columnDefs": [
            {
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function (data, type, row) {
                    return data + ' ' + row.primer_apellido + ' ' + row.segundo_apellido + ' (' + row.cedula + ')';
                },
                "targets": 1
            },
            {
                "render": function (data, type, row) {
                    var estado = row.estado_empleado;
                    var cadena = "Activo";
                    if (estado < 1)
                        cadena = "Inactivo"
                    return cadena;
                },
                "targets": 4
            }
        ]
    });
    cargar_cargos();

    /*eventos para seleccionar fila*/
    $('#tabla_empleados tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        }
        else {
            tabla_empleados.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        if ($('#tabla_empleados tr.selected').length > 0) {
            $("#btn_editar").removeAttr('disabled')
        }
        else {
            $("#btn_editar").attr('disabled', 'disabled');
        }
    });
    /*btn editar registro seleccionado*/
    $("#btn_editar").on('click', function (e) {
        $("#formulario_empleados").attr('action', url_editar);
        var seleccion = $('#tabla_empleados tr.selected');
        var fila_data = tabla_empleados.row(seleccion).data();
        $("#id_empleado").val(fila_data.id_empleado);
        $("#id_empresa").val(fila_data.id_empresa);
        $("#id_persona").val(fila_data.id_persona_empleado);
        $("#id_cargo").val(fila_data.id_cargo);
        $("#cedula").val(fila_data.cedula);
        $("#codigo_empleado").val(fila_data.codigo_empleado);
        $("#nombres").val(fila_data.nombres);
        $("#primer_apellido").val(fila_data.primer_apellido);
        $("#segundo_apellido").val(fila_data.segundo_apellido);
        $("#direccion").val(fila_data.direccion);
        $("#telefono").val(fila_data.telefono);
        $("#email").val(fila_data.email);
        $("#estado").val(fila_data.estado_empleado);
    });

    /*btn nuevo registro*/
    $("#btn_nuevo").on('click', function (e) {
        $('#formulario_empleados')[0].reset();
        $("#formulario_empleados").attr('action', url_nuevo);
    });

    /*btn guardar/actualizar registro*/
    $("#btn_guardar").on('click', function () {
        var datos_formulario = $("#formulario_empleados").serialize();
        $.blockUI({message: '<h1>Por favor espere</h1>'});
        $.ajax({
            type: "POST",
            url: $("#formulario_empleados").attr('action'),
            dataType: 'json',
            data: datos_formulario,
            success: function (respuesta) {
                $.unblockUI();
                if (respuesta.estado) {
                    alerta(respuesta.mensaje, 'success');
                    $("#formulario_empleados")[0].reset();
                    $("#btn_editar").attr('disabled', 'disabled');
                    tabla_empleados.ajax.reload();
                    $("#rEmpleadoModal").modal('hide');
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

function cargar_cargos() {
    $.getJSON(base_url + "admon_empresa/cargos/obtener_cargos", function (data) {
        $.each(data, function (key, val) {
            var cadena = '<option value="' + val.id_cargo + '">' + val.descripcion + '</option>';
            $("#id_cargo").append(cadena);
            $("#id_cargo").val($("#id_car").val());
        });
    });
}