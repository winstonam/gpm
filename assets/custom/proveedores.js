var url_nuevo = base_url + 'inventario/proveedores/guardar';
var url_editar = base_url + 'inventario/proveedores/actualizar';
$(document).ready(function () {
    /*cargar tabla principal*/
    var tabla_proveedores = $('#tabla_proveedores').DataTable({
        language: {
            'url': "//cdn.datatables.net/plug-ins/1.10.10/i18n/Spanish.json"
        },
        "pagingType": "numbers",
        "pageLength": 10,
        "ordering": false,
        "scrollY": 200,
        "scrollX": true,
        ajax: {
            "url": base_url + "inventario/proveedores/obtener/",
            "type": 'POST',
            "dataSrc": ""
        },
        "columns": [
            {"data": "Nombre_Proveedor"},
            {"data": "Contacto_Proveedor"},
            {"data": "Direccion"},
            {"data": "Numero_RUC"},
            {"data": "Fecha_Ingreso"},
            {"data": "estado"}
        ],
        "columnDefs": [
            {
                "render": function (data, type, row) {
                    var estado = row.estado;
                    var cadena = "Activo";
                    if (estado < 1)
                        cadena = "Inactivo"
                    return cadena;
                },
                "targets": 5
            }
        ]

    });


    /*eventos para seleccionar fila*/
    $('#tabla_proveedores tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        }
        else {
            tabla_proveedores.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        if ($('#tabla_proveedores tr.selected').length > 0) {
            $("#btn_editar").removeAttr('disabled')
        }
        else {
            $("#btn_editar").attr('disabled', 'disabled');
        }
    });
    /*btn editar registro seleccionado*/
    $("#btn_editar").on('click', function (e) {
        $("#formulario_proveedores").attr('action', url_editar);
        var seleccion = $('#tabla_proveedores tr.selected');
        var fila_data = tabla_proveedores.row(seleccion).data();
        $("#id_proveedor").val(fila_data.id_proveedor);
        $("#id_empresa").val(fila_data.id_empresa);
        $("#Nombre_Proveedor").val(fila_data.Nombre_Proveedor);
        $("#Contacto_Proveedor").val(fila_data.Contacto_Proveedor);
        $("#Direccion").val(fila_data.Direccion);
        $("#Numero_RUC").val(fila_data.Numero_RUC);
        $("#Dias_Plazo").val(fila_data.Dias_Plazo);
        $("#estado").val(fila_data.estado);
    });

    /*btn nuevo registro*/
    $("#btn_nuevo").on('click', function (e) {
        $('#formulario_proveedores')[0].reset();
        $("#formulario_proveedores").attr('action', url_nuevo);
    });

    /*btn guardar/actualizar registro*/
    $("#btn_guardar").on('click', function () {
        var datos_formulario = $("#formulario_proveedores").serialize();
        $.blockUI({message: '<h1>Por favor espere</h1>'});
        $.ajax({
            type: "POST",
            url: $("#formulario_proveedores").attr('action'),
            dataType: 'json',
            data: datos_formulario,
            success: function (respuesta) {
                $.unblockUI();
                if (respuesta.estado) {
                    alerta(respuesta.mensaje, 'success');
                    $("#formulario_proveedores")[0].reset();
                    $("#btn_editar").attr('disabled', 'disabled');
                    tabla_proveedores.ajax.reload();
                    $("#provsModal").modal('hide');
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