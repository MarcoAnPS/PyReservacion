<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlProducto&accion=guardarNuevo" method="post">
        <div class="row mb-3">
        <div class="col-md-6">
            <label for="inputidProducto" class="form-label">Id:</label>
            <input type="text" class="form-control"
                name="idProducto" value="" id="inputidProducto">
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
        <div class="col-md-6">
            <label for="inputCantidad" class="form-label">Cantidad:</label>
            <input type="text" class="form-control"
                name="Cantidad" value="" id="inputCantidad">
        </div>
        <div class="col-md-6">
            <label for="inputCosto" class="form-label">Costo:</label>
            <input type="text" class="form-control"
                name="Costo" value="" id="inputCosto">
        </div><div class="col-md-6">
            <label for="inputPrecio" class="form-label">Precio:</label>
            <input type="text" class="form-control"
                name="Precio" value="" id="inputPrecio">
        </div>
        <div class="col-md-6">
            <label for="inputEstado" class="form-label">Estado:</label>
            <input type="text" class="form-control"
                name="Estado" value="" id="inputEstado">
        </div>
        <div class="col-md-6">
            <label for="inputCategoria" class="form-label">Categoria:</label>
            <select class="form-control" name="categoria" id="Categoria">
                <?php 
                $categorias= $producto->getCategoria()->leer()['data'];
                foreach ($categorias as $ca) {
                ?>
                <option value="<?=$ca['idCategoria']?>"><?=$ca['Nombre']?></option>
                <?php } ?>

            </select>
            
        </div>
        <div class="col-md-6">
            <label for="inputUsuario" class="form-label">Usuario:</label>
            <select class="form-control" name="usuario" id="Usuario">
                <?php 
                $usuarios= $producto->getUsuario()->leer()['data'];
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
    <br><a href="?ctrl=CtrlProducto" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>