<div class="modal fade" id="mdlAsigPedido"  role="dialog" aria-labelledby="mdlAsigPedido">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" arial-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-tittle" id="mdlAsigPedido">Formulario Asignacion de Pedido</h4>
			</div>
			<div class="modal-body">
				<form id="formulario_pedidoReg" method="POST" action="<?php echo base_url().('inventario/productos/guardar') ?>" enctype="multipart/form-data">
					<input type="hidden" name="id_pedido" value="" id="id_pedido"/>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<div class="col-sm-6">
										<label for="codigo">Cliente<span style="color:red;">*</span></label>
										<input type="text" class="form-control" id="cliente" name="cliente" readonly="true">
									</div>
									<div class="col-sm-6">
										<label for="nombre_producto">Fecha Pedido <span style="color:red;">*</span></label>
										<input type="text" class="form-control" id="fecha" name="fecha" readonly="true">
									</div>
									<div class="col-sm-6">
										<label for="precio">Tipo Pago <span style="color:red;">*</span></label>
										<input type="text" class="form-control" id="tipoPago" name="tipoPago" readonly="true">
									</div>
									<div class="col-sm-6">
										<label for="estado">Reparitdor <span style="color:red;">*</span></label>
										<select class="form-control" id="id_repartidor" name="id_repartidor">
										<option value="">Seleccionar Repartidor</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
			                <button id="btn_cancelar" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			                <button id="btn_guardar" type="button" class="btn btn-primary">Guardar</button>
		            </div>
		</div>
	</div>
</div>