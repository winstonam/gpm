var url_nuevo = base_url + 'ventas/rutas/guardar';
var url_editar = base_url + 'ventas/rutas/actualizar';
var clientes_ruta;
$(document).ready(function () {
    /*cargar tabla principal*/
    var tabla_rutas = $('#tabla_rutas').DataTable({
        language: {
            'url': "//cdn.datatables.net/plug-ins/1.10.10/i18n/Spanish.json"
        },
        "pagingType": "numbers",
        "pageLength": 10,
        "ordering": false,
        "scrollY": 200,
        "scrollX": true,
        ajax: {
            "url": base_url + "ventas/rutas/obtener/",
            "type": 'POST',
            "dataSrc": ""
        },
        "columns": [
            {"data": "Nombre_ruta"},
            {"data": "Nombre_Empresa"},
            {"data": "f_modificacion"},
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
                "targets": 3
            }
        ]
    });

    var markers = [];

    /*eventos para seleccionar fila*/
    $('#tabla_rutas tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        }
        else {
            tabla_rutas.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        if ($('#tabla_rutas tr.selected').length > 0) {
            $("#btn_editar").removeAttr('disabled');

            var seleccion = $('#tabla_rutas tr.selected');
            var fila_data = tabla_rutas.row(seleccion).data();

            var bounds = new google.maps.LatLngBounds();

            clearMarkers();
            markers = [];
            $.getJSON(base_url + "ventas/clientes/obtener_por_ruta/" + fila_data.id_ruta, function (data) {
                //var items = [];
                $.each(data, function (key, val) {

                    var position = new google.maps.LatLng(val.latitud, val.longitud);
                    bounds.extend(position);
                    marker = new google.maps.Marker({
                        position: position,
                        title: val.nombre_negocio
                    });
                    marker.setAnimation(google.maps.Animation.DROP);
                    marker.setMap(map);
                    markers.push(marker);
                });
            });

            /*  var polyOptions = {
             strokeColor: '#000000',
             strokeOpacity: 1.0,
             strokeWeight: 3
             };
             var poly = new google.maps.Polyline(polyOptions);
             poly.setMap(null);
             poly.setMap(map);


             var path = new google.maps.MVCArray;

             $.getJSON(base_url + "ventas/clientes/obtener_por_ruta/" + fila_data.id_ruta, function(data) {
             //var items = [];
             $.each(data, function(key, val) {
             path.push(new google.maps.LatLng(val.latitud, val.longitud));

             var position = new google.maps.LatLng(val.latitud, val.longitud);
             bounds.extend(position);
             marker = new google.maps.Marker({
             position: position,
             map: map,
             title: markers[i][0]

             });

             console.log(path);
             // now update your polyline to use this path

             poly.setPath(path);
             });*/
        }
        else {
            $("#btn_editar").attr('disabled', 'disabled');
        }
    });

    function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

// Removes the markers from the map, but keeps them in the array.
    function clearMarkers() {
        setMapOnAll(null);
    }

    /*btn editar registro seleccionado*/
    $("#btn_editar").on('click', function (e) {
        $("#formulario_rutas").attr('action', url_editar);
        var seleccion = $('#tabla_rutas tr.selected');
        var fila_data = tabla_rutas.row(seleccion).data();
        $("#id_empresa").val(fila_data.id_empresa);
        $("#id_ruta").val(fila_data.id_ruta);
        $("#Nombre_ruta").val(fila_data.Nombre_ruta);
        $("#Nombre_Empresa").val(fila_data.Nombre_Empresa);
        $("#estado").val(fila_data.estado);
    });


    /*btn nuevo registro*/
    $("#btn_nuevo").on('click', function (e) {
        $('#formulario_rutas')[0].reset();
        $("#formulario_rutas").attr('action', url_nuevo);
    });

    /*btn guardar/actualizar registro*/
    $("#btn_guardar").on('click', function () {
        var datos_formulario = $("#formulario_rutas").serialize();
        $.blockUI({message: '<h1>Por favor espere</h1>'});
        $.ajax({
            type: "POST",
            url: $("#formulario_rutas").attr('action'),
            dataType: 'json',
            data: datos_formulario,
            success: function (respuesta) {
                $.unblockUI();
                if (respuesta.estado) {
                    alerta(respuesta.mensaje, 'success');
                    $("#formulario_rutas")[0].reset();
                    $("#btn_editar").attr('disabled', 'disabled');
                    tabla_rutas.ajax.reload();
                    $("#rutasModal").modal('hide');
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

    var ubicacion_cliente = new google.maps.LatLng(12.125796, -86.211982);


    var map = new google.maps.Map(document.getElementById('mapa-clientes-ruta'), {
        center: ubicacion_cliente,
        zoom: 15,
        draggable: true,
        scrollwheel: true,
        mapTypeId: google.maps.MapTypeId.HYBRID
    });


});
