<form action="?ctrl=CtrlReserva&accion=reservar" method="post">
<div class="input-group mb-3">
    <input type="text" name="idmesa" class="form-control" placeholder="id" value="<?=$id?>">
    
</div>
<div class="input-group mb-3">
    <input type="text" name="dni" id="dni" class="form-control" placeholder="DNI">
    <div class="input-group-append">
    <div class="input-group-text">
        <span class="fas fa-user"></span>
    </div>
    </div>
    <a href="#" id="buscarCliente">Buscar</a>
</div>
<div class="input-group mb-3">
    Cliente: <p id='cliente'>Nombre del cliente</p>
    
</div>
<div class="input-group mb-3">
    <input type="date" name="fecha" class="form-control" placeholder="Fecha">
    <div class="input-group-append">
    <div class="input-group-text">
        <span class="fas fa-lock"></span>
    </div>
    </div>
</div>
<div class="input-group mb-3">
    <input type="time" name="hora" class="form-control" placeholder="Hora">
    <div class="input-group-append">
    <div class="input-group-text">
        <span class="fas fa-lock"></span>
    </div>
    </div>
</div>
<div class="input-group mb-3">
    <input type="number" name="cantidad" class="form-control" placeholder="Cantidad">
    <div class="input-group-append">
    <div class="input-group-text">
        <span class="fas fa-lock"></span>
    </div>
    </div>
</div>
<div class="row">
    <!-- /.col -->
    <div class="col-4">
    <button type="submit" class="btn btn-primary btn-block">Reservar</button>
    </div>
    <!-- /.col -->
</div>
</form>
