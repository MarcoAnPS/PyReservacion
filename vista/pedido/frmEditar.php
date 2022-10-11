<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlPedido&accion=guardarEditar" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text">Id:</span>
            <input type="text" name="idPedido" value="<?=$pedido->getidPedido()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Numero:</span>
            <input type="text" name="Numero" value="<?=$pedido->getNumero()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Fecha:</span>
            <input type="datetime-local" name="Fecha" value="<?=$pedido->getFecha()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Pago:</span>
            <input type="text" name="Pago" value="<?=$pedido->getPago()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Estado:</span>
            <input type="text" name="Estado" value="<?=$pedido->getEstado()?>" 
                class="form-control">
        </div>
        <div class="col-md-6">
            <label for="inputNombre" class="form-label">Nombre:</label>
            <select class="form-control" name="cliente" id="Cliente">
                <?php 
                $clientes= $pedido->getCliente()->leer()['data'];
                $cliente = $pedido->getCliente()->getidCliente();
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
                $mesas= $pedido->getMesa()->leer()['data'];
                $mesa = $pedido->getMesa()->getidMesa();
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
        <div class="col-md-6">
            <label for="inputUsuario" class="form-label">Usuario:</label>
            <select class="form-control" name="usuario" id="Usuario">
                <?php 
                $usuarios= $pedido->getUsuario()->leer()['data'];
                $usuario = $pedido->getUsuario()->getidUsuario();
                foreach ($usuarios as $u) {
                    if ($u["idUsuario"]==$usuario) 
                            $seleccionado="selected";
                        else   
                            $seleccionado="";
                ?>
                <option <?=$seleccionado?>  value="<?=$u['idUsuario']?>"><?=$u['Nickname']?></option>
                <?php } ?>

            </select>
            
        </div>
        <div class="col-md-3">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
        </div>
    </form>
    <br><a href="?ctrl=CtrlPedido" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>
