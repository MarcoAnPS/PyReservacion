<!-- Main content -->
<section class="content">
    <div class="container-fluid">

    <a href="?ctrl=CtrlPedido&accion=nuevo" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> 
        Insertar Nueva Ciudad</a>
    <br><br>
    <table class="table table-head-fixed text-nowrap">
        <thead>
          <tr>
            <th>Id</th>
            <th>Numero</th>
            <th>Fecha</th>
            <th>Pago</th>
            <th>Estado</th>
            <th>Cliente</th>
            <th>Numero de Mesa</th>
            <th>Usuario</th>
            <th>Operaciones</th>
          </tr>  
        </thead>
        <tbody>
            <?php 
    if (is_array($data))
        foreach ($data as $c) { ?>
            <tr>
                <td><?=$c["idPedido"]?></td>
                <td><?=$c["Numero"]?></td>
                <td><?=$c["Fecha"]?></td>
                <td><?=$c["Pago"]?></td>
                <td><?=$c["Estado"]?></td>
                <td><?=$c["Nombre"]?></td>
                <td><?=$c["Number"]?></td>
                <td><?=$c["Nickname"]?></td>
                <td>
                <a href="?ctrl=CtrlPedido&accion=editar&idPedido=<?=$c["idPedido"]?>">
                    <i class="bi bi-pencil-square"></i> Editar </a>
                / 
                <a href="?ctrl=CtrlPedido&accion=eliminar&idPedido=<?=$c["idPedido"]?>">
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
<div>
    <p>Daymer</p>
</div>