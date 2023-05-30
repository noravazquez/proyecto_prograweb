<h1>
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>Rol
</h1>
<form class="container-fluid" method="POST" action="rol.php?action=<?php echo $action; ?>" enctype="multipart/form-data">
    <div class="mb-3">
    <label class="form-label">Rol</label>
    <input type="text" name="data[rol]" class="form-control" placeholder="Rol" value="<?php echo isset($data[0]['rol']) ? $data[0]['rol'] : ''; ?>"  required/>
  </div>
  <div class="mb-3">
    <?php if ($action == 'edit'): ?>
      <input type="hidden" name="data[id_rol]"
        value="<?php echo isset($data[0]['id_rol']) ? $data[0]['id_rol'] : ''; ?>">
    <?php endif; ?>
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>
</form>