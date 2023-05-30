<h1>Roles del usuario: <?php echo $data[0]['correo']; ?></h1>
<a href="usuario.php?action=newrol&id=<?php echo $data[0]['id_usuario']; ?>" class="btn btn-success">Nuevo</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col" class="col-md-2">ID usuario</th>
      <th scope="col" class="col-md-3">Correo</th>
      <th scope="col" class="col-md-2">ID rol</th>
      <th scope="col" class="col-md-3">Rol</th>
      <th scope="col" class="col-md-2">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data_rol as $key => $rol_usuario): ?>
    <tr>
        <th scope="row"><?php echo $rol_usuario['id_usuario']; ?></th>
        <td><?php echo $rol_usuario['correo']; ?></td>
        <td><?php echo $rol_usuario['id_rol']; ?></td>
        <td><?php echo $rol_usuario['rol']; ?></td>
        <td>
            <div class="btn-group" role="group" aria-label="Menu Renglon">
              <a href="usuario.php?action=deleterol&id=<?php echo $data[0]["id_usuario"]; ?>&id_rol=<?php echo $rol_usuario["id_rol"];?>" type="button" class="btn btn-danger">Eliminar</a>
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
      <th scope="col">Se encontraron <?php echo sizeof($data_rol); ?> registros.</th>
    </tr>
</table>
