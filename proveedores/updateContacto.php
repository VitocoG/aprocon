<?php

require_once '../../layouts/templateUp.php';
?>


<!--Contenido-->
<div class="row">
  <div class="col-md-6">
    <h3>Editar Proveedor</h3>
  </div>
  <div class="col-md-6"></div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading bg-orange"><h4><strong>Datos Contacto del Proveedor</strong></h4></div>
            <div class="panel-body">
                <form action="" method="post" autocomplete="off">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Nombre Contacto</label>
                            <input type="text" name="contacto" class="form-control"  autofocus value="<?php echo $valor['contacto'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label>Rut Contacto</label>
                            <input type="text" name="rutContacto" class="form-control" value="<?php echo $valor['rutContacto'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label>Tel&eacute;fono</label>
                            <input type="number" name="telefono" class="form-control" value="<?php echo $valor['telefono'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label>email</label>
                            <input type="email" name="email" class="form-control" >
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-md-3">
                            <button type="submit" name="p" value="editarBancario" class="btn btn-success">
                            <i class="fa fa-forward"> Continuar</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php require_once '../../layouts/templateDown.php'; ?>