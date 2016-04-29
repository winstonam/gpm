<div class="modal fade" id="tpagosModal" role="dialog" aria-labelledby="tpagosModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="tpagosModal">Formulario de Tipos de pago</h4>
            </div>
            <div class="modal-body">
                <form id="formulario_tipos_pago" method="POST" action="<?php echo base_url().('administracion/tipos_pago/guardar_tipo_pago') ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id_tipo_pago" value="" id="id_tipo_pago">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="descripcion">Descripcion <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="descripcion" name="descripcion">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="DescripcionCorta">Descripcion corta <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="DescripcionCorta" name="DescripcionCorta">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btn_cancelar" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button id="btn_guardar_tpago" type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>