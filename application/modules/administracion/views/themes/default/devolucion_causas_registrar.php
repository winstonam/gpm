<div class="modal fade" id="dcModal" role="dialog" aria-labelledby="dcModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="dcModal">Formulario de Causas devoluci&oacute;n</h4>
            </div>
            <div class="modal-body">
                <form id="formulario_dev_cau" method="POST" action="<?php echo base_url().('administracion/devolucion_causas/guardar') ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id_causa_devolucion" value="" id="id_causa_devolucion">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="Descripcion">Descripcion <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="Descripcion" name="Descripcion">
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