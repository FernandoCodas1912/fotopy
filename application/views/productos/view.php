<?php
$estado = $productos->estado;
if($estado == 1)
{
	$estado2     = "Activo";$label_class = 'label-success';
}
else
{
	if($estado == 2)
	{
		$estado2     = "Inactivo";$label_class = 'label-warning';
	}
	else
	{
		$estado2     = "Anulado";$label_class = 'label-danger';
	}
}
?>
<p>
	<strong>
		Id Producto:
	</strong><?php echo $productos->id_producto;?>
</p>

<p>
	<strong>
		Descripcion:
	</strong><?php echo $productos->descripcion;?>
</p>
<!-- <p>
	<strong>
		Cant. Stock:
	</strong><?php echo $productos->stock;?>
</p> -->
<p>
	<strong>
		Precio de Compra:
	</strong><?php echo $productos->precio_compra;?>
</p>
<p>
	<strong>
		Precio de Venta:
	</strong><?php echo $productos->precio_venta;?>
</p>
<p>
	<strong>
		Estado:
	</strong>
	<span class="label <?php echo $label_class;?>">
		<?php echo $estado2; ?>
	</span>
</p>