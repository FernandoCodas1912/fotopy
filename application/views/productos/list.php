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
                                class="fa fa-plus"></i> <span> Nuevo Producto</span> </a>
                    </div>
                    <h4 class="header-title m-t-0 m-b-30"> Listado de Productos</h4>
                    <div class="table-responsive">
                        <table class="table table-responsive" id="example3">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Detalle</th>
                                    <th>Cod. Barra</th>
                                    <th>Categoria</th>
                                    <th>Precio Compra</th>
                                    <th>Precio Venta</th>
                                    <th>Stock</th>
                                    <th>Impuesto</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($productos)):?>
                                <?php foreach ($productos as $producto):?>
                                <tr>
                                    <td><?php echo $producto->id_producto; ?></td>
                                    <td><?php echo $producto->descripcion; ?></td>
                                    <td><?php echo $producto->codigobarra; ?></td>
                                    <td><?php echo $producto->categoria; ?></td>
                                    <td><?php echo $producto->precio_compra; ?></td>
                                    <td><?php echo $producto->precio_venta; ?></td>
                                    <td><?php echo $producto->precio_venta; ?></td>
                                    <td><?php echo $producto->impuesto.'%'; ?></td>
                                    <?php

                                            $estado = $producto->estado;
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
                                            data-target="#modal-ver" value="<?php echo $producto->id_producto; ?>"
                                            title="Ver Detalles del producto">
                                            <i class="fa fa-eye">
                                            </i> Ver
                                        </button>
                                        <!-- usa del modelo la funcion correspondiente -->
                                        <button type="button" class="btn btn-warning btn-xs btn-editar"
                                            data-toggle="modal" data-target="#modal-editar"
                                            value="<?php echo $producto->id_producto; ?>"
                                            title="Editar Detalles del producto">
                                            <i class="fa fa-pencil">
                                            </i> Editar
                                        </button>

                                        <a href="<?php echo base_url(); ?>servicios_controller/delete/<?php echo $producto->id_producto; ?>"
                                            class="btn btn-xs btn-danger btn-delete" title="Inactivar producto">
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
                    <h5 class="modal-title" id="exampleModalLabel2">NUEVO PRODUCTO</h5>
                </div>
                <div class="modal-body">
                    <form class="form" action="<?php echo base_url(); ?>Productos_controller/store" method="POST"
                        id="formAdd" name="formAdd">
                        <div class="form-body">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="timesheetinput1">Codigo</label>
                                        <input type="text" min="0" class="form-control"
                                            placeholder="Codigo de Barra u otro codigo"
                                            aria-label="Ingrese Codigo Alfanumerico" required name="codigobarra">

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

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="projectinput5">Categoria</label>
                                        <div class="input-group">
                                            <select id="id_categoria" name="id_categoria" class="form-control"
                                                required="">

                                                <option value="" selected="" disabled="">Seleccione</option>
                                                <?php foreach ($categorias as $categoria):?>
                                                <option value="<?php echo $categoria->id_categoria; ?>">
                                                    <?php echo $categoria->descripcion; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <a class="input-group-addon btn btn-success" id="btn_add_categoria"> <i
                                                    class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
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
                                        <label for="timesheetinput1">Precio Compra</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">Gs.</span>
                                            <input type="number" min="0" class="form-control"
                                                placeholder="Precio de compra" aria-label="Ingrese precio en Gs."
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="timesheetinput1">Stock</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">#</span>
                                            <input type="number" min="0" class="form-control" placeholder="Stock"
                                                aria-label="Cantidad Inicial" name="stock">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="timesheetinput1">Stock Minimo</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">#</span>
                                            <input type="number" min="0" class="form-control" placeholder="Stock Minimo"
                                                aria-label="Minimo para alertar" name="stock_minimo">
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
                    <h5 class="modal-title">DETALLES DEL PRODUCTO</h5>
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
                    <h5 class="modal-title" id="exampleModalLabel2">FICHA DEL PRODUCTO</h5>
                </div>
                <form action="<?php echo base_url(); ?>Productos_controller/update" method="POST" id="formEdit"
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




    <!-- MODAL AGREGAR CATEGORIAS-->
    <div class="modal" id="modal-agregar-categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal-cat" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel2">NUEVA CATEGORIA</h5>
                </div>
                <div class="modal-body">
                    <form class="form"  method="POST"
                        id="formAddCategory" name="formAdd">
                        <div class="form-body">
                            <div class="form-group">
                                <label for="timesheetinput1">Nombre de la Categoria</label>
                                <div class="position-relative has-icon-left">
                                    <input type="text" id="timesheetinput1" class="form-control"
                                        placeholder="Descripcion completa de la Categoria" name="descripcion_categoria"
                                        required="">
                                    <input type="hidden" name="tipo_categoria" value="3">
                                    <div class="form-control-position">
                                        <i class="icon-android-cart"></i>
                                    </div>
                                </div>
                            </div>

                        </div><!-- end div class FORM body-->
                </div><!-- end div class MODAL body-->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-fill" id="btnSaveCat"><i
                            class="icon-check2"></i>Guardar</button>
                    <button type="reset" class="btn btn-warning btn-fill"><i class="icon-cube"></i>Limpiar</button>
                    <button type="button" class="btn btn-danger btn-fill" id="closeModalCat" data-dismiss="modal"><i
                            class="icon-cross2"></i>Cerrar</button>
                </div>
                </form>
            </div><!-- end div class modal content-->
        </div><!-- end div class modal dialog-->
    </div><!-- end div class modal-->
    <!-- end MODAL AGREGAR CATEGORIAS-->