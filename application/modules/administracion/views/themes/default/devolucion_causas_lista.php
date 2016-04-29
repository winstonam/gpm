<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="box-header">
                <h3 class="box-title">Causas devoluci&oacute;n</h3>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listado de causas devoluci&oacute;n
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                            <table id="tabla_dc" class="display" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Descripci&oacute;n</th>
                                    <th>Fecha modificaci&oacute;n</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                    </div>
                    <br>
                    <div class="pull-left">
                        <button disabled id="btn_editar" class="btn btn-success" data-toggle="modal"
                                data-target="#dcModal">
                            <span class="glyphicon glyphicon-pencil"></span> Editar causa devoluci&oacute;n
                        </button>

                    </div>
                    <div class="pull-right">
                        <button id="btn_nuevo" class="btn btn-primary" data-toggle="modal"
                                data-target="#dcModal">
                            <span class="glyphicon glyphicon-plus"></span> Registrar causas devoluci&oacute;n
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

