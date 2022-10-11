<!-- Main content -->
<section class="content">
    <div class="container-fluid">

    <a href="?ctrl=CtrlReserva&accion=nuevo" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> 
        Insertar Nueva Ciudad</a>
    <br><br>
    <table class="table table-head-fixed text-nowrap">
        <thead>
          <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Cliente</th>
            <th>Mesa</th>
            <th>Operaciones</th>
          </tr>  
        </thead>
        <tbody>
            <?php 
    if (is_array($data))
        foreach ($data as $c) { ?>
            <tr>
                <td><?=$c["idReserva"]?></td>
                <td><?=$c["Fecha"]?></td>
                <td><?=$c["Estado"]?></td>
                <td><?=$c["Nombre"]?></td>
                <td><?=$c["Numero"]?></td>
                <td>
                <a href="?ctrl=CtrlReserva&accion=editar&idReserva=<?=$c["idReserva"]?>">
                    <i class="bi bi-pencil-square"></i> Editar </a>
                / 
                <a href="?ctrl=CtrlReserva&accion=eliminar&idReserva=<?=$c["idReserva"]?>">
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