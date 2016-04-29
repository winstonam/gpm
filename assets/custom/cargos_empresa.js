var url_nuevo = base_url + 'admon_empresa/cargos/guardar_cargo';
var url_editar = base_url + 'admon_empresa/cargos/actualizar_cargo';
$(document).ready(function () {
    /*cargar tabla principal*/
    var tabla_cargos = $('#tabla_cargos').DataTable({
        language: {
            'url': "//cdn.datatables.net/plug-ins/1.10.10/i18n/Spanish.json"
        },
        "pagingType": "numbers",
        "pageLength": 10,
        "ordering": false,
        "scrollY": 200,
        "scrollX": true,
        ajax: {
            "url": base_url + "admon_empresa/cargos/obtener_cargos/",
            "type": 'POST',
            "dataSrc": ""
        },
        "columns": [
            {"data": "descripcion"},
            {"data": "nivel_acceso"}
        ]
    });
    /*eventos para seleccionar fila*/
    $('#tabla_cargos tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        }
        else {
            tabla_cargos.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        if ($('#tabla_cargos tr.selected').length > 0) {
            $("#btn_editar_cargo").removeAttr('disabled')
        }
        else {
            $("#btn_editar_cargo").attr('disabled', 'disabled');
        }
    });
    /*btn editar registro seleccionado*/
    $("#btn_editar_cargo").on('click', function (e) {
        $("#formulario_cargos").attr('action', url_editar);
        var seleccion = $('#tabla_cargos tr.selected');
        var fila_data = tabla_cargos.row(seleccion).data();
        $("#id_cargo").val(fila_data.id_cargo);
        $("#descripcion").val(fila_data.descripcion);
        $("#nivel_acceso").val(fila_data.nivel_acceso);
    });

    /*btn nuevo registro*/
    $("#btn_nuevo_cargo").on('click', function (e) {
        restablecer("formulario_cargos");
        $("#formulario_cargos").attr('action', url_nuevo);
    });

    /*btn guardar/actualizar registro*/
    $("#btn_guardar_cargo").on('click', function () {
        var datos_formulario = $("#formulario_cargos").serialize();
        $.blockUI({message: '<h1>Por favor espere</h1>'});
        $.ajax({
            type: "POST",
            url: $("#formulario_cargos").attr('action'),
            dataType: 'json',
            data: datos_formulario,
            success: function (respuesta) {
                $.unblockUI();
                if (respuesta.estado) {
                    alerta(respuesta.mensaje, 'success');
                    $("#formulario_cargos")[0].reset();
                    $("#btn_editar_cargo").attr('disabled', 'disabled');
                    tabla_cargos.ajax.reload();
                    $("#cargosModal").modal('hide');
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