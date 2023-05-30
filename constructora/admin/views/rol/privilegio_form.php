<h1 class="text-center">Agregar privilegio al rol:
    <?php echo $data[0]['rol']; ?>
</h1>
<form class="container-fluid" method="POST" action="rol.php?action=newprivilegio&id=<?php echo($data[0]['id_rol']); ?>">
    <div class="mb-3">
        <label class="form-label">Privilegio</label>
        <select name="data[id_privilegio]" class="form-control" required>
        <?php
            foreach ($privilegios_disponibles as $key => $privilegios): 
            $selected = " ";
            if ($privilegios['id_privilegio']==$privilegios[0]['id_privilegio']):
                $selected = " selected";
            endif;?>
        <option value="<?php echo $privilegios['id_privilegio']; ?>" <?php echo $selected; ?>><?php echo $privilegios['privilegio']; ?></option>
        <?php endforeach; ?>
        </select>
  </div>
  <div class="mb-3">
    <input type="hidden" name="data[id_rol]" value="<?php echo($data[0]['id_rol']); ?>">
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>
</form>