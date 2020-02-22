  <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class="text-center">
                <!--<a href="index.html" class="logo"><span>FOTO<span>PY</span></span></a>-->
                <img height="95" src="assets/images/fotopy.png" width="400" alt="branding logo">

                <br>
                <br>
                <br>
                <h5 class="text-muted m-t-0 font-600">En el corazón de tus recuerdos</h5>
            </div>
            <div class="m-t-40 card-box">
                <div class="text-center">
                    <h4 class="text-uppercase font-bold m-b-0">INICIAR SESIÓN</h4>
                </div>
                 <?php if ($this->session->flashdata("error")): ?>
    <div class="alert alert-danger">
      <p><?php  echo $this->session->flashdata("error")?></p> 
    </div>
  <?php endif; ?>
                <div class="panel-body">
                    <form class="form-horizontal m-t-20" action="Auth/login" method="post">

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" name="username" placeholder="Nombre de Usuario">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="clave" placeholder="Contraseña">
                            </div>
                        </div>
                        <!-- 
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <div class="checkbox checkbox-custom">
                                    <input id="checkbox-signup" type="checkbox">
                                    <label for="checkbox-signup">
                                        Recuérdame
                                    </label>
                                </div>

                            </div>
                        </div>
 -->
                        <div class="form-group text-center m-t-30">
                            <div class="col-xs-12">
                                <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Ingresar</button>
                            </div>
                        </div>
<!-- 
                        <div class="form-group m-t-30 m-b-0">
                            <div class="col-sm-12">
                                <a href="page-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Olvidaste tu contraseña?</a>
                            </div>
                        </div> -->
                    </form>

                </div>
            </div>
            <!-- end card-box-->
<!-- 
            <div class="row">
                <div class="col-sm-12 text-center">
                    <p class="text-muted">No tienes una cuenta? <a href="#" class="text-primary m-l-5"><b>Regístrate</b></a></p>
                </div>
            </div>
 -->            
        </div>
        <!-- end wrapper page -->
        