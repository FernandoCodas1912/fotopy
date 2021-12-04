<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
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
			<!-- end row -->
			<!--/ TERMINA MENSAJE DE GUARDADO O ERROR -->
		</div>
		<div class="card-box">
			<!--inicio card box -->
			<h4 class="header-title m-t-0 m-b-30">Cobranza</h4>

			<div class="row">
				<div class="col-xs-8">
					<b> CLIENTE </b><br>
					<b>Nombre: </b><?php echo $venta->cliente; ?><br>
					<b>Nro.Doc.: </b><?php echo number_format(($venta->nrodocumento), 0, ",", ".") ?><br>
					<b>Telefono: </b><?php echo $venta->telefono; ?><br>
					<b>Direccion : </b><?php echo $venta->direccion; ?><br>
				</div>
				<div class="col-xs-4">
					<?php
					//formateamos el tipo de comprobante
					$tipo = $venta->tipocomprobante;
					if ($tipo == 1) {
						$tipo2     = "Factura";
						$label_class2 = 'label-success';
					} else {
						$tipo2     = "Boleta";
						$label_class2 = 'label-warning';
					}
					?>


					<b>DATOS DE VENTA </b><br>
					<b>ID: </b><?php echo $venta->id_venta; ?><br>
					<b>Comprobante: </b><?php echo $tipo2; ?><br>
					<b>Serie: </b><?php echo $venta->seriecomprobante; ?><br>
					<b>Nro: </b><?php echo $venta->nrocomprobante; ?><br>
					<b>Fecha Op: </b><?php echo date('d-m-Y', strtotime($venta->fecha)); ?><br>

				</div>

			</div>

			<br>
			<br>
			<br>
			<div class="pull-right">

				<?php if($cobranza->estado != 3){ ?>
					<a href="<?php echo base_url(); ?>Cobranzas_controller/delete/<?php echo $cobranza->id_cobro; ?>">
						<button type="button" class="btn btn-danger btn-sm btn-delete" value="<?php echo $cobranza->id_cobro; ?>" title="Anular">
							<i class="fa fa-trash-o"></i> Anular
						</button>
					</a>
				<?php } ?>

				<a href="<?php echo base_url(); ?>Cobranzas_controller"> <button type="button" class="btn btn-primary btn-sm" title="Regresar al listado"><i class="fa fa-arrow-left"></i> Regresar
					</button>
				</a>
			</div>
			<br>
			<div class="row">
				<div class="col-xs-12">
					<h4 class="header-title m-t-0 m-b-30">Detalle de Venta</h4>
					<table class="table table-bordered">
						<thead class="thead-inverse">
							<tr>
								<th>CODIGO</th>
								<th>CANT.</th>
								<th>NOMBRE PRODUCTO</th>
								<th>PRECIO UNIT</th>
								<th>IMPORTE</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if (!empty($detalles)) : ?>
								<?php foreach ($detalles as $detalle) : ?>
									<tr>
										<td><?php echo $detalle->codigobarra; ?></td>
										<td align="center"><?php echo number_format(($detalle->cantidad), 0, ",", ".") ?></td>
										<td><?php echo $detalle->producto; ?></td>
										<td><?php echo number_format(($detalle->precio), 0, ",", ".") ?></td>
										<td><?php echo number_format(($detalle->importe), 0, ",", ".") ?></td>
									</tr>
								<?php endforeach; ?>
							<?php endif; ?>
						</tbody>
						<tfoot>

							<tr>
								<td colspan="4" class="text-right"><strong><label class="text text-gray-dark">TOTAL GENERAL: </label></strong></td>
								<td><label class="label label-default"><?php echo number_format(($venta->total), 0, ",", ".") ?></label></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>


			<hr>


			<div class="row">
				<div class="col-lg-12">
					<h4 class="header-title m-t-0 m-b-30">Listado de Cobranzas para la Venta</h4>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Op</th>
									<th>Fecha</th>
									<th>Abonado</th>
									<th>F.Pago</th>
									<th>Estado</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$cobrado_total = 0;
								if (!empty($otras_cobranzas)) : ?>
									<?php foreach ($otras_cobranzas as $cobro) :
										if($cobro->estado != 3){
											$cobrado_total += $cobro->monto;
										}
									?>
										<tr>
											<td><?php echo $cobro->id_cobro; ?></td>
											<?php
											$fecha = $cobro->fecha;
											$fecha = date('d-m-Y', strtotime($fecha));
											$estado = $cobro->cobro_estado;

											if ($estado == 1) {
												$estado     = "Parcial";
												$label_class = 'label-info';
											} else {
												if ($estado == 2) {
													$estado     = "Total";
													$label_class = 'label-success';
												} else {
													$estado     = "Anulado";
													$label_class = 'label-danger';
												}
											}

											?>
											<td><?php echo $fecha; ?></td>
											<td><?php echo $cobro->monto; ?></td>
											<td><?php echo $cobro->formadepago; ?></td>
											<td><span class="label <?php echo $label_class; ?>"><?php echo $estado; ?></span></td>
											<td>
												<?php if ($cobro->id_cobro != $cobranza->id_cobro) { ?>
													<a href="<?php echo base_url(); ?>Cobranzas_controller/view/<?php echo $cobro->id_cobro; ?>" class="btn btn-sm btn-primary" title="Ver y editar detalles de la cobranza">
														<i class="fa fa-eye">
														</i> Ver mas detalles
													</a>
												<?php } else { ?>
													<span class="label label-info">Vista Actual</span>
												<?php } ?>
											</td>
										</tr>

									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>

							<tfoot>
								<tr>
									<td colspan="5" class="text-right"><strong><label class="text text-gray-dark"> <small>(No se consideran los montos anulados)</small> TOTAL GENERAL:</label></strong></td>
									<td><label class="label label-default"><?php echo number_format(($cobrado_total), 0, ",", ".") ?></label></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div><!-- end col -->
			</div>