<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlUsuario&accion=guardarNuevo" method="post">
        <div class="row mb-3">
        <div class="col-md-6">
            <label for="inputidUsuario" class="form-label">Id:</label>
            <input type="text" class="form-control"
                name="idUsuario" value="" id="inputidUsuario">
        </div>
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
        </div>
        <div class="col-md-3">
        <button type="submit" class="form-control btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
        </div>
    </form>
    <br><a href="?ctrl=CtrlUsuario" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>