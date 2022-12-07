<section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none">LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3>
              <div class="col-12">
                <?php 
                    $imagen= (is_array($imagenes['data']))?$imagenes['data'][0]['url']:'SIN_IMAGEN.jpg' ;
                ?>
                <img src="recursos/images/mesas/<?=$imagen?>" class="mesa-image" alt="Mesa Image">
              </div>
              <div class="col-12 mesa-image-thumbs">
                <?php 
                    if(is_array($imagenes['data']))
                    foreach ($imagenes['data'] as $img) { ?>
                <div class="mesa-image-thumb active"><img src="recursos/images/mesas/<?=$img['url']?>" alt="Mesa Image"></div>           
                <?php 
                    }
                ?>    
             </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3"><?=$data[0]['Numero']?></h3>
                <p><?=$data[0]['Capacidad']?>
                </p>
                
              <hr>
              <h4>Numero de Personas: <?=$data[0]['NroPersonas']?></h4>
              <h4>Estado: <?=$data[0]['Estado']?></h4>
              <hr>
              <div class="row">
                <div class="col-md-6">
                    <div class="bg-gray py-2 px-3 mt-4">
                        <h2 class="mb-0">
                        S/ <?=number_format($data[0]['Costo'], 2, ',', ' ')?>
                        </h2>
                        <h4 class="mt-0">
                        <small>Ex Tax: $80.00 </small>
                        </h4>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-gray py-2 px-3 mt-4">
                        <h2 class="mb-0">
                          <?= $data[0]['Cantidad']?> Unidades disponibles
                        </h2>
                        
                    </div>
                </div>
              </div>

              <div class="mt-4">
                <div class="btn btn-primary btn-lg btn-flat">
                  <i class="fas fa-cart-plus fa-lg mr-2"></i>
                  Agregar al carrito
                </div>

                <div class="btn btn-default btn-lg btn-flat">
                  <i class="fas fa-heart fa-lg mr-2"></i>
                  Añadir a favoritos
                </div>
              </div>

              <div class="mt-4 mesa-share">
                <a href="#" class="text-gray">
                  <i class="fab fa-facebook-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fab fa-twitter-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fas fa-envelope-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fas fa-rss-square fa-2x"></i>
                </a>
              </div>

            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->