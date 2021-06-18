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

</script>