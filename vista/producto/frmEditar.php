<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlProducto&accion=guardarEditar" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text">Id:</span>
            <input type="text" name="idProducto" value="<?=$producto->getidProducto()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Nombre:</span>
            <input type="text" name="Nombre" value="<?=$producto->getNombre()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Descripcion:</span>
            <input type="text" name="Descripcion" value="<?=$producto->getDescipcion()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Cantidad:</span>
            <input type="text" name="Cantidad" value="<?=$producto->getCantidad()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Costo:</span>
            <input type="text" name="Costo" value="<?=$producto->getCosto()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Precio:</span>
            <input type="text" name="Precio" value="<?=$producto->getPrecio()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Estado:</span>
            <input type="text" name="Estado" value="<?=$producto->getEstado()?>" 
                class="form-control">
        </div>
        <div class="col-md-6">
            <label for="inputCategoria" class="form-label">Categoria:</label>
            <select class="form-control" name="categoria" id="Categoria">
                <?php 
                $categorias= $producto->getCategoria()->leer()['data'];
                $categoria = $producto->getCategoria()->getidCategoria();
                foreach ($categorias as $ca) {
                    if ($ca["idCategoria"]==$categoria) 
                            $seleccionado="selected";
                        else   
                            $seleccionado="";
                ?>
                <option <?=$seleccionado?>  value="<?=$ca['idCategoria']?>"><?=$ca['Nombre']?></option>
                <?php } ?>

            </select>
            
        </div>
        <div class="col-md-6">
            <label for="inputUsuario" class="form-label">Usuario:</label>
            <select class="form-control" name="usuario" id="Usuario">
                <?php 
                $usuarios= $producto->getUsuario()->leer()['data'];
                $usuario = $producto->getUsuario()->getidUsuario();
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
    <br><a href="?ctrl=CtrlProducto" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>
