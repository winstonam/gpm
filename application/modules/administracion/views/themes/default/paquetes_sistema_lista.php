<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="box-header">
                <h3 class="box-title">Paquetes sistema</h3>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listado de Paquetes sistema
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                            <table id="tabla_paquetes" class="display" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Nombre Paquete</th>
                                    <th>Cantidad usuarios moviles</th>
                                    <th>Precio Mensual</th>
                                    <th>Ultima fecha modificacion</th>
                                    <th>Estado</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                    </div>
                    <br>
                    <div class="pull-left">
                        <button disabled id="btn_editar" class="btn btn-success" data-toggle="modal"
                                data-target="#psistemaModal">
                            <span class="glyphicon glyphicon-pencil"></span> Editar Paquete sistema
                        </button>

                    </div>
                    <div class="pull-right">
                        <button id="btn_nuevo" class="btn btn-primary" data-toggle="modal"
                                data-target="#psistemaModal">
                            <span class="glyphicon glyphicon-plus"></span> Registrar Paquete sistema
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

