<div class="modal fade" id="rutasModal" role="dialog" aria-labelledby="rutasModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="rutasModal">Formulario de Rutas de venta</h4>
            </div>
            <div class="modal-body">
                <form id="formulario_rutas" method="POST" action="<?php echo base_url().('ventas/rutas/guardar') ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id_ruta" value="" id="id_ruta">
                    <input type="hidden" name="id_empresa" value="<?php echo $this->session->userdata('id_empresa');?>" id="id_empresa">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="Nombre_ruta">Nombre ruta <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="Nombre_ruta" name="Nombre_ruta">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="Nombre_Empresa">Nombre empresa <span style="color:red;">*</span></label>
                                        <input disabled type="text" value="<?php echo $this->session->userdata('Nombre_Empresa');?>" class="form-control" id="Nombre_Empresa" name="Nombre_Empresa">
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