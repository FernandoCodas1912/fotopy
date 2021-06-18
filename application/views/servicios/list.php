<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">

        <?php
        if ($this->session->flashdata('success')): ?>
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
        if ($this->session->flashdata('error')): ?>
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
                        <a href="" class="btn btn-success" data-toggle="modal" data-target="#modal-agregar"><i
                                class="fa fa-plus"></i> <span> Nuevo Servicio</span> </a>
                    </div>
                    <h4 class="header-title m-t-0 m-b-30"> Listado de Productos y Servicios</h4>
                    <div class="table-responsive">
                        <table class="table" id="example3">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Detalle</th>
                                    <th>Codigo</th>
                                    <th>Categoria</th>
                                    <th>Precio Costo</th>
                                    <th>Precio Venta</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($servicios)):?>
                                <?php foreach ($servicios as $servicio):?>
                                <tr>
                                    <td><?php echo $servicio->id_producto; ?></td>
                                    <td><?php echo $servicio->descripcion; ?></td>
                                    <td><?php echo $servicio->codigobarra; ?></td>
                                    <td><?php echo $servicio->categoria; ?></td>
                                    <td><?php echo $servicio->precio_compra; ?></td>
                                    <td><?php echo $servicio->precio_venta; ?></td>
                                    <?php

                                            $estado = $servicio->estado;
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
                                        <button type="button" class="btn btn-success btn-xs btn-ver" data-toggle="modal"
                                            data-target="#modal-ver" value="<?php echo $servicio->id_producto; ?>"
                                            title="Ver Detalles del servicio">
                                            <i class="fa fa-eye">
                                            </i> Ver
                                        </button>
                                        <!-- usa del modelo la funcion correspondiente -->
                                        <button type="button" class="btn btn-warning btn-xs btn-editar"
                                            data-toggle="modal" data-target="#modal-editar"
                                            value="<?php echo $servicio->id_producto; ?>"
                                            title="Editar Detalles del servicio">
                                            <i class="fa fa-pencil">
                                            </i> Editar
                                        </button>

                                        <a href="<?php echo base_url(); ?>Servicios_controller/delete/<?php echo $servicio->id_producto; ?>"
                                            class="btn btn-xs btn-danger btn-delete" title="Inactivar servicio">
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
                    <h5 class="modal-title" id="exampleModalLabel2">NUEVO SERVICIO</h5>
                </div>
                <div class="modal-body">
                    <form class="form" action="<?php echo base_url(); ?>Servicios_controller/store" method="POST"
                        id="formAdd" name="formAdd">
                        <div class="form-body">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="timesheetinput1">Codigo</label>
                                        <input type="text" min="0" class="form-control"
                                            placeholder="Codigo del servicio" aria-label="Ingrese Codigo Alfanumerico"
                                            required name="codigobarra">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="timesheetinput1">Nombre del Producto</label>
                                <div class="position-relative has-icon-left">
                                    <input type="text" id="timesheetinput1" class="form-control"
                                        placeholder="Descripcion completa del Producto" name="descripcion" required="">
                                    <div class="form-control-position">
                                        <i class="icon-android-cart"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput5">Categoria</label>
                                        <select id="projectinput5" name="id_categoria" class="form-control" required="">

                                            <option value="" selected="" disabled="">Seleccione</option>
                                            <?php foreach ($categorias as $categoria):?>
                                            <option value="<?php echo $categoria->id_categoria; ?>">
                                                <?php echo $categoria->descripcion; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput5">Impuesto</label>
                                        <select id="projectinput5" name="impuesto" class="form-control" required="">
                                            <option value="" selected="" disabled="">Seleccione</option>
                                            <option value="10">Iva 10%</option>
                                            <option value="5">Iva 5%</option>
                                            <option value="0">Exento</option>

                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="timesheetinput1">Precio Costo</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">Gs.</span>
                                            <input type="number" min="0" class="form-control"
                                                placeholder="Precio de Costo" aria-label="Ingrese precio en Gs."
                                                name="precio_compra">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="timesheetinput1">Precio Venta</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">Gs.</span>
                                            <input type="number" min="0" class="form-control"
                                                placeholder="Precio de Venta" aria-label="Ingrese precio en Gs."
                                                name="precio_venta">
                                        </div>
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
                    <h5 class="modal-title">DETALLES DEL SERVICIO</h5>
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
                    <h5 class="modal-title" id="exampleModalLabel2">FICHA DEL SERVICIO</h5>
                </div>
                <form action="<?php echo base_url(); ?>Servicios_controller/update" method="POST" id="formEdit"
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