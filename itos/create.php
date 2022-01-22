<?php 

require_once '../../layouts/blade/head.php';
require_once '../../layouts/blade/header.php';
require_once '../../layouts/blade/aside.php';
require_once '../../layouts/blade/body_up.php';

?>

<!--Contenido-->
<div class="row">
  <div class="col-md-6">
    <h3>Nuevo Inspector</h3>
  </div>
</div>

<form action="itos.php" method="post" accept-charset="utf-8">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" placeholder="Nombre..." class="form-control" autofocus required>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="rut">Rut</label>
        <input type="text" name="rut" placeholder="11.111.111-1" class="form-control">
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
require_once '../../layouts/blade/body_down.php';
require_once '../../layouts/blade/footer.php';
require_once '../../layouts/blade/jquery.php';
require_once '../../layouts/blade/fin.php';

 ?>