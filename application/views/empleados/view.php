<?php
$estado = $empleados->estado;
if ($estado == 1) {
    $estado2     = "Activo";
    $label_class = 'label-success';
} else {
    if ($estado == 2) {
        $estado2     = "Inactivo";
        $label_class = 'label-warning';
    } else {
        $estado2     = "Anulado";
        $label_class = 'label-danger';
    }
}
?>
<p>
    <strong>
        Id :
    </strong><?php echo $empleados->id_empleado; ?>
</p>

<p>
    <strong>
        Empleado:
    </strong><?php echo $empleados->nomape; ?>
</p>
<p>
    <strong>
        Documento:
    </strong><?php echo $empleados->nrodocumento; ?>
</p>
<p>
    <strong>
        Cargo:
    </strong><?php echo $empleados->cargo; ?>
</p>
<p>
    <strong>
        Departamento:
    </strong><?php echo $empleados->departamento; ?>
</p>
<p>
    <strong>
        Ciudad:
    </strong><?php echo $empleados->ciudad; ?>
</p>
<p>
    <strong>
        Direccion:
    </strong><?php echo $empleados->direccion; ?>
</p>
<p>
    <strong>
        Telefono:
    </strong><?php echo $empleados->telefono; ?>
</p>
<p>
    <strong>
        Email:
    </strong><?php echo $empleados->email; ?>
</p>
<p>
    <strong>
        Salario:
    </strong><?php echo $empleados->salario; ?>
</p>
<p>
    <strong>
        Estado:
    </strong>
    <span class="label <?php echo $label_class; ?>">
        <?php echo $estado2; ?>
    </span>
</p>