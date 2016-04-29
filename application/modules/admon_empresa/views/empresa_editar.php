<?php
/**
 * Created by PhpStorm.
 * User: AlienRta2015
 * Date: 25/03/2016
 * Time: 09:42 PM
 */
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="box-header">
                <h3 class="box-title">Empresa</h3>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Datos empresa actual
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <input type="hidden" name="est" value="<?php echo $empresa['estado'] ?>"
                           id="est">
                    <input type="hidden" name="id_paq" value="<?php echo $empresa['id_paquete'] ?>"
                           id="id_paq">
                    <form id="formulario_empresas" method="POST"
                          action="<?php echo base_url() . ('admon_empresa/empresa/actualizar') ?>"
                          enctype="multipart/form-data">
                        <input type="hidden" name="id_empresa" value="<?php echo $empresa['id_empresa'] ?>"
                               id="id_empresa">
                        <input type="hidden" name="id_persona" value="<?php echo $empresa['id_persona'] ?>"
                               id="id_persona">

                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <label for="Nombre_Empresa">Nombre empresa <span
                                                    style="color:red;">*</span></label>
                                            <input disabled type="text" class="form-control" id="Nombre_Empresa"
                                                   name="Nombre_Empresa"
                                                   value="<?php echo $empresa['Nombre_Empresa'] ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="Direccion_empresa">Direccion empresa <span
                                                    style="color:red;">*</span></label>
                                            <input disabled type="text" class="form-control" id="Direccion_empresa"
                                                   name="Direccion_empresa"
                                                   value="<?php echo $empresa['Direccion_empresa'] ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="id_paquete">Paquete sistema <span
                                                    style="color:red;">*</span></label>
                                            <select disabled class="form-control" id="id_paquete" name="id_paquete">                                                    >
                                                <option value="">Seleccionar Opci&oacute;n</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="cedula">Numero de identificacion contacto <span
                                                    style="color:red;">*</span></label>
                                            <input disabled type="text" class="form-control" required="required" id="cedula"
                                                   name="cedula" value="<?php echo $empresa['cedula'] ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="nombres">Nombre contacto <span
                                                    style="color:red;">*</span></label>
                                            <input disabled type="text" class="form-control" id="nombres" name="nombres"
                                                   value="<?php echo $empresa['nombres'] ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="primer_apellido">Primer apellido contacto <span
                                                    style="color:red;">*</span></label>
                                            <input disabled type="text" class="form-control" id="primer_apellido"
                                                   name="primer_apellido"
                                                   value="<?php echo $empresa['primer_apellido'] ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="segundo_apellido">Segundo apellido contacto</label>
                                            <input disabled type="text" class="form-control" id="segundo_apellido"
                                                   name="segundo_apellido"
                                                   value="<?php echo $empresa['segundo_apellido'] ?>">
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="direccion">Direccion contacto</label>
                                            <input disabled type="text" class="form-control" id="direccion" name="direccion"
                                                   value="<?php echo $empresa['direccion'] ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="telefono">Telefono contacto</label>
                                            <input disabled type="text" class="form-control" id="telefono" name="telefono"
                                                   value="<?php echo $empresa['telefono'] ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="email">Email contacto</label>
                                            <input disabled type="text" class="form-control" id="email" name="email"
                                                   value="<?php echo $empresa['email'] ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="estado">Estado <span style="color:red;">*</span></label>
                                            <select disabled class="form-control" id="estado" name="estado"
                                                    >
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
                    <br>
                    <div class="pull-left">
                        <button  id="btn_editar" class="btn btn-success" >
                            <span class="glyphicon glyphicon-pencil"></span> Editar Empresa
                        </button>

                    </div>
                    <div class="pull-right">
                        <button disabled id="btn_guardar" class="btn btn-primary">
                            <span class="glyphicon glyphicon-plus"></span> Actualizar datos Empresa
                        </button>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
<!-- /#page-wrapper -->
<!-- MODALES -->
<?php if (!empty($modals)) foreach ($modals as $modal) echo $modal . '<br>'; ?>

