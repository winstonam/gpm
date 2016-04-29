var url_nuevo = base_url + 'administracion/paquetes_sistema/guardar';
var url_editar = base_url + 'administracion/paquetes_sistema/actualizar';
$(document).ready(function () {
    /*cargar tabla principal*/
    var tabla_paquetes = $('#tabla_paquetes').DataTable({
        language: {
            'url': "//cdn.datatables.net/plug-ins/1.10.10/i18n/Spanish.json"
        },
        "pagingType": "numbers",
        "pageLength": 10,
        "ordering": false,
        "scrollY": 200,
        "scrollX": true,
        ajax: {
            "url": base_url + "administracion/paquetes_sistema/obtener/",
            "type": 'POST',
            "dataSrc": ""
        },
        "columns": [
            {"data": "Nombre_Paquete"},
            {"data": "Numero_Usuarios_Moviles"},
            {"data": "Precio_Mensual"},
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
                "targets" : 4
            }
        ]
    });
    /*eventos para seleccionar fila*/
    $('#tabla_paquetes tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        }
        else {
            tabla_paquetes.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        if ($('#tabla_paquetes tr.selected').length > 0) {
            $("#btn_editar").removeAttr('disabled')
        }
        else {
            $("#btn_editar").attr('disabled', 'disabled');
        }
    });
    /*btn editar registro seleccionado*/
    $("#btn_editar").on('click', function (e) {
        $("#formulario_paquetes").attr('action', url_editar);
        var seleccion = $('#tabla_paquetes tr.selected');
        var fila_data = tabla_paquetes.row(seleccion).data();
        $("#id_paquete").val(fila_data.id_paquete);
        $("#Nombre_Paquete").val(fila_data.Nombre_Paquete);
        $("#Numero_Usuarios_Moviles").val(fila_data.Numero_Usuarios_Moviles);
        $("#Precio_Mensual").val(fila_data.Precio_Mensual);

    });

    /*btn nuevo registro*/
    $("#btn_nuevo").on('click', function (e) {
        restablecer("formulario_paquetes");
        $("#formulario_paquetes").attr('action', url_nuevo);
    });

    /*btn guardar/actualizar registro*/
    $("#btn_guardar").on('click', function () {
        var datos_formulario = $("#formulario_paquetes").serialize();
        $.blockUI({message: '<h1>Por favor espere</h1>'});
        $.ajax({
            type: "POST",
            url: $("#formulario_paquetes").attr('action'),
            dataType: 'json',
            data: datos_formulario,
            success: function (respuesta) {
                $.unblockUI();
                if (respuesta.estado) {
                    alerta(respuesta.mensaje, 'success');
                    $("#formulario_paquetes")[0].reset();
                    $("#btn_editar").attr('disabled', 'disabled');
                    tabla_paquetes.ajax.reload();
                    $("#psistemaModal").modal('hide');
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