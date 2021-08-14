<div class="row">
	<div class="col-xs-12 text-center">
		<h2><b><?php echo $empresa->nombre; ?></b><br></h2>
		<h4>"<?php echo $empresa->slogan; ?>"</h4>
		<?php echo $empresa->direccion ?><br>
		Wsp <?php echo $empresa->telefono ?><br>
		<?php echo $empresa->email ?> <br>
		<?php echo $empresa->sitioweb ?> <br><br>
	</div>
</div>



<div class="row">
	<div class="col-xs-8">
		<b> PROVEEDOR </b><br>
		<hr>
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
		} elseif ($tipo == 2) {
			$tipo2     = "Boleta";
			$label_class2 = 'label-warning';
		} else {
			$tipo2     = "Presupuesto";
			$label_class2 = 'label-primary';
		}
		?>
		<b> OPERACION </b><br>
		<hr>
		<b>Comprobante: </b><?php echo $tipo2; ?><br>
		<b>Serie: </b><?php echo $venta->seriecomprobante; ?><br>
		<b>Nro: </b><?php echo $venta->id_venta; ?><br>
		<b>Fecha Op: </b><?php echo date('d-m-Y', strtotime($venta->fecha)); ?><br>

	</div>

</div>

<br>
<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<thead>
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
					<td colspan="4" class="text-right"><strong>TOTAL: </strong></td>
					<td><?php echo number_format(($venta->total), 0, ",", ".") ?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>