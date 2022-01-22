<?php 
require_once'../../layouts/blade/head.php'; 
require_once'../../layouts/blade/header.php'; 
require_once'../../layouts/blade/aside.php'; 
require_once'../../layouts/blade/body_up.php';

require_once'../../config/core.class.php';
$core   =   new core;

$id       =   $_REQUEST['id'];
$mostrar  =   $core->ShowById( 'ODS', $id );
foreach( $mostrar as $row )
{
  $codigo             =   $row['codigo'];
  $horaInicio         =   $row['horaInicio'];
  $horaTermino        =   $row['horaTermino'];
  $cierre             =   $row['cierre'];
  $descripcion        =   $row['descripcion'];
  $ito                =   $row['ito'];
  $actividad          =   $row['actividad'];
  $brigada            =   $row['brigada'];
  $direccion          =   $row['direccion'];
  $localidad          =   $row['localidad'];
  $tipo_orden         =   $row['tipo_orden'];
  $prioridad_orden    =   $row['prioridad_orden'];
}

$fechaInicio  =   explode( " ", $horaInicio );  
$fechaCierre  =   explode( " ", $horaTermino );  
$fechaIto     =   explode( " ", $cierre ); 
?>

                    
<!--Contenido-->
<div class="row">
  <div class="col-md-6">
    <h3>Nueva ODS</h3>
  </div>
</div>


  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="codigo">C&oacute;digo</label>
        <input type="text" class="form-control" value="<?php echo $codigo ?>" disabled>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label for="tipo">Tipo de &Oacute;rden</label>
<?php 
$tipo   =   $core->ShowById( 'tipo_orden', $tipo_orden );
foreach( $tipo as $row )
{
  echo '
        <input type="text" class="form-control" value="'.$row['nombre'].'" disabled>
  ';
}
?>        
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label for="prioridad">Prioridad</label>
<?php 
$prioridad   =   $core->ShowById( 'prioridad_orden', $prioridad_orden );
foreach( $prioridad as $row )
{
  echo '
        <input type="text" class="form-control" value="'.$row['nombre'].'" disabled>
  ';
}
?>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="inicio">Inicio</label>
        <input type="datetime-local" class="form-control" value="<?php echo $fechaInicio[0].'T'.$fechaInicio[1] ?>" disabled>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label for="termino">T&eacute;rmino</label>
        <input type="datetime-local" value="<?php echo $fechaCierre[0].'T'.$fechaCierre[1] ?>" class="form-control" disabled>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label for="cierre">Cierre Ito</label>
        <input type="datetime-local" value="<?php echo $fechaIto[0].'T'.$fechaIto[1] ?>" class="form-control" disabled>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="ito">ITO</label>
<?php 
$itos   =   $core->ShowById( 'itos', $ito );
foreach( $itos as $row )
{
  echo '
        <input type="text" class="form-control" value="'.$row['nombre'].'" disabled>
  ';
}
?>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label for="brigada">Brigada</label>
<?php 
$brigadas   =   $core->ShowById( 'brigadas', $brigada );
foreach( $brigadas as $row )
{
  echo '
        <input type="text" class="form-control" value="'.$row['nombre'].'" disabled>
  ';
}
?>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="actividad">Actividad</label>
<?php 
$actividades   =   $core->ShowById( 'actividad', $actividad );
foreach( $actividades as $row )
{
  echo '
        <input type="text" class="form-control" value="'.$row['nombre'].'" disabled>
  ';
}
?>
          
      </div>
    </div>
  </div>


    

  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="localidad">Localidad</label>
<?php 
$localidades   =   $core->ShowById( 'localidades', $localidad );
foreach( $localidades as $row )
{
  echo '
        <input type="text" class="form-control" value="'.$row['nombre'].'" disabled>
  ';
}
?>
<?php 
//$localidad  =   $core->ShowAll( 'localidades' );
//foreach ($localidad as $localidades) 
//{
 ?>
<?php// } ?>
      </div>
    </div>
    
    <div class="col-md-4">
      <div class="form-group">
        <label for="direccion">Direccion</label>
        <input type="text" value="<?php echo $direccion ?>" class="form-control" disabled>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label for="descripcion">Descripci&oacute;n</label>
        <textarea  class="form-control"  disabled><?php echo $descripcion ?> </textarea>
      </div>
    </div>
  </div>


<?php 
require_once'../../layouts/blade/body_down.php'; 
require_once'../../layouts/blade/footer.php'; 
require_once'../../layouts/blade/jquery.php';
require_once'../../layouts/blade/fin.php';
?>