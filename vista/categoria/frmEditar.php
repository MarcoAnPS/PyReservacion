    <section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlCategoria&accion=guardarEditar" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text">Id:</span>
            <input type="text" name="id" value="<?=$categoria->getidCategoria()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Nombre:</span>
            <input type="text" name="Nombre" value="<?=$categoria->getNombre()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Descripcion:</span>
            <input type="text" name="Descripcion" value="<?=$categoria->getDescripcion()?>" 
                class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Guardar</button>
    </form>
    <br><a href="?ctrl=CtrlCategoria" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>