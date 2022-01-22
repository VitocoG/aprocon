<?php

require_once ( '../../layouts/blade/head.php');
require_once ( '../../layouts/blade/header.php');
require_once ( '../../layouts/blade/aside.php');
require_once ( '../../layouts/blade/body_up.php');

?>


<!--Contenido-->
<div class="row">
  <div class="col-md-6">
    <h3>Nuevo Proveedor</h3>
  </div>
</div>

<form action="" method="post" accept-charset="utf-8">
  <div class="row">
    <div class="col-md-4">
        <div class="form-group">  
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="" class="form-control" placeholder="Nombre..." autofocus required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="rut">Rut</label>
            <input type="text" name="rut" id="" class="form-control" placeholder="11.111.111-1" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">                                                              
            <label for="direccion">Direcci&oacute;n</label>
            <input type="text" name="direccion" id="" class="form-control" placeholder="Nombre..." required>
        </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="giro">Giro</label>
            <input type="text" name="giro" id="" class="form-control" placeholder="Giro..." required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="telefono">Tel&eacute;fono</label>
            <input type="number" name="telefono" id="" class="form-control" placeholder="752313131">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="mail">Email</label>
            <input type="email" name="mail" id="" class="form-control" placeholder="nobre@empresa.cl">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="ciudad">Ciudad</label>
            <input type="text" name="ciudad" id="" class="form-control" placeholder="Ciudad..." required>
        </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="p" value="save">Guardar</button>
            <button type="reset" class="btn btn-danger">Cancelar</button>
        </div>
    </div>
  </div>
</form>

<?php
require_once ( '../../layouts/blade/body_down.php');
require_once ( '../../layouts/blade/footer.php');
require_once ( '../../layouts/blade/jquery.php');
require_once ( '../../layouts/blade/fin.php');
?>
