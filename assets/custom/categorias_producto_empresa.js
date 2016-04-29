var url_nuevo = base_url + 'ventas/categoria_productos/guardar';
var url_editar = base_url + 'ventas/categoria_productos/actualizar';
$(document).ready(function () {
    /*cargar tabla principal*/
    var tabla_cat_prods = $('#tabla_cat_prods').DataTable({
        language: {
            'url': "//cdn.datatables.net/plug-ins/1.10.10/i18n/Spanish.json"
        },
        "pagingType": "numbers",
        "pageLength": 10,
        "ordering": false,
        "scrollY": 200,
        "scrollX": true,
        ajax: {
            "url": base_url + "ventas/categoria_productos/obtener/",
            "type": 'POST',
            "dataSrc": ""
        },
        "columns": [
            {"data": "Nombre_categoria"},
            {"data": "descripcion"},
            {"data": "f_modificacion"},
            {"data": "estado"}
        ],
        "columnDefs": [
            {
                "render" : function(data, type, row){
                    var estado = row.estado;
                    var cadena = "Activo";
                    if(estado < 1)
                        cadena = "Inactivo"
                    return cadena;
                },
                "targets" : 3
            }
        ]
    });
    /*eventos para seleccionar fila*/
    $('#tabla_cat_prods tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        }
        else {
            tabla_cat_prods.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        if ($('#tabla_cat_prods tr.selected').length > 0) {
            $("#btn_editar").removeAttr('disabled')
        }
        else {
            $("#btn_editar").attr('disabled', 'disabled');
        }
    });
    /*btn editar registro seleccionado*/
    $("#btn_editar").on('click', function (e) {
        $("#formulario_cat_prods").attr('action', url_editar);
        var seleccion = $('#tabla_cat_prods tr.selected');
        var fila_data = tabla_cat_prods.row(seleccion).data();
        $("#id_categoria").val(fila_data.id_categoria);
        $("#descripcion").val(fila_data.descripcion);
        $("#Nombre_categoria").val(fila_data.Nombre_categoria);
        $("#estado").val(fila_data.estado);
    });

    /*btn nuevo registro*/
    $("#btn_nuevo").on('click', function (e) {
        restablecer("formulario_cat_prods");
        $("#formulario_cat_prods").attr('action', url_nuevo);
    });

    /*btn guardar/actualizar registro*/
    $("#btn_guardar_cp").on('click', function () {
        var datos_formulario = $("#formulario_cat_prods").serialize();

        $.blockUI({message: '<h1>Por favor espere</h1>'});
        $.ajax({
            type: "POST",
            url: $("#formulario_cat_prods").attr('action'),
            dataType: 'json',
            data: datos_formulario,
            success: function (respuesta) {
                $.unblockUI();
                if (respuesta.estado) {
                    alerta(respuesta.mensaje, 'success');
                    $("#formulario_cat_prods")[0].reset();
                    $("#btn_editar").attr('disabled', 'disabled');
                    tabla_cat_prods.ajax.reload();
                    $("#catprodModal").modal('hide');
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