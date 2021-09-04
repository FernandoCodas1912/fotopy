<?php 




?>

<script type="text/javascript">
var base_url = "<?php echo base_url(); ?>";
$(document).ready(function() {

    // cargarDatosReserva();


});


function cargarDatosReserva(accion, objEvento, modal) {
    $.ajax({
        type: 'POST',
        url: base_url + 'eventos.php?accion=' + accion,
        dataType: "JSON",
        success: function(msg) {

            console.log(msg);
            if (msg) {
                $('#CalendarioWeb').fullCalendar('refetchEvents');
                if (!modal) {
                    $("#ModalEventos").modal('toggle');
                }

            }
        },
        error: function() {
            alert("Hay un error..!");
        }
    })
}


var data = "<?php  ($dataCalendar); ?>";
console.log(data);

$('#CalendarioWeb').fullCalendar({
    header: {
        left: 'today,prev,next',
        center: 'title',
        // right: 'month, basicWeek, basicDay, agendaWeek, agendaDay'
        right: 'month, agendaWeek, agendaDay'
    },

    dayClick: function(date, jsEvent, view) {

        $('#btnAgregar').prop("disabled", false);
        $('#btnModificar').prop("disabled", true);
        $('#btnEliminar').prop("disabled", true);

        limpiarFormulario();

        $('#txtFecha').val(date.format());
        $("#ModalEventos").modal();
    },

    // mostrar todos los eventos del calendario

    // events: [{
    //     'id': ' 1',
    //     'title': 'title',
    //     'descripcion': 'xs',
    //     'start': '2021-09-04 03:15:00',

    // }],
    events: data,
    // events: 'http://localhost:8080/Proyectos/calendarioweb/eventos.php',

    eventClick: function(calEvent, jsEvent, view) {

        $('#btnAgregar').prop("disabled", true);
        $('#btnModificar').prop("disabled", false);
        $('#btnEliminar').prop("disabled", false);


        // H2
        $('#tituloEvento').html(calEvent.title);

        // Mostrar la información del evento en los inputs
        $('#txtDescripcion').val(calEvent.descripcion);
        $('#txtID').val(calEvent.id);
        $('#txtTitulo').val(calEvent.title);
        $('#txtColor').val(calEvent.color);

        FechaHora = calEvent.start._i.split(" ");
        $('#txtFecha').val(FechaHora[0]);
        //$('#txtHora').val(FechaHora[1]);

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














var NuevoEvento;

$('#btnAgregar').click(function() {
    RecolectarDatosGUI();
    EnviarInformacion('agregar', NuevoEvento);
});

$('#btnEliminar').click(function() {
    RecolectarDatosGUI();
    EnviarInformacion('eliminar', NuevoEvento);
});

$('#btnModificar').click(function() {
    RecolectarDatosGUI();
    EnviarInformacion('modificar', NuevoEvento);
});

function RecolectarDatosGUI() {
    NuevoEvento = {
        id: $('#txtID').val(),
        title: $('#txtTitulo').val(),
        start: $('#txtFecha').val() + " " + $('#txtHora').val(),
        color: $('#txtColor').val(),
        descripcion: $('#txtDescripcion').val(),
        textColor: "#FFFFFF",
        end: $('#txtFecha').val() + " " + $('#txtHora').val(),
    };
}

function EnviarInformacion(accion, objEvento, modal) {
    $.ajax({
        type: 'POST',
        url: 'eventos.php?accion=' + accion,
        data: objEvento,
        success: function(msg) {
            if (msg) {
                $('#CalendarioWeb').fullCalendar('refetchEvents');
                if (!modal) {
                    $("#ModalEventos").modal('toggle');
                }

            }
        },
        error: function() {
            alert("Hay un error..!");
        }
    })
}

$('.clockpicker').clockpicker();

function limpiarFormulario() {
    $('#txtID').val('');
    $('#txtTitulo').val('Evento..');
    $('#txtColor').val('');
    $('#txtDescripcion').val('');
}
</script>