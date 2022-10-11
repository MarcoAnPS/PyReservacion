<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlPedido&accion=guardarNuevo" method="post">
        <div class="row mb-3">
        <div class="col-md-6">
            <label for="inputidPedido" class="form-label">Id:</label>
            <input type="text" class="form-control"
                name="idPedido" value="" id="inputidPedido">
        </div>
        <div class="col-md-6">
            <label for="inputNumero" class="form-label">Numero:</label>
            <input type="text" class="form-control"
                name="Numero" value="" id="inputNumero">
        </div>
        <div class="col-md-6">
            <label for="inputFecha" class="form-label">Fecha:</label>
            <input type="datetime-local" class="form-control"
                name="Fecha" value="" id="inputFecha">
        </div>
        <div class="col-md-6">
            <label for="inputPago" class="form-label">Pago:</label>
            <input type="text" class="form-control"
                name="Pago" value="" id="inputPago">
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
                $clientes= $pedido->getCliente()->leer()['data'];
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
                $mesas= $pedido->getMesa()->leer()['data'];
                foreach ($mesas as $m) {
                ?>
                <option value="<?=$m['idMesa']?>"><?=$m['Numero']?></option>
                <?php } ?>

            </select>
        </div>
        <div class="col-md-6">
            <label for="inputUsuario" class="form-label">Usuario:</label>
            <select class="form-control" name="usuario" id="Usuario">
                <?php 
                $usuarios= $pedido->getUsuario()->leer()['data'];
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
    <br><a href="?ctrl=CtrlPedido" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>