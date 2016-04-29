<style>
    #mapa-clientes-ruta{
        width: 100%;
        height: 400px;
    }
</style>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="box-header">
                <h3 class="box-title">Rutas de venta</h3>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listado de Rutas de venta
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                    <div class="dataTable_wrapper">
                            <table id="tabla_rutas" class="display" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Nombre Ruta</th>
                                    <th>Empresa</th>
                                    <th>Fecha modificacion</th>
                                    <th>Estado</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        <br>
                        <div id="mapa-clientes-ruta"></div>
                        <br>
                    </div>
                    </div>
                    <br>
                    <div class="pull-left">
                        <button disabled id="btn_editar" class="btn btn-success" data-toggle="modal"
                                data-target="#rutasModal">
                            <span class="glyphicon glyphicon-pencil"></span> Editar Ruta de venta
                        </button>

                    </div>
                    <div class="pull-right">
                        <button id="btn_nuevo" class="btn btn-primary" data-toggle="modal"
                                data-target="#rutasModal">
                            <span class="glyphicon glyphicon-plus"></span> Registrar Ruta de venta
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

