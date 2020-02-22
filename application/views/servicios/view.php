<?php
$estado = $servicios->estado;
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
		Id Producto o Servicio:
	</strong><?php echo $servicios->id_producto;?>
</p>
<p>
	<strong>
		Cod Barra:
	</strong><?php echo $servicios->codigobarra;?>
</p>
<p>
	<strong>
		Descripcion:
	</strong><?php echo $servicios->descripcion;?>
</p>
<p>
	<strong>
		Cant. Stock:
	</strong><?php echo $servicios->stock;?>
</p>
<p>
	<strong>
		Precio de Compra:
	</strong><?php echo $servicios->precio_compra;?>
</p>
<p>
	<strong>
		Precio de Venta:
	</strong><?php echo $servicios->precio_venta;?>
</p>
<p>
	<strong>
		Estado:
	</strong>
	<span class="label <?php echo $label_class;?>">
		<?php echo $estado2; ?>
	</span>
</p>