<?php 

header("Content-Type: application/vnd.ms-".$app."; charset=UTF-8");
header("Content-Disposition: attachment; filename=".$filename);
header("Expires: 0");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte</title>

</head>
<body>
    <h1 style="color:blue">Categorias</h1>
    <table>
        <thead>
          <tr style="color:red">
            <th>Id</th>
            <th>Nombre</th>
            <th>Descripcion</th>
          </tr>  
        </thead>
        <tbody>
            <?php 
    if (is_array($data))
        foreach ($data as $c) { ?>
            <tr>
                <td><?=$c["idCategoria"]?></td>
                <td><?=$c["Nombre"]?></td>
                <td><?=$c["Descripcion"]?></td>
            </tr>
        <?php }    ?>
        </tbody>
    </table>
</body>
</html>
    
