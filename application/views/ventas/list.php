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
                        <a href="<?php echo base_url(); ?>Ventas_controller/add" class="btn btn-success"><i
                                class="fa fa-plus"></i> <span>Nueva Venta</span> </a>
                    </div>
                    <h4 class="header-title m-t-0 m-b-30"> Listado de Ventas </h4>
                    <div class="table-responsive">
                        <table class="table" id="example3">
                            <thead>
                                <tr>
                                    <th>Op</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>Total</th>
                                    <th>F.Pago</th>
                                    <th>T.Comprob.</th>
                                    <th>Cond. Venta</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								if (!empty($ventas)) : ?>
                                <?php foreach ($ventas as $venta) : ?>
                                <tr>
                                    <td><?php echo $venta->id_venta; ?></td>
                                    <?php
											$fecha = $venta->fecha;
											$fecha = date('d-m-Y', strtotime($fecha));
											$estado = $venta->estado;

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
											$tipo =	$venta->tipocomprobante;
											if ($tipo == 1) {
												$tipo2     = "Factura";
												$label_class2 = 'label-success';
											} else {
												$tipo2     = "Boleta";
												$label_class2 = 'label-warning';
											}
											$condicion = $venta->condicionventa;
											if ($condicion == 1) {
												$condicion2     = "Contado";
												$label_condicion = 'label-primary';
											} else {
												$condicion2     = "Crédito";
												$label_condicion = 'label-secondary';
											}
											?>
                                    <td><?php echo $fecha; ?></td>
                                    <td><?php echo $venta->id_cliente . " - " . $venta->nombre; ?></td>
                                    <td><?php echo $venta->total; ?></td>
                                    <td><?php echo $venta->formadepago; ?></td>
                                    <td><?php echo $tipo2; ?></td>
                                    <td><span
                                            class="label <?php echo $label_condicion; ?>"><?php echo $condicion2; ?></span>
                                    <td><span class="label <?php echo $label_class; ?>"><?php echo $estado2; ?></span>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>Ventas_controller/view/<?php echo $venta->id_venta; ?>"
                                            class="btn btn-sm btn-primary" title="Ver y editar detalles de la venta">
                                            <i class="fa fa-eye">
                                            </i> Ver mas detalles
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