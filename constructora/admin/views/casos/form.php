<h1>
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>Caso de exito
</h1>
<form class="container-fluid" method="POST" action="proyecto.php?action=<?php echo $action; ?>" enctype="multipart/form-data">
<form class="container-fluid" method="POST" action="casos.php?action=<?php echo $action; ?>" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label">Caso de exito</label>
      <input type="text" name="data[caso_exito]" class="form-control" placeholder="Caso de exito" value="<?php echo isset($data[0]['caso_exito']) ? $data[0]['caso_exito'] : ''; ?>"  required minlength="3" maxlength="200" />
    </div>
  <div class="mb-3">
    <label class="form-label">Descripción</label>
    <form method="post">
      <textarea id="mytextarea" name="data[descripcion]" value="<?php echo isset($data[0]['descripcion']) ? $data[0]['descripcion'] : ''; ?>"></textarea>
    </form>
  </div>
  <div class="mb-3">
    <label class="form-label">Resumen</label>
    <input type="text" name="data[resumen]" class="form-control" placeholder="Resumen" value="<?php echo isset($data[0]['resumen']) ? $data[0]['resumen'] : ''; ?>"  required minlength="3" maxlength="200" />
  </div>
  <div class="mb-3">
    <label class="form-label">Imagen</label>
    <?php if ($action == 'edit'): ?>
      <div class="alert alert-primary" role="alert">
        <a href="<?php echo $data[0]['imagen'] ?>" target = "_blank">Descargar el adjunto</a>
      </div>
    <?php endif; ?>
    <input type="file" name="data[imagen]" class="form-control" 
                value='<?php echo isset($data[0]['imagen']) ? $data[0]['imagen'] : ''; ?>' />
  </div>
  <div class="mb-3">
    <label class="form-label">Activo</label><br>
    <input type="checkbox" id="activo" name="data[activo]" value="<?php echo isset($data[0]['activo']) ? $data[0]['activo'] : ''; ?>">
    <label for="activo"> Si</label>
    <input type="checkbox" id="activo2" name="data[activo]" value="<?php echo isset($data[0]['activo']) ? $data[0]['activo'] : ''; ?>">
    <label for="activo2"> No</label>
  </div>
  <div class="mb-3">
    <?php if ($action == 'edit'): ?>
      <input type="hidden" name="data[id_caso]"
        value="<?php echo isset($data[0]['id_caso']) ? $data[0]['id_caso'] : ''; ?>">
    <?php endif; ?>
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>
</form>