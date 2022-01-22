<?php 
require_once'../../layouts/blade/head.php'; 
require_once'../../layouts/blade/header.php'; 
require_once'../../layouts/blade/aside.php'; 
require_once'../../layouts/blade/body_up.php';

require_once'../../config/core.class.php';
$core   =   new core;
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
        <input type="text" class="form-control" name="codigo" required autofocus>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label for="tipo_orden">Tipo de &Oacute;rden</label>
        <select class="form-control" name="tipo_orden" id="tipo">
          <?php 

$tipo   =   $core->ShowAll( 'tipo_orden' );
foreach( $tipo as $row )
{ ?>
          <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] ?></option>
<?php } ?>

        </select>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label for="prioridad">Prioridad</label>
        <select name="prioridad" id="prioridad" class="form-control">
          <option value="">Seleccione Prioridad</option>

<?php 
$tipo   =   $core->ShowAll( 'prioridad_orden' );
foreach( $tipo as $row )
{ ?>
          <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] ?></option>
<?php } ?>
        </select>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="inicio">Inicio</label>
        <input type="datetime-local" class="form-control" name="inicio" required>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label for="termino">T&eacute;rmino</label>
        <input type="datetime-local" name="termino" class="form-control">
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label for="cierre">Cierre Ito</label>
        <input type="datetime-local" name="cierre" class="form-control">
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
$ito  =   $core->ShowAll( 'itos' );
foreach ($ito as $itos) 
{
 ?>
          <option value="<?php echo $itos['id'] ?>"><?php echo $itos['nombre'] ?></option>
<?php } ?>
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
foreach ($brigadas as $brigadas) 
{
 ?>
          <option value="<?php echo $brigadas['id'] ?>"><?php echo $brigadas['nombre'] ?></option>
<?php } ?>
        
        </select>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="actividad">Actividad</label>
        <select name="actividad" class="form-control selectpicker" required  data-show-subtext="true" data-live-search="true">
          <option value="">Seleccione Actividad</option>
<?php 
$actividad = $core->ShowAll( 'actividad' );
foreach ($actividad as $actividades)
{ ?>
          <option value="<?php echo $actividades['id'] ?>"><?php echo $actividades['nombre'] ?></option>
<?php } ?>
        </select>
      </div>
    </div>
  </div>


    

  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="localidad">Localidad</label>
        <select name="localidad" class="form-control" required>
          <!-- <option value="">Seleccione Localidad</option> -->
          <option value="4">San Fernando</option>
<?php 
//$localidad  =   $core->ShowAll( 'localidades' );
//foreach ($localidad as $localidades) 
//{
 ?>
<?php// } ?>
        
        </select>
      </div>
    </div>
    
    <div class="col-md-4">
      <div class="form-group">
        <label for="direccion">Direccion</label>
        <input type="text" name="direccion" id="direccion" class="form-control" required>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label for="descripcion">Descripci&oacute;n</label>
        <textarea  class="form-control" name="descripcion" required> </textarea>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <button type="submit" class="btn btn-primary" value="nuevo" name="p">Guardar</button>
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