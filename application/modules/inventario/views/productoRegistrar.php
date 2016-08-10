<div class="modal fade" id="mdlProducto"  role="dialog" aria-labelledby="mdlProducto">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" arial-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-tittle" id="mdlProducto">Formulario Producto</h4>
			</div>
			<div class="modal-body">
				<form id="formulario_producto" method="POST" action="<?php echo base_url().('inventario/productos/guardar') ?>" enctype="multipart/form-data">
					<input type="hidden" name="id_producto" value="" id="id_producto"/>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<div class="col-sm-6">
										<label for="codigo">Codigo<span style="color:red;">*</span></label>
										<input type="text" class="form-control" id="codigo" name="codigo">
									</div>
									<div class="col-sm-6">
										<label for="nombre_producto">Nombre Producto <span style="color:red;">*</span></label>
										<input type="text" class="form-control" id="nombre_producto" name="nombre_producto">
									</div>
									<div class="col-sm-6">
										<label for="precio">Precio <span style="color:red;">*</span></label>
										<input type="text" class="form-control" id="precio" name="precio_sugerido">
									</div>
									<div class="col-sm-6">
										<label for="existencia">Existencia<span style="color:red;">*</span></label>
										<input type="text" class="form-control" id="existencia" name="existencia_max">
									</div>
									<div class="col-sm-6">
										<label for="estado">Estado <span style="color:red;">*</span></label>
										<select class="form-control" id="estado" name="estado">
										<option value="">Seleccionar Estado</option>
										<option value="0">Inactivo</option>
										<option value="1">Activo</option>
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