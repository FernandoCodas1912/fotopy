<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-2 pull-right">
                        <a href="<?php echo base_url(); ?>Reservas_controller" class="btn btn-success"><span> Gestionar
                                Reservas </span><i class="fa fa-arrow-right"></i> </a>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <div id="CalendarioWeb"></div>
                            </div>
                            <div class="col"></div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div>
                <!-- end col-12 -->
            </div> <!-- end row -->
        </div> <!-- container -->

    </div> <!-- content -->

</div>
<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->



<!-- Modal(Agregar, Modificar, Eliminar) -->
<div class="modal fade" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="tituloEvento"></h5>
            </div>

            <div class="modal-body">

                <div class="form-group col-md-12">
                    <label for="">Cliente:</label>
                    <input type="text" id="txtCliente" class="form-control">
                </div>

                <div class="form-group col-md-12">
                    <label for="">Lugar: </label>
                    <input id="txtLugar" class="form-control">
                </div>


                <div class="form-group col-md-6">
                    <label for="">Fecha:</label>
                    <input type="text" id="txtFecha" class="form-control">

                </div>

                <div class="form-group col-md-6">
                    <label for="">Hora:</label>
                    <input type="text" id="txtHora" class="form-control">
                </div>

                <div class="form-group col-md-12">
                    <label>Detalle: </label>
                    <textarea id="txtDescripcion" class="form-control"></textarea>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

            </div>

        </div>
    </div>
</div>
<!-- end Modal(Agregar, Modificar, Eliminar) -->