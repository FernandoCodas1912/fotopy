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

        <?php if (!empty($cajas)) {
            if ($cajas->estadocaja == 1) {
                $estadocaja = "Abierta";
            } else {
                $estadocaja = "Cerrada";
            }

        ?>

        <div class="row">
            <div class="col-lg-12">
                <!-- article -->
                <form class="form" id="formCierre" name="formCierre">
                    <article class="pricing-column col-xl-2 col-md-2">
                        <input type="hidden" name="monto_cierre" value="<?php echo $saldo_caja->saldo_movimiento; ?>">
                        <input type="hidden" name="id_caja" value="<?php echo $cajas->id_caja; ?>">
                        <input type="hidden" name="usuario_cierre" value="<?php echo $cajas->usuario_apertura; ?>">
                        <div class="ribbon"><span><?php echo $estadocaja; ?></span></div>
                        <div class="inner-box card-box">
                            <div class="plan-header p-3 text-center">
                                <h3 class="plan-title"> Caja <?php echo $cajas->id_caja; ?></h3>
                                <div class="plan-duration">Saldo:</div>
                                <h2 class="plan-title">
                                    <?php echo number_format(($saldo_caja->saldo_movimiento), 0, ',', '.'); ?>
                                </h2>
                                <div class="plan-duration">Usuario: <?php echo $cajas->usuario_apertura; ?></div>
                            </div>
                            <div class="text-center">
                                <?php if ($cajas->estadocaja == 1) { ?>
                                <button class="btn btn-success btn-md" type="submit">Cerrar
                                    Caja</button>
                            </div>
                            <?php } else {
                                        echo "<a href='" . base_url() . "'Dashboard_controller' class='btn btn-success btn-md'>Volver a Abrir</a>";
                                    } ?>
                        </div>

                    </article>
                </form>
                <!-- end article -->
                <?php } ?>
                <div class="card-box">
                    <!-- <div class="col-md-2 pull-right">
                    <a href="" class="btn btn-success btn-md btn-block" data-toggle="modal"
                        data-target="#modal-agregar"><i class="fa fa-plus"></i> <span> Nuevo Perfil</span> </a>
                </div> -->
                    <h4 class="header-title m-t-0 m-b-30"> Listado de Movimientos</h4>
                    <div class="table-responsive">
                        <table class="table" id="movimientos">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Fecha</th>
                                    <th>Tipo</th>
                                    <th>Motivo</th>
                                    <th>Caja</th>
                                    <th>Usuario</th>
                                    <th>Importe</th>
                                    <th>Saldo</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($movimientos)) : ?>
                                <?php foreach ($movimientos as $movimiento) : ?>
                                <tr>
                                    <td><?php echo $movimiento->id_movimiento; ?></td>
                                    <td><?php echo  date('d-m-Y', strtotime($movimiento->fecha_hora));
                                                ?></td>

                                    <?php

                                            $tipo_movimiento = $movimiento->tipo_movimiento;
                                            $saldo_movimiento = $movimiento->saldo_movimiento;

                                            if ($tipo_movimiento == 1) {
                                                $tipo_movimiento2     = "Entrada";
                                                $label_class_tipo_movimiento = 'label-primary';
                                            } elseif ($tipo_movimiento == 2) {
                                                $tipo_movimiento2     = "Salida";
                                                $label_class_tipo_movimiento = 'label-default';
                                            }

                                            $estado = $movimiento->estado;

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
                                    <td><span class="label <?php echo $label_class_tipo_movimiento ?>">
                                            <?php echo  $tipo_movimiento2 ?></span>
                                    </td>
                                    <td><?php echo $movimiento->motivo; ?></td>

                                    <td>Caja <?php echo $movimiento->id_caja; ?></td>
                                    <td><?php echo $movimiento->usuario; ?></td>
                                    <td><?php echo  number_format(($movimiento->importe_movimiento), 0, ',', '.'); ?>
                                    </td>
                                    <td><?php echo  number_format(($saldo_movimiento), 0, ',', '.'); ?>
                                    </td>

                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>

                            </tbody>
                            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;">
                                <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;">
                                </div>
                            </div>
                            <div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;">
                                <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;">
                                </div>
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>