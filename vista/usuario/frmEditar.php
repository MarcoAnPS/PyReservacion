<section class="content">
    <div class="container-fluid">
    <form action="?ctrl=CtrlUsuario&accion=guardarEditar" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text">Id:</span>
            <input type="text" name="idUsuario" value="<?=$usuarios->getidUsuario()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Nickname:</span>
            <input type="text" name="Nickname" value="<?=$usuarios->getNickname()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Contraseña:</span>
            <input type="text" name="Contraseña" value="<?=$usuarios->getContraseña()?>" 
                class="form-control">
        </div><div class="input-group mb-3">
            <span class="input-group-text">Nombre:</span>
            <input type="text" name="nombre" value="<?=$usuarios->getNombre()?>" 
                class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Email:</span>
            <input type="text" name="email" value="<?=$usuarios->getEmail()?>" 
                class="form-control">
        </div>
        <div class="col-md-6">
            <label for="inputTipoUsuario" class="form-label">Categoria:</label>
            <select class="form-control" name="tipousuario" id="TipoUsuario">
                <?php 
                $tipoUsuarios= $usuarios->getTipoUsuario()->leer()['data'];
                $tipoUsuario = $usuarios->getTipoUsuario()->getidtipousuario();
                foreach ($tipoUsuarios as $tu) {
                    if ($tu["idtipoUsuario"]==$tipoUsuario) 
                            $seleccionado="selected";
                        else   
                            $seleccionado="";
                ?>
                <option <?=$seleccionado?>  value="<?=$tu['idtipoUsuario']?>"><?=$tu['Nombre']?></option>
                <?php } ?>

            </select>
            
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
    </form>
    <br><a href="?ctrl=CtrlUsuario" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</div>
</section>
