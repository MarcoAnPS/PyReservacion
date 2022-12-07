<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlTipoUsuario&accion=guardarEditar" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text">Id:</span>
            <input type="text" name="idtipoUsuario" value="<?=$tipousuario->getidtipousuario()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Nombre:</span>
            <input type="text" name="Nombre" value="<?=$tipousuario->getNombre()?>" 
                class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
    </form>
    <br><a href="?ctrl=CtrlTipoUsuario" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>
