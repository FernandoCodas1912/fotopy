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
                                class="fa fa-plus"></i> <span> Nuevo Usuario</span> </a>
                    </div>
                    <h4 class="header-title m-t-0 m-b-30"> Listado de Usuarios</h4>
                    <div class="table-responsive">
                        <table class="table" id="example3">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>Nombre</th>
                                    <th>Perfil</th>
                                    <th>Fecha Alta</th>
                                    <th>Ult. Modificacion</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($usuarios)):?>
                                <?php foreach ($usuarios as $usuario):?>
                                <tr>
                                    <td><?php echo $usuario->id_usuario; ?></td>
                                    <td><?php echo $usuario->username; ?></td>
                                    <td><?php echo $usuario->nombre; ?></td>
                                    <td><?php echo $usuario->perfil; ?></td>
                                    <?php
                                                                $date_added = $usuario->date_add;
                                                                $date_added = date('d-M-Y H:i:s', strtotime($date_added));

                                                                $date_mod = $usuario->date_mod;
                                                                $date_mod = date('d-M-Y H:i:s', strtotime($date_mod));

                                                                $estado = $usuario->estado;

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
                                    <td><?php echo $date_added; ?></td>
                                    <td><?php echo $date_mod; ?></td>
                                    <td><span class="label <?php echo $label_class; ?>"><?php echo $estado2; ?></span>
                                    </td>
                                    <td>
                                        <!-- usa del modelo la funcion correspondiente -->
                                        <button type="button" class="btn btn-success btn-xs btn-ver" data-toggle="modal"
                                            data-target="#modal-ver" value="<?php echo $usuario->id_usuario; ?>"
                                            title="Ver Detalles">
                                            <i class="fa fa-eye">
                                            </i> Ver
                                        </button>
                                        <button type="button" class="btn btn-primary btn-xs btn-cambio_clave"
                                            data-toggle="modal" data-target="#modal-cambio_clave"
                                            value="<?php echo $usuario->id_usuario; ?>" title="Cambiar Clave">
                                            <i class="fa fa-lock">
                                            </i> Cambiar Clave
                                        </button>
                                        <!-- usa del modelo la funcion correspondiente -->
                                        <button type="button" class="btn btn-warning btn-xs btn-editar"
                                            data-toggle="modal" data-target="#modal-editar"
                                            value="<?php echo $usuario->id_usuario; ?>" title="Editar Detalles">
                                            <i class="fa fa-pencil">
                                            </i> Editar
                                        </button>


                                        <a href="<?php echo base_url(); ?>Usuarios_controller/delete/<?php echo $usuario->id_usuario; ?>"
                                            class="btn btn-xs btn-danger btn-delete" title="Inactivar Usuario">
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
                    <h5 class="modal-title" id="exampleModalLabel2">FICHA DEL USUARIO</h5>
                </div>
                <div class="modal-body">
                    <form class="form" action="<?php echo base_url(); ?>Usuarios_controller/store" method="POST"
                        id="formAdd" name="formAdd">
                        <div class="form-body">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="projectinput5">Empleado</label>
                                    <select id="projectinput5" name="id_empleado" class="form-control" required>

                                        <option value="" selected="" disabled="">Seleccione</option>
                                        <?php foreach ($empleados as $empleado):?>
                                        <option value="<?php echo $empleado->id_empleado; ?>">
                                            <?php echo $empleado->nomape; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="timesheetinput1">Username/Login</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="timesheetinput1" class="form-control"
                                                placeholder="Nombre de usuario" name="username" required="">
                                            <div class="form-control-position">
                                                <i class="icon-slack"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput5">Perfil</label>
                                        <select id="projectinput5" name="id_perfil" class="form-control" required="">

                                            <option value="" selected="" disabled="">Seleccione</option>
                                            <?php foreach ($perfiles as $perfil):?>
                                            <option value="<?php echo $perfil->id_usuario_perfil; ?>">
                                                <?php echo $perfil->descripcion; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="timesheetinput1">Clave</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="password" id="timesheetinput1" class="form-control"
                                                placeholder="clave" name="clave" required="">
                                            <div class="form-control-position">
                                                <i class="icon-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="timesheetinput1">Repetir Clave</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="password" id="timesheetinput1" class="form-control"
                                                placeholder="Repetir clave" name="repetirclave" required="">
                                            <div class="form-control-position">
                                                <i class="icon-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end div class FORM body-->
                </div><!-- end div class MODAL body-->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-fill" id="btnEnviarDatos"><i
                            class="icon-check2"></i>Agregar</button>
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
                    <h5 class="modal-title">FICHA DEL USUARIO</h5>
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
                    <h5 class="modal-title" id="exampleModalLabel2">FICHA DEL USUARIO </h5>
                </div>
                <form action="<?php echo base_url(); ?>Usuarios_controller/update" method="POST" id="formEdit"
                    name="formEdit">
                    <div class="modal-body">
                        <!-- AQUI SE CARGA DESDE EL CONTROLADOR -->
                    </div><!-- end div class modal body-->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-fill" id="btnEnviarDatos"><i
                                class="icon-check2"></i>Agregar</button>
                        <button type="reset" class="btn btn-warning btn-fill"><i class="icon-cube"></i>Limpiar</button>
                        <button type="button" class="btn btn-danger btn-fill" data-dismiss="modal"><i
                                class="icon-cross2"></i>Cerrar</button>
                    </div>
                </form>
            </div><!-- end div class modal content-->
        </div><!-- end div class modal dialog-->
    </div><!-- end div class modal-->
    <!-- end Modal editar-->


    <!-- MODAL CAMBIAR CLAVE-->
    <div class="modal" id="modal-cambio_clave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel2">CAMBIAR CLAVE DEL USUARIO</h5>
                </div>
                <form class="form" action="<?php echo base_url(); ?>Usuarios_controller/update_password" method="POST"
                    id="formUpdatePassword" name="formUpdatePassword">
                    <div class="modal-body">
                        
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
    <!-- end MODAL CAMBIAR CLAVE-->