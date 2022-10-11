<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlReserva&accion=guardarNuevo" method="post">
        <div class="row mb-3">
        <div class="col-md-6">
            <label for="inputidReserva" class="form-label">Id:</label>
            <input type="text" class="form-control"
                name="idReserva" value="" id="inputidReserva">
        </div>
        <div class="col-md-6">
            <label for="inputFecha" class="form-label">Fecha:</label>
            <input type="datetime-local" class="form-control"
                name="Fecha" value="" id="inputFecha">
        </div>
        <div class="col-md-6">
            <label for="inputEstado" class="form-label">Estado:</label>
            <input type="text" class="form-control"
                name="Estado" value="" id="inputEstado">
        </div>
        <div class="col-md-6">
            <label for="inputNombre" class="form-label">Nombre Cliente:</label>
            <select class="form-control" name="cliente" id="Cliente">
                <?php 
                $clientes= $reserva->getCliente()->leer()['data'];
                foreach ($clientes as $cl) {
                ?>
                <option value="<?=$cl['idCliente']?>"><?=$cl['Nombre']?></option>
                <?php } ?>

            </select>
            
        </div>
        <div class="col-md-6">
            <label for="inputMesa" class="form-label">Numero de Mesa:</label>
            <select class="form-control" name="mesa" id="Mesa">
                <?php 
                $mesas= $reserva->getMesa()->leer()['data'];
                foreach ($mesas as $m) {
                ?>
                <option value="<?=$m['idMesa']?>"><?=$m['Numero']?></option>
                <?php } ?>

            </select>
        </div>
        </div>
        <div class="col-md-3">
        <button type="submit" class="form-control btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
        </div>
    </form>
    <br><a href="?ctrl=CtrlReserva" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>