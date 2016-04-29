var url_nuevo = base_url + 'ventas/tipos_pago/guardar_tipo_pago';
var url_editar = base_url + 'ventas/tipos_pago/actualizar_tipo_pago';
$(document).ready(function () {
    /*cargar tabla principal*/
    var tabla_tipos_pago = $('#tabla_tipos_pago').DataTable({
        language: {
            'url': "//cdn.datatables.net/plug-ins/1.10.10/i18n/Spanish.json"
        },
        "pagingType": "numbers",
        "pageLength": 10,
        "ordering": false,
        "scrollY": 200,
        "scrollX": true,
        ajax: {
            "url": base_url + "ventas/tipos_pago/obtener_tipos_pagos/",
            "type": 'POST',
            "dataSrc": ""
        },
        "columns": [
            {"data": "descripcion"},
            {"data": "DescripcionCorta"},
            {"data": "f_modificacion"}
        ]
    });
    /*eventos para seleccionar fila*/
    $('#tabla_tipos_pago tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        }
        else {
            tabla_tipos_pago.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        if ($('#tabla_tipos_pago tr.selected').length > 0) {
            $("#btn_editar_tipo_pago").removeAttr('disabled')
        }
        else {
            $("#btn_editar_tipo_pago").attr('disabled', 'disabled');
        }
    });
    /*btn editar registro seleccionado*/
    $("#btn_editar_tipo_pago").on('click', function (e) {
        $("#formulario_tipos_pago").attr('action', url_editar);
        var seleccion = $('#tabla_tipos_pago tr.selected');
        var fila_data = tabla_tipos_pago.row(seleccion).data();
        $("#id_tipo_pago").val(fila_data.id_tipo_pago);
        $("#descripcion").val(fila_data.descripcion);
        $("#DescripcionCorta").val(fila_data.DescripcionCorta);
    });

    /*btn nuevo registro*/
    $("#btn_nuevo_tipo_pago").on('click', function (e) {
        restablecer("formulario_tipos_pago");
        $("#formulario_tipos_pago").attr('action', url_nuevo);
    });

    /*btn guardar/actualizar registro*/
    $("#btn_guardar_tpago").on('click', function () {
        var datos_formulario = $("#formulario_tipos_pago").serialize();
        $.blockUI({message: '<h1>Por favor espere</h1>'});
        $.ajax({
            type: "POST",
            url: $("#formulario_tipos_pago").attr('action'),
            dataType: 'json',
            data: datos_formulario,
            success: function (respuesta) {
                $.unblockUI();
                if (respuesta.estado) {
                    alerta(respuesta.mensaje, 'success');
                    $("#formulario_tipos_pago")[0].reset();
                    $("#btn_editar_tipo_pago").attr('disabled', 'disabled');
                    tabla_tipos_pago.ajax.reload();
                    $("#tpagosModal").modal('hide');
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