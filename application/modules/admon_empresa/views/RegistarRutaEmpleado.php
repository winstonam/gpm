<div class="modal fade" id="mdlRutaEmp" role="dialog" aria-labelledby="mdlRutaEmp">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="mdlRutaEmptitle">Formulario de Rutas Empleado</h4>
            </div>
            <div class="modal-body">
                <form id="formulario_rutasEmp" method="POST" action="<?php echo base_url().('admon_empresa/RutaEmpleado/guardar') ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id_ruta" value="" id="idruta">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="txtruta">Ruta: <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="txtruta" name="ruta" readonly="true">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="nivel_acceso">Empleado<span style="color:red;">*</span></label>
                                        <select class="form-control" id="id_empleado" name="id_empleado">
                                                              <option value="">Seleccionar Empleado</option>
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