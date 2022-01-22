<?php 
$id     =   $_REQUEST['id'];

require_once '../../layouts/blade/head.php';
require_once '../../layouts/blade/header.php';
require_once '../../layouts/blade/aside.php';
require_once '../../layouts/blade/body_up.php';

require_once '../../config/core.class.php';
$core   =   new core;
$gasto  =   $core->ShowById( 'gastos', $id );

foreach( $gasto as $row )
{
    $documento  =   $row['num_documento'];
    $detalle    =   $row['detalle'];
    $total      =   $row['total'];
    $archivo    =   $row['archivo'];
    $fecha      =   $row['fecha_documento'];
}
?>



<!--Contenido-->
<div class="row">
  <div class="col-md-6">
    <h3>Actualiza Gasto</h3>
    <br>
  </div>
</div>

<form action="gastos.php" method="post">
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label for="documento">N° Factura</label>
        <input type="number" name="documento" class="form-control" max="9999999999" min="1"  required value="<?php echo $documento ?>">
      </div>
    </div>


    <div class="col-md-3">
      <div class="form-group"> 
        <label for="detalle">Detalle Gasto</label>
        <input type="text" name="detalle" class="form-control" required value="<?php echo $detalle ?>" title="Usa solo letras Mayusculas">
      </div>
    </div>


    <div class="col-md-3">
      <div class="form-group">
        <label for="fecha">Fecha del Documento</label>
        <input type="date" name="fecha" class="form-control" value="<?php echo $fecha ?>" required>
      </div>
    </div>


    <div class="col-md-3">
      <div class="form-group"> 
        <label for="total">Total Factura</label>
        <input type="number" name="total" class="form-control" max="9999999999" min="1" required value="<?php echo $total ?>"> 
        <input type="hidden" name="id" value="<?php echo $id ?>">
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <button type="submit" class="btn btn-primary" name="p" value="actualizar">Guardar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
      </div>
    </div>
  </div>
  
</form>
<!--Fin Contenido-->  

<?php 
require_once '../../layouts/blade/body_down.php'; 
require_once '../../layouts/blade/footer.php';
require_once '../../layouts/blade/jquery.php';
require_once '../../layouts/blade/fin.php';
?>