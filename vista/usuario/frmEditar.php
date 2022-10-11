<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlUsuario&accion=guardarEditar" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text">Id:</span>
            <input type="text" name="idUsuario" value="<?=$usuario->getidUsuario()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Nickname:</span>
            <input type="text" name="Nickname" value="<?=$usuario->getNickname()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Contraseña:</span>
            <input type="text" name="Contraseña" value="<?=$usuario->getContraseña()?>" 
                class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
    </form>
    <br><a href="?ctrl=CtrlUsuario" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>
