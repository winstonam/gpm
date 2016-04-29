<style>
    #map-canvas3{
        width: 100%;
        height: 400px;
    }
    #map-canvas{
        width: 100%;
        height: 400px;
    }
</style>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="box-header">
                <h3 class="box-title">Clientes</h3>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Listado de Cliente
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                    <div class="dataTable_wrapper">
                             <table id="tabla_clientes" class="display" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Nombre Negocio</th>
                                    <th>Identificacion Contacto</th>
                                    <th>Nombre Contacto</th>
                                    <th>Apellidos Contacto</th>
                                    <th>Direccion Contacto</th>
                                    <th>Telefono Contacto</th>
                                    <th>Ruta</th>
                                    <th>Empresa</th>
                                    <th>Estado Negocio</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                                <tbody></tbody>
                            </table>
                    </div>
                    </div>
                    <br>
                    <div id="map-canvas3"></div>
                    <br>
                    <div class="pull-left">
                        <button disabled id="btn_editar" class="btn btn-success" data-toggle="modal"
                                data-target="#clienteModal">
                            <span class="glyphicon glyphicon-pencil"></span> Editar Cliente
                        </button>

                    </div>
                    <div class="pull-right">
                        <button id="btn_nuevo" class="btn btn-primary" data-toggle="modal"
                                data-target="#clienteModal">
                            <span class="glyphicon glyphicon-plus"></span> Registrar Cliente
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
<?php if(!empty($modals)) foreach($modals as $modal) echo $modal.'<br>'; ?>