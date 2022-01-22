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
            <div class="panel-heading bg-orange"><h4><strong>Datos B&aacute;sicos del Proveedor</strong></h4></div>
            <div class="panel-body">
                <form action="" method="post" autocomplete="off">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Raz&oacute;n Social</label>
                            <input type="text" name="nombre" class="form-control" required autofocus value="<?php echo $valor['nombre'] ?>">
                        </div>
                        <div class="col-md-4">
                            <label>Rut</label>
                            <input type="text" name="rut" class="form-control" required value="<?php echo $valor['rut'] ?>">
                        </div>
                        <div class="col-md-4">
                            <label>Giro</label>
                            <input type="text" name="giro" class="form-control" required value="<?php echo $valor['giro'] ?>">
                        </div>
                    </div><br>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <label>Direcci&oacute;n</label>
                            <input type="text" name="direccion" class="form-control" value="<?php echo $valor['direccion'] ?>">
                        </div>
                        <div class="col-md-4">
                            <label>Ciudad</label>
                            <input type="text" name="ciudad" class="form-control" value="<?php echo $valor['ciudad'] ?>">
                        </div>
                        <div class="col-md-4">
                            <label>Localidades</label>
                            <select name="localidad[]" class=" form-control selectpicker" multiple title="Seleccione Localidades" data-selected-text-format="values" data-actions-box="true">
<?php
$localidades    =   $model->ShowAll( 'localidades', ' ORDER BY nombre ASC');
foreach ($localidades as $value):
    $selected = ( $valor['localidad'] == $value['id'] ) ? 'selected' : '';
    echo '                      <option value="'.$value['id'].'" '.$selected.'>'.$value['nombre'].'</option>';
endforeach;
?>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-md-3">
                            <input type="hidden" name="id" value="<?php echo $valor['id'] ?>">
                            <button type="submit" name="p" value="editContacto" class="btn btn-success">
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