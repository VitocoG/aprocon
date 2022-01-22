<?php
require_once '../../layouts/templateUp.php';
?>

<div class="row">
    <div class="col-md-8">
        <h3>Inicio de Turno</h3>
    </div>
    <div class="col-md-4"></div>
</div>

<form action="" method="post">
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <select name="trabajador" class="form-control selectpicker"  data-live-search="true" required autofocus>
                <option value="">Trabajador</option>
<?php
$condicion  =   " AND estado = 0 AND activo = 0 ORDER BY apellido";
$trabajador =   $model->SelectByKey( 'trabajadores', 'localidad', $_SESSION['localidad'], $condicion );
foreach ($trabajador as $key ):
    echo '      <option value="'.$key['id'].'">'.$key['apellido'].' '.$key['nombre'].'</option>';
endforeach;
?>
            </select>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <input type="text" name="motivo" class="form-control" required placeholder="Motivo">
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group">
            <input type="number" name="ods" min="10100000" max="999999999" required class="form-control" placeholder="ODS">
            <span class="input-group-btn">
                <button type="submit" name="p" value="start" class="btn btn-facebook">
                    <i class="fa fa-play" aria-hidden="true"></i>
                </button>
            </span>
        </div>
    </div>
</div>
</form>

<?php
require_once '../../layouts/templateDown.php';