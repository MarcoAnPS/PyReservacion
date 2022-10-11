<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlMesa&accion=guardarNuevo" method="post">
        <div class="row mb-3">
        <div class="col-md-6">
            <label for="inputidMesa" class="form-label">Id:</label>
            <input type="text" class="form-control"
                name="idMesa" value="" id="inputidMesa">
        </div>
        <div class="col-md-6">
            <label for="inputNumero" class="form-label">Numero:</label>
            <input type="text" class="form-control"
                name="Numero" value="" id="inputNumero">
        </div>
        <div class="col-md-6">
            <label for="inputEstado" class="form-label">Estado:</label>
            <input type="text" class="form-control"
                name="Estado" value="" id="inputEstado">
        </div>
        <div class="col-md-6">
            <label for="inputCapacidad" class="form-label">Capacidad:</label>
            <input type="text" class="form-control"
                name="Capacidad" value="" id="inputCapacidad">
        </div>
        <div class="col-md-6">
            <label for="inputNroPersonas" class="form-label">NroPersonas:</label>
            <input type="text" class="form-control"
                name="NroPersonas" value="" id="inputNroPersonas">
        </div>
        </div>
        <div class="col-md-3">
        <button type="submit" class="form-control btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
        </div>
    </form>
    <br><a href="?ctrl=CtrlMesa" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>