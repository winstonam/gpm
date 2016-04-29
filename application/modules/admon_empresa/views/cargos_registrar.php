<div class="modal fade" id="cargosModal" role="dialog" aria-labelledby="cargosModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="cargosModal">Formulario de Cargos</h4>
            </div>
            <div class="modal-body">
                <form id="formulario_cargos" method="POST" action="<?php echo base_url().('admon_empresa/cargos/guardar_cargo') ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id_cargo" value="" id="id_cargo">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="descripcion">Descripcion <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="descripcion" name="descripcion">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="nivel_acceso">Nivel Acceso <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="nivel_acceso" name="nivel_acceso">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btn_cancelar" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button id="btn_guardar_cargo" type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>