<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<div class="box-header">
				<h3 class="box-title">Pedidos</h3>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Listado de Pedidos
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="dataTable_wrapper">
							<table id="tblAsignPedido" class="display" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Cliente</th>
										<th>Fecha</th>
										<th>Tipo Pago</th>
										<th>Estado</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
					<br/>
					<div class="pull-right">
						<button  id="btn_nuevo" class="btn btn-primary" data-toggle="modal"
						data-target="#mdlAsigPedido">
							<span class="glyphicon glyphicon-plus"></span> Registrar Producto
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php if (!empty($modals)) foreach ($modals as $modal) echo $modal . '<br>'; ?>