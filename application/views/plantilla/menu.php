<div id="wrapper">
    <!-- Top Bar Start -->
    <div class="topbar">
        <!-- LOGO -->
        <div class="topbar-left">
            <br>
            <br>
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
                        <h4 class="page-title"></h4>
                    </li>
                </ul>

                <!-- Right(Notification and Searchbox -->
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <!-- Notification -->
                        <div class="notification-box">
                            <ul class="list-inline m-b-0">
                                <li>
                                    <a href="javascript:void(0);" class="right-bar-toggle">
                                        <i class="zmdi zmdi-notifications-none"></i>
                                    </a>
                                    <div class="noti-dot">
                                        <span class="dot"></span>
                                        <span class="pulse"></span>
                                    </div>
                                </li>
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
                    <img src="<?php echo base_url(); ?>assets/images/users/fer.jpg" alt="user-img" title="Administrador" class="img-circle img-thumbnail img-responsive">
                    <div class="user-status offline"><i class="zmdi zmdi-dot-circle"></i></div>
                </div>
                <h5><a href="#"><?php echo $this->session->userdata("id_usuario") . "-" . $this->session->userdata("username"); ?></a> </h5>
            </div>
            <!-- End User -->

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <ul>

                    <li>
                        <a href="<?php echo base_url(); ?>" class="waves-effect"><i class="fa fa-calendar"></i> <span> Actividades </span> </a>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-calendar-plus-o"></i> <span> Reservas </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo base_url(); ?>Reservas_controller">Gestionar Reservas</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-camera"></i> <span> Productos/Servicios </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo base_url(); ?>Servicios_controller">Gestionar Productos/Servicios </a></li>
                            <li><a href="<?php echo base_url(); ?>Categorias_controller">Gestionar Categorias </a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-money"></i> <span> Presupuestos </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo base_url(); ?>Presupuestos_controller">Gestionar Presupuestos</a></li>
                        </ul>
                    </li>

                 

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-dollar (alias)"></i> <span> Ventas </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo base_url(); ?>Ventas_controller/add">Nueva Venta </a></li>
                            <li><a href="<?php echo base_url(); ?>Ventas_controller">Gestionar Ventas </a></li>
                            <li><a href="<?php echo base_url(); ?>Ventas_controller/reporte">Reporte por Fecha</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-line-chart"></i> <span> Cobranzas </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo base_url(); ?>Cobros_controller">Gestionar Cobranzas </a></li>
                        </ul>
                    </li>
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-newspaper-o"></i> <span> Comprobantes </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo base_url(); ?>Comprobantes_controller">Gestionar Comprobantes </a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cogs"></i> <span> Mantenimientos </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo base_url(); ?>Empleados_controller">Empleado </a></li>
                            <li><a href="<?php echo base_url(); ?>Eventos_controller">Tipo de Evento </a></li>
                            <li><a href="<?php echo base_url(); ?>Horarios_controller">Horario Reserva </a></li>
                        </ul>
                    </li>
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-phone"></i> <span> Contactos </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo base_url(); ?>Clientes_controller">Clientes</a></li>
                            <li><a href="<?php echo base_url(); ?>Proveedores_controller">Proveedores </a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user-circle"></i> <span> Usuarios </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo base_url(); ?>Usuarios_controller">Gestionar Usuarios </a></li>
                            <li><a href="<?php echo base_url(); ?>Usuarios_controller">Permisos por Perfil</a></li>
                            <li><a href="<?php echo base_url(); ?>Perfiles_controller">Gestionar Perfiles </a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Bk" class="waves-effect"><i class="fa fa-refresh"></i> <span> Copia de Seguridad </span> </a>
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