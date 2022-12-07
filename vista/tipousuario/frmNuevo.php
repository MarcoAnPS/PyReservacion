<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlTipoUsuario&accion=guardarNuevo" method="post">
        <div class="row mb-3">
        <div class="col-md-6">
            <label for="inputidtipoUsuario" class="form-label">Id:</label>
            <input type="text" class="form-control"
                name="idtipoUsuario" value="" id="inputidtipoUsuario">
        </div>
        <div class="col-md-6">
            <label for="inputNombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control"
                name="Nombre" value="" id="inputNombre">
        </div>
        </div>
        <div class="col-md-3">
        <button type="submit" class="form-control btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
        </div>
    </form>
    <br><a href="?ctrl=CtrlTipoUsuario" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>