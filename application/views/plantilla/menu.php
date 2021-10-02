<div id="wrapper">
    <!-- Top Bar Start -->
    <div class="topbar">
        <!-- LOGO -->
        <div class="topbar-left">
            <img src="<?php echo base_url(); ?>assets/images/1.png" alt="branding logo">
            <!--<a href="<?php echo base_url(); ?>" class="logo"><span>FOTO<span>PY</span></span><i class="zmdi zmdi-layers"></i></a>-->
        </div>
        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">

                <!-- Page title -->
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <button class="button-menu-mobile open-left">
                            <i class="zmdi zmdi-menu"></i>
                        </button>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>Ventas_controller/add" class="page-title menu_superior">
                            <i class="fa fa-dollar"></i>
                            Vender
                        </a>
                    </li>
                </ul>

                <!-- Right(Notification and Searchbox -->
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <!-- Notification -->
                        <div class="notification-box">
                            <ul class="list-inline m-b-0">
                                <!-- <li>
                                    <a href="<?php echo base_url(); ?>Ventas_controller" class="right-bar-toggle">
                                        <i class="zmdi zmdi-notifications-none"></i>
                                    </a>

                                </li> -->
                                <li>
                                    <a href="<?php echo base_url(); ?>Auth/logout" class="right-bar-toggle">
                                        <i class="zmdi zmdi-power"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- End Notification bar -->
                    </li>

                </ul>

            </div><!-- end container -->
        </div><!-- end navbar -->
    </div>
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">

            <!-- User -->
            <div class="user-box">
                <div class="user-img">
                    <img src="<?php echo base_url(); ?>assets/images/users/fer.jpg" alt="user-img" title="Administrador"
                        class="img-circle img-thumbnail img-responsive">
                    <div class="user-status offline"><i class="zmdi zmdi-dot-circle"></i></div>
                </div>
                <h5><a
                        href="#"><?php echo $this->session->userdata('id_usuario') . '-' . $this->session->userdata('username'); ?></a>
                </h5>
            </div>
            <!-- End User -->

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <ul>

                    <li>
                        <a href="<?php echo base_url(); ?>" class="waves-effect"><i class="fa fa-calendar"></i> <span>
                                Planificación </span> </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>Reservas_controller" class="waves-effect">
                            <i class="fa fa-calendar-o"></i> <span> Reservas </span> </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Ventas_controller" class="waves-effect">
                            <i class="fa fa-dollar"></i> <span> Ventas </span> </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Cobranzas_controller" class="waves-effect">
                            <i class="fa fa-money"></i> <span> Cobranzas </span> </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Movimientos_controller" class="waves-effect">
                            <i class="fa fa-bar-chart"></i> <span> Movimientos </span> </a>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cogs"></i>
                            <span>Mantenimientos </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">

                            <li><a href="<?php echo base_url(); ?>Productos_controller"
                                    class="waves-effect">Productos</a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>Servicios_controller"
                                    class="waves-effect">Servicios</a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>Categorias_controller"
                                    class="waves-effect">Categorias</a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>Tipo_eventos_controller" class="waves-effect">Tipos de
                                    Eventos</a>
                            </li>

                            <li><a href="<?php echo base_url(); ?>Cajas_controller" class="waves-effect">Cajas</a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>Clientes_controller" class="waves-effect">Clientes</a>
                            </li>

                            <li><a href="<?php echo base_url(); ?>Proveedores_controller"
                                    class="waves-effect">Proveedores
                                </a></li>

                            <li><a href="<?php echo base_url(); ?>Empleados_controller" class="waves-effect">Personal
                                    del Staff </a></li>

                            <li><a href="<?php echo base_url(); ?>Cargos_controller" class="waves-effect">Cargos</a>
                            </li>


                            <li><a href="<?php echo base_url(); ?>Comprobantes_controller"
                                    class="waves-effect">Comprobantes</a></li>


                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-file"></i> <span> Reportes
                            </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li class="has_sub">
                            <li><a href="<?php echo base_url(); ?>Ventas_controller/reporte">Reporte de Ventas por
                                    Fecha</a>
                            </li>

                    </li>
                </ul>


                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-shield"></i> <span>
                            Seguridad </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url(); ?>Usuarios_controller">Gestionar Usuarios </a></li>
                        <li><a href="<?php echo base_url(); ?>Usuarios_controller">Permisos por Perfil</a></li>
                        <li><a href="<?php echo base_url(); ?>Perfiles_controller">Gestionar Perfiles </a></li>
                        <li>
                            <a href="<?php echo base_url(); ?>Bk" class="waves-effect"></i> <span>
                                    Copia de Seguridad </span> </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a target="_blank" href="<?php echo base_url(); ?>docFotoPy/site" class="waves-effect"><i
                            class="fa fa-file"></i> <span>
                            Documentacion </span> </a>
                </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <!-- Sidebar -->
            <div class="clearfix"></div>
        </div>

    </div>
</div>
<!-- Left Sidebar End -->