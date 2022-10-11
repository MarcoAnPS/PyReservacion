<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlReserva&accion=guardarEditar" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text">Id:</span>
            <input type="text" name="idReserva" value="<?=$reserva->getidReserva()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Fecha:</span>
            <input type="datetime-local" name="Fecha" value="<?=$reserva->getFecha()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Estado:</span>
            <input type="text" name="Estado" value="<?=$reserva->getEstado()?>" 
                class="form-control">
        </div>
        <div class="col-md-6">
            <label for="inputNombre" class="form-label">Nombre:</label>
            <select class="form-control" name="cliente" id="Cliente">
                <?php 
                $clientes= $reserva->getCliente()->leer()['data'];
                $cliente = $reserva->getCliente()->getidCliente();
                foreach ($clientes as $cl) {
                    if ($cl["idCategoria"]==$cliente) 
                            $seleccionado="selected";
                        else   
                            $seleccionado="";
                ?>
                <option <?=$seleccionado?>  value="<?=$cl['idCliente']?>"><?=$cl['Nombre']?></option>
                <?php } ?>

            </select>
            
        </div>
        <div class="col-md-6">
            <label for="inputMesa" class="form-label">Numero de mesa:</label>
            <select class="form-control" name="mesa" id="Mesa">
                <?php 
                $mesas= $reserva->getMesa()->leer()['data'];
                $mesa = $reserva->getMesa()->getidMesa();
                foreach ($mesas as $m) {
                    if ($m["idMesa"]==$mesa) 
                            $seleccionado="selected";
                        else   
                            $seleccionado="";
                ?>
                <option <?=$seleccionado?>  value="<?=$m['idMesa']?>"><?=$m['Numero']?></option>
                <?php } ?>

            </select>
            
        </div>
        <div class="col-md-3">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
        </div>
    </form>
    <br><a href="?ctrl=CtrlReserva" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>
