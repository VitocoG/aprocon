<?php require_once '../../layouts/templateUp.php'; 

    $usuario    =   $depositos['usuario'];
    $monto      =   $depositos['monto'];
    $detalle    =   $depositos['detalle'];
    $fecha      =   $depositos['fecha'];
?>


<!--Contenido-->
<div class="row">
  <div class="col-md-6">
    <h3>Editar Dep&oacute;sito N°<?php echo $id ?></h3>
  </div>
</div>
<form action="" method="post" accept-charset="utf-8">
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label for="usuario">Nombre</label>
        <select name="usuario" id="usuario" class="form-control selectpicker" required  data-show-subtext="true" data-live-search="true">
          <option value="">Seleccione Usuario</option>
<?php
$usuarios = $model->ShowAll( 'usuarios', ' WHERE estado = "ACTIVO" ORDER BY nombre');
foreach ( $usuarios as $value ):
$selected   =   ( $usuario == $value['id'] ) ?   'selected'  :   '';
  echo '   <option value="'.$value['id'].'" '.$selected.'>'.$value['nombre'].'</option>';
endforeach;

?>
          
        </select>
      </div>
  </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="monto">Monto</label>
        <input type="number" name="monto" value="<?php echo $monto ?>" placeholder="monto..." class="form-control" required>
      </div>
  </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="detalle">Detalle</label>
        <input type="text" name="detalle" value="<?php echo $detalle ?>" placeholder="detalle..." class="form-control" required>
      </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="">Fecha</label>
            <input type="date" name="fecha" value="<?php echo date( 'Y-m-d', strtotime( $fecha) ) ?>" class="form-control">
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <button type="submit" class="btn btn-primary" name="p" value="update">Guardar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
        <input type="hidden" name="id" value="<?php echo $id ?>">
      </div>
    </div>
  </div>
</form>

                    
<?php require_once '../../layouts/templateDown.php'; ?>