<!-- Main content -->
<section class="content">
    <div class="container-fluid">

    <a href="?ctrl=CtrlProducto&accion=nuevo" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> 
        Insertar Nueva Ciudad</a>
    <br><br>
    <table class="table table-head-fixed text-nowrap">
        <thead>
          <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Costo</th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Categoria</th>
            <th>Usuario</th>
            <th>Operaciones</th>
          </tr>  
        </thead>
        <tbody>
            <?php 
    if (is_array($data))
        foreach ($data as $c) { ?>
            <tr>
                <td><?=$c["idProducto"]?></td>
                <td><?=$c["Nombre"]?></td>
                <td><?=$c["Descripcion"]?></td>
                <td><?=$c["Cantidad"]?></td>
                <td><?=$c["Costo"]?></td>
                <td><?=$c["Precio"]?></td>
                <td><?=$c["Estado"]?></td>
                <td><?=$c["name"]?></td>
                <td><?=$c["Nickname"]?></td>
                <td>
                <a href="?ctrl=CtrlProducto&accion=editar&idProducto=<?=$c["idProducto"]?>">
                    <i class="bi bi-pencil-square"></i> Editar </a>
                / 
                <a href="?ctrl=CtrlProducto&accion=eliminar&idProducto=<?=$c["idProducto"]?>">
                    <i class="bi bi-trash"></i> Eliminar </a>
                </td>
            </tr>
        <?php }    ?>
        </tbody>
    </table>
    <br><a href="?" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
    </div>
</section>