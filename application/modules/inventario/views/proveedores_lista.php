<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="box-header">
                <h3 class="box-title">Proveedores de productos</h3>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listado de Proveedores
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                    <div class="dataTable_wrapper">
                            <table id="tabla_proveedores" class="display" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Nombre Proveedor</th>
                                    <th>Contacto_Proveedor</th>
                                    <th>Direccion</th>
                                    <th>Numero_RUC</th>
                                    <th>Fecha Registro</th>
                                    <th>Estado</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                    </div>
                    </div>
                    <br>
                    <div class="pull-left">
                        <button disabled id="btn_editar" class="btn btn-success" data-toggle="modal"
                                data-target="#provsModal">
                            <span class="glyphicon glyphicon-pencil"></span> Editar datos Proveedor
                        </button>

                    </div>
                    <div class="pull-right">
                        <button id="btn_nuevo" class="btn btn-primary" data-toggle="modal"
                                data-target="#provsModal">
                            <span class="glyphicon glyphicon-plus"></span> Registrar Proveedor
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

