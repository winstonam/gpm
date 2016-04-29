var url_nuevo = base_url + 'ventas/clientes/guardar';
var url_editar = base_url + 'ventas/clientes/actualizar';
var nuevo = false;
$(document).ready(function () {

    cargar_rutas();

    /*cargar tabla principal*/
    var tabla_clientes = $('#tabla_clientes').DataTable({
        language: {
            'url': "//cdn.datatables.net/plug-ins/1.10.10/i18n/Spanish.json"
        },
        "pagingType": "numbers",
        "pageLength": 5,
        "ordering": false,
        "scrollY": 200,
        "scrollX": true,
        ajax: {
            "url": base_url + "ventas/clientes/obtener/",
            "type": 'POST',
            "dataSrc": ""
        },
        "columns": [
            {"data": "nombre_negocio"},
            {"data": "cedula"},
            {"data": "nombres"},
            {"data": "primer_apellido"},
            {"data": "direccion"},
            {"data": "telefono"},
            {"data": "Nombre_ruta"},
            {"data": "Nombre_Empresa"},
            {"data": "estado_cliente"}
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
                "targets": 8
            }
        ]
    });


    var ubicacion_cliente = new google.maps.LatLng(12.125796, -86.211982);
    var infowindow = new google.maps.InfoWindow;

    var map = new google.maps.Map(document.getElementById('map-canvas3'), {
        center: ubicacion_cliente,
        zoom: 15,
        draggable: true,
        scrollwheel: false,
        mapTypeId: google.maps.MapTypeId.HYBRID
    });


    var marker = new google.maps.Marker({
        position: ubicacion_cliente
        // map:map
    });

    /*eventos para seleccionar fila*/
    $('#tabla_clientes tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        }
        else {
            tabla_clientes.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        if ($('#tabla_clientes tr.selected').length > 0) {
            $("#btn_editar").removeAttr('disabled');
            var seleccion = $('#tabla_clientes tr.selected');
            var fila_data = tabla_clientes.row(seleccion).data();
            var lat = fila_data.latitud;
            var lng = fila_data.longitud;
            ubicacion_cliente = new google.maps.LatLng(lat, lng);
            map.setCenter(ubicacion_cliente);
            marker.setAnimation(google.maps.Animation.DROP);

            marker.setMap(map);
            marker.setPosition(ubicacion_cliente);

            infowindow.setContent(
                '<h3 id="firstHeading" class="firstHeading">' + fila_data.nombre_negocio + '</h3>' +
                '<div id="bodyContent">' +
                '<p>Latitud: <b>' + fila_data.latitud + '</b>' +
                '<p>Longuitud: <b>' + fila_data.longitud + '</b>' +
                '</div>'
            );
        }
        else {
            $("#btn_editar").attr('disabled', 'disabled');

        }
    });
    marker.addListener('click', function () {
        infowindow.open(map, marker);
    });
    map.addListener('center_changed', function () {
        // 3 seconds after the center of the map has changed, pan back to the
        // marker.
        window.setTimeout(function () {
            map.panTo(marker.getPosition());
        }, 10000);
    });


    /*btn editar registro seleccionado*/
    $("#btn_editar").on('click', function (e) {
        nuevo = false;
        $("#formulario_clientes").attr('action', url_editar);
        var seleccion = $('#tabla_clientes tr.selected');
        var fila_data = tabla_clientes.row(seleccion).data();
        $("#id_cliente").val(fila_data.id_cliente);
        $("#id_persona").val(fila_data.id_persona_cliente);
        $("#id_ruta").val(fila_data.id_ruta);
        $("#nombre_negocio").val(fila_data.nombre_negocio);
        $("#direccion_negocio").val(fila_data.direccion_negocio);
        $("#cedula").val(fila_data.cedula);
        $("#nombres").val(fila_data.nombres);
        $("#primer_apellido").val(fila_data.primer_apellido);
        $("#segundo_apellido").val(fila_data.segundo_apellido);
        $("#direccion").val(fila_data.direccion);
        $("#telefono").val(fila_data.telefono);
        $("#estado").val(fila_data.estado_cliente);
        $("#email").val(fila_data.email);
        $("#longitud").val(fila_data.longitud);
        $("#latitud").val(fila_data.latitud);

    });
    var marker_Modal;
    $("#clienteModal").on("shown.bs.modal", function () {

        var seleccion = $('#tabla_clientes tr.selected');
        var fila_data = tabla_clientes.row(seleccion).data();

        var map_Modal;

        var myCenter;
        if (nuevo) {
            myCenter = new google.maps.LatLng(12.125796, -86.211982);
        } else {

            myCenter = new google.maps.LatLng(fila_data.latitud, fila_data.longitud);
        }

        marker_Modal = new google.maps.Marker({
            position: myCenter,
            draggable: true,

        });

        var mapProp = {
            center: myCenter,
            zoom: 14,
            draggable: true,
            scrollwheel: true,
            mapTypeId: google.maps.MapTypeId.HYBRID
        };

        map_Modal = new google.maps.Map(document.getElementById("map-canvas"), mapProp);
        marker_Modal.setMap(map_Modal);

        //google.maps.event.trigger(map_Modal, "resize");
        //google.maps.event.addDomListener(window, 'load', initialize);
        google.maps.event.addListener(marker_Modal, 'dragend', function (event) {


            document.getElementById("latitud").value = event.latLng.lat().toFixed(12);
            document.getElementById("longitud").value = event.latLng.lng().toFixed(12);
        });


        map_Modal.addListener('center_changed', function () {
            // 3 seconds after the center of the map has changed, pan back to the
            // marker.
            window.setTimeout(function () {
                map.panTo(marker.getPosition());
            }, 20000);
        });

    });


    /*btn nuevo registro*/
    $("#btn_nuevo").on('click', function (e) {
        restablecer("formulario_clientes");
        $("#formulario_clientes").attr('action', url_nuevo);
        nuevo = true;
        //  $("#formulario_clientes").attr('method', 'POST');

    });

    /*btn guardar/actualizar registro*/
    $("#btn_guardar").on('click', function () {
        var datos_formulario = $("#formulario_clientes").serialize();

        /*   var CLIENTE = {

         Id_ruta:$("#id_ruta").val(),
         Nombre_Negocio:$("#nombre_negocio").val(),

         DireccionNegocio: $("#direccion_negocio").val(),
         Cedula:$("#cedula").val(),
         Nombres:$("#nombres").val(),
         Primer_apellido:  $("#primer_apellido").val(),
         Segundo_apellido:$("#segundo_apellido").val(),
         Direccion: $("#direccion").val(),
         Telefono:  $("#telefono").val(),
         Estado: $("#estado").val(),
         Email: $("#email").val(),
         Longuitud: $("#longitud").val(),
         Latitud:$("#latitud").val()
         };*/


        $.blockUI({message: '<h1>Por favor espere</h1>'});
        $.ajax({
            type: "POST",
            url: $("#formulario_clientes").attr('action'),
            dataType: 'json',
            data: datos_formulario,
            success: function (respuesta) {
                $.unblockUI();
                if (respuesta.estado) {
                    alerta(respuesta.mensaje, 'success');
                    $("#formulario_clientes")[0].reset();
                    $("#btn_editar").attr('disabled', 'disabled');
                    tabla_clientes.ajax.reload();
                    $("#clienteModal").modal('hide');
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

function cargar_rutas() {
    $.getJSON(base_url + "ventas/rutas/obtener", function (data) {
        $.each(data, function (key, val) {
            var cadena = '<option value="' + val.id_ruta + '">' + val.Nombre_ruta + ' </option>';
            $("#id_ruta").append(cadena);
        });
    });
}
