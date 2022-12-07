
<div class="wrapper">
  <div class="container-fluid">
    <nav class=" main-header navbar navbar-expand navbar-white navbar-light ">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
        <?php if (isset($_SESSION['tipo'])) 
          if($_SESSION['tipo']!='1') { ?>
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i>Administrador</i></a>
          </li>
          <?php }?>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="?" class="nav-link">Inicio</a>
          </li>
        </ul>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="search">
            <input id="txtBuscar" class="form-control form-control" type="search" placeholder="Buscar" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar bg-info" id="btnBuscar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>
        
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Navbar Search -->
          <li class="nav-item">
            <div class="navbar-search-block">
              <form class="form-inline">
                <div class="input-group input-group-sm">
                  <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </li>

            <?php 
            if (isset($_SESSION['nombre'])){
            ?>
            <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown mt-4 pb-3 mb-3 d-flex">
              <a class="mr-2 d-none d-lg-inline text-gray-600 small text-info" data-toggle="dropdown" href="#" title=" <?=$_SESSION['nombre'];?>">
              <i class=""></i><?=$_SESSION['nombre'];?>
              
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      <?= (isset($_SESSION['nombre']))?$_SESSION['nombre']:'Visitante';?>
                      <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">
                      <i class="far fa-envelope"></i> : <?= (isset($_SESSION['email']))?$_SESSION['email']:'-';?>
                    </p>
                    <p class="text-sm text-muted"><i></i> hace 4 horas</p>
                  </div>
                </div>
                <!-- Message End -->
              </a>
              <div class="dropdown-divider"></div>
              <a href="?ctrl=CtrlUsuario&accion=cambiarClave" class="dropdown-item dropdown-footer">cambiar contraseña</a>
              <a href="#" class="dropdown-item dropdown-footer">Acerca de...</a>
              <a href="?ctrl=CtrlUsuario&accion=perfil" class="dropdown-item dropdown-footer">Perfil...</a>
              <div class="dropdown-divider"></div>
              <a href="?ctrl=CtrlUsuario&accion=cerrarSesion" class="dropdown-item dropdown-footer">Cerrar Sesión</a>
            </div>
          </li>
          <hr> 
          <?php
          } 
          else {
            ?>
            <li class="nav-item">
              <a class="btn btn-app bg-info" role="button" data-toggle="modal" data-target="#modal-login" title="Ingresar...">
                <i class="far fa-user "></i> Ingresar
              </a> 
              <a href="?ctrl=CtrlUsuario&accion=nuevo " class="btn btn-app nuevo bg-info">
                <i class="far fa-user "></i> 
                Registrarse
              </a>
              <?php
              }
              $cantProductos =isset($_SESSION['carrito'])?$_SESSION['carrito']->getNroProductos():0;
              ?>
            </li>
            
            <li class="nav-item">
              <a href="?ctrl=CtrlCarrito&accion=mostrar" class="btn btn-app bg-info" title="Tiene <?= $cantProductos?> Elementos en el Carrito">
              <span class="badge bg-red "><?= $cantProductos?></span>
              <i class="fa fa-cart-plus"></i>Ver Carrito</a>
            </li> 
        </ul>
    </nav>
  </div>
<div>

<!-- /.navbar -->

    <div class="modal fade" id="modal-login">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-info">
            <h4 class="modal-title">Login</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p class="login-box-msg">Registre la siguiente información</p>
            <form action="?ctrl=CtrlUsuario&accion=validar" method="post">
              <div class="input-group mb-3">
                <input type="text" name="usuario" class="form-control" placeholder="Usuario">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" name="clave" class="form-control" placeholder="Clave">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" id="remember">
                    <label for="remember">
                      Recuérdame
                    </label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                </div>                  
                <!-- /.col -->
              </div>
            </form>
          </div>                  
          <div class="social-auth-links text-center mt-2 mb-3">
            <a href="#" class="btn btn-block btn-primary">
              <i class="fab fa-facebook mr-2"></i> Ingresa usando Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
              <i class="fab fa-google-plus mr-2"></i> Ingresa usando Google+
            </a>
          </div>
          <div class="modal-footer bg-info">
            <a href="#" class="text-white">Perdiste tu Contraseña?</a>
          </div>
          <!-- /.social-auth-links -->
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  
   

