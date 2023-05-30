<h1>Casos de exito</h1>
<a href="casos.php?action=new" class="btn btn-success">Nuevo</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col" class="col-md-2">Caso de exito</th>
      <th scope="col" class="col-md-2">Descripción</th>
      <th scope="col" class="col-md-2">Resumen</th>
      <th scope="col" class="col-md-2">Imagen</th>
      <th scope="col" class="col-md-2">Activo</th>
      <th scope="col" class="col-md-2">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $key => $caso): 
      if (!file_exists($caso['imagen'])) {
        $caso['imagen']="images/default-image.png";
      }  
    ?>
    <tr>
        <td><?php echo $caso['caso_exito']; ?></td>
        <td><?php echo $caso['descripcion']; ?></td>
        <td><?php echo $caso['resumen']; ?></td>
        <td><img src="<?php echo $caso['imagen']; ?>" alt="" width="80%"></td>
        <td><?php echo $caso["activo"]; ?></td>
        <td>
            <div class="btn-group" role="group" aria-label="Menu Renglon">
                <a class="btn btn-primary" href="casos.php?action=edit&id=<?php echo $caso['id_caso']?>">Modificar</a>
                <a class="btn btn-danger" href="casos.php?action=delete&id=<?php echo $caso['id_caso']?>">Eliminar</a>
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
      <th scope="col">Se encontraron <?php echo sizeof($data); ?> registros.</th>
    </tr>
</table>