<?php 
$id     =   $_REQUEST['id'];

require_once'../../layouts/blade/head.php'; 
require_once'../../layouts/blade/header.php'; 
require_once'../../layouts/blade/aside.php'; 
require_once'../../layouts/blade/body_up.php';

require_once'../../config/core.class.php';
$core   =   new core;

$ods    =   $core->ShowById( 'ODS', $id);
foreach ($ods as $value)
{
  $codigo     =   $value['codigo'];
  $inicio     =   $value['horaInicio'];
  $termino    =   $value['horaTermino'];
  $cierre     =   $value['cierre'];
  $ito        =   $value['ito'];
  $brigada    =   $value['brigada'];
  $actividad  =   $value['actividad'];
  $localidad  =   $value['localidad'];
  $direccion  =   $value['direccion'];
  $descripcion=   $value['descripcion'];
  $tipo       =   $value['tipo_orden'];
  $prioridad  =   $value['prioridad_orden'];
}

$fechaInicio  =   explode( " ", $inicio );  
$fechaCierre  =   explode( " ", $termino );  
$fechaIto     =   explode( " ", $cierre );  

?>

                    
<!--Contenido-->
<div class="row">
  <div class="col-md-6">
    <h3>Nueva ODS</h3>
  </div>
</div>

<form action="ods.php" method="post" accept-charset="utf-8">
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="codigo">C&oacute;digo</label>
        <input type="text" class="form-control" name="codigo" required value="<?php echo $codigo ?>">
        <input type="hidden" name="id" value="<?php echo $id ?>">
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label for="tipo_orden">Tipo de &Oacute;rden</label>
        <select class="form-control" name="tipo_orden" id="tipo">
          <?php 

$tipos   =   $core->ShowAll( 'tipo_orden' );
foreach( $tipos as $row )
{ 
  $selected   = ( $tipo == $row['id'] ) ? 'selected':'';
  echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>';
 } ?>

        </select>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label for="prioridad">Prioridad</label>
        <select name="prioridad" id="prioridad" class="form-control">
          <option value="">Seleccione Prioridad</option>

<?php 
$prioridades   =   $core->ShowAll( 'prioridad_orden' );

foreach( $prioridades as $row )
{ 
  $selected   = ( $prioridad == $row['id'] ) ? 'selected':'';
  echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>';
 } ?>
        </select>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="inicio">Inicio</label>
        <input type="datetime-local" class="form-control" name="inicio" required value="<?php echo $fechaInicio[0].'T'.$fechaInicio[1]; ?>">
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label for="termino">T&eacute;rmino</label>
        <input type="datetime-local" name="termino" class="form-control"  value="<?php echo $fechaCierre[0].'T'.$fechaCierre[1]; ?>">
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label for="cierre">Cierre Ito</label>
        <input type="datetime-local" name="cierre" class="form-control" value="<?php echo $fechaIto[0].'T'.$fechaIto[1]; ?>">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="ito">ITO</label>
        <select name="ito" id="ito" class="form-control" required>
          <option value="">Seleccione ITO</option>
<?php 
$itos  =   $core->ShowAll( 'itos' );
foreach ($itos as $row) 
{ 
  $selected   = ( $ito == $row['id'] ) ? 'selected':'';
  echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>';
 } ?>
        </select>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label for="brigada">Brigada</label>
        <select name="brigada" class="form-control" required>
          <option value="">Seleccione Brigada</option>
<?php 
$brigadas  =   $core->ShowAll( 'brigadas' );
foreach ($brigadas as $row) 
{ 
  $selected   = ( $brigada == $row['id'] ) ? 'selected':'';
  echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>';
 } ?>
        
        </select>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="actividad">Actividad</label>
        <select name="actividad" class="form-control selectpicker" required  data-show-subtext="true" data-live-search="true">
          <option value="">Seleccione Actividad</option>
<?php 
$actividades = $core->ShowAll( 'actividad' );
foreach ($actividades as $row)
{ 
  $selected   = ( $actividad == $row['id'] ) ? 'selected':'';
  echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>';
 } ?>
        </select>
      </div>
    </div>
  </div>


    

  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="localidad">Localidad</label>
        <select name="localidad" class="form-control" required>
          <option value="4">San Fernando</option>
<?php 
//$localidades  =   $core->ShowAll( 'localidades' );
//foreach ($localidades as $row) 
//{ 
  //$selected   = ( $localidad == $row['id'] ) ? 'selected':'';
  //echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>';
 //} ?>
        
        </select>
      </div>
    </div>
    
    <div class="col-md-4">
      <div class="form-group">
        <label for="direccion">Direccion</label>
        <input type="text" name="direccion" id="direccion" class="form-control" required value="<?php echo $direccion ?>">
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label for="descripcion">Descripci&oacute;n</label>
        <textarea  class="form-control" name="descripcion" required><?php echo $descripcion ?></textarea>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <button type="submit" class="btn btn-primary" value="actualizar" name="p">Guardar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
      </div>
    </div>
  </div>
</form>

<?php 
require_once'../../layouts/blade/body_down.php'; 
require_once'../../layouts/blade/footer.php'; 
?>

<!-- jQuery 2.1.4 -->
<script src="../../public/js/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="../../public/js/bootstrap.min.js"></script> -->
<script src="../../public/js/bootstrap-select.min.js"></script>
<!-- AdminLTE App -->
<script src="../../public/js/app.min.js"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(document).ready( function()
{
  if($("#tipo").val()==2)
  {
     $('#prioridad').prop('disabled', 'disabled');
  }
});


$("#tipo").change(function() {
      if($("#tipo").val() == "1"){
        $('#prioridad').prop('disabled', false);
      }else{
        $('#prioridad').prop('disabled', 'disabled');
      }
    });
</script>

<?php
require_once'../../layouts/blade/fin.php';
?>