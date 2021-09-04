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
                                <div id="CalendarioWeb"></div>
                            </div>
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
                <h5 class="modal-title" id="tituloEvento"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="txtID" name="txtID">
                <input type="hidden" id="txtFecha" name="txtFecha" /></br>

                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="">Titulo:</label>
                        <input type="text" id="txtTitulo" class="form-control" placeholder="Título del evento"></br>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Hora del evento:</label>
                        <div class="input-group clockpicker" data-autoclose="true">
                            <input type="text" id="txtHora" value="10:30" class="form-control">
                        </div>

                    </div>

                </div>
                <div class="form-group">
                    <label>Descripcion: </label>
                    <textarea id="txtDescripcion" rows="3" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Color: </label>
                    <input type="color" value="#FF0000" id="txtColor" class="form-control" style="height:36px;">
                </div>




            </div>
            <div class="modal-footer">

                <button type="button" id="btnAgregar" class="btn btn-success">Agregar</button>
                <button type="button" id="btnModificar" class="btn btn-success">Modificar</button>
                <button type="button" id="btnEliminar" class="btn btn-danger">Borrar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

            </div>
        </div>
    </div>
</div>
<!-- end Modal(Agregar, Modificar, Eliminar) -->