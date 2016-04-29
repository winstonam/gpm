<div class="modal fade" id="provsModal" role="dialog" aria-labelledby="provsModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="provsModal">Formulario de Proveedores</h4>
            </div>
            <div class="modal-body">
                <form id="formulario_proveedores" method="POST" action="<?php echo base_url().('inventario/proveedores/guardar') ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id_proveedor" value="" id="id_proveedor">
                    <input type="hidden" name="id_empresa" value="<?php echo $this->session->userdata('id_empresa');?>" id="id_empresa">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="Nombre_Proveedor">Nombre_Proveedor <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="Nombre_Proveedor" name="Nombre_Proveedor">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="Direccion">Direccion <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="Direccion" name="Direccion">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="Contacto_Proveedor">Contacto_Proveedor <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="Contacto_Proveedor" name="Contacto_Proveedor">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="Numero_RUC">Numero_RUC<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="Numero_RUC" name="Numero_RUC">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="Dias_Plazo">Dias_Plazo<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="Dias_Plazo" name="Dias_Plazo">
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