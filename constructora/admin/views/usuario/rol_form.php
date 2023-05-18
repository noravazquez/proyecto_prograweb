<h1 class="text-center">Agregar rol al usuario:
    <?php echo $data[0]['correo']; ?>
</h1>
<form class="container-fluid" method="POST" action="usuario.php?action=newrol&id=<?php echo($data[0]['id_usuario']); ?>">
    <div class="mb-3">
        <label class="form-label">Rol</label>
        <select name="data[id_rol]" class="form-control" required>
        <?php
            foreach ($roles_disponibles as $key => $roles): 
            $selected = " ";
            if ($roles['id_rol']==$roles[0]['id_rol']):
                $selected = " selected";
            endif;?>
        <option value="<?php echo $roles['id_rol']; ?>" <?php echo $selected; ?>><?php echo $roles['rol']; ?></option>
        <?php endforeach; ?>
        </select>
  </div>
  <div class="mb-3">
    <input type="hidden" name="data[id_usuario]" value="<?php echo($data[0]['id_usuario']); ?>">
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>
</form>