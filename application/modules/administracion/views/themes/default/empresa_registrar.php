<div class="modal fade" id="rEmpresaModal" role="dialog" aria-labelledby="rEmpresaModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="rEmpresaModal">Formulario de Empresas</h4>
            </div>
            <div class="modal-body">
                <form id="formulario_empresas" method="POST"
                      action="<?php echo base_url() . ('administracion/empresa/guardar') ?>"
                      enctype="multipart/form-data">
                    <input type="hidden" name="id_empresa" value="" id="id_empresa">
                    <input type="hidden" name="id_persona" value="" id="id_persona">

                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="Nombre_Empresa">Nombre empresa <span
                                                style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="Nombre_Empresa"
                                               name="Nombre_Empresa">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="Direccion_empresa">Direccion empresa <span
                                                style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="Direccion_empresa"
                                               name="Direccion_empresa">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="id_paquete">Paquete sistema <span
                                                style="color:red;">*</span></label>
                                        <select class="form-control" id="id_paquete" name="id_paquete">
                                            <option value="">Seleccionar Opción</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="cedula">Numero de identificacion contacto <span
                                                style="color:red;">*</span></label>
                                        <input type="text" class="form-control" required="required" id="cedula"
                                               name="cedula">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="nombres">Nombre contacto <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="nombres" name="nombres">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="primer_apellido">Primer apellido contacto <span
                                                style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="primer_apellido"
                                               name="primer_apellido">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="segundo_apellido">Segundo apellido contacto</label>
                                        <input type="text" class="form-control" id="segundo_apellido"
                                               name="segundo_apellido">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="direccion">Direccion contacto</label>
                                        <input type="text" class="form-control" id="direccion" name="direccion">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="telefono">Telefono contacto</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="email">Email contacto</label>
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
