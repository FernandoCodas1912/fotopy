<?php
$estado = $categorias->estado;
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
$tipo = $categorias->tipo;
if ($tipo == 1) {
    $tipo2 = 'Evento';
    $label_class = 'label-success';
} else {
    if ($tipo == 2) {
        $tipo2 = 'Servicio';
        $label_class = 'label-warning';
    } else {
        $tipo2 = 'Producto';
        $label_class = 'label-danger';
    }
}

?>

<p>
	<strong>
		Id :
	</strong><?php echo $categorias->id_categoria; ?>
</p>

<p>
	<strong>
		Descripcion:
	</strong><?php echo $categorias->descripcion; ?>
</p>

<p>
	<strong>
		Tipo:
	</strong>
	<span class="label <?php echo $label_class; ?>">
		<?php echo $tipo2; ?>
	</span>
</p>

<p>
	<strong>
		Estado:
	</strong>
	<span class="label <?php echo $label_class; ?>">
		<?php echo $estado2; ?>
	</span>
</p>