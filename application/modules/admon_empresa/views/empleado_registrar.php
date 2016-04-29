<div class="modal fade" id="rEmpleadoModal" role="dialog" aria-labelledby="rEmpleadoModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="rEmpleadoModal">Formulario de Empleados</h4>
            </div>
            <div class="modal-body">
                <form id="formulario_empleados" method="POST"
                      action="<?php echo base_url() . ('admon_empresa/empleados/guardar') ?>"
                      enctype="multipart/form-data">
                    <input type="hidden" name="id_empleado" value="" id="id_empleado">
                    <input type="hidden" name="id_persona" value="" id="id_persona">
                    <input type="hidden" name="id_empresa" value="<?php echo $this->session->userdata('id_empresa');?>" id="id_empresa">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="codigo_empleado">Codigo_empleado <span
                                                style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="codigo_empleado"
                                               name="codigo_empleado">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="id_cargo">Cargos <span
                                                style="color:red;">*</span></label>
                                        <select class="form-control" id="id_cargo" name="id_cargo">
                                            <option value="">Seleccionar Opci&oacute;n</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="cedula">Numero de identificaci&oacute;n <span
                                                style="color:red;">*</span></label>
                                        <input type="text" class="form-control" required="required" id="cedula"
                                               name="cedula">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="nombres">Nombre empleado <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="nombres" name="nombres">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="primer_apellido">Primer apellido empleado <span
                                                style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="primer_apellido"
                                               name="primer_apellido">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="segundo_apellido">Segundo apellido empleado</label>
                                        <input type="text" class="form-control" id="segundo_apellido"
                                               name="segundo_apellido">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="direccion">Direccion empleado</label>
                                        <input type="text" class="form-control" id="direccion" name="direccion">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="telefono">Telefono empleado</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="email">Email empleado</label>
                                        <input type="text" class="form-control" id="email" name="email">
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
