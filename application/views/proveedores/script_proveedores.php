<script type="text/javascript">
var base_url = "<?php echo base_url(); ?>";

//esto es para abrir modal ver
$(".btn-ver").on("click", function() {
    var id = $(this).val();
    //alert(id);
    $.ajax({
        url: base_url + "Proveedores_controller/view/" + id,
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
        url: base_url + "Proveedores_controller/edit/" + id,
        type: "POST",
        success: function(resp) {
            $("#modal-editar .modal-body").html(resp);
            // alert(resp);
        }
    });
})

$("#id_departamento").on("change", function() {
    var id_departamento = $(this).val();
    buscar_ciudades(id_departamento);
    // alert("entro change" + id_departamento);
});
$("#mod_departamento").on("change", function() {
    var id_departamento = $(this).val();
    // alert("entro mod id " + id_departamento);
    buscar_ciudades(id_departamento);
});

function buscar_ciudades(id_departamento) {
    //   alert("recibi" + id_departamento);
    if (id_departamento) {
        $.ajax({
            type: "POST",
            url: base_url + "Ciudades_controller/getAllDepartamento/",
            data: "id_departamento=" + id_departamento,
            success: function(html) {
                console.log(html)
                $(".ciudad").html(html);
            }
        });
    } else {
        $(".ciudad").html('<option value="">Elija Primero el Departamento </option>');
    }
}
</script>