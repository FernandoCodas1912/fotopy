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
        <b> CLIENTE </b><br>
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
		} else {
			$tipo2     = "Boleta";
			$label_class2 = 'label-warning';
		}
		?>
        <b> OPERACION </b><br>
        <hr>
        <b>Comprobante: </b><?php echo $tipo2; ?><br>
        <b>Nro: </b><?php echo $venta->seriecomprobante; ?>-<?php echo $venta->nrocomprobante; ?> <br>
        <b>Fecha Op: </b><?php echo date('d-m-Y', strtotime($venta->fecha)); ?><br>

    </div>

</div>

<br>
<div class="row">
    <div class="col-xs-12">
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>Cod.</th>
                    <th>Cant.</th>
                    <th>Producto</th>
                    <th>P. Unit</th>
                    <th>Exento</th>
                    <th>5%</th>
                    <th>10%</th>
                </tr>
            </thead>
            <tbody>
                <?php
				if (!empty($detalles)) : ?>
                <?php
					$sumadorIva10 = 0;
					$sumadorIva5 = 0;
					$total_iva10 = 0;
					$total_iva5 = 0;
					$suma_ivas = 0;

					?>
                <?php foreach ($detalles as $detalle) : ?>
                <?php
						//formateamos el Impuesto
						$impuesto = $detalle->impuesto;
						if ($impuesto == '10') {
							$calculariva10 = $detalle->importe / 11;
							$sumadorIva10 = $sumadorIva10 + $calculariva10;
						} elseif ($impuesto == '5') {
							$calculariva5 = $detalle->importe / 21;
							$sumadorIva5 += $calculariva5;
						}

						?>
                <tr class="text-center">
                    <td><?php echo $detalle->codigobarra; ?></td>
                    <td align="center"><?php echo number_format(($detalle->cantidad), 0, ",", ".") ?></td>
                    <td><?php echo $detalle->producto; ?></td>
                    <td><?php echo number_format(($detalle->precio), 0, ",", ".") ?></td>
                    <td><?php if ($impuesto == '0') {
									echo number_format(($detalle->importe), 0, ",", ".");
								} else {
									echo "0";
								} ?></td>
                    <td><?php if ($impuesto == '5') {
									echo number_format(($detalle->importe), 0, ",", ".");
								} else {
									echo "0";
								} ?></td>
                    <td><?php if ($impuesto == '10') {
									echo number_format(($detalle->importe), 0, ",", ".");
								} else {
									echo "0";
								} ?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
            <?php
			$total_iva10 += $sumadorIva10;
			$total_iva5 += $sumadorIva5;
			$suma_ivas = $total_iva5 + $total_iva10;
			?>
            <tfoot>
                <tr>
                    <td colspan="6" class="text-right"><strong>TOTAL: </strong></td>
                    <td><?php echo number_format(($venta->total), 0, ",", ".") ?></td>
                </tr>
                <tr>
                    <td class='text-right' colspan=3><b> Liquidacion del Impuesto </b></td>
                    <td class='text-left'> (Exento) <b> 0</b></td>
                    <td class='text-left'> Iva(5%) : <b><?php echo number_format(($total_iva5), 0, ",", "."); ?></b>
                    </td>
                    <td class='text-left'> Iva(10%) : <b><?php echo number_format(($total_iva10), 0, ",", "."); ?></b>
                    </td>
                    <td class='text-left'>Total Iva : <b><?php echo number_format(($suma_ivas), 0, ",", "."); ?></b>
                    </td>

                </tr>
            </tfoot>
        </table>
    </div>
</div>