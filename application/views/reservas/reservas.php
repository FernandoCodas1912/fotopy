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
                        <div class="col-md-3">
                            <div class="widget">
                                <div class="widget-body">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href="#" data-toggle="modal" data-target="#add-category"
                                                class="btn btn-lg btn-success btn-block waves-effect waves-light">
                                                <i class="fa fa-plus"></i> Crear Nuevo
                                            </a>

                                            <div id="external-events" class="m-t-20">
                                                <br>
                                                <p>Arrastre y Suelte el evento o reserva en el calendario</p>
                                                <div class="external-event bg-primary" data-class="bg-primary">
                                                    <i class="fa fa-move"></i>Evento
                                                </div>
                                                <div class="external-event bg-pink" data-class="bg-pink">
                                                    <i class="fa fa-move"></i>My Event
                                                </div>
                                                <div class="external-event bg-warning" data-class="bg-warning">
                                                    <i class="fa fa-move"></i>Meet manager
                                                </div>
                                                <div class="external-event bg-purple" data-class="bg-purple">
                                                    <i class="fa fa-move"></i>Create New theme
                                                </div>
                                            </div>

                                            <!-- checkbox -->
                                            <div class="checkbox m-t-40">
                                                <input id="drop-remove" type="checkbox">
                                                <label for="drop-remove">
                                                    Remove after drop
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                    <h4 class="modal-title"><strong>Add New Event</strong></h4>
                                </div>
                                <div class="modal-body"></div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default waves-effect"
                                        data-dismiss="modal">Close</button>
                                    <button type="button"
                                        class="btn btn-success save-event waves-effect waves-light">Create
                                        event</button>
                                    <button type="button" class="btn btn-danger delete-event waves-effect waves-light"
                                        data-dismiss="modal">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Add Category -->
                    <div class="modal fade none-border" id="add-category">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><strong>Add a category </strong></h4>
                                </div>
                                <div class="modal-body">
                                    <form role="form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="control-label">Category Name</label>
                                                <input class="form-control form-white" placeholder="Enter name"
                                                    type="text" name="category-name" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label">Choose Category Color</label>
                                                <select class="form-control form-white"
                                                    data-placeholder="Choose a color..." name="category-color">
                                                    <option value="success">Success</option>
                                                    <option value="danger">Danger</option>
                                                    <option value="info">Info</option>
                                                    <option value="pink">Pink</option>
                                                    <option value="primary">Primary</option>
                                                    <option value="warning">Warning</option>
                                                    <option value="inverse">Inverse</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default waves-effect"
                                        data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger waves-effect waves-light save-category"
                                        data-dismiss="modal">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL -->
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