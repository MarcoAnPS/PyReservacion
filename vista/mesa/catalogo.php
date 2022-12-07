<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card card-solid">
    <div class="card-body pb-0 bg-info">
        <div class="row">
          <?php
        if (is_array($data)){
          foreach ($data as $d) {
            ?>
        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                    Mesa Exclusiva
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-7">
                            <h2 class="lead"><b><?=$d['Numero']?></b></h2>
                            <p class="text-muted text-sm"><b>Capacidad: </b><?=$d['Capacidad']?></p>
                            <p class="text-muted text-sm"><b>Numero de Personas: </b><?=$d['NroPersonas']?></p>
                            <h3 class="text-red"><b><?=$d['Estado']?></b></h3>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <a href="#" 
                        class="btn btn-sm btn-success reservar" role="button" data-capacidad="<?=$d['Capacidad']?>" 
                        data-nro="<?=$d['Numero']?>"  data-id="<?=$d['idMesa']?>"
                        data-toggle="modal" data-target="#modal-reserva">
                        <i class="fas fa-user"></i> Reservar</a>
                        <a href="#" class="btn btn-sm btn-primary">
                        <i class="fas fa-user"></i> Anular Reserva</a>
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

<div class="modal fade" id="modal-reserva">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-info">
                  <h4 class="modal-title">Reservar</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                
                <div class="modal-body">
                <form action="?ctrl=CtrlReserva&accion=reservar" method="post">
                  <div class="input-group mb-3">
                      <input type="text" name="idmesa" id="idMesa" class="form-control" placeholder="id">
                      
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