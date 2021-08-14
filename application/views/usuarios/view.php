<?php
$estado = $usuarios->estado;
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
$date_added = $usuarios->date_add;
$date_added = date('d-M-Y H:i:s', strtotime($date_added));
$date_act = $usuarios->date_mod;
if ($date_act == '0000-00-00 00:00:00') {
	$date_act = 'Sin Datos';
} else {
	$date_act = date('d-M-Y H:i:s', strtotime($date_act));
}



if (!$usuarios->caja) {
	$usuario_caja = 'Sin Caja Asignada';
} else {
	$usuario_caja = $usuarios->caja;
}
?>
<p>
    <strong>
        Id Usuario:
    </strong><?php echo $usuarios->id_usuario; ?>
</p>
<p>
    <strong>
        Nombres:
    </strong><?php echo $usuarios->nombre; ?>
</p>
<p>
    <strong>
        Username:
    </strong><?php echo $usuarios->username; ?>
</p>
<p>
    <strong>
        Perfil:
    </strong><?php echo $usuarios->perfil; ?>
</p>
<p>
    <strong>
        Caja:
    </strong><?php echo $usuario_caja; ?>
</p>
<p>
    <strong>
        Fecha Alta:
    </strong><?php echo $date_added; ?>
</p>
<p>
    <strong>
        Ult. Modificacion:
    </strong><?php echo $date_act; ?>
</p>
<p>
    <strong>
        Estado:
    </strong>
    <span class="label <?php echo $label_class; ?>">
        <?php echo $estado2; ?>
    </span>
</p>