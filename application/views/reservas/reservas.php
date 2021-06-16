<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">

                    <div class="row">
                        <div class="col-md-1">
                        </div> <!-- end col-->
                        <div class="col-md-9">
                            <div class="card-box">
                                <div id="calendar"></div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                    <!-- BEGIN MODAL -->
                    <div class="modal fade none-border" id="event-modal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><strong>Nueva Reserva</strong></h4>
                                </div>
                                <div class="modal-body"></div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default waves-effect"
                                        data-dismiss="modal">Cerrar</button>
                                    <button type="button"
                                        class="btn btn-success save-event waves-effect waves-light">Crear Reserva</button>
                                    <button type="button" class="btn btn-danger delete-event waves-effect waves-light"
                                        data-dismiss="modal">Borrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end col-12 -->
            </div> <!-- end row -->


        </div> <!-- container -->

    </div> <!-- content -->

</div>


<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->




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

                                        <input type="text" id="cajero" class="form-control" required="" placeholder=""
                                            name="id_cajero" value="<?php echo $this->session->userdata('username'); ?>"
                                            readonly="">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <label for="projectinput1"><b>Caja</b></label>
                                    <div class="input-group">
                                        <input type="text" id="id_caja" class="form-control" required="" placeholder=""
                                            name="id_caja" value="1" readonly="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="input-group">
                                    <label for="projectinput1"><b>Fecha Hora</b></label>
                                    <div class="input-group">

                                        <input type="text" id="f_apertura" class="form-control" required=""
                                            placeholder="" name="f_apertura" value="<?php echo date('Y-m-d H:i:s') ?>"
                                            readonly="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <label for="projectinput1"><b>Monto de Apertura</b></label>
                                    <div class="input-group">

                                        <input type="text" id="monto_apertura" onfocus="" class="form-control"
                                            required="" placeholder="" name="monto_apertura" value="1">
                                    </div>
                                </div>
                            </div>

                        </div>
                </div>
                <!-- fin detalle  -->
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i> Abrir CAJA! </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> CERRAR
                </button>
            </div>
            </form>
        </div><!-- Fin Modal content-->
    </div><!-- Fin Modal dialog-->
</div><!-- Fin Modal-->
<!--fin modal apertura caja -->
<?php

$cajaabierta = 'no';
if ($AperturaCierreCaja) {
    $estado_caja =  $AperturaCierreCaja->estado_caja;

    if ($estado_caja == "1") {
        $cajaabierta = 'ok';
    }
}
?>

<script>
//si la caja esta cerrada, abrirlo
var cajaabierta = "<?php echo $cajaabierta; ?>";
var base_url = "<?php echo base_url(); ?>";
$(document).ready(function() {









    //    alert('cajaabiera' + cajaabierta);
    if (cajaabierta !== 'ok') {
        $('#modal-ape-caja').modal('show');
        $('#form_ape_caja').on('submit', function(e) {
            e.preventDefault();
            url = base_url + "Movimientos_controller/abrir_caja/";
            data = $('#form_ape_caja').serialize();

            $.ajax({
                url: url,
                type: "POST",
                data: data,
                dataType: "JSON",
                success: function(data) {
                    res = data; //guardamos resultado para poder preg.
                    if (res.Status == "OK") {
                        Swal.fire(
                            'Buen Trabajo!',
                            res.textStatus, //mostramos error desde array
                            'success'
                        )


                        //if success close modal and reload ajax table
                        $('#modal-ape-caja').modal('hide');
                        $('#form_ape_caja')[0].reset(); //reseteamos el form
                        //    var redirect = location.href = base_url + "Dashboard";
                        //    setTimeout(redirect, 30000);

                    } else {
                        swal(
                            'Error al Agregar/Actualizar datos',
                            res.textStatus, //mostramos error desde array
                            "error"
                        );
                    };
                },
            });
        });
    };
});

</script>