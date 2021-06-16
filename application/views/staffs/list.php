<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
	<!-- Start content -->
	<div class="content">

		<?php
		if($this->session->flashdata("success")): ?>
			<div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert">
					&times;
				</button>
				<strong>
					¡Buen Trabajo!
				</strong>
				<p>
					<?php echo $this->session->flashdata("success")?>
				</p>
			</div>

		<?php endif; ?>
		<?php
		if($this->session->flashdata("error")): ?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">
					&times;
				</button>
				<strong>
					¡Error!
				</strong>
				<p>
					<?php echo $this->session->flashdata("error")?>
				</p>
			</div>
		<?php endif; ?>
		<!-- end row -->
		<div class="row">
			<div class="col-lg-12">
				<div class="card-box">
					<div class="col-md-2 pull-right">
						<a href="" class="btn btn-success btn-md btn-block"  data-toggle="modal" data-target="#modal-agregar"><i class="fa fa-plus"></i> <span> Nuevo Personal de Staff</span> </a>
					</div>
					<h4 class="header-title m-t-0 m-b-30"> Listado de Personal de Staff</h4>
					<div class="table-responsive">
						<table class="table" id="example3">
							<thead>
								<tr>
									<th>Id</th>
                                    <!-- <th>Codigo</th> -->
                                    <th>Documento</th>
                                    <th>Personal de Staff</th>
                                    <th>Dirección</th>
                                    <th>Ciudad</th> 
                                    <th>Telefono</th>
                                    <th>Telefono 2</th>
									<th>Email</th>
                                    <th>Ocupación</th>
                                    <th>Año de ingreso</th>
									<th>Estado</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($staffs)):?>
									<?php foreach($staffs as $staff):?>
										<tr>
                                            <td><?php echo $staff->id_staff;?></td>
                                            <td><?php echo $staff->nrodocumento;?></td>
											<td><?php echo $staff->nomape;?></td>
                                            <td><?php echo $staff->direccion;?></td>
                                            <td><?php echo $staff->id_ciudad;?></td>
                                            <td><?php echo $staff->telefono;?></td>
                                            <td><?php echo $staff->telefono2;?></td>
											<td><?php echo $staff->email;?></td>
											<td><?php echo $staff->ocupacion;?></td>
                                            <td><?php echo $staff->ingreso;?></td>
											<?php 

											$estado = $staff->estado;
											if($estado == 1)
											{
												$estado2     = "Activo";$label_class = 'label-success';
											}
											else
											{
												if($estado == 2)
												{
													$estado2     = "Inactivo";$label_class = 'label-warning';
												}
												else
												{
													$estado2     = "Anulado";$label_class = 'label-danger';
												}
											}
											?>
											<td><span class="label <?php echo $label_class;?>"><?php echo $estado2; ?></span></td>
											<td>
												<!-- usa del modelo la funcion correspondiente -->
												<button type="button" class="btn btn-success btn-sm btn-ver" data-toggle="modal" data-target="#modal-ver" value="<?php echo $staff->id_staff;?>" title="Ver Detalles del Personal del Staff">
													<i class="fa fa-eye">
													</i> Ver
												</button>
												<!-- usa del modelo la funcion correspondiente -->
												<button type="button" class="btn btn-warning btn-sm btn-editar" data-toggle="modal" data-target="#modal-editar" value="<?php echo $staff->id_staff;?>" title="Editar Detalles del Personal del Staff">
													<i class="fa fa-pencil">
													</i> Editar
												</button>

												<a href="<?php echo base_url();?>Staffs_controller/delete/<?php echo $staff->id_staff;?>" class="btn btn-sm btn-danger btn-delete" title="Inactivar personal">
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
                            <h5 class="modal-title" id="exampleModalLabel2">NUEVO PERSONAL DEL STAFF</h5>
                        </div>
                        <div class="modal-body">
                            <form class="form" action="<?php echo base_url();?>Staffs_controller/store" method="POST" id="formAdd" name="formAdd" >
                                <div class="form-body">
                                    <div class="form-group">
                                        <label for="timesheetinput1">Documento</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="timesheetinput1" class="form-control" placeholder="Documento" name="nrodocumento" required="">
                                            <div class="form-control-position">
                                                <i class="icon-android-cart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="timesheetinput1">Nombre y Apellido del Personal</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="timesheetinput1" class="form-control" placeholder="Nombre y Apellido" name="nomape" required="">
                                            <div class="form-control-position">
                                                <i class="icon-android-cart"></i>
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label for="timesheetinput1">Dirección</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="timesheetinput1" class="form-control" placeholder="Dirección" name="direccion" required="">
                                            <div class="form-control-position">
                                                <i class="icon-android-cart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="timesheetinput1">Ciudad</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="timesheetinput1" class="form-control" placeholder="Ciudad" name="id_ciudad" required="">
                                            <div class="form-control-position">
                                                <i class="icon-android-cart"></i>
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label for="timesheetinput1">Telefono</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="timesheetinput1" class="form-control" placeholder="Telefono" name="telefono" required="">
                                            <div class="form-control-position">
                                                <i class="icon-android-cart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="timesheetinput1">Telefono 2</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="timesheetinput1" class="form-control" placeholder="Telefono 2" name="telefono2" required="">
                                            <div class="form-control-position">
                                                <i class="icon-android-cart"></i>
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label for="timesheetinput1">Email</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="timesheetinput1" class="form-control" placeholder="Email" name="email" required="">
                                            <div class="form-control-position">
                                                <i class="icon-android-cart"></i>
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label for="timesheetinput1">Ocupación</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="timesheetinput1" class="form-control" placeholder="Ocupación" name="ocupacion" required="">
                                            <div class="form-control-position">
                                                <i class="icon-android-cart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="timesheetinput1">Año de ingreso</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="timesheetinput1" class="form-control" placeholder="Año de ingreso" name="ingreso" required="">
                                            <div class="form-control-position">
                                                <i class="icon-android-cart"></i>
                                            </div>
                                        </div>
                                    </div>
									
                            
                                </div><!-- end div class FORM body--> 
                    </div><!-- end div class MODAL body--> 
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-fill" id="btnEnviarDatos"><i class="icon-check2"></i>Agregar</button>
                        <button type="reset" class="btn btn-warning btn-fill" ><i class="icon-cube"></i>Limpiar</button>
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
                    <h5 class="modal-title">DETALLES DEL PERSONAL</h5>
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
                    <h5 class="modal-title" id="exampleModalLabel2">FICHA DEL PERSONAL</h5>
                </div>
                <form action="<?php echo base_url();?>Staffs_controller/update" method="POST" id="formEdit" name="formEdit" >
                    <div class="modal-body">
                  	<!-- AQUI SE CARGA DESDE EL CONTROLADOR -->
                    </div><!-- end div class modal body--> 
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-fill" id="btnEnviarDatos"><i class="icon-check2"></i>Agregar</button>
                        <button type="reset" class="btn btn-warning btn-fill" ><i class="icon-cube"></i>Limpiar</button>
                        <button type="button" class="btn btn-danger btn-fill" data-dismiss="modal"><i class="icon-cross2"></i>Cerrar</button>
                    </div>
                </form>
            </div><!-- end div class modal content--> 
        </div><!-- end div class modal dialog--> 
    </div><!-- end div class modal-->
    <!-- end Modal editar--> 
