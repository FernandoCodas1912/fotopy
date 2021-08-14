<?php
$estado = $servicio->estado;
// var_dump($servicio);
if ($estado == 1) {
    $estado2 = 'Activo';
    $label_class = 'label-success';
} else {
    if ($estado == 2) {
        $estado2 = 'Inactivo';
        $label_class = 'label-warning';
    } else {
        $estado2 = 'Anulado';
        $label_class = 'label-danger';
    }
}
?>
<p>
	<strong>
		Id Servicio:
	</strong><?php echo $servicio->id_producto; ?>
</p>
<p>
	<strong>
		Codigo:
	</strong><?php echo $servicio->codigobarra; ?>
</p>
<p>
	<strong>
		Descripcion:
	</strong><?php echo $servicio->descripcion; ?>
</p>
<p>
	<strong>
		Precio de Costo:
	</strong><?php echo $servicio->precio_compra; ?>
</p>
<p>
	<strong>
		Precio de Venta:
	</strong><?php echo $servicio->precio_venta; ?>
</p>
<p>
	<strong>
		Impuesto:
	</strong><?php echo $servicio->impuesto.'%'; ?>
</p>
<p>
	<strong>
		Estado:
	</strong>
	<span class="label <?php echo $label_class; ?>">
		<?php echo $estado2; ?>
	</span>
</p>