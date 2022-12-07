<!-- Main content -->
<section class="content">
    <div class="container-fluid">

    <a href="?ctrl=CtrlTipoUsuario&accion=nuevo" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> 
        Insertar Nuevo Pais</a>
    <br><br>
    <table class="table table-head-fixed text-nowrap">
        <thead>
          <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Operaciones</th>
          </tr>  
        </thead>
        <tbody>
            <?php 
    if (is_array($data))
        foreach ($data as $c) { ?>
            <tr>
                <td><?=$c["idtipoUsuario"]?></td>
                <td><?=$c["Nombre"]?></td>
                <td>
                <a href="?ctrl=CtrlTipoUsuario&accion=editar&idtipoUsuario=<?=$c["idtipoUsuario"]?>">
                    <i class="bi bi-pencil-square"></i> Editar </a>
                / 
                <a href="?ctrl=CtrlTipoUsuario&accion=eliminar&idtipoUsuario=<?=$c["idtipoUsuario"]?>">
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