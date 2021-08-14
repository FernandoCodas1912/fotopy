$(document).ready(function() {

    $('#example1').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron Resultados!",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
    $('#example2').DataTable({

        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron Resultados!",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });

    $('#example3').DataTable({
        ServerSide: true,
        dom: 'Bfrtip',
        //  "pageLength": 4,
        bDestroy: true,
        buttons: [
            //   'copyHtml5',
            'excelHtml5',
            // 'csvHtml5',
            'pdfHtml5',
        ],
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron Resultados!",
            "searchPlaceholder": "Buscar elemento",
            "info": "Mostrando registros de _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
    $('#divMiCalendario').datepicker({
        //current:true,
        format: "yyyy-mm-dd",
        today: true,
    });
    $('#divMiCalendario2').datepicker({
        current: true,
        format: "yyyy-mm-dd",
        //today: true,
    });
});