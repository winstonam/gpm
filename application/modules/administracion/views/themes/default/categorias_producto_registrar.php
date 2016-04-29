<div class="modal fade" id="catprodModal" role="dialog" aria-labelledby="catprodModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="catprodModal">Formulario de Categorias de producto</h4>
            </div>
            <div class="modal-body">
                <form id="formulario_cat_prods" method="POST" action="<?php echo base_url().('administracion/categoria_productos/guardar') ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id_categoria" value="" id="id_categoria">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="Nombre_categoria">Nombre categor&iacute;a <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="Nombre_categoria" name="Nombre_categoria">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="descripcion">Descripci&oacute;n categor&iacute;a</label>
                                        <input type="text" class="form-control" id="descripcion" name="descripcion">
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
                <button id="btn_guardar_cp" type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>