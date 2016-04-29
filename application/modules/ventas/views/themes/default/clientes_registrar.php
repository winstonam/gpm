<style>
    #map-canvas {
        width: 100%;
        height: 400px;
    }
</style>
<div class="modal fade" id="clienteModal" role="dialog" aria-labelledby="clienteModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="clienteModal">Formulario de Clientes</h4>
            </div>
            <div class="modal-body">
                <form id="formulario_clientes" method="POST"
                      action="<?php echo base_url() . ('ventas/clientes/guardar') ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id_cliente" value="" id="id_cliente">
                    <input type="hidden" name="id_persona" value="" id="id_persona">


                    <div class="row">
                        <div class="col-sm-6">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Datos Cliente</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <label for="nombre_negocio">Nombre Negocio <span
                                                        style="color:red;">*</span></label>
                                                <input type="text" class="form-control" id="nombre_negocio"
                                                       name="nombre_negocio">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="direccion_negocio">Direccion negocio <span
                                                        style="color:red;">*</span></label>
                                                <input type="text" class="form-control" id="direccion_negocio"
                                                       name="direccion_negocio">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="id_ruta">Ruta de venta <span
                                                        style="color:red;">*</span></label>
                                                <select class="form-control" id="id_ruta" name="id_ruta">
                                                    <option value="">Seleccionar Opción</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="cedula">DNI contacto <span
                                                        style="color:red;">*</span></label>
                                                <input type="text" class="form-control" required="required" id="cedula"
                                                       name="cedula">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="nombres">Nombre contacto <span
                                                        style="color:red;">*</span></label>
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
                        </div>
                        <div class="col-sm-6">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Ubicaci&oacute;n negocio</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div id="map-canvas"></div>
                                            <input readonly type="text" class="form-control" id="latitud"
                                                   name="latitud">
                                            <input readonly type="text" class="form-control" id="longitud"
                                                   name="longitud">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="btn_cancelar" type="button" class="btn btn-default" data-dismiss="modal">Cerrar
                                    </button>
                                    <button id="btn_guardar" type="button" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>


            </div>
        </div>
    </div>
</div>