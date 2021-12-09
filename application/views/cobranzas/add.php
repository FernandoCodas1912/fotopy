<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
	<!-- Start content-page -->
	<div class="content">
		<!-- Start content -->
		<div class="container">
			<?php
			if ($this->session->flashdata("success")) : ?>

				<div class="alert alert-success" role="alert">
					<button type="button" class="close" data-dismiss="alert">
						&times;
					</button>
					<strong>
						¡Buen Trabajo!
					</strong>
					<p>
						<?php echo $this->session->flashdata("success") ?>
					</p>
				</div>

			<?php endif; ?>
			<?php
			if ($this->session->flashdata("error")) : ?>

				<div class="alert alert-danger" role="alert">
					<button type="button" class="close" data-dismiss="alert">
						&times;
					</button>
					<strong>
						¡Error!
					</strong>
					<p>
						<?php echo $this->session->flashdata("error") ?>
					</p>
				</div>
			<?php endif; ?>
		</div>

		<div class="card-box">
			<!--inicio card box -->
			<h4 class="header-title m-t-0 m-b-30">Cobranza</h4>
			<div class="form-group row">
				<form class="form-horizontal" role="form" id="datos_factura_cobranzas" action="<?php echo base_url(); ?>Cobranzas_controller/store" method="post">

					<div class="form-group">

						<label for="nombre" class="col-md-1 control-label">Cliente</label>
						<div class="form-group col-md-3 col-sm-12 col-xs-12">
							<span class="input-group-btn">

								<input type="hidden" id="id_cliente" name="id_cliente" class="" placeholder="">
								<input type="text" id="razonsocial_cliente" class="form-control col-md-2" placeholder="" readonly="">

								<button type="button" class="btn waves-effect waves-light btn-primary" data-toggle="modal" data-target="#modal-buscar-cliente"><i class="fa fa-search"></i>Buscar Cliente</button>
							</span>
						</div>

						<label for="ventas" class="col-md-2 col-sm-12 col-xs-12 control-label">Venta</label>
						<div class="input-group col-md-2 col-sm-12 col-xs-12 pull-left">
							<!--combo dinamico al seleccionar cliente-->
							<select class='form-control' name="id_venta" id="ventas">
								<option value="" selected="" disabled="">Seleccione</option>
							</select>
						</div>
					</div>

					<h4 class="header-title m-t-0 m-b-30">Detalle de Venta</h4>
					<div class="form-group table-responsive">
						<!-- tabla item de productos agregados -->
						<table id="tbcobranzas" class="table table-bordered  table-hover">
							<thead>
								<td>Codigo</td>
								<td>Descripcion</td>
								<td>Cantidad</td>
								<td>Precio</td>
								<td>Total</td>
							</thead>
							<tbody>
								<!-- esto se carga desde el footer -->
							</tbody>
						</table>
						<!-- fin tabla item de productos agregados -->
					</div>
					<div class="form-group">
						<div class="col-md-3 pull-right">
							<div class="input-group m-t-10">
								<span class="input-group-addon">Total Iva Incl. </span>
								<div class="form-control totales"></div>
								<input type="hidden" class="hidden totales" name="total_venta" value="">
								<span class="input-group-addon"> Gs.</span>
							</div>
						</div>
					</div>

					<div id="datos-cobranza" style="display: none;">
						<hr>
	
						<h4 class="header-title m-t-0 m-b-30">Detalle de Cobro</h4>
	
						<div class="row">
							<div class="col-xs-12 col-md-6 col-lg-4 col-md-offset-3" style="margin: 0px 15px;">
								<div class="form-group">
									<label for="id_formapago" class="control-label">Medio de Pago:</label>
									<select class="form-control" name="id_formapago" id="id_formapago">
										<option value="" selected="" disabled="">Seleccione</option>
	
										<?php foreach ($formapago as $pago) : ?>
										<option value="<?php echo $pago->id_formapago; ?>">
											<?php echo $pago->id_formapago . "-" . $pago->descripcion; ?> </option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							
							<div class="col-xs-12 col-md-6 col-lg-4" style="margin: 0px 15px;">
								<div class="form-group">
									<label for="monto_entregado" class="control-label">Monto Entregado:</label>
									<input type="text" class="form-control onlyNumbers" id="monto_entregado" name="monto_entregado">
								</div>
							</div>
						</div>
						
						<div class="row" style="position: relative;">
							<div class="col-xs-12 col-md-6 col-md-offset-3">
								<span class="h3" style="position: absolute;left: 50%;transform: translateX(-50%);" id="vuelto-ttl">Vuelto</span>
							</div>
							<div class="col-xs-12 col-md-6 col-md-offset-3" style="margin-top: 40px;margin-bottom: 60px;">
								<span class="bg-primary h3 text-center text-white" id="vuelto-amnt" style="padding: 1rem 3rem;position: absolute;left: 50%;transform: translateX(-50%);">0</span>
							</div>
						</div>
	
						<div class="form-group">
							<div class="col-md-2 pull-right">
								<div class="input-group m-t-10">
									<button type="submit" class="btn btn-success" id="iniciar_cobranza">
										<span class="glyphicon glyphicon-ok"></span> Gestionar Cobranza
									</button>
								</div>
							</div>
						</div>
					</div>

				</form>
			</div>
		</div>
		<!-- Modal // buscar cliente cambiar clase por modal fade si queres con efectos-->
		<div class="modal bs-example-modal-xs" id="modal-buscar-cliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Buscar Clientes </h4>
					</div>
					<div class="modal-body">
						<table id="example1" class="table table-bordered table-hover">
							<thead>
								<td>Nro. documento</td>
								<td>Nombre y Apellido</td>
								<td>Acciones</td>
							</thead>
							<tbody>
								<?php
								if (!empty($clientes)) : ?>
									<?php foreach ($clientes as $cliente) : ?>
										<tr>
											<td><?php echo $cliente->id_cliente . " - " . $cliente->nrodocumento; ?></td>
											<td><?php echo $cliente->razonsocial; ?></td>
											<?php $datacliente = $cliente->id_cliente . "*" . $cliente->razonsocial; ?>
											<td>
												<!-- usa del modelo la funcion correspondiente -->
												<button type="button" class="btn btn-success btn-check" value="<?php echo $datacliente; ?>"><i class="fa fa-check"></i>
												</button>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>