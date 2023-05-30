<h1>
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>Proyecto
</h1>
<form class="container-fluid" method="POST" action="proyecto.php?action=<?php echo $action; ?>" enctype="multipart/form-data">
    <div class="mb-3">
    <label class="form-label">Nombre del proyecto</label>
    <input type="text" name="data[proyecto]" class="form-control" placeholder="Proyecto" value="<?php echo isset($data[0]['proyecto']) ? $data[0]['proyecto'] : ''; ?>"  required minlength="3" maxlength="200" />
  </div>
  <div class="mb-3">
    <label class="form-label">Descripción</label>
    <input type="text" name="data[descripcion]" class="form-control" placeholder="Descripción del proyecto" value="<?php echo isset($data[0]['descripcion']) ? $data[0]['descripcion'] : ''; ?>"  required minlength="3" maxlength="200" />
  </div>
  <div class="mb-3">
    <label class="form-label">Fecha inicial</label>
    <input type="date" name="data[fecha_inicio]" class="form-control" placeholder="Fecha de inicio" value="<?php echo isset($data[0]['fecha_inicio']) ? $data[0]['fecha_inicio'] : ''; ?>"  required minlength="3" maxlength="200" />
  </div>
  <div class="mb-3">
    <label class="form-label">Fecha final</label>
    <input type="date" name="data[fecha_fin]" class="form-control" placeholder="Fecha de fin" value="<?php echo isset($data[0]['fecha_fin']) ? $data[0]['fecha_fin'] : ''; ?>"  required minlength="3" maxlength="200" />
  </div>
  <div class="mb-3">
    <label class="form-label">Departamento</label>
    <select name="data[id_departamento]" class="form-control" required>
      <?php
        foreach ($datadepartamentos as $key => $depto): 
          $selected = " ";
          if ($depto['id_departamento']==$data[0]['id_departamento']):
            $selected = " selected";
          endif;?>
      <option value="<?php echo $depto['id_departamento']; ?>" <?php echo $selected; ?>><?php echo $depto['departamento']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Archivo adjunto</label>
    <?php if ($action == 'edit'): ?>
      <div class="alert alert-primary" role="alert">
        <a href="<?php echo $data[0]['archivo'] ?>" target = "_blank">Descargar el adjunto</a>
      </div>
    <?php endif; ?>
    <input type="file" name="archivo" class="form-control" 
                value='<?php echo isset($data[0]['archivo']) ? $data[0]['archivo'] : ''; ?>' />
  </div>
  <div class="mb-3">
    <?php if ($action == 'edit'): ?>
      <input type="hidden" name="data[id_proyecto]"
        value="<?php echo isset($data[0]['id_proyecto']) ? $data[0]['id_proyecto'] : ''; ?>">
    <?php endif; ?>
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>
</form>