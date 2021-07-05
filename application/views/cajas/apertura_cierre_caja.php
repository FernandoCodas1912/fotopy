<!-- Modal apertura caja-->
<div class="modal bs-example-modal-lg" id="modal-ape-caja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header miclase">
                <h5 class="modal-title" id="exampleModalLabel2">La Caja esta Cerrada, Debe Abrirla</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="impresion" width="300px">

                <!-- detalle  -->
                <div class="form-body">
                    <form class="form" role="form" id="form_ape_caja" name="form_ape_caja" action="#" method="post">
                        <div class="row">

                            <div class="col-md-3">
                                <div class="input-group">
                                    <label for="projectinput1"><b>Cajero</b></label>
                                    <div class="input-group">

                                        <input type="text" id="usuario_ape" class="form-control" required=""
                                            placeholder="" name="usuario_ape"
                                            value="<?php echo $this->session->userdata('username'); ?>" readonly="">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <label for="projectinput1"><b>Caja</b></label>
                                    <div class="input-group">
                                        <input type="text" id="id_caja" class="form-control" required="" placeholder=""
                                            name="id_caja" value="<?php echo $this->session->userdata('id_caja'); ?>"
                                            readonly="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="input-group">
                                    <label for="projectinput1"><b>Fecha Hora</b></label>
                                    <div class="input-group">

                                        <input type="text" id="f_apertura" class="form-control" required=""
                                            placeholder="" name="f_apertura" value="<?php echo date('Y-m-d') ?>"
                                            readonly="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <label for="projectinput1"><b>Monto de Apertura</b></label>
                                    <div class="input-group">

                                        <input type="number" id="monto_apertura" onfocus="" class="form-control"
                                            required="" placeholder="" name="monto_apertura" min-value="1">
                                    </div>
                                </div>
                            </div>

                        </div>
                </div>
                <!-- fin detalle  -->
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i> ABRIR CAJA! </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> CERRAR
                </button>
            </div>
            </form>
        </div><!-- Fin Modal content-->
    </div><!-- Fin Modal dialog-->
</div><!-- Fin Modal-->
<!--fin modal apertura caja -->

<?php
$id_caja_user = $this->session->userdata('id_caja');
if ($id_caja_user != "0") { //solo si tiene caja asignada
  //ver si tiene datos        
  //averiguar si esta abierta o no
  if ($datoscaja) {
    $estado_caja = $datoscaja->estadocaja; //puede ser 1 o 2
    if ($estado_caja == 2) { //2 es cerrada
      $abrir_caja = '1';
    } else {
      $abrir_caja = '0';
    }
  } else {
    $abrir_caja = '1'; //es cajero pero no existe 
  }
} else {
  $abrir_caja = '0'; //perfil no es cajero
}
?>
<script>
$(document).ready(function() {
    //si la caja esta cerrada, abrirlo
    var abrir_caja = <?php echo $abrir_caja; ?>;
    if (abrir_caja == 1) {
        $("#modal-ape-caja").modal("show");
    }
})

$('#form_ape_caja').on('submit', function(e) {
    e.preventDefault();
    var base_url = "<?php echo base_url(); ?>";
    $.ajax({
        url: base_url + "Cajas_controller/abrir_caja/",
        data: $('#form_ape_caja').serialize(),
        type: "POST",
        dataType: "JSON",
        success: function(response) {
            resp = response; //guardamos resultado para poder preg.
            if (resp.status == "success") {
                //if success close modal and reload ajax table
                $('#modal-ape-caja').modal('hide');
                $('#form_ape_caja')[0].reset(); //reseteamos el form
            }
            Swal.fire({
                icon: resp.status,
                title: resp.message,
                showConfirmButton: false,
                timer: 1500
            });
        },
    });
})
</script>