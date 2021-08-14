<script type="text/javascript">
var base_url = "<?php echo base_url(); ?>";

//esto es para abrir modal ver
$(".btn-ver").on("click", function() {
    var id = $(this).val();
    //alert(id);
    $.ajax({
        url: base_url + "Movimientos_controller/view/" + id,
        type: "POST",
        success: function(resp) {
            $("#modal-ver .modal-body").html(resp);
            //alert(resp);
        }
    });
})

//esto es para abrir modal editar
$(".btn-editar").on("click", function() {
    var id = $(this).val();
    // alert(id);
    $.ajax({
        url: base_url + "Movimientos_controller/edit/" + id,
        type: "POST",
        success: function(resp) {
            $("#modal-editar .modal-body").html(resp);
            // alert(resp);
        }
    });
})



$('#formCierre').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        url: base_url + "Cajas_controller/cerrar_caja",
        data: $('#formCierre').serialize(),
        type: "POST",
        dataType: "JSON",
        success: function(response) {
            res = response; //guardamos resultado para poder preg.
            if (res.Status == "OK") {
                Swal.fire({
                    icon: 'success',
                    title: 'BUEN TRABAJO!',
                    text: res.textStatus,
                    showConfirmButton: true,
                    timer: 2000
                });
                setTimeout(function() {
                    location.reload();
                }, 2100);

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: res.textStatus,
                    showConfirmButton: true,
                    timer: 2000
                });

            };
        },

    });
});




$('#movimientos').DataTable({
    ServerSide: true,
    dom: 'Bfrtip',
    "pageLength": 4,
    bDestroy: true,
    buttons: [
        //   'copyHtml5',
        'excelHtml5',
        // 'csvHtml5',
        // 'pdfHtml5',
    ],
    "language": {
        "lengthMenu": "Mostrar _MENU_ registros por pagina",
        "zeroRecords": "No se encontraron Resultados!",
        "searchPlaceholder": "Buscar Datos",
        "info": "Mostrando registros de _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "No existen registros",
        "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
        "search": "Búsqueda:",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        },
    }
});
</script>