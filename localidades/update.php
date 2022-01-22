<?php 
$id=$_REQUEST['id']; 
require_once'../../layouts/blade/head.php';
require_once'../../layouts/blade/header.php';
require_once'../../layouts/blade/aside.php';
require_once'../../layouts/blade/body_up.php'; ?>


<div class="row">
  <div class="col-md-6">
    <h3>Actualizar Localidad</h3>
  </div>
</div>

<form action="localidades.php" method="post" accept-charset="utf-8">
       
<?php 
require_once( '../../config/core.class.php' );
$core   =   new core;
$prov   = $core->ShowById( 'localidades', $id );
while( $fila  = $prov->fetch_assoc() )
  {   ?>
 
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input type="text" name="nombre" placeholder="Nombre..." class="form-control" autofocus required value="<?php echo $fila['nombre'] ?>">
      <input type="hidden" name="id" value="<?php echo $fila['id'] ?>">
    </div>
  </div>
</div>

<?php } ?>

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
require_once'../../layouts/blade/jquery.php'; 
require_once '../../layouts/blade/fin.php';
?>