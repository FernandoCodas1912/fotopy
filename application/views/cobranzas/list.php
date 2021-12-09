<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		
		<?php
		if($this->session->flashdata("success")): ?>
			<div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert">
					&times;
				</button>
				<strong>
					¡Buen Trabajo!
				</strong>
				<p>
					<?php echo $this->session->flashdata("success")?>
				</p>
			</div>
			
		<?php endif; ?>
		<?php
		if($this->session->flashdata("error")): ?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">
					&times;
				</button>
				<strong>
					¡Error!
				</strong>
				<p>
					<?php echo $this->session->flashdata("error")?>
				</p>
			</div>
		<?php endif; ?>
		<!-- end row -->
		<div class="row">
			<div class="col-lg-12">
				<div class="card-box">
					<div class="col-md-2 pull-right">
						<a href="<?php echo base_url();?>Cobranzas_controller/add" class="btn btn-success"><i class="fa fa-plus"></i> <span>Nueva Cobranza</span> </a>
					</div>
					<h4 class="header-title m-t-0 m-b-30"> Listado de Cobranzas </h4>
					<div class="table-responsive">
						<table class="table" id="example3">
							<thead>
								<tr>
									<th>Op</th>
									<th>Fecha</th>
									<th>Cliente</th>
									<th>Abonado</th>
									<th>F.Pago</th>
									<th>Estado</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if(!empty($cobranzas)):?>
									<?php foreach($cobranzas as $cobranza):?>
										<tr>
											<td><?php echo $cobranza->id_cobro;?></td>
											<?php 
											$fecha = $cobranza->fecha;
											$fecha = date('d-m-Y', strtotime($fecha));
											$estado = $cobranza->cobro_estado;

											if($estado == 1)
											{
												$estado     = "Parcial";
												$label_class = 'label-info';
											}
											else
											{
												if($estado == 2)
												{
													$estado     = "Total";
													$label_class = 'label-success';
												}
												else
												{
													$estado     = "Anulado";
													$label_class = 'label-danger';
												}
											}

											?>
											<td><?php echo $fecha;?></td>
											<td><?php echo $cobranza->id_cliente." - ".$cobranza->razonsocial;?></td>
											<td><?php echo $cobranza->monto;?></td>
											<td><?php echo $cobranza->formadepago;?></td>
											<td><span class="label <?php echo $label_class;?>"><?php echo $estado; ?></span></td>
											<td>
												<a href="<?php echo base_url();?>Cobranzas_controller/view/<?php echo $cobranza->id_cobro;?>" class="btn btn-sm btn-primary" title="Ver y editar detalles de la cobranza">
													<i class="fa fa-eye">
													</i> Ver mas detalles
												</a>

												
											</td>
										</tr>

									<?php endforeach; ?>
								<?php endif; ?>	
							</tbody>
						</table>
					</div>
				</div>
			</div><!-- end col -->
		</div>
		<!-- end row -->
</div> <!-- container -->