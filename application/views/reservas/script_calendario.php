<script type="text/javascript">
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {
    cargarDatosReserva();
});


function cargarDatosReserva(modal) {
    $.ajax({
        type: 'POST',
        url: base_url + 'Reservas_controller/chargeCalendar',
        dataType: "JSON",
        success: function(msg) {
            console.log(msg);
            if (msg) {
                $('#CalendarioWeb').fullCalendar('refetchEvents');
            }
        },
        error: function() {
            alert("Hay un error..!");
        }
    })
}

$('#CalendarioWeb').fullCalendar({
    header: {
        left: 'today,prev,next',
        center: 'title',
        right: 'month, basicWeek, basicDay, agendaWeek, agendaDay'
        //   right: 'month, agendaWeek, agendaDay'
    },

    dayClick: function(date, jsEvent, view) {

        $('#btnAgregar').prop("disabled", false);
        $('#btnModificar').prop("disabled", true);
        $('#btnEliminar').prop("disabled", true);
        $('#txtFecha').val(date.format());

        limpiarFormulario();
    },

    // mostrar todos los eventos del calendario
    events: base_url + 'Reservas_controller/chargeCalendar',

    eventClick: function(calEvent, jsEvent, view) {

        $('#btnAgregar').prop("disabled", true);
        $('#btnModificar').prop("disabled", false);
        $('#btnEliminar').prop("disabled", false);


        // H2
        $('#tituloEvento').html(calEvent.title + ' - ' + calEvent.cliente);

        // Mostrar la información del evento en los inputs
        //    $('#txtID').val(calEvent.id);
        $('#txtLugar').val(calEvent.lugar_evento);
        $('#txtCliente').val(calEvent.cliente);
        $('#txtDescripcion').val(calEvent.detalle);
        FechaHora = calEvent.start._i.split(" ");
        $('#txtFecha').val(FechaHora[0]);
        $('#txtHora').val(FechaHora[1]);
        $("#ModalEventos").modal();

    },

    editable: true,
    eventDrop: function(calEvent) {
        $('#txtID').val(calEvent.id);
        $('#txtTitulo').val(calEvent.title);
        $('#txtColor').val(calEvent.color);
        $('#txtDescripcion').val(calEvent.descripcion);

        var FechaHora = calEvent.start.format().split("T");
        $('#txtFecha').val(FechaHora[0]);
        $('#txtHora').val(FechaHora[1]);

        RecolectarDatosGUI();
        EnviarInformacion('modificar', NuevoEvento, true);

    }

});

$('.clockpicker').clockpicker();

function limpiarFormulario() {
    $('#txtID').val('');
    $('#txtTitulo').val('');
    $('#txtColor').val('');
    $('#txtDescripcion').val('');
}
</script>