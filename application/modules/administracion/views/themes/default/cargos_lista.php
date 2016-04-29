<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="box-header">
                <h3 class="box-title">Cargos</h3>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listado de Cargos
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                            <table id="tabla_cargos" class="display" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Descripcion</th>
                                    <th>Nivel Acceso</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                    </div>
                    <br>
                    <div class="pull-left">
                        <button disabled id="btn_editar_cargo" class="btn btn-success" data-toggle="modal"
                                data-target="#cargosModal">
                            <span class="glyphicon glyphicon-pencil"></span> Editar Cargo
                        </button>

                    </div>
                    <div class="pull-right">
                        <button id="btn_nuevo_cargo" class="btn btn-primary" data-toggle="modal"
                                data-target="#cargosModal">
                            <span class="glyphicon glyphicon-plus"></span> Registrar Cargo
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

