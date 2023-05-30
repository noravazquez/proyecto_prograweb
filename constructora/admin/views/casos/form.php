<h1>
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>Caso de exito
</h1>
<form class="container-fluid" method="POST" action="casos.php?action=<?php echo $action; ?>" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label">Caso de exito</label>
      <input type="text" name="data[caso_exito]" class="form-control" placeholder="Caso de exito" value="<?php echo isset($data[0]['caso_exito']) ? $data[0]['caso_exito'] : ''; ?>"  required minlength="3" maxlength="200" />
    </div>

    <div class="mb-3">
      <label class="form-label">Descripción</label>
      <textarea name="data[descripcion]" id="mytextarea"><?php echo isset($data[0]['descripcion']) ? $data[0]['descripcion'] : ''; ?></textarea>
    </div>
    
    <div class="mb-3">
      <label class="form-label">Resumen</label>
      <input type="text" name="data[resumen]" class="form-control" placeholder="Resumen" value="<?php echo isset($data[0]['resumen']) ? $data[0]['resumen'] : ''; ?>"  required minlength="3" maxlength="200" />
    </div>

    <div class="mb-3">
      <label class="form-label">Imagen</label>
      <input type="file" class="form-control" name="imagen" />
    </div>

    <div class="mb-3">
      <label for="activo">Activo</label>
      <input type="checkbox" name="activo" value="1" <?php if (!empty($data) && $data[0]['activo'] == 1) echo "checked"; ?>>
    </div>
  
    <div class="mb-3">
      <?php if ($action == 'edit'): ?>
        <input type="hidden" name="data[id_caso]" value="<?php echo isset($data[0]['id_caso']) ? $data[0]['id_caso'] : ''; ?>">
      <?php endif; ?>
      <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
    </div>
</form>

<script>
    var descripcion = "<?php echo isset($data[0]['descripcion']) ? $data[0]['descripcion'] : ''; ?>";
    if (tinymce.get('mytextarea')) {
      tinymce.get('mytextarea').setContent(descripcion);
    }
</script>