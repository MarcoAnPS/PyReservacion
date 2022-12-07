<?php 
 $dataCSS =
      array ('cssGbl'=> Libreria::cssGlobales()
    );
    $dataJS = 
      array('jsGbl'=>Libreria::jsGlobales(),
          'msg'=>$datos['msg']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$titulo?></title>
    <?php echo Vista::mostrar('./plantilla/css.php',$datos,true); ?>
    <style>
      .contenido1{
        margin: 10px;
      }
      .card{
        margin-left:30px;
        margin-right:30px;
      }
    </style>
</head>
<body class="hold-transition sidebar-collapse">
    <?php echo Vista::mostrar('./plantilla/nav.php',$datos,true); ?>
    <?php echo Vista::mostrar('./plantilla/aside.php',$datos,true); ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php echo Vista::mostrar('./plantilla/wrapper.php',$datos,true); ?>
    <div class="card">
      <div class="contenido1">
        <?php echo $contenido; ?>
      </div>
    </div>
  </div>

    <?php echo Vista::mostrar('./plantilla/footer.php',$datos,true); ?>
    <?php echo Vista::mostrar('./plantilla/js.php',$datos,true);
    if (isset($grafico))
      echo Vista::mostrar('./plantilla/jsEstadisticas.php',$grafico,true);
    if (isset($grafico))
      echo Vista::mostrar('./plantilla/jsEstadisticas.php',$grafico,true);
      if (isset($grafico1))
      echo Vista::mostrar('./plantilla/jsEstadisticas1.php',$grafico1,true);
     // var_dump($js);exit();
     if (isset($js))
     foreach ($js as $j) { ?>
       <script src="<?=$j['url']?>"></script>
    <?php }
    ?>
</body>
</html>