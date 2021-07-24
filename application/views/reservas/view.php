<?php

//se recibe desde el controlador reservas, metodo view como reservas
$estado = $reservas->estado;
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
        Id Reserva:
    </strong><?php echo $reservas->id_reserva; ?>
</p>
<p>
    <strong>
        Contacto:
    </strong><?php echo $reservas->cliente; ?>
</p>
<p>
    <strong>
        Telefono Cliente:
    </strong><?php echo $reservas->telefono; ?>
</p>
<p>
    <strong>
        Descripcion del servicio reservado:
    </strong><?php echo $reservas->servicio; ?>
</p>
<p>
    <strong>
        Evento:
    </strong><?php echo $reservas->tipo_evento; ?>
</p>
<p>
    <strong>
        Fecha y Hora del Evento:
    </strong><?php echo $reservas->fecha_evento . ' a las ' . $reservas->hora_evento; ?>
</p>
<p>
    <strong>
        Departamento del Evento:
    </strong><?php echo $reservas->departamento_evento; ?>
</p>
<p>
    <strong>
        Ciudad del Evento:
    </strong><?php echo $reservas->ciudad_evento; ?>
</p>
<p>
    <strong>
        Lugar del Evento:
    </strong><?php echo $reservas->lugar_evento; ?>
</p>
<p>
    <strong>
        Estado:
    </strong>
    <span class="label <?php echo $label_class; ?>">
        <?php echo $estado2; ?>
    </span>
</p>