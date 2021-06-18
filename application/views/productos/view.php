<?php
$estado = $producto->estado;
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
		Id Producto:
	</strong><?php echo $producto->id_producto; ?>
</p>
<p>
	<strong>
		Codigo:
	</strong><?php echo $producto->codigobarra; ?>
</p>

<p>
	<strong>
		Descripcion:
	</strong><?php echo $producto->descripcion; ?>
</p>
<p>
	<strong>
		Categoria:
	</strong><?php echo $producto->categoria; ?>
</p>

<p>
	<strong>
		Precio de Compra:
	</strong><?php echo $producto->precio_compra; ?>
</p>
<p>
	<strong>
		Precio de Venta:
	</strong><?php echo $producto->precio_venta; ?>
</p>
<p>
	<strong>
		Stock Actual:
	</strong><?php echo $producto->stock; ?>
</p>
<p>
	<strong>
		Stock Minimo:
	</strong><?php echo $producto->stock_minimo; ?>
</p>
<p>
	<strong>
		Impuesto:
	</strong><?php echo $producto->impuesto.'%'; ?>
</p>
<p>
	<strong>
		Estado:
	</strong>
	<span class="label <?php echo $label_class; ?>">
		<?php echo $estado2; ?>
	</span>
</p>