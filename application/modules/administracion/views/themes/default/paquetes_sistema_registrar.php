<div class="modal fade" id="psistemaModal" role="dialog" aria-labelledby="psistemaModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="psistemaModal">Formulario de Paquetes sistema</h4>
            </div>
            <div class="modal-body">
                <form id="formulario_paquetes" method="POST" action="<?php echo base_url().('administracion/paquetes_sistema/guardar') ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id_paquete" value="" id="id_paquete">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="Nombre_Paquete">Nombre paquete <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="Nombre_Paquete" name="Nombre_Paquete">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="Numero_Usuarios_Moviles">Cantidad de dispositivos moviles <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="Numero_Usuarios_Moviles" name="Numero_Usuarios_Moviles">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="Precio_Mensual">Precio Mensual <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="Precio_Mensual" name="Precio_Mensual">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="estado">Estado <span style="color:red;">*</span></label>
                                        <select class="form-control" id="estado" name="estado">
                                            <option value="">Seleccionar Estado</option>
                                            <option value="0">Inactivo</option>
                                            <option value="1">Activo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btn_cancelar" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button id="btn_guardar" type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>