<section class="content">
    <div class="container w-25 p-2">
    <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Nuevo</b>Usuario</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Ingresar Datos</p>

      <form action="?ctrl=CtrlUsuario&accion=guardarNuevo" method="post">
      <div class="row mb-3">
        <div class="col-md-6">
            <label for="inputNickname" class="form-label">Nickname:</label>
            <input type="text" class="form-control"
                name="Nickname" value="" id="inputNickname">
        </div>
        <div class="col-md-6">
            <label for="inputContraseña" class="form-label">Contraseña:</label>
            <input type="text" class="form-control"
                name="Contraseña" value="" id="inputContraseña">
        </div>
        <div class="col-md-6">
            <label for="inputNombre" class="form-label">Nomber:</label>
            <input type="text" class="form-control"
                name="nombre" value="" id="inputNombre">
        </div>
        <div class="col-md-6">
            <label for="inputEmail" class="form-label">Email:</label>
            <input type="text" class="form-control"
                name="email" value="" id="inputEmail">
        </div>
        
        <div class="col-md-6">
            <label for="inputTipoUsuario" class="form-label">Tipo de Usuario:</label>
            <select class="form-control" name="tipousuario" id="TipoUsuario">
                <?php 
                $tipoUsuarios= $usuarios->getTipoUsuario()->leer()['data'];
                foreach ($tipoUsuarios as $tu) {
                ?>
                <option value="<?=$tu['idtipoUsuario']?>"><?=$tu['Nombre']?></option>
                <?php } ?>

            </select> 
        </div>
        <div class="col-md-6">
            
            <input hidden type="text" class="form-control"
                name="Estado" value="0" id="inputEstado">
        </div>
        <div class="col-md-6">
            
            <input hidden type="text" class="form-control"
                name="idUsuario" value="" id="inputidUsuario">
        </div>
        </div>
        <div class="col-md-3">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
        </div>
      </form>

      <div class="social-auth-links text-center">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Registrarse con Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Registrarse con Google+
        </a>
        
      </div>
    </div>
    <!-- /.form-box -->
  </div>
</div>
</section>