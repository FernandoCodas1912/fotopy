<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container">
		
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
								<!--/ TERMINA MENSAJE DE GUARDADO O ERROR -->
							</div>
								<div class="card-box"><!--inicio card box -->
			<h4 class="header-title m-t-0 m-b-30">Nueva Venta</h4>
			<div class="form-group row">
		<form class="form" role="form" id="ventas" action="<?php echo base_url();?>Ventas_controller/view" method="post">		
									
									<div class="row">
										<div class="col-xs-8">
											<b> CLIENTE </b><br>
											<b>Nombre: </b><?php echo $venta->cliente; ?><br>
											<b>Nro.Doc.: </b><?php echo number_format(($venta->nrodocumento),0,",",".")?><br>
											<b>Telefono: </b><?php echo $venta->telefono; ?><br>
											<b>Direccion : </b><?php echo $venta->direccion; ?><br>
										</div>
										<div class="col-xs-4">
											<?php 
			//formateamos el tipo de comprobante
											$tipo = $venta->tipocomprobante;
											if($tipo == 1)
											{
												$tipo2     = "Factura";$label_class2 = 'label-success';
											}
											else
											{
												$tipo2     = "Boleta";$label_class2 = 'label-warning';
											}
											?>


											<b> OPERACION </b><br>
											<b>ID: </b><?php echo $venta->id_venta; ?><br>
											<b>Comprobante: </b><?php echo $tipo2 ; ?><br>
											<b>Serie: </b><?php echo $venta->seriecomprobante; ?><br>
											<b>Nro: </b><?php echo $venta->nrocomprobante; ?><br>
											<b>Fecha Op: </b><?php echo date('d-m-Y', strtotime($venta->fecha));?><br>

										</div>

									</div>	

									<br>
									<br>
									<br>
							   	<div class="pull-right">
									
									 <button type="button" class="btn btn-success btn-sm btn-generar-print" data-toggle="modal" data-target="#modal-print" value="<?php echo $venta->id_venta;?>" title="Generar comprobante"><i class="fa fa-print"></i> Vista Impresion
									</button>
									
									<a href="<?php echo base_url();?>Ventas_controller/delete/<?php echo $venta->id_venta;?>"
										<button type="button" class="btn btn-danger btn-sm btn-delete" value="<?php echo $venta->id_venta;?>" title="Anular"><i class="fa fa-trash-o"></i> Anular
										</button>
									</a>
									
									<a href="<?php echo base_url();?>Ventas_controller"
									<button type="button" class="btn btn-primary btn-sm" title="Regresar al listado"><i class="fa fa-arrow-left"></i> Regresar
									</button>
									</a>
								</div>
									<br>
									<div class="row">
										<div class="col-xs-12">
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
													if(!empty($detalles)):?>
														<?php foreach($detalles as $detalle):?>
															<tr>	
																<td><?php echo $detalle->codigobarra;?></td>
																<td align="center"><?php echo number_format(($detalle->cantidad),0,",",".")?></td>
																<td><?php echo $detalle->producto;?></td>
																<td><?php echo number_format(($detalle->precio),0,",",".")?></td>
																<td><?php echo number_format(($detalle->importe),0,",",".")?></td>
															</tr>
														<?php endforeach; ?>
													<?php endif; ?>	
												</tbody>
												<tfoot>

													<tr>
														<td colspan="4" class="text-right" ><strong><label class="text text-gray-dark">TOTAL GENERAL: </label></strong></td>
														<td><label class="label label-default"><?php echo number_format(($venta->total),0,",",".")?></label></td>
													</tr>
												</tfoot>
											</table>
										</div>
									</div>

									<!-- Modal //print comprobante--> 
									<div class="modal bs-example-modal-xs" id="modal-print" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
										<div class="modal-dialog modal-xs" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title"  id="myModalLabel">COMPROBANTE DE VENTA</h4>
												</div>
												<div class="modal-body">
													<!--/ CARGA CONTENIDO DESDE VISTA -->
												</div>
												<div class="modal-footer">
														<button type="button" class="btn btn-success btn-print">Imprimir <?php echo $tipo2 ?></button>
														<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
												</div>			
											</div><!-- Fin Modal content--> 
										</div><!-- Fin Modal dialog--> 
									</div><!-- Fin Modal--> 