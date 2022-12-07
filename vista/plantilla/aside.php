
<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-5 bg-info">
  <!-- Brand Logo -->
  <a href=".?" class="brand-link text-white">
    <img src="dist/img/logo2.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
    <span class="brand-text font-weight-light">SIST-RE</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info ">
        <a href="#" class="d-block text-white">
          <?php 
          echo (isset($_SESSION['email']))?$_SESSION['email']:'Visitante';
          
          ?>
        </a>
        
      </div>  
    </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php 
            if (isset($_SESSION['nombre']))
            foreach ($menu as $m) {
              ?>
              <li class="nav-item bg-white rounded text-info">
                
                <a href="<?='?ctrl='.$m['enlace']?>" class="nav-link ">
                
                <i class="nav-icon fas fa-<?=$m['icono']?>"></i>
                
                <p><?=$m['texto']?></p></a>
                
              </li>
              <br> 
              <?php 
            } 
            ?>
          </ul>
        </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>