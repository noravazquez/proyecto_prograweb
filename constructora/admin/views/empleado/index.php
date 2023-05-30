<h1>Empleados</h1>
<a href="empleado.php?action=new" class="btn btn-success">Nuevo</a>
<table>
    <thead>
        <tr>
            <th scope="col" class="col-md-1">Id empleado</th>
            <th scope="col" class="col-md-2">Nombre</th>
            <th scope="col" class="col-md-1">Primer apellido</th>
            <th scope="col" class="col-md-1">Segundo apellido</th>
            <th scope="col" class="col-md-1">Fecha nacimiento</th>
            <th scope="col" class="col-md-1">RFC</th>
            <th scope="col" class="col-md-1">CURP</th>
            <th scope="col" class="col-md-1">Foto</th>
            <th scope="col" class="col-md-1">Departamento</th>
            <th scope="col" class="col-md-2">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $key => $empleado): ?>
            <tr>
                <th scope="row"><?php echo $empleado['id_empleado']; ?></th>
                <td><?php echo $empleado['nombre']; ?></td>
                <td><?php echo $empleado['primer_apellido']; ?></td>
                <td><?php echo $empleado['segundo_apellido']; ?></td>
                <td><?php echo $empleado['fecha_nacimiento']; ?></td>
                <td><?php echo $empleado['rfc']; ?></td>
                <td><?php echo $empleado['curp']; ?></td>
                <td><?php echo $empleado['foto']; ?></td>
                <td><?php echo $empleado['departamento']; ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Menu Renglon">
                        <a class="btn btn-primary" href="empleado.php?action=edit&id=<?php echo $empleado['id_empleado']; ?>">Modificar</a>
                        <a class="btn btn-danger" href="empleado.php?action=delete&id=<?php echo $empleado['id_empleado']; ?>">Eliminar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tr>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col">Se encontraron <?php echo sizeof($data); ?> registros.</th>
    </tr>
</table>