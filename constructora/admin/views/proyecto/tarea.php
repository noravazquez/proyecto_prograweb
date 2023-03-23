<h1>Tareas del proyecto: <?php echo $data[0]['proyecto']; ?></h1>
<a href="proyecto.php?action=newtask&id=<?php echo $data[0]['id_proyecto']; ?>" class="btn btn-success">Nuevo</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col" class="col-md-2">Id</th>
      <th scope="col" class="col-md-3">Tarea</th>
      <th scope="col" class="col-md-5">Porcentaje de avance</th>
      <th scope="col" class="col-md-2">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data_tarea as $key => $tarea): ?>
    <tr>
        <th scope="row"><?php echo $tarea['id_tarea']; ?></th>
        <td><?php echo $tarea['tarea']; ?></td>
        <td> 
          <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="<?php echo $tarea['avance']; ?>" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar" style="width: <?php echo $tarea['avance']; ?>%"><?php echo $tarea['avance']; ?>%</div>
          </div>
        </td>
        <td>
            <div class="btn-group" role="group" aria-label="Menu Renglon">
            <a href="proyecto.php?action=edittask&id=<?php echo $data[0]["id_proyecto"]; ?>&id_tarea=<?php echo $tarea["id_tarea"];?>" type="button" class="btn btn-secondary">Modificar</a>
              <a href="proyecto.php?action=deletetask&id=<?php echo $data[0]["id_proyecto"]; ?>&id_tarea=<?php echo $tarea["id_tarea"];?>" type="button" class="btn btn-danger">Eliminar</a>
            </div>
        </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
  <tr>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col">Se encontraron <?php echo sizeof($data_tarea); ?> registros.</th>
    </tr>
</table>