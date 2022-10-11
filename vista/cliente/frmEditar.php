<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlCliente&accion=guardarEditar" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text">Id:</span>
            <input type="text" name="idCliente" value="<?=$cliente->getidCliente()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Nombre:</span>
            <input type="text" name="Nombre" value="<?=$cliente->getNombre()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Apellido:</span>
            <input type="text" name="Apellido" value="<?=$cliente->getApellido()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">DNI:</span>
            <input type="text" name="DNI" value="<?=$cliente->getDNI()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Telefono:</span>
            <input type="text" name="Telefono" value="<?=$cliente->getTelefono()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Direccion:</span>
            <input type="text" name="Direccion" value="<?=$cliente->getDireccion()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Email:</span>
            <input type="email" name="Email" value="<?=$cliente->getEmail()?>" 
                class="form-control">
        </div>
        <div class="col-md-6">
            <label for="inputUsuario" class="form-label">Usuario:</label>
            <select class="form-control" name="usuario" id="Usuario">
                <?php 
                $usuarios= $cliente->getUsuario()->leer()['data'];
                $usuario = $cliente->getUsuario()->getidUsuario();
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
    <br><a href="?ctrl=CtrlCliente" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>
