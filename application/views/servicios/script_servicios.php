<script type="text/javascript">
var base_url = "<?php echo base_url(); ?>";

//esto es para abrir modal ver
$(".btn-ver").on("click", function() {
    var id = $(this).val();
    $.ajax({
        url: base_url + "Servicios_controller/view/" + id,
        type: "POST",
        beforeSend: function() {
            //mostramos gif "cargando"
            jQuery('#loading_spinner').show();
            //antes de enviar la petición al fichero PHP, mostramos mensaje
            jQuery("#resultado").html("Déjame pensar un poco...");
        },
        success: function(resp) {
            $("#modal-ver .modal-body").html(resp);
            //alert(resp);
        }
    });
})

//esto es para abrir modal editar
$(".btn-editar").on("click", function() {
    var id = $(this).val();
    $.ajax({
        url: base_url + "Servicios_controller/edit/" + id,
        type: "POST",
        beforeSend: function() {
            //mostramos gif "cargando"
            jQuery('#loading_spinner').show();
            //antes de enviar la petición al fichero PHP, mostramos mensaje
            jQuery("#resultado").html("Déjame pensar un poco...");
        },
        success: function(resp) {
            $("#modal-editar .modal-body").html(resp);
            // alert(resp);
        },
        error: function() {
            alert('There was some error performing the AJAX call!');
        }
    });
})



//esto es para abrir modal agregar categoria
$("#btn_add_categoria").on("click", function() {
    $("#modal-agregar").hide();
    $("#modal-agregar-categoria").show();
})

$("#closeModalCat").on("click", function() {
    $("#modal-agregar").show();
    $("#modal-agregar-categoria").hide();
})



//esto es para agregar categoria

$("#formAddCategory").on("submit", function(event) {
    event.preventDefault();
    var data = $(this).serialize();
    $.ajax({
        url: base_url + "Categorias_controller/storeCategoria/",
        type: "POST",
        data: data,
        dataType: "JSON",
        success: function(response) {
            resp = response; //guardamos resultado para poder preg.
            Swal.fire({
                icon: resp.status,
                title: resp.message,
                showConfirmButton: false,
                timer: 1500
            });
            if (resp.status == "success") {
                $("#modal-agregar-categoria").hide();
                $('#id_categoria').append($('<option>', {
                    text: resp.name,
                    value: resp.id,
                    selected: true
                }));
                $("#modal-agregar").show();
            }
        }
    });
});
</script>