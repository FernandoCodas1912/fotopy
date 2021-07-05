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
                        <a href="" class="btn btn-success btn-md btn-block" data-toggle="modal"
                            data-target="#modal-agregar"><i class="fa fa-plus"></i> <span> Nueva caja</span>
                        </a>
                    </div>
                    <h4 class="header-title m-t-0 m-b-30"> Listado de Cajas</h4>
                    <div class="table-responsive">
                        <table class="table" id="example3">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Descripcion</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($cajas)) : ?>
                                <?php foreach ($cajas as $caja) : ?>
                                <tr>
                                    <td><?php echo $caja->id_caja; ?></td>
                                    <td><?php echo $caja->descripcion; ?></td>
                                    <?php

                                            $estado = $caja->estado;
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
                                        <button type="button" class="btn btn-success btn-sm btn-ver" data-toggle="modal"
                                            data-target="#modal-ver" value="<?php echo $caja->id_caja; ?>"
                                            title="Ver Detalles del tipo de evento">
                                            <i class="fa fa-eye">
                                            </i> Ver
                                        </button>
                                        <!-- usa del modelo la funcion correspondiente -->
                                        <button type="button" class="btn btn-warning btn-sm btn-editar"
                                            data-toggle="modal" data-target="#modal-editar"
                                            value="<?php echo $caja->id_caja; ?>"
                                            title="Editar Detalles del tipo de evento">
                                            <i class="fa fa-pencil">
                                            </i> Editar
                                        </button>

                                        <a href="<?php echo base_url(); ?>Cajas_controller/delete/<?php echo $caja->id_caja; ?>"
                                            class="btn btn-sm btn-danger btn-delete" title="Inactivar">
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
    <div class="modal" id="modal-agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel2">Nueva Caja</h5>
                </div>
                <div class="modal-body">
                    <form class="form" action="<?php echo base_url(); ?>Cajas_controller/store" method="POST"
                        id="formAdd" name="formAdd">
                        <div class="form-body">
                            <div class="form-group">
                                <label for="timesheetinput1">Descripcion</label>
                                <div class="position-relative has-icon-left">
                                    <input type="text" id="timesheetinput1" class="form-control"
                                        placeholder="Descripcion o nombre de la caja" name="descripcion" required="">
                                    <div class="form-control-position">
                                        <i class="icon-android-cart"></i>
                                    </div>
                                </div>
                            </div>


                        </div><!-- end div class FORM body-->
                </div><!-- end div class MODAL body-->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-fill" id="btnEnviarDatos"><i
                            class="icon-check2"></i>Guardar</button>
                    <button type="reset" class="btn btn-warning btn-fill"><i class="icon-cube"></i>Limpiar</button>
                    <button type="button" class="btn btn-danger btn-fill" data-dismiss="modal"><i
                            class="icon-cross2"></i>Cerrar</button>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title">DETALLES DE LA CAJA</h5>
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
    <div class="modal" id="modal-editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel2">FICHA DE LA CAJA</h5>
                </div>
                <form action="<?php echo base_url(); ?>Cajas_controller/update" method="POST" id="formEdit"
                    name="formEdit">
                    <div class="modal-body">
                        <!-- AQUI SE CARGA DESDE EL CONTROLADOR -->
                    </div><!-- end div class modal body-->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-fill" id="btnEnviarDatos"><i
                                class="icon-check2"></i>Guardar</button>
                        <button type="reset" class="btn btn-warning btn-fill"><i class="icon-cube"></i>Limpiar</button>
                        <button type="button" class="btn btn-danger btn-fill" data-dismiss="modal"><i
                                class="icon-cross2"></i>Cerrar</button>
                    </div>
                </form>
            </div><!-- end div class modal content-->
        </div><!-- end div class modal dialog-->
    </div><!-- end div class modal-->
    <!-- end Modal editar-->