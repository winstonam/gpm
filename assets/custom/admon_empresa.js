var url_editar = base_url + 'admon_empresa/empresa/actualizar';

$(document).ready(function () {
    $.getJSON(base_url+"admon_empresa/empresa/obtener_paquetes", function(data){
        $.each(data, function(key, val){
            var cadena = '<option value="'+val.id_paquete+'">'+val.Nombre_Paquete+' (US $ '+val.Precio_Mensual+') </option>';
            $("#id_paquete").append(cadena);
            var id_pa=$("#id_paq").val();
            $("#id_paquete").val(id_pa);

        });
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
                    $("#id_paquete").attr('disabled', 'disabled');
                    $("#Nombre_Empresa").attr('disabled', 'disabled');
                    $("#Direccion_empresa").attr('disabled', 'disabled');
                    $("#cedula").attr('disabled', 'disabled');
                    $("#nombres").attr('disabled', 'disabled');
                    $("#primer_apellido").attr('disabled', 'disabled');
                    $("#segundo_apellido").attr('disabled', 'disabled');
                    $("#direccion").attr('disabled', 'disabled');
                    $("#telefono").attr('disabled', 'disabled');
                    $("#email").attr('disabled', 'disabled');
                    $("#estado").attr('disabled', 'disabled');
                    $("#btn_editar").removeAttr('disabled');
                    $("#btn_guardar").attr('disabled', 'disabled');
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

$("#btn_editar").on('click', function (e) {
    $("#id_paquete").removeAttr('disabled');
    $("#Nombre_Empresa").removeAttr('disabled');
    $("#Direccion_empresa").removeAttr('disabled');
    $("#cedula").removeAttr('disabled');
    $("#nombres").removeAttr('disabled');
    $("#primer_apellido").removeAttr('disabled');
    $("#segundo_apellido").removeAttr('disabled');
    $("#direccion").removeAttr('disabled');
    $("#telefono").removeAttr('disabled');
    $("#email").removeAttr('disabled');
    $("#estado").removeAttr('disabled');
    $("#btn_guardar").removeAttr('disabled');
    $("#btn_editar").attr('disabled', 'disabled');
});

$("#estado").val($("#est").val());