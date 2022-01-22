<?php

require_once '../../layouts/templateUp.php';
?>


<!--Contenido-->
<div class="row">
  <div class="col-md-6">
    <h3>Nuevo Proveedor</h3>
  </div>
  <div class="col-md-6"></div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading bg-orange"><h4><strong>Datos B&aacute;sicos del Proveedor</strong></h4></div>
            <div class="panel-body">
                <form action="" method="post" autocomplete="off">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Raz&oacute;n Social</label>
                            <input type="text" name="nombre" class="form-control" required autofocus>
                        </div>
                        <div class="col-md-4">
                            <label>Rut</label>
                            <input type="text" name="rut" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label>Giro</label>
                            <input type="text" name="giro" class="form-control" required>
                        </div>
                    </div><br>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <label>Direcci&oacute;n</label>
                            <input type="text" name="direccion" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Ciudad</label>
                            <input type="text" name="ciudad" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Localidades</label>
                            <select name="localidad[]" class=" form-control selectpicker" multiple title="Seleccione Localidades" data-selected-text-format="values" data-actions-box="true">
<?php
$localidades    =   $model->ShowAll( 'localidades', ' ORDER BY nombre ASC');
foreach ($localidades as $value):
    echo '                      <option value="'.$value['id'].'">'.$value['nombre'].'</option>';
endforeach;
?>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-md-3">
                            <button type="submit" name="p" value="contacto" class="btn btn-success">
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