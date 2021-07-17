<?php
$estado = $proveedores->estado;
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
$date_added = $proveedores->date_add;
$date_added = date('d-m-Y H:i:s', strtotime($date_added));
$date_act   = $proveedores->date_mod;
if($date_act == "0000-00-00 00:00:00")
{
	$date_act = "Sin Datos";
}
else
{
	$date_act = date('d-m-Y H:i:s', strtotime($date_act));

}
?>
<p>
	<strong>
		ID Cliente:
	</strong><?php echo $proveedores->id_proveedor;?>
</p>
<p>
	<strong>
		Número de Documento: 
	</strong><?php echo $proveedores->nrodocumento;?>
</p>
<p>
	<strong>
		Razón Social:
	</strong><?php echo $proveedores->razonsocial;?>
</p>
<p>
	<strong>
		Teléfono:
	</strong><?php echo $proveedores->telefono;?>
</p>
<p>
	<strong>
		Diréccion:
	</strong><?php echo $proveedores->direccion;?>
</p>
<p>
	<strong>
		Ciudad:
	</strong><?php echo $proveedores->ciudad;?>
</p>
<p>
	<strong>
		Fecha Alta:
	</strong><?php echo $date_added;?>
</p>
<p>
	<strong>
		Ult. Modificación:
	</strong><?php echo $date_act;?>
</p>
<p>
	<strong>
		Estado:
	</strong>
	<span class="label <?php echo $label_class;?>">
		<?php echo $estado2; ?>
	</span>
</p>