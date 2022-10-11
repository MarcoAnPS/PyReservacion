<!-- Main content -->
<section class="content">
    <div class="container-fluid">

    <a href="?ctrl=CtrlCliente&accion=nuevo" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> 
        Insertar Nueva Ciudad</a>
    <br><br>
    <table class="table table-head-fixed text-nowrap">
        <thead>
          <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>DNI</th>
            <th>Telefono</th>
            <th>Direccion</th>
            <th>Email</th>
            <th>Usuario</th>
            <th>Operaciones</th>
          </tr>  
        </thead>
        <tbody>
            <?php 
    if (is_array($data))
        foreach ($data as $c) { ?>
            <tr>
                <td><?=$c["idCliente"]?></td>
                <td><?=$c["Nombre"]?></td>
                <td><?=$c["Apellido"]?></td>
                <td><?=$c["DNI"]?></td>
                <td><?=$c["Telefono"]?></td>
                <td><?=$c["Direccion"]?></td>
                <td><?=$c["Email"]?></td>
                <td><?=$c["Nickname"]?></td>
                <td>
                <a href="?ctrl=CtrlCliente&accion=editar&idCliente=<?=$c["idCliente"]?>">
                    <i class="bi bi-pencil-square"></i> Editar </a>
                / 
                <a href="?ctrl=CtrlCliente&accion=eliminar&idCliente=<?=$c["idCliente"]?>">
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