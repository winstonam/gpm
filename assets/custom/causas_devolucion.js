var url_nuevo = base_url + 'administracion/devolucion_causas/guardar';
var url_editar = base_url + 'administracion/devolucion_causas/actualizar';
$(document).ready(function () {
    /*cargar tabla principal*/
    var tabla_dc = $('#tabla_dc').DataTable({
        language: {
            'url': "//cdn.datatables.net/plug-ins/1.10.10/i18n/Spanish.json"
        },
        "pagingType": "numbers",
        "pageLength": 10,
        "ordering": false,
        "scrollY": 200,
        "scrollX": true,
        ajax: {
            "url": base_url + "administracion/devolucion_causas/obtener/",
            "type": 'POST',
            "dataSrc": ""
        },
        "columns": [
            {"data": "Descripcion"},
            {"data": "f_modificacion"}
        ]
    });
    /*eventos para seleccionar fila*/
    $('#tabla_dc tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        }
        else {
            tabla_dc.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        if ($('#tabla_dc tr.selected').length > 0) {
            $("#btn_editar").removeAttr('disabled')
        }
        else {
            $("#btn_editar").attr('disabled', 'disabled');
        }
    });
    /*btn editar registro seleccionado*/
    $("#btn_editar").on('click', function (e) {
        $("#formulario_dev_cau").attr('action', url_editar);
        var seleccion = $('#tabla_dc tr.selected');
        var fila_data = tabla_dc.row(seleccion).data();
        $("#id_causa_devolucion").val(fila_data.id_causa_devolucion);
        $("#Descripcion").val(fila_data.Descripcion);

    });

    /*btn nuevo registro*/
    $("#btn_nuevo").on('click', function (e) {
        restablecer("formulario_dev_cau");
        $("#formulario_dev_cau").attr('action', url_nuevo);
    });

    /*btn guardar/actualizar registro*/
    $("#btn_guardar").on('click', function () {
        var datos_formulario = $("#formulario_dev_cau").serialize();

        $.blockUI({message: '<h1>Por favor espere</h1>'});
        $.ajax({
            type: "POST",
            url: $("#formulario_dev_cau").attr('action'),
            dataType: 'json',
            data: datos_formulario,
            success: function (respuesta) {
                $.unblockUI();
                if (respuesta.estado) {
                    alerta(respuesta.mensaje, 'success');
                    $("#formulario_dev_cau")[0].reset();
                    $("#btn_editar").attr('disabled', 'disabled');
                    tabla_dc.ajax.reload();
                    $("#dcModal").modal('hide');
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