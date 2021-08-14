<?php
$estado = $caja->estado;
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
        Id :
    </strong><?php echo $caja->id_caja; ?>
</p>

<p>
    <strong>
        Descripcion:
    </strong><?php echo $caja->descripcion; ?>
</p>

<p>
    <strong>
        Estado:
    </strong>
    <span class="label <?php echo $label_class; ?>">
        <?php echo $estado2; ?>
    </span>
</p>