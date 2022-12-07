<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row">
        <?php
            if (is_array($productos)){
            foreach ($productos as $d) {
                ?>
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                    Producto exclusivo
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                    <div class="col-7">
                        <h2 class="lead"><b><?=$d['Nombre']?></b></h2>
                        <p class="text-muted text-sm"><b>Descripcion: </b><?=$d['Descripcion']?></p>
                        <p class="text-muted text-sm"><b>Cantidad: </b><?=$d['Cantidad']?></p>
                        
                        <h3 class="text-red">S/ <?=number_format($d['Pu'], 2, ',', ' ');?></h3>
                    </div>
                    <div class="col-5 text-center">
                        <?php 
                            $img = (!is_null($d['url']))?$d['url']:'SIN_IMAGEN.jpg';
                        ?>
                        <img src="recursos/images/<?=$img?>" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                    
                    <a href="?ctrl=CtrlProducto&accion=verDetalles&idProducto=<?=$d['idProducto']?>" class="btn btn-sm btn-success">
                        <i class="fas fa-user"></i> Ver detalles
                    </a>
                    <a href="#" class="btn btn-sm btn-primary" 
                    role="button" data-toggle="modal" data-target="#modal-pedido" 
                    data-id="<?=$d['idProducto']?>">
                        <i class="fas fa-user"></i> Añadir a Pedido
                    </a>
                    </div>
                </div>
                </div>
            </div>
        <?php
            }  
            }else{
                echo "no hay productos";
            }
        ?>

            </div>
        </div>
    </div>
    
</section>

<div class="modal fade" id="modal-pedido">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-info">
                  <h4 class="modal-title">Pedido</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                
                <div class="modal-body">
                <form action="?ctrl=CtrlCarrito&accion=agregar" method="post">
                <table class="table table-head-fixed text-nowrap table-info">
                    <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Descripcion</th>
                        <th>Cantidad</th>
                        <th>Pu</th>
                    </tr>  
                    </thead>
                    <tbody>
                        <tr>
                            <td><?=$d['Nombre']?></td>
                            <td><?=$d['Descripcion']?></td>
                            <td><?=$d['Cantidad']?></td>
                            <td><?=$d['Pu']?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="input-group mb-3">
                    <div class="input-group mb-3">
                      <input type="text" name="idProducto" id="idProducto" class="form-control" placeholder="id">
                      
                    </div>
                    <h4>Seleccione una mesa</h4>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <?php if (is_array($mesas)) {
                            foreach ($mesas as $m) { ?>
                                <label class="btn btn-default text-center active">
                                    <input type="radio" name="idMesa" id="idMesa" autocomplete="off"  value="<?=$m['idMesa']?>">
                                    Mesa <?=$m['Numero']?>
                                    <br>
                                    <i class="fas fa-circle fa-2x text-green"></i>
                                </label>
                        <?php }
                        } ?>
                    </div>
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

                </div>

                <div class="modal-footer bg-info">
                  Po
                </div>
                <!-- /.social-auth-links -->
              </div>
            </div>
          </div>
<!-- /.modal-content -->