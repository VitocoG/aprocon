<?php 
require_once '../../layouts/blade/head.php';
require_once '../../layouts/blade/header.php';
require_once '../../layouts/blade/aside.php';
require_once '../../layouts/blade/body_up.php';

require_once '../../config/core.class.php';
$core = new core;
?>



<!--Contenido-->
<div class="row">
  <div class="col-md-6">
    <h3>Nuevo Gasto</h3>
    <br>
  </div>
</div>

<form action="gastos.php" method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label for="documento">N° Factura</label>
        <input type="number" name="documento" class="form-control" required>
      </div>
    </div>


    <div class="col-md-3">
      <div class="form-group">
        <label for="fecha">Fecha del Documento</label>
        <input type="date" name="fecha" class="form-control" value="<?php echo date('Y-m-d') ?>" required>
      </div>
    </div>

    <div class="col-md-3">
      <div class="form-group"> 
        <label for="detalle">Detalle Gasto</label>
        <input type="text" name="detalle" class="form-control" required>           
      </div>
    </div>


    <div class="col-md-3">
      <div class="form-group"> 
        <label for="total">Total Factura</label>
        <input type="number" name="total" class="form-control" required>           
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-6">
      <div class="form-group"> 
        <input type="file" name="archivo" class="form-control" required accept="application/pdf">           
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <button type="submit" class="btn btn-primary" name="p" value="nuevo">Guardar</button>
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