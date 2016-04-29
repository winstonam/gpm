<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="box-header">
                <h3 class="box-title">Categor&iacute;a de productos</h3>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listado de categor&iacute;s de productos
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                            <table id="tabla_cat_prods" class="display" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Nombre categor&iacute;a</th>
                                    <th>Descripci&oacute;n</th>
                                    <th>Ultima fecha modificaci&oacute;n</th>
                                    <th>Estado</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                    </div>
                    <br>
                    <div class="pull-left">
                        <button disabled id="btn_editar" class="btn btn-success" data-toggle="modal"
                                data-target="#catprodModal">
                            <span class="glyphicon glyphicon-pencil"></span> Editar categor&iacute;a
                        </button>

                    </div>
                    <div class="pull-right">
                        <button id="btn_nuevo" class="btn btn-primary" data-toggle="modal"
                                data-target="#catprodModal">
                            <span class="glyphicon glyphicon-plus"></span> Registrar categor&iacute;a
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

