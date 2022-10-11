<!-- Main content -->
<section class="content">
    <div class="container-fluid">

    <a href="?ctrl=CtrlMesa&accion=nuevo" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> 
        Insertar Nuevo Pais</a>
    <br><br>
    <table class="table table-head-fixed text-nowrap">
        <thead>
          <tr>
            <th>Id</th>
            <th>Numero</th>
            <th>Estado</th>
            <th>Capacidad</th>
            <th>NroPersonas</th>
            <th>Operaciones</th>
          </tr>  
        </thead>
        <tbody>
            <?php 
    if (is_array($data))
        foreach ($data as $c) { ?>
            <tr>
                <td><?=$c["idMesa"]?></td>
                <td><?=$c["Numero"]?></td>
                <td><?=$c["Estado"]?></td>
                <td><?=$c["Capacidad"]?></td>
                <td><?=$c["NroPersonas"]?></td>
                <td>
                <a href="?ctrl=CtrlMesa&accion=editar&idMesa=<?=$c["idMesa"]?>">
                    <i class="bi bi-pencil-square"></i> Editar </a>
                / 
                <a href="?ctrl=CtrlMesa&accion=eliminar&idMesa=<?=$c["idMesa"]?>">
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