<?php require_once '../../layouts/templateUp.php'; ?>

<!--Contenido-->
<div class="row">
  <div class="col-md-6">
    <h3>Nuevo Dep&oacute;sito</h3>
  </div>
</div>
<form action="" method="post" accept-charset="utf-8">
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="usuario">Nombre</label>
        <select name="usuario" id="usuario" class="form-control selectpicker" required  data-show-subtext="true" data-live-search="true">
          <option value="">Seleccione Usuario</option>
<?php
$usuarios = $model->ShowAll( 'usuarios', ' WHERE estado = "ACTIVO" ORDER BY nombre');
foreach ( $usuarios as $value ):
  echo '                        <option value="'.$value['id'].'">'.$value['nombre'].'</option>';
endforeach;

?>
          
        </select>
      </div>
  </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="monto">Monto</label>
        <input type="number" name="monto" placeholder="monto..." class="form-control" required>
      </div>
  </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="detalle">Detalle</label>
        <input type="text" name="detalle" placeholder="detalle..." class="form-control" required>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <button type="submit" class="btn btn-primary" name="p" value="save">Guardar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
      </div>
    </div>
  </div>
</form>

                    
<?php require_once '../../layouts/templateDown.php'; ?>