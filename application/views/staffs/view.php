<?php
$estado = $staffs->estado;
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
		Id :
	</strong><?php echo $staffs->id_staff;?>
</p>
<p>
	<strong>
		Documento:
	</strong><?php echo $staffs->nrodocumento;?>
</p>
<p>
	<strong>
		Personal de staff:
	</strong><?php echo $staffs->nomape;?>
</p>
<p>
	<strong>
		Dirección:
	</strong><?php echo $staffs->direccion;?>
</p>
<p>
	<strong>
		Ciudad:
	</strong><?php echo $ciudad->descripcion;?>
</p>
<p>
	<strong>
		Telefono:
	</strong><?php echo $staffs->telefono;?>
</p>
<p>
	<strong>
		Telefono 2:
	</strong><?php echo $staffs->telefono2;?>
</p>
<p>
	<strong>
		Email:
	</strong><?php echo $staffs->email;?>
</p>
<p>
	<strong>
		Ocupación:
	</strong><?php echo $staffs->ocupacion;?>
</p>
<p>
	<strong>
		Año de ingreso:
	</strong><?php echo $staffs->ingreso;?>
</p>
<p>
	<strong>
		Estado:
	</strong>
	<span class="label <?php echo $label_class;?>">
		<?php echo $estado2; ?>
	</span>
</p>