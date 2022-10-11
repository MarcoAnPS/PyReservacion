<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlCliente&accion=guardarNuevo" method="post">
        <div class="row mb-3">
        <div class="col-md-6">
            <label for="inputidCliente" class="form-label">Id:</label>
            <input type="text" class="form-control"
                name="idCliente" value="" id="inputidCliente">
        </div>
        <div class="col-md-6">
            <label for="inputNombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control"
                name="Nombre" value="" id="inputNombre">
        </div>
        <div class="col-md-6">
            <label for="inputApellido" class="form-label">Apellido:</label>
            <input type="text" class="form-control"
                name="Apellido" value="" id="inputApellido">
        </div>
        <div class="col-md-6">
            <label for="inputDNI" class="form-label">DNI:</label>
            <input type="text" class="form-control"
                name="DNI" value="" id="inputDNI">
        </div>
        <div class="col-md-6">
            <label for="inputTelefono" class="form-label">Telefono:</label>
            <input type="text" class="form-control"
                name="Telefono" value="" id="inputTelefono">
        </div><div class="col-md-6">
            <label for="inputDireccion" class="form-label">Direccion:</label>
            <input type="text" class="form-control"
                name="Direccion" value="" id="inputDireccion">
        </div>
        <div class="col-md-6">
            <label for="inputEmail" class="form-label">Email:</label>
            <input type="email" class="form-control"
                name="Email" value="" id="inputEmail">
        </div>
        <div class="col-md-6">
            <label for="inputUsuario" class="form-label">Usuario:</label>
            <select class="form-control" name="usuario" id="Usuario">
                <?php 
                $usuarios= $cliente->getUsuario()->leer()['data'];
                foreach ($usuarios as $u) {
                ?>
                <option value="<?=$u['idUsuario']?>"><?=$u['Nickname']?></option>
                <?php } ?>

            </select>
        </div>
        </div>
        <div class="col-md-3">
        <button type="submit" class="form-control btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
        </div>
    </form>
    <br><a href="?ctrl=CtrlCliente" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>