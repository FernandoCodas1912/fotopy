<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">

        <?php
        if ($this->session->flashdata("success")) : ?>
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert">
                    &times;
                </button>
                <strong>
                    ¡Buen Trabajo!
                </strong>
                <p>
                    <?php echo $this->session->flashdata("success") ?>
                </p>
            </div>

        <?php endif; ?>
        <?php
        if ($this->session->flashdata("error")) : ?>
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">
                    &times;
                </button>
                <strong>
                    ¡Error!
                </strong>
                <p>
                    <?php echo $this->session->flashdata("error") ?>
                </p>
            </div>
        <?php endif; ?>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="col-md-2 pull-right">
                        <a href="" class="btn btn-success" data-toggle="modal" data-target="#modal-agregar"><i class="fa fa-plus"></i> <span> Nuevo Proveedor</span> </a>
                    </div>
                    <h4 class="header-title m-t-0 m-b-30"> Listado de Proveedores</h4>
                    <div class="table-responsive">
                        <table class="table" id="example3">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nro. Doc.</th>
                                    <th>Razon Social</th>
                                    <th>Telefono</th>
                                    <th>Ult. Modificacion</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($proveedores)) : ?>
                                    <?php foreach ($proveedores as $proveedor) : ?>
                                        <tr>
                                            <td><?php echo $proveedor->id_proveedor; ?></td>
                                            <td><?php echo $proveedor->nrodocumento; ?></td>
                                            <td><?php echo $proveedor->razonsocial; ?></td>
                                            <td><?php echo $proveedor->telefono; ?></td>
                                            <?php

                                            $date_mod = $proveedor->date_mod;
                                            $date_mod = date('d-m-Y H:i:s', strtotime($date_mod));

                                            $estado = $proveedor->estado;

                                            if ($estado == 1) {
                                                $estado2     = "Activo";
                                                $label_class = 'label-success';
                                            } else {
                                                if ($estado == 2) {
                                                    $estado2     = "Inactivo";
                                                    $label_class = 'label-warning';
                                                } else {
                                                    $estado2     = "Anulado";
                                                    $label_class = 'label-danger';
                                                }
                                            }
                                            ?>
                                            <td><?php echo $date_mod; ?></td>
                                            <td><span class="label <?php echo $label_class; ?>"><?php echo $estado2; ?></span></td>
                                            <td>
                                                <!-- usa del modelo la funcion correspondiente -->
                                                <button type="button" class="btn btn-success btn-xs btn-ver" data-toggle="modal" data-target="#modal-ver" value="<?php echo $proveedor->id_proveedor; ?>" title="Ver Detalles">
                                                    <i class="fa fa-eye">
                                                    </i> Ver
                                                </button>
                                                <!-- usa del modelo la funcion correspondiente -->
                                                <button type="button" class="btn btn-warning btn-xs btn-editar" data-toggle="modal" data-target="#modal-editar" value="<?php echo $proveedor->id_proveedor; ?>" title="Editar Detalles">
                                                    <i class="fa fa-pencil">
                                                    </i> Editar
                                                </button>

                                                <a href="<?php echo base_url(); ?>Proveedores_controller/delete/<?php echo $proveedor->id_proveedor; ?>" class="btn btn-xs btn-danger btn-delete" title="Inactivar proveedor">
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
                    <h5 class="modal-title" id="exampleModalLabel2">FICHA DEL PROVEEDOR</h5>
                </div>
                <div class="modal-body">
                    <form class="form" action="<?php echo base_url(); ?>Proveedores_controller/store" method="POST" id="formAdd" name="formAdd">
                        <div class="form-body">

                            <div class="form-group">
                                <label for="timesheetinput1">Nombre o Razon Social</label>
                                <div class="position-relative has-icon-left">
                                    <input type="text" id="timesheetinput1" class="form-control" placeholder="Nombre de proveedor" name="razonsocial" required="">
                                    <div class="form-control-position">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="timesheetinput1">Nro. Documento</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="timesheetinput1" class="form-control" placeholder="Nro. de Documento" name="nrodocumento" required="">
                                            <div class="form-control-position">
                                                <i class="icon-slack"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="timesheetinput1">Telefono</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="timesheetinput1" class="form-control" placeholder="Nro de Telefono" name="telefono">
                                            <div class="form-control-position">
                                                <i class="icon-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="timesheetinput1">Direccion</label>
                                <div class="position-relative has-icon-left">
                                    <input type="text" id="timesheetinput1" class="form-control" placeholder="Direccion" name="direccion">
                                    <div class="form-control-position">
                                        <i class="icon-home"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="timesheetinput1">Email</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="email" id="timesheetinput1" class="form-control" placeholder="Email" name="email">
                                            <div class="form-control-position">
                                                <i class="icon-mail"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput5">Ciudad</label>
                                        <select id="projectinput5" name="id_ciudad" class="form-control" required="">
                                            <option value="" selected="" disabled="">Seleccione</option>
                                            <?php foreach ($ciudades as $ciudad) : ?>
                                                <option value="<?php echo $ciudad->id_ciudad; ?>"> <?php echo $ciudad->descripcion; ?></option>
                                            <?php endforeach; ?>
                                        </select>
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
                    <h5 class="modal-title">DETALLES DEL PROVEEDOR</h5>
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
                    <h5 class="modal-title" id="exampleModalLabel2">FICHA DE MODIFICACION DEL PROVEEDOR</h5>
                </div>
                <form action="<?php echo base_url(); ?>Proveedores_controller/update" method="POST" id="formEdit" name="formEdit">
                    <div class="modal-body">

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