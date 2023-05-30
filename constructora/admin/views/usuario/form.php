<h1>
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>Usuario
</h1>
<form class="container-fluid" method="POST" action="usuario.php?action=<?php echo $action; ?>" enctype="multipart/form-data">
    <div class="mb-3">
    <label class="form-label">Correo</label>
    <input type="email" name="data[correo]" class="form-control" placeholder="Correo" value="<?php echo isset($data[0]['correo']) ? $data[0]['correo'] : ''; ?>"  required/>
  </div>
  <div class="mb-3">
    <label class="form-label">Contraseña</label>
    <input type="password" name="data[contrasena]" class="form-control" placeholder="Contraseña" value="<?php echo isset($data[0]['contrasena']) ? $data[0]['contrasena'] : ''; ?>"  required minlength="3" maxlength="20" />
  </div>
  <div class="mb-3">
    <?php if ($action == 'edit'): ?>
      <input type="hidden" name="data[id_usuario]"
        value="<?php echo isset($data[0]['id_usuario']) ? $data[0]['id_usuario'] : ''; ?>">
    <?php endif; ?>
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>
</form>