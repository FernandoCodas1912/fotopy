<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">	<!-- Start content-page -->
	<div class="content">	<!-- Start content -->
				<section id="description" class="card">
					<div class="card-header">
						<div class="col-md-12">
							<h4 class="card-title"><i class="icon-layers"></i> REPORTE DE VENTAS POR RANGO DE FECHAS</h4>
						</div>
						<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
						<div class="heading-elements">
							<ul class="list-inline mb-0">
								<li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
								<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
								<li><a data-action="reload"><i class="icon-reload"></i></a></li>
								<li><a data-action="close"><i class="icon-cross2"></i></a></li>
							</ul>
						</div>
					</div>

					<div class="card-body collapse in">
						<div class="card-block">
							
								<form class="form form-group" role="form" id="reporte" action="<?php echo base_url();?>Ventas_controller/generarreporte" method="post">		
									<div class="row">
										<div class="col-md-3">
											<label for="">Fecha Inicio</label>
											<div class="input-group date" id="divMiCalendario">
												<input type="text" id="fechaini" class="form-control" name="fechaini" value="" >
												<span class="input-group-addon">
													<span class="glyphicon-calendar glyphicon"></span>
												</span> 
											</div>
										</div>
										<div class="col-md-3">
											<label for="">Fecha Fin</label>
											<div class="input-group date" id="divMiCalendario2">
												<input type="text" id="fechafin" class="form-control" name="fechafin" value="" >
												<span class="input-group-addon">
													<span class="glyphicon-calendar glyphicon"></span>
												</span> 
											</div>
										</div>
										<div class="col-md-3">
											<label for="">Cliente</label>
											<select id="projectinput5" name="id_cliente" class="form-control" required="">
												<option value="" selected="" disabled="">Seleccione</option>
												<option value="">Todos</option>
												<?php foreach($clientes as $cliente):?>
													<option value="<?php echo $cliente->id_cliente;?>"> <?php echo $cliente->razonsocial; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="col-md-3">
											<label for=""></label>
											<button type="submit" id="btn_add_products" class="btn btn-block btn-lg btn-success">
												<span class="glyphicon glyphicon-cog"></span> GENERAR REPORTE
											</button>
										</div>
									</div>
								</form>	
							</div><!-- TERMINA FORM BODY-->
						</div><!-- TERMINA CARD BLOQ -->
					

				</section>
				<?php if(!empty($reporteventas)):?>
					<div class="table-responsive">
									<table class="table table-bordered table-hover" id="example3">
										<thead class="table-info">
											<tr>
												<th>Fecha</th>
												<th>Cliente</th>
												<th>F.Pago</th>
												<th>Monto</th>
												<th>Usuario</th>
											</tr>
										</thead>
										<tbody>
											<?php 	$total=0; ?>
											<?php foreach($reporteventas as $reporteventa):?>
												<tr>
													<?php 
													$fecha_formateada = $reporteventa->fecha;
													$fecha_formateada = date('d-m-Y', strtotime($fecha_formateada));
													$monto=$reporteventa->total;
													$total=$total+$reporteventa->total;
													?>
													<td><?php echo $fecha_formateada;?></td>
													<td><?php echo $reporteventa->razonsocial;?></td>
													<td><?php echo $reporteventa->descripcion;?></td>
													<td ><?php echo number_format(($monto),0,",",".") ?></td>
													<td><?php echo $reporteventa->username;?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
										<tfoot>
											<tr>
												<th> </th>
												<th> </th>
												<th  class="text-right">TOTAL</th>
												<th><?php echo number_format(($total),0,",",".") ?></th>
												<th> </th>
											</tr>
										</tfoot>	
									</table>
								</div>
							</div>
						</div><!-- end col -->
					</div><!--TERMINA DIV TABLE RESPONSIVE -->
					<?php endif; ?>	