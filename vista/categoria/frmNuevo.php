    <section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlCategoria&accion=guardarNuevo" method="post">
        <div class="row mb-3">
        <div class="col-md-6">
            <label for="inputidCategoria" class="form-label">Id:</label>
            <input type="text" class="form-control"
                name="id" value="" id="inputidCategoria">
        </div>
        <div class="col-md-6">
            <label for="inputNombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control"
                name="Nombre" value="" id="inputNombre">
        </div>
        <div class="col-md-6">
            <label for="inputDescripcion" class="form-label">Descripcion:</label>
            <input type="text" class="form-control"
                name="Descripcion" value="" id="inputDescripcion">
        </div>
        </div>
        <div class="col-md-3">
        <button type="submit" class="form-control btn btn-primary">
            <i class="fa fa-save"></i> Guardar</button>
        </div>
    </form>
</div>
</section>