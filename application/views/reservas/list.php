<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">

        <?php
        if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert">
                    &times;
                </button>
                <strong>
                    ¡Buen Trabajo!
                </strong>
                <p>
                    <?php echo $this->session->flashdata('success'); ?>
                </p>
            </div>

        <?php endif; ?>
        <?php
        if ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">
                    &times;
                </button>
                <strong>
                    ¡Error!
                </strong>
                <p>
                    <?php echo $this->session->flashdata('error'); ?>
                </p>
            </div>
        <?php endif; ?>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="col-md-2 pull-right">
                        <a href="" class="btn btn-success" data-toggle="modal" data-target="#modal-agregar"><i class="fa fa-plus"></i> <span> Nueva Reserva</span> </a>
                    </div>
                    <h4 class="header-title m-t-0 m-b-30"> Listado de Reservas</h4>
                    <div class="table-responsive">
                        <table class="table" id="example3">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Cliente</th>
                                    <th>Telefono/Celular</th>
                                    <th>Servicio Solicitado</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Lugar</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($reservas)) : ?>
                                    <?php foreach ($reservas as $reserva) : ?>
                                        <tr>
                                            <td><?php echo $reserva->id_reserva; ?></td>
                                            <td><?php echo $reserva->cliente; ?></td>
                                            <td><?php echo $reserva->telefono; ?></td>
                                            <td><?php echo $reserva->id_producto . '-' . $reserva->servicio; ?></td>
                                            <td><?php echo $reserva->fecha_evento; ?></td>
                                            <td><?php echo $reserva->hora_evento; ?></td>
                                            <td><?php echo $reserva->lugar_evento; ?></td>
                                            <?php

                                            $estado = $reserva->estado;
                                            if ($estado == 1) {
                                                $estado2 = 'Activo';
                                                $label_class = 'label-success';
                                            } else {
                                                if ($estado == 2) {
                                                    $estado2 = 'Inactivo';
                                                    $label_class = 'label-warning';
                                                } else {
                                                    $estado2 = 'Anulado';
                                                    $label_class = 'label-danger';
                                                }
                                            }
                                            ?>
                                            <td><span class="label <?php echo $label_class; ?>"><?php echo $estado2; ?></span>
                                            </td>
                                            <td>
                                                <!-- usa del modelo la funcion correspondiente -->
                                                <button type="button" class="btn btn-success btn-xs btn-ver" data-toggle="modal" data-target="#modal-ver" value="<?php echo $reserva->id_reserva; ?>" title="Ver Detalles de la Reserva">
                                                    <i class="fa fa-eye">
                                                    </i> Ver
                                                </button>
                                                <!-- usa del modelo la funcion correspondiente -->
                                                <button type="button" class="btn btn-warning btn-xs btn-editar" data-toggle="modal" data-target="#modal-editar" value="<?php echo $reserva->id_reserva; ?>" title="Editar Detalles de la Reserva">
                                                    <i class="fa fa-pencil">
                                                    </i> Editar
                                                </button>

                                                <a href="<?php echo base_url(); ?>Reservas_controller/delete/<?php echo $reserva->id_reserva; ?>" class="btn btn-xs btn-danger btn-delete" title="Anular Reserva">
                                                    <i class="fa fa-trash-o">
                                                    </i> Anular
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- container -->

    <!-- MODAL AGREGAR-->
    <div class="modal" id="modal-agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel2">DATOS DE LA RESERVA</h5>
                </div>
                <div class="modal-body">
                    <form class="form" action="<?php echo base_url(); ?>Reservas_controller/store" method="POST" id="formAdd" name="formAdd">
                        <div class="form-body">
                            <!--    <h4 class="form-section"><i class="icon-ios-albums"></i> Datos Basicos</h4> -->

                            <div class="form-group">
                                <label for="timesheetinput1">Producto o Servicio Solicitado</label>
                                <select id="projectinput5" name="id_producto" class="form-control" required="">

                                    <option value="" selected="" disabled="">Seleccione</option>
                                    <?php foreach ($servicios as $servicio) : ?>
                                        <option value="<?php echo $servicio->id_producto; ?>">
                                            <?php echo $servicio->descripcion; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="timesheetinput1">Cliente</label>
                                <select id="projectinput5" name="id_cliente" class="form-control" required="">

                                    <option value="" selected="" disabled="">Seleccione</option>
                                    <?php foreach ($clientes as $cliente) : ?>
                                        <option value="<?php echo $cliente->id_cliente; ?>">
                                            <?php echo $cliente->razonsocial; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput5">Fecha</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control fecha-autoclose" placeholder="mm/dd/yyyy" name="fecha_evento">
                                            <span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Hora del Evento</label>
                                    <div class="input-group m-b-15">

                                        <div class="bootstrap-timepicker">
                                            <input id="timepicker" type="text" name="hora_evento" class="form-control hora">
                                        </div>
                                        <span class="input-group-addon bg-primary b-0 text-white"><i class="glyphicon glyphicon-time"></i></span>
                                    </div><!-- input-group -->

                                </div>

                            </div>

                            <div class="form-group">
                                <label for="timesheetinput1">Detalle del Lugar del Evento</label>
                                <div class="position-relative has-icon-left">
                                    <input type="text" id="timesheetinput1" class="form-control" placeholder="Descripcion completa del lugar del evento" name="lugar_evento" required="">
                                    <div class="form-control-position">
                                        <i class="icon-android-cart"></i>
                                    </div>
                                </div>
                            </div>

                        </div><!-- end div class FORM body-->
                </div><!-- end div class MODAL body-->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-fill" id="btnEnviarDatos"><i class="icon-check2"></i>Guardar</button>
                    <button type="reset" class="btn btn-warning btn-fill"><i class="icon-cube"></i>Limpiar</button>
                    <button type="button" class="btn btn-danger btn-fill" data-dismiss="modal"><i class="icon-cross2"></i>Cerrar</button>
                </div>
                </form>
            </div><!-- end div class modal content-->
        </div><!-- end div class modal dialog-->
    </div><!-- end div class modal-->
    <!-- end MODAL AGREGAR-->

    <!-- Modal ver-->
    <div class="modal bs-example-modal-xs" id="modal-ver" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog modal-xs" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title">DETALLES DE LA RESERVA</h5>
                </div>
                <div class="modal-body">
                    <!--/ CARGA CONTENIDO DESDE VISTA -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                </div>
            </div><!-- Fin Modal content-->
        </div><!-- Fin Modal dialog-->
    </div><!-- Fin Modal-->
    <!-- end Modal ver-->

    <!-- Modal editar-->
    <div class="modal" id="modal-editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel2">FICHA DE LA RESERVA A EDITAR </h5>
                </div>
                <form action="<?php echo base_url(); ?>Reservas_controller/update" method="POST" id="formEdit" name="formEdit">
                    <div class="modal-body">
                        <!-- AQUI SE CARGA DESDE EL CONTROLADOR -->
                    </div><!-- end div class modal body-->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-fill" id="btnEnviarDatos"><i class="icon-check2"></i>Guardar</button>
                        <button type="reset" class="btn btn-warning btn-fill"><i class="icon-cube"></i>Limpiar</button>
                        <button type="button" class="btn btn-danger btn-fill" data-dismiss="modal"><i class="icon-cross2"></i>Cerrar</button>
                    </div>
                </form>
            </div><!-- end div class modal content-->
        </div><!-- end div class modal dialog-->
    </div><!-- end div class modal-->
    <!-- end Modal editar-->