<?php
$estado = $tipocobros->estado;
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
		Id Tipo de Cobro:
	</strong><?php echo $tipocobros->id_tipocobro;?>
</p>
<p>
	<strong>
		Descripción:
	</strong><?php echo $tipocobros->descripcion;?>
</p>
<p>
	<strong>
		Estado:
	</strong>
	<span class="label <?php echo $label_class;?>">
		<?php echo $estado2; ?>
	</span>
</p>