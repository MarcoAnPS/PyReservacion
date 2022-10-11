<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlMesa&accion=guardarEditar" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text">Id:</span>
            <input type="text" name="idMesa" value="<?=$mesa->getidMesa()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Numero:</span>
            <input type="text" name="Numero" value="<?=$mesa->getNumero()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Estado:</span>
            <input type="text" name="Estado" value="<?=$mesa->getEstado()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Capacidad:</span>
            <input type="text" name="Capacidad" value="<?=$mesa->getCapacidad()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">NroPersonas:</span>
            <input type="text" name="NroPersonas" value="<?=$mesa->getNroPersonas()?>" 
                class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
    </form>
    <br><a href="?ctrl=CtrlMesa" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>
