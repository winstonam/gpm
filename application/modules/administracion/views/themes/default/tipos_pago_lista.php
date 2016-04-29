<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="box-header">
                <h3 class="box-title">Tipos de pago</h3>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listado de tipos de pago
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                            <table id="tabla_tipos_pago" class="display" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Descripcion</th>
                                    <th>Descripcion corta</th>
                                    <th>Ultima fecha modificacion</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                    </div>
                    <br>
                    <div class="pull-left">
                        <button disabled id="btn_editar_tipo_pago" class="btn btn-success" data-toggle="modal"
                                data-target="#tpagosModal">
                            <span class="glyphicon glyphicon-pencil"></span> Editar Tipo de pago
                        </button>

                    </div>
                    <div class="pull-right">
                        <button id="btn_nuevo_tipo_pago" class="btn btn-primary" data-toggle="modal"
                                data-target="#tpagosModal">
                            <span class="glyphicon glyphicon-plus"></span> Registrar Tipo de pago
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

